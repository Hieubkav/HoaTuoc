<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Hình ảnh';

    protected static ?string $recordTitleAttribute = 'image_url';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_url')
                    ->label('Hình ảnh')
                    ->image()
                    ->required()
                    ->directory('products/gallery')
                    ->preserveFilenames()
                    ->maxSize(2048),

                Forms\Components\TextInput::make('alt')
                    ->label('Mô tả hình ảnh (ALT)')
                    ->maxLength(255),

                Forms\Components\TextInput::make('order')
                    ->label('Thứ tự hiển thị')
                    ->numeric()
                    ->minValue(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Ảnh')
                    ->square(),

                Tables\Columns\TextColumn::make('alt')
                    ->label('Mô tả')
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->numeric()
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
                    ->label('Thêm một hình')
                    ->modalHeading('Thêm một hình ảnh'),
                
                Tables\Actions\Action::make('uploadMultiple')
                    ->label('Tải nhiều hình')
                    ->modalHeading('Tải nhiều hình ảnh')
                    ->icon('heroicon-o-photo')
                    ->form([
                        Forms\Components\FileUpload::make('images')
                            ->label('Chọn nhiều hình')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->directory('products/gallery')
                            ->preserveFilenames(),
                    ])
                    ->action(function (array $data): void {
                        foreach ($data['images'] as $image) {
                            $this->getOwnerRecord()->images()->create([
                                'image_url' => $image
                            ]);
                        }
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa')
                    ->modalHeading('Sửa thông tin hình ảnh'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
                ]),
            ])
            ;
    }
}