<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Recipe;

class Recipesearch extends Component
{
    public $query;
    public $recipes;
    public $eating_order;

    function mount()
    {
        $this->query = "";
        $this->recipes = [];
        $this->eating_order = "main";
    }

    function dish($order)
    {
        //ändrar eating_order
    }

    function emptyquery()
    {
        $this->query = "";
    }

    public function updatedQuery()
    {
        $this->recipes = Recipe::where('eating_order', '=' , $this->eating_order)
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->query . '%')
                    ->orWhereRelation('ingredients', 'name', 'like', '%' . $this->query . '%')
                    ->orWhereRelation('typeoffoods', 'name', 'like', '%' . $this->query . '%');
            })
            ->get();
    }



    public function render()
    {
        return view('livewire.recipesearch');
    }
}
