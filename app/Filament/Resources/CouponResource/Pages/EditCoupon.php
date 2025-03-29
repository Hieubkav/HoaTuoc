<?php

namespace App\Filament\Resources\CouponResource\Pages;

use App\Filament\Resources\CouponResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoupon extends EditRecord
{
    protected static string $resource = CouponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa mã giảm giá'),
            Actions\ForceDeleteAction::make()
                ->label('Xóa vĩnh viễn'),
            Actions\RestoreAction::make()
                ->label('Khôi phục'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Đã cập nhật mã giảm giá thành công';
    }
}