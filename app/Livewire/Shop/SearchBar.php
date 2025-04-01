<?php

namespace App\Livewire\Shop;

use Livewire\Component;

class SearchBar extends Component
{
    public string $searchQuery = '';

    public function render()
    {
        return view('livewire.shop.search-bar');
    }
}