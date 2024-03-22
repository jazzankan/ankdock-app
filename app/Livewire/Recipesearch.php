<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Recipe;

class Recipesearch extends Component
{
    public $query;
    public $recipes;

    function mount()
    {
        $this->query = "";
        $this->recipes = [];
    }

    function emptyquery()
    {
        $this->query = "";
    }

    public function updatedQuery()
    {
        $this->recipes = Recipe:: where('name', 'like', '%' . $this->query . '%')
            ->get();
    }



    public function render()
    {
        return view('livewire.recipesearch');
    }
}
