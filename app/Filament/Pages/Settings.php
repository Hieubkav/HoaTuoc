<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;

class Settings extends Page
{
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
        $this->form->fill($settings->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin liên hệ')
                    ->description('Cài đặt thông tin liên hệ của nhà hàng')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_link')
                            ->label('Link Facebook')
                            ->url()
                            ->prefix('https://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('zalo_link')
                            ->label('Link Zalo')
                            ->url()
                            ->prefix('https://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('slogan')
                            ->label('Slogan')
                            ->maxLength(65535)
                            ->columnSpanFull()
                    ])->columns(2),

                Forms\Components\Section::make('Cài đặt chung')
                    ->description('Cài đặt thông tin cơ bản của nhà hàng')
                    ->schema([
                        Forms\Components\TextInput::make('brand_name')
                            ->label('Tên thương hiệu')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('shipping_fee')
                            ->label('Phí vận chuyển')
                            ->numeric()
                            ->prefix('VND')
                            ->default(0),
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->imageEditor()
                            ->directory('settings')
                            ->columnSpanFull(),
                        FileUpload::make('default_product_image')
                            ->label('Ảnh mặc định cho sản phẩm')
                            ->image()
                            ->imageEditor()
                            ->directory('settings')
                            ->columnSpanFull()
                    ])->columns(2),

                Forms\Components\Section::make('Thông tin địa điểm')
                    ->description('Cài đặt thông tin địa chỉ của nhà hàng')
                    ->schema([
                        Forms\Components\KeyValue::make('address')
                            ->label('Danh sách địa chỉ')
                            ->keyLabel('Tên địa điểm')
                            ->valueLabel('Địa chỉ chi tiết')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('google_map_embed')
                            ->label('Mã nhúng Google Map')
                            ->maxLength(65535)
                            ->columnSpanFull()
                    ]),

                Forms\Components\Section::make('Cài đặt giảm giá')
                    ->description('Cài đặt các thông số giảm giá')
                    ->schema([
                        Forms\Components\TextInput::make('global_discount_percentage')
                            ->label('Phần trăm giảm giá toàn hệ thống')
                            ->numeric()
                            ->suffix('%')
                            ->default(0)
                            ->maxValue(100)
                            ->minValue(0)
                    ])
            ]);
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