<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa đơn hàng')
                ->modalHeading('Xóa đơn hàng')
                ->modalDescription('Bạn có chắc chắn muốn xóa đơn hàng này không?')
                ->modalSubmitActionLabel('Có, xóa đơn hàng')
                ->modalCancelActionLabel('Không, giữ lại'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Đơn hàng đã được cập nhật';
    }

    protected function getDeletedNotificationTitle(): ?string
    {
        return 'Đơn hàng đã được xóa';
    }
}