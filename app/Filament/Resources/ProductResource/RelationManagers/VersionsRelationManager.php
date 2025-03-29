<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VersionsRelationManager extends RelationManager
{
    protected static string $relationship = 'versions';

    protected static ?string $title = 'Phiên bản';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên phiên bản')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Ảnh đại diện')
                    ->image()
                    ->directory('versions')
                    ->preserveFilenames(),

                Forms\Components\TextInput::make('price')
                    ->label('Giá bán')
                    ->required()
                    ->numeric()
                    ->prefix('VND')
                    ->minValue(0),

                Forms\Components\TextInput::make('discount_percentage')
                    ->label('Phần trăm giảm giá')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%'),

                Forms\Components\Toggle::make('is_in_stock')
                    ->label('Còn hàng')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger'),

                Forms\Components\Select::make('status')
                    ->label('Trạng thái')
                    ->required()
                    ->default('available')
                    ->options([
                        'available' => 'Còn hàng',
                        'unavailable' => 'Không có sẵn',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->width(100)
                    ->height(100),

                Tables\Columns\TextColumn::make('name')
                    ->label('Tên phiên bản')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Giá bán')
                    ->money('VND')
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount_percentage')
                    ->label('Giảm giá')
                    ->numeric()
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_in_stock')
                    ->label('Còn hàng')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->colors([
                        'success' => 'available',
                        'danger' => 'unavailable',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'available' => 'Còn hàng',
                        'unavailable' => 'Không có sẵn',
                    ]),

                Tables\Filters\TernaryFilter::make('is_in_stock')
                    ->label('Tình trạng hàng')
                    ->placeholder('Tất cả')
                    ->trueLabel('Còn hàng')
                    ->falseLabel('Hết hàng'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Thêm phiên bản')
                    ->modalHeading('Thêm phiên bản mới'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa')
                    ->modalHeading('Sửa phiên bản'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}