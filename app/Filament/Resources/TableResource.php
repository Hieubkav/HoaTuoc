<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableResource\Pages;
use App\Models\Table as TableModel;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TableResource extends Resource
{
    protected static ?string $model = TableModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Quản lý bàn';

    protected static ?string $modelLabel = 'bàn';

    protected static ?string $pluralModelLabel = 'bàn';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Quản lý phòng bàn';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin bàn')
                    ->schema([
                        Forms\Components\Select::make('room_id')
                            ->label('Phòng')
                            ->options(Room::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->label('Tên bàn')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('seats')
                            ->label('Số chỗ ngồi')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'available' => 'Trống',
                                'occupied' => 'Có khách',
                                'reserved' => 'Đã đặt',
                                'maintenance' => 'Bảo trì'
                            ])
                            ->default('available')
                            ->required()
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room.name')
                    ->label('Phòng')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên bàn')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('seats')
                    ->label('Số chỗ ngồi')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'available' => 'Trống',
                        'occupied' => 'Có khách',
                        'reserved' => 'Đã đặt',
                        'maintenance' => 'Bảo trì'
                    ])
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('room_id')
                    ->label('Phòng')
                    ->options(Room::all()->pluck('name', 'id'))
                    ->searchable(),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'available' => 'Trống',
                        'occupied' => 'Có khách', 
                        'reserved' => 'Đã đặt',
                        'maintenance' => 'Bảo trì'
                    ]),
                Tables\Filters\Filter::make('seats')
                    ->form([
                        Forms\Components\TextInput::make('seats_from')
                            ->label('Số chỗ từ')
                            ->numeric(),
                        Forms\Components\TextInput::make('seats_until')
                            ->label('Số chỗ đến')
                            ->numeric()
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['seats_from'],
                                fn (Builder $query, $value): Builder => $query->where('seats', '>=', $value)
                            )
                            ->when(
                                $data['seats_until'],
                                fn (Builder $query, $value): Builder => $query->where('seats', '<=', $value)
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'edit' => Pages\EditTable::route('/{record}/edit')
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
