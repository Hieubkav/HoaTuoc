<?php

namespace App\Filament\Resources\SectionResource\Pages;

use App\Filament\Resources\SectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSection extends CreateRecord
{
    protected static string $resource = SectionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Đã tạo phân mục mới';
    }
}