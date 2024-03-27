<?php

namespace App\Livewire;

use App\Models\Typeoffood;
use Illuminate\Database\Eloquent\Builder;
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
            ->orWhereRelation('ingredients', 'name', 'like', '%' . $this->query . '%')
            ->orWhereRelation('typeoffoods', 'name', 'like', '%' . $this->query . '%')
           // ->orWhereBelongsTo(Typeoffood::class, function ($q)  {
            //    $q->where('name', 'LIKE', '%'. $this->query . '%');
            //})
            ->get();
    }



    public function render()
    {
        return view('livewire.recipesearch');
    }
}
