<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\Version;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Sản phẩm trong đơn hàng';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('version_id')
                    ->relationship('version', 'name', function ($query) {
                        return $query->with('product'); // Eager load product
                    })
                    ->label('Sản phẩm')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $version = Version::find($state);
                            if ($version) {
                                $set('price', $version->price);
                            }
                        }
                    }),

                Forms\Components\TextInput::make('quantity')
                    ->label('Số lượng')
                    ->numeric()
                    ->default(1)
                    ->minValue(1)
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, $old, Forms\Set $set, Forms\Get $get) {
                        $price = floatval($get('price'));
                        $quantity = intval($state);
                        $set('subtotal', $price * $quantity);
                    }),

                Forms\Components\TextInput::make('price')
                    ->label('Đơn giá')
                    ->numeric()
                    ->prefix('VND')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        $price = floatval($state);
                        $quantity = intval($get('quantity'));
                        $set('subtotal', $price * $quantity);
                    }),

                Forms\Components\TextInput::make('subtotal')
                    ->label('Thành tiền')
                    ->numeric()
                    ->prefix('VND')
                    ->disabled()
                    ->dehydrated()
                    ->formatStateUsing(function ($state, Forms\Get $get) {
                        $price = floatval($get('price'));
                        $quantity = intval($get('quantity'));
                        return $price * $quantity;
                    }),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('version.product.name')
                    ->label('Sản phẩm')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => url("/admin/products/{$record->version->product->id}/edit"))
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('version.name')
                    ->label('Phiên bản')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => url("/admin/versions/{$record->version->id}/edit"))
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Số lượng')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Đơn giá')
                    ->money('VND')
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Thành tiền')
                    ->money('VND')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Thêm sản phẩm')
                    ->modalHeading('Thêm sản phẩm vào đơn hàng')
                    ->mutateFormDataUsing(function (array $data): array {
                        $version = Version::find($data['version_id']);
                        if (!isset($data['price']) && $version) {
                            $data['price'] = $version->price;
                        }
                        $data['subtotal'] = $data['quantity'] * $data['price'];
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa')
                    ->modalHeading('Cập nhật sản phẩm')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['subtotal'] = $data['quantity'] * $data['price'];
                        return $data;
                    }),
                    
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->modalHeading('Xóa sản phẩm')
                    ->successNotificationTitle('Đã xóa sản phẩm khỏi đơn hàng'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa đã chọn')
                        ->modalHeading('Xóa các sản phẩm đã chọn')
                        ->successNotificationTitle('Đã xóa các sản phẩm đã chọn'),
                ]),
            ]);
    }
}