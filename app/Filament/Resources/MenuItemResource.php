<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    
    protected static ?string $navigationLabel = 'Quản lý Menu';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'label')
                    ->label('Menu cha')
                    ->searchable()
                    ->placeholder('Chọn menu cha nếu có'),
                    
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->label('Tên menu'),

                Forms\Components\Select::make('type')
                    ->required()
                    ->options([
                        MenuItem::TYPE_LINK => 'Liên kết',
                        MenuItem::TYPE_CATEGORY => 'Danh mục',
                        MenuItem::TYPE_PAGE => 'Trang',
                    ])
                    ->default(MenuItem::TYPE_LINK)
                    ->reactive()
                    ->label('Loại menu'),

                Forms\Components\TextInput::make('link')
                    ->required()
                    ->maxLength(255)
                    ->label('Đường dẫn')
                    ->visible(fn ($get) => $get('type') === MenuItem::TYPE_LINK),

                Forms\Components\Select::make('target_id')
                    ->label('Nội dung liên kết')
                    ->searchable()
                    ->relationship('target', 'name')
                    ->visible(fn ($get) => in_array($get('type'), [MenuItem::TYPE_CATEGORY, MenuItem::TYPE_PAGE])),

                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->label('Thứ tự'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Tên menu')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('type')
                    ->label('Loại')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        MenuItem::TYPE_LINK => 'Liên kết',
                        MenuItem::TYPE_CATEGORY => 'Danh mục',
                        MenuItem::TYPE_PAGE => 'Trang',
                        default => 'Không xác định'
                    }),

                Tables\Columns\TextColumn::make('link')
                    ->label('Đường dẫn')
                    ->visible(fn ($record) => $record && $record->type === MenuItem::TYPE_LINK),

                Tables\Columns\TextColumn::make('target.name')
                    ->label('Nội dung liên kết')
                    ->visible(fn ($record) => $record && in_array($record->type, [MenuItem::TYPE_CATEGORY, MenuItem::TYPE_PAGE])),

                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        MenuItem::TYPE_LINK => 'Liên kết',
                        MenuItem::TYPE_CATEGORY => 'Danh mục', 
                        MenuItem::TYPE_PAGE => 'Trang',
                    ])
                    ->label('Loại menu'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
