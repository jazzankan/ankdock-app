<?php

namespace App\Http\Controllers;

use App\Enums\EatingOrder;
use Illuminate\Validation\Rule;
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
            'ingredients[]' => 'nullable | array',
            'spice' => 'nullable | min:3',
            'c_time' => 'nullable | min:3',
            'eating_order' => [Rule::enum(EatingOrder::class)],
            'comment' => 'nullable | min:3 max:200',
            'printed_source' => 'required_without_all:url,whole_text,fileToUpload | nullable | min:10',
            'url' => 'required_without_all:printed_source,whole_text,fileToUpload |  nullable | url:http,https',
            'whole_text' => 'required_without_all:url,printed_source,fileToUpload | nullable | min:30',
            'fileToUpload' => 'required_without_all:printed_source, url,whole_text | nullable | file'
        ]);

        array_pop($attributes);

        $recipe = Recipe::create($attributes);

        if($request['ingredients']!== null) {
            $ingredients = $request['ingredients'];
            foreach ($ingredients as $ingredient){
                $recipe->ingredients()->attach($ingredient);
            }
            }

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
