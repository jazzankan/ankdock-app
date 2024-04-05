<?php

namespace App\Livewire;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Recipe;

class Recipesearch extends Component
{
    use WithPagination;

    public $query;
    public $recipes;
    public $eating_order;
    public $random_recipe;
    public $showallcat;

    function mount()
    {
        $this->query = "";
        $this->recipes = [];
        $this->eating_order = "main";
        $this->random_recipe = null;
        $this->showallcat = true;
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
        if($order == "baking")
        {
            $this->eating_order = "baking";
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

    function allcat()
    {
        $this->query = "Alla";
        $this->updatedQuery();
        $this->showallcat = false;
    }

    function emptyquery()
    {
        $this->query = "";
        $this->showallcat = true;
    }

    public function updatedQuery()
    {
        if($this->query == "Alla"){
            $this->recipes = Recipe::where('eating_order', '=' , $this->eating_order)->get()->sortByDesc('latestcook');
        }
        else {
            $this->recipes = Recipe::where('eating_order', '=', $this->eating_order)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->query . '%')
                        ->orWhereRelation('ingredients', 'name', 'like', '%' . $this->query . '%')
                        ->orWhereRelation('typeoffoods', 'name', 'like', '%' . $this->query . '%');
                })
                ->get()->sortByDesc('latestcook');
        }
    }



    public function render()
    {
        return view('livewire.recipesearch');
    }
}
