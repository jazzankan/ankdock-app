<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        //
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
        //
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
