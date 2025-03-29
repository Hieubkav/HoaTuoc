<?php

namespace App\Filament\Resources\ComboResource\RelationManagers;

use App\Models\Version;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VersionsRelationManager extends RelationManager
{
    protected static string $relationship = 'versions';
    
    protected static ?string $title = 'Phiên bản sản phẩm';
    
    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->label('Số lượng'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->width(100)
                    ->height(100),

                TextColumn::make('product.name')
                    ->label('Sản phẩm')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Phiên bản')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND')
                    ->sortable(),

                TextColumn::make('pivot.quantity')
                    ->label('Số lượng')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Thêm phiên bản')
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Chọn phiên bản')
                            ->options(
                                Version::with('product')
                                    ->get()
                                    ->mapWithKeys(fn (Version $version): array => [
                                        $version->id => "{$version->product->name} - {$version->name} ({$version->price} VND)"
                                    ])
                            )
                            ->searchable(['name', 'product.name'])
                            ->preload()
                            ->required(),
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->label('Số lượng'),
                    ]),
            ])
            ->actions([
                Action::make('view_product')
                    ->label('Xem sản phẩm')
                    ->url(fn (Version $record): string => route('filament.admin.resources.products.edit', $record->product))
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()
                    ->label('Sửa số lượng')
                    ->modalHeading('Cập nhật số lượng')
                    ->form([
                        TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->label('Số lượng'),
                    ]),

                Tables\Actions\DetachAction::make()
                    ->label('Xóa khỏi combo'),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()
                    ->label('Xóa các mục đã chọn'),
            ]);
    }
}