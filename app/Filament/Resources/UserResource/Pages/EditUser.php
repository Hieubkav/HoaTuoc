<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa người dùng')
                ->modalHeading('Xóa người dùng')
                ->modalDescription('Bạn có chắc chắn muốn xóa người dùng này không?')
                ->modalSubmitActionLabel('Có, xóa người dùng')
                ->modalCancelActionLabel('Không, giữ lại'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Đã cập nhật thông tin người dùng';
    }

    protected function getDeletedNotificationTitle(): ?string
    {
        return 'Đã xóa người dùng';
    }
}