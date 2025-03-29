<?php

namespace App\Filament\Resources\SectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    protected static ?string $title = 'Danh mục';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên danh mục')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'visible' => 'Hiển thị',
                        'hidden' => 'Ẩn',
                    ])
                    ->default('hidden')
                    ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Ảnh đại diện')
                    ->image()
                    ->directory('categories')
                    ->preserveFilenames()
                    ->maxSize(2048),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Thứ tự sắp xếp')
                    ->numeric()
                    ->default(0),

                Forms\Components\RichEditor::make('description')
                    ->label('Mô tả')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'redo',
                        'undo',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('products_count')
                    ->label('Số sản phẩm')
                    ->counts('products')
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'visible' => 'Hiển thị',
                        'hidden' => 'Ẩn',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'visible' => 'Hiển thị',
                        'hidden' => 'Ẩn',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Thêm danh mục')
                    ->modalHeading('Thêm danh mục mới'),
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
            ])
            ->defaultSort('sort_order', 'asc');
    }
}