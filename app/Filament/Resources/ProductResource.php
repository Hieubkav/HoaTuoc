<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Quản lý sản phẩm';

    protected static ?string $navigationLabel = 'Sản phẩm';

    protected static ?string $modelLabel = 'sản phẩm';

    protected static ?string $pluralModelLabel = 'sản phẩm';

    protected static ?int $navigationSort = 2;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên sản phẩm')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),

                        Forms\Components\Select::make('categories')
                            ->label('Danh mục')
                            ->multiple()
                            ->relationship('categories', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),

                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Ảnh đại diện')
                            ->image()
                            ->directory('products')
                            ->preserveFilenames()
                            ->maxSize(2048),
                    ])->columns(1),

                Forms\Components\Section::make('Mô tả sản phẩm')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Mô tả chi tiết')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'heading',
                                'bulletList',
                                'orderedList',
                                'redo',
                                'undo',
                            ]),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Danh mục')
                    ->badge(),

                Tables\Columns\TextColumn::make('versions_count')
                    ->label('Phiên bản')
                    ->counts('versions')
                    ->sortable(),

                Tables\Columns\TextColumn::make('images_count')
                    ->label('Hình ảnh')
                    ->counts('images')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VersionsRelationManager::class,
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}