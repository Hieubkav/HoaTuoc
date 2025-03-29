<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Quản lý nội dung';
    
    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Bài viết';
    protected static ?string $pluralModelLabel = 'Bài viết';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin bài viết')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('slug')
                            ->label('Đường dẫn')
                            ->required()
                            ->unique(ignorable: fn ($record) => $record)
                            ->maxLength(255)
                            ->disabled(),
                            
                        Forms\Components\RichEditor::make('description')
                            ->label('Nội dung')
                            ->required()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('posts')
                            ->columnSpanFull(),
                            
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Ảnh đại diện')
                            ->image()
                            ->directory('posts')
                            ->preserveFilenames()
                            ->columnSpanFull(),
                            
                        Forms\Components\Toggle::make('status')
                            ->label('Hiển thị')
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh đại diện')
                    ->circular()
                    ->size(40),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Tác giả')
                    ->sortable(),
                    
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Hiển thị')
                    ->onColor('success')
                    ->offColor('danger'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Trạng thái')
                    ->placeholder('Tất cả')
                    ->trueLabel('Hiển thị')
                    ->falseLabel('Ẩn'),
                    
                Tables\Filters\TrashedFilter::make()
                    ->label('Đã xóa'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa'),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->label('Xóa vĩnh viễn'),
                    Tables\Actions\RestoreBulkAction::make()
                        ->label('Khôi phục'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}