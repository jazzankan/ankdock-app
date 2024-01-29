<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Typeoffood;
use Illuminate\Http\Request;

class TypeoffoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeoffoods = Typeoffood::all()->sortBy('name');

        return view('typeoffoods.list')->with('typeoffoods', $typeoffoods);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('typeoffoods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required | min:3',
        ]);

        Typeoffood::create($attributes);

        return redirect('typeoffoods');
    }

    /**
     * Display the specified resource.
     */
    public function show(Typeoffood $typeoffood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Typeoffood $typeoffood)
    {
        $recipes = Recipe::all();
        $hasrecipe = false;
        foreach($recipes as $r){
            if($r->typeoffood_id == $typeoffood->id) {
                $hasrecipe = true;
            }
        }
        return view('typeoffoods.edit')->with('typeoffood',$typeoffood)->with('hasrecipe', $hasrecipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Typeoffood $typeoffood)
    {
        if($request['delete'] === 'delete') {
            $this->destroy($typeoffood);
            return redirect('/typeoffoods');
        }
        $attributes = request()->validate([
            'name' => 'required | min:3'
        ]);
        $typeoffood->update(request(['name']));

        return redirect('/typeoffoods');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Typeoffood $typeoffood)
    {
        $typeoffood->delete();
    }
}
