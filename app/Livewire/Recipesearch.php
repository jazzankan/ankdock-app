<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Recipe;

class Recipesearch extends Component
{
    public $query;
    public $recipes;
    public $eating_order;
    public $random_recipe;

    function mount()
    {
        $this->query = "";
        $this->recipes = [];
        $this->eating_order = "main";
        $this->random_recipe = null;
    }

    function dish($order)
    {
        if($order == "starter")
        {
            $this->eating_order = "starter";
        }
        if($order == "main")
        {
            $this->eating_order = "main";
        }
        if($order == "dessert")
        {
            $this->eating_order = "dessert";
        }
    }

    function random()
    {
        $all = Recipe::where('eating_order', $this->eating_order)->get();
            $number = count($all);
        if($number > 0) {
            $random_num = rand(0, $number - 1);
            $this->random_recipe = $all[$random_num];
        }

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
