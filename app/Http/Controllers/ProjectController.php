<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Todo;
use App\Models\File;
use App\Models\Projcomment;
use App\Notifications\ChangedProject;
use App\Notifications\NewProject;

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

        $visibleproj->each(function ($item, $key) {
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
        });

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
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        $today = date('Y-m-d');
        $myname = auth()->user()->name;
        $sharing = User::Shared($myname, $project);
        $belongingfiles = File::where('projectid',$project->id)->get();
        $belongingtodos = Todo::where('project_id',$project->id)->orderBy('deadline', 'ASC')->get();

        $detlink = false;

        $belongingtodos->each(function ($todo, $key) {
            if ($todo['assigned']) {
                $todo['assigned'] = " Utförs av: " . $todo['assigned'];
            }
            else {
                $todo['assigned'] = "";
            }
            if(!$todo['deadline']) {
                $todo['deadline'] = "Ingen satt";
            }
            if($todo['priority'] == "l") {
                $todo['priority'] = "Prio: Låg ";
            }
            if($todo['priority'] == "m") {
                $todo['priority'] = "";
            }
            if($todo['priority'] == "h") {
                $todo['priority'] = "Prio: Hög ";
            }
            $todo['details'] = str_replace("'","\\'",$todo['details']); //Annars blank sida om ' förekommer
        });
        $projcomments = Projcomment::where('project_id', $project->id)->orderBy('id', 'DESC')->get();
        //dd($projcomments->user->name);
        return view('projects.show')->with('project',$project)->with('belongingtodos',$belongingtodos)->with('today',$today)->with('sharing',$sharing)->with('belongingfiles',$belongingfiles)->with('projcomments',$projcomments);
        //return view('projects.show')->with('project',$project)->with('sharing',$sharing)->with('belongingtodos',$belongingtodos)->with('belongingfiles',$belongingfiles)->with('projcomments',$projcomments)->with('today',$today);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
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
    public function update(Request $request, Project $project)
    {
        if($request['delete'] === 'delete'){
            $this->destroy($project);
            return redirect('/projects');
        }

        if($request['visible'] != 'n'){
            $request['visible'] = 'y';
        }
        $request['deadline'] = $request['date'];

        $attributes = request()->validate([

            'title' => 'required | min:3',
            'description' => 'required | min:5',
            'deadline' => 'nullable|date',
            'must' => 'required',
            'visible' => 'required'
        ]);

        $allUsers = User::all();
        $me = auth()->user();
        $user_id = auth()->id();

        $project->update(request(['title','description','deadline','must','visible']));

        if($request['selshare']) {
            $getSharingUsers = User::whereIn('name', $request['selshare'])->get();
            foreach ($getSharingUsers as $g) {
                if (!$g->projects->contains($project->id)) {
                    $g->projects()->attach($project->id);
                }

                if($request['sendmail']) {
                    if ($g->id !== $user_id) {
                        $g->notify(new ChangedProject());
                    }
                }
            }
            foreach ($allUsers as $a) {
                if ($a->projects->contains($project->id) && $getSharingUsers->where('name', $a->name)->count() === 0 && $a->id != $me->id) {
                    $a->projects()->detach($project->id);
                }
            }
        }
        else {
            foreach ($allUsers as $a) {
                if ($a->projects->contains($project->id) && $a->id != $me->id) {
                    $a->projects()->detach($project->id);
                }
            }
        }

        return redirect('/projects/' . $project->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('view',$project);

        $allUsers = User::all();

        foreach($allUsers as $a) {
            $a->projects()->detach($project);
        }

        $allProjcomments = Projcomment::all();
        foreach($allProjcomments as $c) {
            if($c->project_id === $project->id){
                $c->delete();
            }
        }
        $allTodos = Todo::all();
        foreach($allTodos as $t) {
            if($t->project_id === $project->id){
                $t->delete();
            }
        }

        $project->delete();
    }
}
