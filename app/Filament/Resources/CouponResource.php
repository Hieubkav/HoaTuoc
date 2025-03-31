<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    
    protected static ?string $navigationGroup = 'Quản lý nội dung';
    
    protected static ?string $modelLabel = 'Mã giảm giá';
    
    protected static ?string $pluralModelLabel = 'Mã giảm giá';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->label('Tên mã giảm giá'),
                
            Textarea::make('description')
                ->label('Mô tả')
                ->nullable()
                ->columnSpanFull(),
                
            TextInput::make('code')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('Mã code'),
                
            Toggle::make('is_percentage')
                ->label('Giảm theo phần trăm')
                ->onColor('success')
                ->offColor('danger'),
                
            TextInput::make('value')
                ->numeric()
                ->required()
                ->label('Giá trị')
                ->minValue(0)
                ->step(0.01),
                
            FileUpload::make('thumbnail')
                ->image()
                ->label('Ảnh')
                ->directory('coupons')
                ->preserveFilenames()
                ->nullable(),
                
            DateTimePicker::make('valid_until')
                ->label('Hết hạn')
                ->nullable()
                ->timezone('Asia/Ho_Chi_Minh'),
                
            Select::make('status')
                ->options([
                    'active' => 'Hoạt động',
                    'inactive' => 'Không hoạt động'
                ])
                ->default('inactive')
                ->required()
                ->label('Trạng thái'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->circular(),
                    
                TextColumn::make('name')
                    ->label('Tên')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('code')
                    ->label('Mã code')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('value')
                    ->label('Giá trị')
                    ->formatStateUsing(fn (string $state, Coupon $record): string => 
                        $record->is_percentage 
                            ? "{$state}%" 
                            : number_format($state) . ' VND'
                    )
                    ->sortable(),
                    
                TextColumn::make('valid_until')
                    ->label('Hết hạn')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                    
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Đang hoạt động',
                        'inactive' => 'Không hoạt động',
                    ])
                    ->label('Trạng thái'),
                    
                Tables\Filters\TernaryFilter::make('is_percentage')
                    ->label('Loại giảm giá')
                    ->placeholder('Tất cả')
                    ->trueLabel('Phần trăm')
                    ->falseLabel('Số tiền'),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }    
}