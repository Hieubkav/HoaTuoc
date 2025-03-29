<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Quản lý phòng';

    protected static ?string $modelLabel = 'phòng';

    protected static ?string $pluralModelLabel = 'phòng';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Quản lý phòng bàn';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên phòng')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('operating_hours')
                            ->label('Giờ hoạt động')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('capacity')
                            ->label('Sức chứa')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('is_vip')
                            ->label('Phòng VIP')
                            ->default(false)
                    ])->columns(2),
                
                Forms\Components\Section::make('Dịch vụ 1-3')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('service_name_1')
                                    ->label('Tên dịch vụ 1')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('service_description_1')
                                    ->label('Mô tả dịch vụ 1')
                                    ->maxLength(65535),
                                Forms\Components\TextInput::make('service_name_2')
                                    ->label('Tên dịch vụ 2')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('service_description_2')
                                    ->label('Mô tả dịch vụ 2')
                                    ->maxLength(65535),
                                Forms\Components\TextInput::make('service_name_3')
                                    ->label('Tên dịch vụ 3')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('service_description_3')
                                    ->label('Mô tả dịch vụ 3')
                                    ->maxLength(65535)
                            ])
                    ])->collapsible(),

                Forms\Components\Section::make('Dịch vụ 4-6')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('service_name_4')
                                    ->label('Tên dịch vụ 4')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('service_description_4')
                                    ->label('Mô tả dịch vụ 4')
                                    ->maxLength(65535),
                                Forms\Components\TextInput::make('service_name_5')
                                    ->label('Tên dịch vụ 5')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('service_description_5')
                                    ->label('Mô tả dịch vụ 5')
                                    ->maxLength(65535),
                                Forms\Components\TextInput::make('service_name_6')
                                    ->label('Tên dịch vụ 6')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('service_description_6')
                                    ->label('Mô tả dịch vụ 6')
                                    ->maxLength(65535)
                            ])
                    ])->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên phòng')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Sức chứa')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_vip')
                    ->label('VIP')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('operating_hours')
                    ->label('Giờ hoạt động')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('is_vip')
                    ->label('Loại phòng')
                    ->options([
                        '1' => 'Phòng VIP',
                        '0' => 'Phòng thường'
                    ]),
                Tables\Filters\Filter::make('capacity')
                    ->form([
                        Forms\Components\TextInput::make('capacity_from')
                            ->label('Sức chứa từ')
                            ->numeric(),
                        Forms\Components\TextInput::make('capacity_until')
                            ->label('Sức chứa đến')  
                            ->numeric()
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['capacity_from'],
                                fn (Builder $query, $date): Builder => $query->where('capacity', '>=', $date)
                            )
                            ->when(
                                $data['capacity_until'],
                                fn (Builder $query, $date): Builder => $query->where('capacity', '<=', $date)
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make()
                ])
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\RoomImagesRelationManager::class,
            RelationManagers\TablesRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit')
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class
            ]);
    }
}
