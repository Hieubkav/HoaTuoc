<?php

namespace App\Filament\Resources\ComboResource\Pages;

use App\Filament\Resources\ComboResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCombo extends EditRecord
{
    protected static string $resource = ComboResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa combo'),
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
        return 'Đã cập nhật combo thành công';
    }
}