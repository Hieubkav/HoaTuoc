<?php

namespace App\Filament\Resources\SectionResource\Pages;

use App\Filament\Resources\SectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSection extends EditRecord
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Xóa phân mục')
                ->modalHeading('Xóa phân mục')
                ->modalDescription('Bạn có chắc chắn muốn xóa phân mục này không?')
                ->modalSubmitActionLabel('Có, xóa phân mục')
                ->modalCancelActionLabel('Không, giữ lại'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Đã cập nhật phân mục';
    }

    protected function getDeletedNotificationTitle(): ?string
    {
        return 'Đã xóa phân mục';
    }
}