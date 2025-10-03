<?php

namespace App\Http\Controllers;

use App\Models\SharedMemory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Memory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Notifications\MailMemory;

class SharedMemoryController extends Controller
{
    public function share($memory_id){
        $memory = Memory::find($memory_id);
        $this->authorize('update', $memory);
        $myid = auth()->user()->id;
        $allusers = User::all();
        $usersminusme = $allusers->where('id', '!=', $myid);
        return view('/memories/share')->with('memory', $memory)->with('usersminusme', $usersminusme);
    }
    public function store(Request $request){
        $attributes = request()->validate([
            'memory_id' => 'required | int',
            'memshare' => 'required | array'
        ]);
        $shared_memory_id = $attributes['memory_id'];
        foreach ($attributes['memshare'] as $user_id){
            $shared_memory = new SharedMemory();
            $attarray = ['shared_memory_id' => $shared_memory_id,'user_id' => $user_id];
            $shared_memory->sharingusers()->withTimestamps()->attach([$attarray]);
            $mailfail = null;
            try {
                $user = User::find($user_id);
                $user->notify(new MailMemory());
            } catch(\Exception $e) {
                $mailfail = 'OBS! Mail till medarbetare om nytt projekt funkade inte!';
            }
        }

        return redirect('/memories/'.$attributes['memory_id'])->with('mailfail',$mailfail);
    }
    public function sharing(){
        $myself = auth()->user();
        $toyouids = DB::table('shared_memory_user')->where('user_id', $myself->id)->get()->pluck('shared_memory_id');
        $memories = Memory::whereIn('id', $toyouids)->get();
        foreach ($memories as $m){
            $m['sharetime'] = $m->sharedmemoriesuser()->value('created_at')->format('Y-m-d');
        };
        $memories = $memories->sortByDesc('sharetime');
        $newmemory = Carbon::now()->subDay()->format('Y-m-d');
        return view('/memories/sharing')->with('memories', $memories)->with('myself', $myself)->with('newmemory', $newmemory);
    }
}
