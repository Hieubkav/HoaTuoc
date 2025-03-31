<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class Settings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Cài đặt hệ thống';
    protected static ?string $navigationGroup = 'Quản lý hệ thống';

    protected static ?string $title = 'Cài đặt hệ thống';

    protected static ?int $navigationSort = 20;

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::first() ?? new Setting();
        $this->data = $settings->attributesToArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin thương hiệu')
                    ->schema([
                        TextInput::make('brand_name')
                            ->label('Tên thương hiệu')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('settings')
                            ->maxSize(2048),
                        Textarea::make('slogan')
                            ->label('Slogan')
                            ->maxLength(500),
                    ]),

                Section::make('Thông tin liên hệ')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->tel()
                            ->maxLength(20),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('facebook_link')
                            ->label('Link Facebook')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('zalo_link')
                            ->label('Link Zalo')
                            ->url()
                            ->maxLength(255),
                    ]),

                Section::make('Địa chỉ')
                    ->schema([
                        Textarea::make('address')
                            ->label('Địa chỉ')
                            ->maxLength(500),
                        Textarea::make('google_map_embed')
                            ->label('Mã nhúng Google Map')
                            ->helperText('Dán mã nhúng iframe từ Google Maps'),
                    ]),

                Section::make('Cài đặt bán hàng')
                    ->schema([
                        TextInput::make('shipping_fee')
                            ->label('Phí vận chuyển')
                            ->numeric()
                            ->prefix('VNĐ')
                            ->default(0),
                        TextInput::make('global_discount_percentage')
                            ->label('Phần trăm giảm giá toàn hệ thống')
                            ->numeric()
                            ->suffix('%')
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(100),
                        FileUpload::make('default_product_image')
                            ->label('Ảnh mặc định cho sản phẩm')
                            ->image()
                            ->directory('settings')
                            ->maxSize(2048),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        $setting = Setting::first() ?? new Setting();
        $setting->fill($data);
        $setting->save();

        Notification::make()
            ->title('Đã lưu cài đặt')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Lưu thay đổi')
                ->submit('save'),
        ];
    }
}