<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComboResource\Pages;
use App\Filament\Resources\ComboResource\RelationManagers\VersionsRelationManager;
use App\Models\Combo;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ComboResource extends Resource
{
    protected static ?string $model = Combo::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    
    protected static ?string $navigationGroup = 'Quản lý sản phẩm';
    
    protected static ?string $modelLabel = 'Combo';
    
    protected static ?string $pluralModelLabel = 'Combo';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->label('Tên combo'),
                
            Textarea::make('description')
                ->label('Mô tả')
                ->rows(3),
                
            FileUpload::make('thumbnail')
                ->image()
                ->label('Ảnh đại diện')
                ->directory('combos')
                ->preserveFilenames(),
                
            Select::make('discount_type')
                ->options([
                    'percentage' => 'Phần trăm',
                    'fixed' => 'Số tiền cố định',
                ])
                ->required()
                ->label('Loại giảm giá'),
                
            TextInput::make('discount_value')
                ->numeric()
                ->label('Giá trị giảm')
                ->required(),
                
            Toggle::make('apply_discount')
                ->label('Áp dụng giảm giá')
                ->default(true)
                ->onColor('success')
                ->offColor('danger'),
                
            TextInput::make('price')
                ->numeric()
                ->label('Giá combo')
                ->required(),
                
            Select::make('status')
                ->options([
                    'available' => 'Còn hàng',
                    'out_of_stock' => 'Hết hàng',
                    'discontinued' => 'Ngừng kinh doanh',
                ])
                ->required()
                ->default('available')
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
                    
                TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND')
                    ->sortable(),
                    
                TextColumn::make('discount_value')
                    ->label('Giảm giá')
                    ->formatStateUsing(fn (string $state, Combo $record): string => 
                        $record->discount_type === 'percentage' 
                            ? "{$state}%" 
                            : number_format($state) . ' VND'
                    )
                    ->sortable(),
                    
                TextColumn::make('comboItems_count')
                    ->label('Số sản phẩm')
                    ->counts('comboItems')
                    ->sortable(),
                    
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'out_of_stock' => 'warning',
                        'discontinued' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'available' => 'Còn hàng',
                        'out_of_stock' => 'Hết hàng',
                        'discontinued' => 'Ngừng kinh doanh',
                    ])
                    ->label('Trạng thái'),
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
            VersionsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCombos::route('/'),
            'create' => Pages\CreateCombo::route('/create'),
            'edit' => Pages\EditCombo::route('/{record}/edit'),
        ];
    }    
}