<?php

namespace App\Filament\Resources\SectionResource\RelationManagers;

use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    protected static ?string $title = 'Danh mục';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên danh mục')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $state, Forms\Set $set) {
                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('status')
                    ->label('Trạng thái')
                    ->options(Category::getStatuses())
                    ->default('hidden')
                    ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Ảnh đại diện')
                    ->image()
                    ->directory('categories')
                    ->preserveFilenames()
                    ->maxSize(2048),

                Forms\Components\RichEditor::make('description')
                    ->label('Mô tả')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'redo',
                        'undo',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->width(100)
                    ->height(100),

                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('products_count')
                    ->label('Số sản phẩm')
                    ->counts('products')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->colors([
                        'success' => 'visible',
                        'danger' => 'hidden',
                    ])
                    ->formatStateUsing(fn (string $state): string => Category::getStatuses()[$state])
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options(Category::getStatuses()),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tạo danh mục mới')
                    ->modalHeading('Tạo danh mục mới'),

                Tables\Actions\Action::make('add_existing')
                    ->label('Thêm danh mục có sẵn')
                    ->form([
                        Forms\Components\Select::make('category_id')
                            ->label('Chọn danh mục')
                            ->options(
                                Category::whereNull('section_id')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        Category::find($data['category_id'])->update([
                            'section_id' => $this->ownerRecord->id
                        ]);
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('view_category')
                    ->label('Xem danh mục')
                    ->url(fn (Category $record): string => route('filament.admin.resources.categories.edit', $record))
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()
                    ->label('Sửa'),

                Tables\Actions\Action::make('detach')
                    ->label('Gỡ khỏi phân mục')
                    ->color('danger')
                    ->icon('heroicon-m-x-mark')
                    ->requiresConfirmation()
                    ->action(fn (Category $record) => $record->update(['section_id' => null])),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('detach_selected')
                    ->label('Gỡ các mục đã chọn')
                    ->color('danger')
                    ->icon('heroicon-m-x-mark')
                    ->requiresConfirmation()
                    ->action(fn ($records) => $records->each->update(['section_id' => null])),
            ])
            ->defaultSort('created_at', 'desc');
    }
}