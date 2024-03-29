<?php

namespace App\Http\Controllers;

use App\Enums\EatingOrder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;
use App\Models\Ingredient;
use App\Models\Recipefile;
use App\Models\Recipe;
use App\Models\Typeoffood;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all()->sortByDesc('created_at');
        $latestviewed = $recipes->sortByDesc('latestviewed')->first();
        $latestrecipes = $recipes->take(5);

        return view('recipes.list')->with('latestrecipes', $latestrecipes)->with('latestviewed', $latestviewed);
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
        //dd($request['ingredients']);
        $data = $request->session()->only(['upload', 'successful']);
        if(!empty($data)){
            $uploadedfile = Recipefile::latest()->first();
            $request['fileToUpload'] = 'uploaded';
        }

        $attributes = request()->validate([
            'typeoffoods_id' => 'nullable | int',
            'name' => 'required | min:3',
            'ingredients[]' => 'nullable | array',
            'spice' => 'nullable | min:3',
            'c_time' => 'nullable | min:3',
            'eating_order' => [Rule::enum(EatingOrder::class)],
            'comment' => 'nullable | min:3',
            'printed_source' => 'required_without_all:url,whole_text,fileToUpload, | nullable | min:10',
            'url' => 'required_without_all:printed_source,whole_text,fileToUpload, |  nullable | url:http,https',
            'whole_text' => 'required_without_all:printed_source,url,fileToUpload, | nullable | min:30',
            'fileToUpload' => 'required_without_all:printed_source,url,whole_text, | nullable | regex:/uploaded/'
        ]);

        if($request['fileToUpload']) {
            array_pop($attributes);
        }


        $recipe = Recipe::create($attributes);

        if($request['ingredients']!== null) {
            $ingredients = $request['ingredients'];
            foreach ($ingredients as $ingredient){
                $recipe->ingredients()->attach($ingredient);
                }
            }
        if(isset($uploadedfile)){
            $recipe = Recipe::latest()->first();
            $uploadedfile->recipe_id = $recipe->id;
            $uploadedfile->save();
        }

        return redirect("recipes/" . $recipe->id)->with('recipe', $recipe);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $typeoffood = Typeoffood::where('id', $recipe->typeoffoods_id)->first();

        $file = $recipe->recipefile()->first();

        $recipe->latestviewed = Carbon::now();
        $recipe->save();

        return view('recipes.show')->with('recipe', $recipe)->with('typeoffood', $typeoffood)->with('file', $file);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $ingredients = Ingredient::all()->sortBy('name');
        $typeoffoods = Typeoffood::all()->sortBy('name');
        $file = $recipe->recipefile()->first();

        //dd($recipe->ingredients()->get()->toArray());

        return view("recipes.edit")->with('recipe', $recipe)->with('ingredients', $ingredients)->with('typeoffoods', $typeoffoods)->with('file', $file);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        if($request['delete'] === 'delete'){
            $this->destroy($recipe);
            return redirect('/recipes');
        }

        if($request['rating'] == null){
            $request['rating'] = 0;
        }
        if(!$request['markingcooked']){

            $file = $recipe->recipefile()->first();
            if($file){
                $request['fileToUpload'] = 'uploaded';
            }

            $precookedattributes = request()->validate([
                'typeoffoods_id' => 'nullable | int',
                'name' => 'required | min:3',
                'ingredients[]' => 'nullable | array',
                'spice' => 'nullable | min:3',
                'c_time' => 'nullable | min:3',
                'eating_order' => [Rule::enum(EatingOrder::class)],
                'comment' => 'nullable | min:3',
                'printed_source' => 'required_without_all:url,whole_text,fileToUpload, | nullable | min:10',
                'url' => 'required_without_all:printed_source,whole_text,fileToUpload, |  nullable | url:http,https',
                'whole_text' => 'required_without_all:printed_source,url,fileToUpload, | nullable | min:30',
                'fileToUpload' => 'required_without_all:printed_source,url,whole_text, | nullable | regex:/uploaded/'
            ]);

            $recipe->ingredients()->detach();
            if($request['ingredients']!== null) {
                $ingredients = $request['ingredients'];
                foreach ($ingredients as $ingredient){
                    $recipe->ingredients()->attach($ingredient);
                }
            }
            if($request['fileToUpload']) {
                array_pop($precookedattributes);
                }

        }

        if($request['markingcooked'] || $recipe->cooked) {
            $cookedattributes = request()->validate([
                'latestcook' => 'required | date',
                'rating' => 'nullable | integer',
                'judgement' => 'nullable | min:3'
            ]);
        }

        if(isset($precookedattributes) && !isset($cookedattributes)){
            $attributes = $precookedattributes;
        }
        if(!isset($precookedattributes) && isset($cookedattributes)){
            $attributes = $cookedattributes;
        }
        if(isset($precookedattributes) && isset($cookedattributes)){
            $attributes = array_merge($precookedattributes, $cookedattributes);
        }

        if($request['latestcook']) {
            $attributes['cooked'] = true;
        }

        $recipe->update($attributes);

        return redirect('/recipes/' . $recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
    }
}
