<?php

namespace App\Http\Controllers;

use App\Enums\IngredientCategories;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Typeoffood;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all()->sortBy('name');

        return view('recipes.list')->with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::all()->sortBy('name');
        $typeoffoods = Typeoffood::all()->sortBy('name');

        return view('recipes.create')->with('ingredients',$ingredients)->with('typeoffoods', $typeoffoods);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required | min:3',

        ]);

        Ingredient::create($attributes);

        return redirect('recipes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
    }
}
