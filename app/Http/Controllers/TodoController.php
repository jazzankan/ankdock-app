<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\ChangedProject;
use DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now();
        $authuserid = auth()->id();

        $undonetodos = Todo::where('status','o')->orWhere('status','n')->orderBy('deadline')->get();

        foreach($undonetodos as $ut){
            $userids = DB::table('project_user')->where('project_id',$ut['project_id'])->get(['user_id']);
            if (!$userids->contains('user_id',$authuserid)){
                $undonetodos = $undonetodos->except($ut->id);
            }
            else{
                $projname = Project::where('id',$ut->project_id)->value('title');
                $ut['projname'] = $projname;
            }
        }

        return view('todos.list')->with('undonetodos',$undonetodos)->with('today',$today);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectid)
    {
        $taskProject = Project::where('id', $projectid)->first();

        return view('todos.create')->with('taskProject',$taskProject);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['status'] = 'n';
        $request['deadline'] = $request['date'];
        $detailstring = $request['details'];

        $request['details'] = str_replace("\r\n", '&#13;', $detailstring);

        $attributes = request()->validate([

            'title' => 'required | min:3',
            'details' => 'nullable | min:5',
            'deadline' => 'nullable|date',
            'status' => 'required',
            'priority' => 'required',
            'assigned' => 'nullable',
            'project_id' => 'required'
        ]);
        Todo::create($attributes);
        $myself = auth()->id();
        $new = true;
        $fixed = false;
        $thisprojid = $request['project_id'];
        $mailusers = USER::whereHas('projects' , function($query) use ($thisprojid){
            $query->where('project_user.project_id', '=',$thisprojid);
        })->get();

        foreach ($mailusers as $mu) {
            if($mu->id !== $myself){
                $mu->notify(new ChangedProject($new, $fixed, $thisprojid));
            }
        }

        return redirect('/projects/' . $request['project_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $project = Project::where('id', $todo['project_id'])->first();
        //To be able to mail only when the project is shared
        $myname = auth()->user()->name;
        $shared = User::Shared($myname, $project);

        return view('todos.edit')->with('todo',$todo)->with('project',$project)->with('shared',$shared);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $thisprojid = $request['project_id'];
        $request['deadline'] = $request['date'];
        if ($request['delete'] === 'delete') {
            $this->destroy($todo);
            return redirect('/projects/'.$thisprojid);
        }
        $myself = auth()->id();
        $new = false;
        $fixed = true;

        request()->validate([
            'title' => 'required | min:3',
            'details' => 'nullable | min:5',
            'deadline' => 'nullable|date',
            'status' => 'required',
            'priority' => 'required',
            'assigned' => 'nullable',
        ]);
        //$detailstring = $request['details'];
        //$request['details'] = str_replace("\r\n", '&#13;', $detailstring);

        $todo->update(request(['title', 'details', 'deadline', 'status', 'priority', 'assigned']));

        $mailusers = USER::whereHas('projects', function ($query) use ($thisprojid) {
            $query->where('project_id', '=', $thisprojid);
        })->get();

        if($request['smail']) {
            foreach ($mailusers as $mu) {
                if ($mu->id !== $myself) {
                    $mu->notify(new ChangedProject($new, $fixed, $thisprojid));
                }
            }
        }
        return redirect('/projects/' . $thisprojid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
    }
}
