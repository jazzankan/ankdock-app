<?php

namespace App\Http\Controllers;

use App\Models\Projcomment;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Notifications\NewProjcomment;

class ProjcommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projectid = $request->projid;
        $project = Project::where('id',$projectid)->first();

        return view ('projcomments.create')->with('project',$project);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'project_id' => 'required | int',
            'body' => 'required | min:3'
        ]);

        $attributes['user_id'] = auth()->id();
        Projcomment::create($attributes);

        $project = Project::where('id',$request->project_id)->first();
        $projectusers = $project->users()->get();
        $user_id = auth()->id();

        foreach ($projectusers as $pu){
            if ($pu->id != $user_id){
                $pu->notify(new NewProjcomment());
            }
        }
        //$anders = User::where('id', 1)->first();
        //$anders->notify(new NewProjcomment());

        return redirect('/projects/'.$attributes['project_id']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function show(Projcomment $projcomment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function edit(Projcomment $projcomment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projcomment $projcomment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projcomment  $projcomment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projcomment $projcomment)
    {
        //
    }
}
