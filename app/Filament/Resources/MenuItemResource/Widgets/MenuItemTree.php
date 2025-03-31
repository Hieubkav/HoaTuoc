<?php

namespace App\Filament\Resources\MenuItemResource\Widgets;

use App\Models\MenuItem;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;
use Filament\Forms\Components\TextInput;

class MenuItemTree extends BaseWidget
{
    protected static string $model = MenuItem::class;

    protected static int $maxDepth = 5;

    protected ?string $treeTitle = 'Menu Động';

    protected bool $enableTreeTitle = true;
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('label'),
        ];
    }
    
    protected function hasDeleteAction(): bool
    {
        return true;
    }

    protected function hasEditAction(): bool
    {
        return true;
    }

    protected function hasViewAction(): bool
    {
        return false;
    }

    public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    {
        return null;
    }

    public function getTreeQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return static::getModel()::query()
            ->with(['children' => function ($query) {
                $query->orderBy('order');
            }])
            ->whereNull('parent_id')
            ->orderBy('order');
    }

    public function getRecordKey(?\Illuminate\Database\Eloquent\Model $record): string
    {
        return (string) $record?->id;
    }

    public function getParentKey(?\Illuminate\Database\Eloquent\Model $record): ?string
    {
        return $record?->parent_id ? (string) $record->parent_id : null;
    }

    public function getRecordTitle(?\Illuminate\Database\Eloquent\Model $record): string
    {
        return $record?->label ?? '';
    }

    public function getChildrenByParentKey(?string $parentKey = null): \Illuminate\Support\Collection
    {
        if ($parentKey === null) {
            return $this->getTreeQuery()->get();
        }

        return static::getModel()::query()
            ->where('parent_id', $parentKey)
            ->orderBy('order')
            ->get();
    }
}