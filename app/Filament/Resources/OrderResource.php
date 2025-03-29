<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Quản lý bán hàng';

    protected static ?string $navigationLabel = 'Đơn hàng';

    protected static ?string $modelLabel = 'đơn hàng';

    protected static ?string $pluralModelLabel = 'đơn hàng';

    protected static ?int $navigationSort = 1;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin đơn hàng')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Mã đơn hàng')
                            ->default(fn() => '#' . random_int(100000, 999999))
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        Forms\Components\Select::make('customer_id')
                            ->label('Khách hàng')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                            
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'pending' => 'Chờ xử lý',
                                'processing' => 'Đang xử lý', 
                                'completed' => 'Hoàn thành',
                                'cancelled' => 'Đã hủy',
                                'draft' => 'Nháp'
                            ])
                            ->default('draft')
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Thông tin thanh toán')
                    ->schema([
                        Forms\Components\Select::make('payment_status')
                            ->label('Trạng thái thanh toán')
                            ->options([
                                'pending' => 'Chờ thanh toán',
                                'paid' => 'Đã thanh toán',
                                'failed' => 'Thanh toán thất bại'
                            ])
                            ->default('pending')
                            ->required(),

                        Forms\Components\TextInput::make('payment_method')
                            ->label('Phương thức thanh toán')
                            ->placeholder('Tiền mặt, Thẻ tín dụng, v.v')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('total_amount')
                            ->label('Tổng tiền')
                            ->numeric()
                            ->prefix('VND')
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('total_items')
                            ->label('Tổng số sản phẩm')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Mã đơn hàng')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Khách hàng')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Tổng tiền')
                    ->money('VND')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_items')
                    ->label('Tổng SP')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ xử lý',
                        'processing' => 'Đang xử lý',
                        'completed' => 'Hoàn thành', 
                        'cancelled' => 'Đã hủy',
                        'draft' => 'Nháp'
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('PT thanh toán'),

                Tables\Columns\SelectColumn::make('payment_status')
                    ->label('TT thanh toán')
                    ->options([
                        'pending' => 'Chờ thanh toán',
                        'paid' => 'Đã thanh toán',
                        'failed' => 'Thất bại'
                    ])
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
                        'pending' => 'Chờ xử lý',
                        'processing' => 'Đang xử lý',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy', 
                        'draft' => 'Nháp'
                    ]),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Trạng thái thanh toán')
                    ->options([
                        'pending' => 'Chờ thanh toán',
                        'paid' => 'Đã thanh toán',
                        'failed' => 'Thất bại'
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa'),
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
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}