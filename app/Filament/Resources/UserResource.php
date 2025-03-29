<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Quản lý hệ thống';

    protected static ?string $navigationLabel = 'Người dùng';

    protected static ?string $modelLabel = 'người dùng';

    protected static ?string $pluralModelLabel = 'người dùng';

    protected static ?int $navigationSort = 1;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên người dùng')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('role')
                            ->label('Vai trò')
                            ->options([
                                'admin' => 'Quản trị viên',
                                'staff' => 'Nhân viên',
                                'customer' => 'Khách hàng',
                            ])
                            ->default('customer')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Bảo mật')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Mật khẩu')
                            ->password()
                            ->dehydrateStateUsing(function ($state) {
                                if (!empty($state)) {
                                    return Hash::make($state);
                                }
                            })
                            ->required(function (string $context): bool {
                                return $context === 'create';
                            })
                            ->maxLength(255)
                            ->confirmed(),

                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Xác nhận mật khẩu')
                            ->password()
                            ->required(function (string $context): bool {
                                return $context === 'create';
                            })
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Vai trò')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $labels = [
                            'admin' => 'Quản trị viên',
                            'staff' => 'Nhân viên',
                            'customer' => 'Khách hàng',
                        ];
                        
                        // Make sure state is a valid string before using as array key
                        if (is_string($state) && isset($labels[$state])) {
                            return $labels[$state];
                        }
                        
                        return $state ?? '';
                    })
                    ->colors([
                        'success' => 'admin',
                        'warning' => 'staff',
                        'gray' => 'customer',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Vai trò')
                    ->options([
                        'admin' => 'Quản trị viên',
                        'staff' => 'Nhân viên',
                        'customer' => 'Khách hàng',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa đã chọn')
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}