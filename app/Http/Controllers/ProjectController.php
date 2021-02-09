<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = date('Y-m-d');
        $archived = false;
        if(auth()->user()->projects) {
            $projectlist = auth()->user()->projects->sortByDesc('must');
            $currentQueries = $request->query();
            if ($currentQueries && $currentQueries['arkiv'] === 'y') {
                $archived = true;
                $visibleproj = $projectlist->filter(function ($item) {
                    return $item->visible === 'n';
                });
            } else {
                $archived = false;
                $visibleproj = $projectlist->filter(function ($item) {
                    return $item->visible === 'y';
                });
            }
        }
        else{
            $visibleproj = array();
        }

        /*$visibleproj->each(function ($item, $key) {
            $this->late = false;
            $belongingtodo = Todo::where('project_id',$item->id)->get();
            if($belongingtodo){
                $belongingtodo->each(function ($todoitem, $key){
                    if($todoitem['deadline'] < date('Y-m-d') && $todoitem['deadline'] != null && $todoitem['status'] != 'd' ) {
                        $this->late = true;
                    }
                });
            }
            if($this->late){
                $item['late'] = 'y';
            }
        });*/

        return view('projects.list')->with('visibleproj', $visibleproj)->with('today', $today)->with('archived',$archived);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $myid = auth()->user()->id;
        $allusers = User::all();
        $usersminusme = $allusers->where('id','!=',$myid);

        return view ('projects.create')->with('usersminusme',$usersminusme);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['visible'] = 'y';
        $request['deadline'] = $request['date'];
        $getSharingUsers = null;

        $attributes = request()->validate([

            'title' => 'required | min:3',
            'description' => 'required | min:5',
            'deadline' => 'nullable|date',
            'must' => 'required',
            'visible' => 'required'
        ]);

        $project = Project::create($attributes);

        $user_id = auth()->id();

        $project->users()->attach($user_id);

        if($request['selshare'] !== null) {
            $getSharingUsers = User::whereIn('name', $request['selshare'])->get();

            foreach ($getSharingUsers as $g) {
                if (!$g->projects->contains($project->id)) {
                    $g->projects()->attach($project->id);
                }
                if($g->id !== $user_id){
                    $g->notify(new NewProject());
                }
            }
        }
        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $this->authorize('update',$project);

            $myname = auth()->user()->name;
            $users = User::all();
            $usernames = array();
            foreach ($users as $u) {
                if($u->name !== $myname) {
                    array_push($usernames, $u->name);
                }
            };

            // Det finns ett scope i model User, en metod kallad scopeShared. Den returnerar namnen på dem som delar projektet. Och den anropas med bara Shared.
            $sharing = User::Shared($myname, $project);

            return view('projects.edit')->with('project',$project)->with('usernames',$usernames)->with('sharing',$sharing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
