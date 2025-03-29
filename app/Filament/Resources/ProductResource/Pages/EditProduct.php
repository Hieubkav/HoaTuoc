<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa sản phẩm')
                ->modalHeading('Xóa sản phẩm')
                ->modalDescription('Bạn có chắc chắn muốn xóa sản phẩm này không?')
                ->modalSubmitActionLabel('Có, xóa sản phẩm')
                ->modalCancelActionLabel('Không, giữ lại'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Đã cập nhật sản phẩm';
    }

    protected function getDeletedNotificationTitle(): ?string
    {
        return 'Đã xóa sản phẩm';
    }
}