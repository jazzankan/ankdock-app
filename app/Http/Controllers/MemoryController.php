<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\Tag;
use App\Models\Memfile;
use Illuminate\Http\Request;
use DB;

class MemoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('auth');  //->only(['store','update']) eller ->except....
    }

    public function index(Request $request)
    {
        $userid = auth()->id();
        $searchterm = $request['search'];
        $tags = Tag::where('user_id',$userid)->orderBy('name')->get();

        if(empty($_POST)) {
            $memories = DB::table('memories')->where('user_id', $userid)->orderBy('updated_at', 'desc')->paginate(10);
        }
        else{
            if($request['importance'] === null){
                $request['importance'] = '%';
            }
            if($request['tag'] === ""){
                $request['tag'] = '%';
            }
            $tomorrow = date("Y-m-d", strtotime('tomorrow'));
            if($request['fromdate'] === null){
                $request['fromdate'] = date("2020-01-01");
            }
            if($request['todate'] === null){
                $request['todate'] = $tomorrow;
            }

            request()->validate([
                'search' => 'max:20',
                'tag' => 'max:20',
                'importance' => 'max:1'
            ]);
            $memories = Memory::
            where(function ($q) use ($searchterm) {
                $q->whereHas('tags', function ($query) use ($searchterm) {
                    $query->where('name', 'LIKE', '%'.$searchterm.'%');
                })
                    ->orWhere('memories.title', 'LIKE', '%'.$searchterm.'%')
                    ->orWhere('memories.description', 'LIKE', '%'.$searchterm.'%');
            })
                ->where(function ($q) use ($request) {
                    $q->where('memories.importance', 'LIKE', $request['importance']);
                })
                ->where(function ($q) use ($request) {
                    $q->whereDate('memories.created_at', '>=', $request['fromdate']);
                })
                ->where(function ($q) use ($request) {
                    $q->whereDate('memories.created_at', '<=', $request['todate']);
                })
                ->where(function ($q) use ($searchterm,$request) {
                    $q->whereHas('tags', function ($query) use ($request) {
                        $query->where('tags.id', 'LIKE', $request['tag']);
                    });
                })
                ->where(function ($q) use ($request,$userid) {
                    $q->where('user_id', $userid);
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }

        return view('memories.list')->with('memories',$memories)->with('searchterm',$searchterm)->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = auth()->user()->tags;
        return view('memories.create')->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = auth()->id();

        $attributes = request()->validate([
            'title' => 'required | min:3',
            'description' => 'nullable | min:5',
            'source' => 'nullable',
            'link' => 'nullable',
            'importance' => 'required',
            'user_id' => 'required',
        ]);

        $memory = Memory::create($attributes);

        if($request['tags'] !== null) {
            $tags = $request['tags'];
            foreach ($tags as $tag){
                $memory->tags()->attach($tag);
            }
        }
        if($request['newtag1'] !== null) {
            $newtag1 = $request['newtag1'];
            $userid = auth()->id();
            $newtag1id = DB::table('tags')->insertGetId(
                ['name' => $newtag1, 'user_id' => $userid,'created_at' => Carbon::now(),'updated_at' => Carbon::now(),]
            );
            $memory->tags()->attach($newtag1id);
        }
        if($request['newtag2'] !== null) {
            $newtag2 = $request['newtag2'];
            $userid = auth()->id();
            $newtag2id = DB::table('tags')->insertGetId(
                ['name' => $newtag2, 'user_id' => $userid,'created_at' => Carbon::now(),'updated_at' => Carbon::now(),]
            );
            $memory->tags()->attach($newtag2id);
        }


        return redirect('/memories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function show(Memory $memory)
    {
        //$this->authorize('view', $memory);
        $tags = $memory->tags()->orderBy('name')->get();
        $belongingfiles = Memfile::whereIn('memoryid',[$memory->id])->get();
        return view('memories.show')->with('memory',$memory)->with('tags', $tags)->with('belongingfiles', $belongingfiles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function edit(Memory $memory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memory $memory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memory $memory)
    {
        //
    }
}
