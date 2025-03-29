<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'Quản lý bán hàng';
    
    protected static ?string $modelLabel = 'Khách hàng';
    
    protected static ?string $pluralModelLabel = 'Khách hàng';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->label('Tên khách hàng'),
                
            TextInput::make('email')
                ->email()
                ->unique(ignoreRecord: true)
                ->label('Email'),
                
            TextInput::make('phone')
                ->tel()
                ->required()
                ->unique(ignoreRecord: true)
                ->label('Số điện thoại'),
                
            TextInput::make('address')
                ->label('Địa chỉ'),
                
            TextInput::make('total_spent')
                ->numeric()
                ->disabled()
                ->label('Tổng chi tiêu')
                ->suffix('VND'),
                
            TextInput::make('total_orders')
                ->numeric()
                ->disabled()
                ->label('Số đơn hàng'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tên')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('total_spent')
                    ->label('Tổng chi tiêu')
                    ->money('VND')
                    ->sortable(),
                    
                TextColumn::make('total_orders')
                    ->label('Số đơn hàng')
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }    
}