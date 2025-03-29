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

                Forms\Components\TextInput::make('price')
                    ->label('Giá bán')
                    ->required()
                    ->numeric()
                    ->prefix('VND')
                    ->minValue(0),

                Forms\Components\TextInput::make('stock')
                    ->label('Tồn kho')
                    ->required()
                    ->numeric()
                    ->minValue(0),

                Forms\Components\TextInput::make('sku')
                    ->label('Mã SKU')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên phiên bản')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Giá bán')
                    ->money('VND')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Tồn kho')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sku')
                    ->label('Mã SKU')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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