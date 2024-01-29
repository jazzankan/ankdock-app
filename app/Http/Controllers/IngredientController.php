<?php

namespace App\Http\Controllers;

use App\Enums\IngredientCategories;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class IngredientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::all()->sortBy('name');

        return view('ingredients.list')->with('ingredients', $ingredients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required | min:3',
            'category' => [new Enum(IngredientCategories::class)]
        ]);

        Ingredient::create($attributes);

        return redirect('ingredients');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        $recipes = Recipe::all();
        $hasrecipe = false;
        foreach($recipes as $r){
            if($r->ingredients) {
                $hasrecipe = true;
            }
        }

        return view('ingredients.edit')->with('ingredient',$ingredient)->with('hasrecipe', $hasrecipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        if($request['delete'] === 'delete') {
            $this->destroy($ingredient);
            return redirect('/ingredients');
        }
        $attributes = request()->validate([
            'name' => 'required | min:3',
            'category' => [new Enum(IngredientCategories::class)]
        ]);
        $ingredient->update(request(['name','category']));

        return redirect('/ingredients');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
    }
}
