<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Memory;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Memory $memory)
    {
        $usersmemory = $memory->where('user_id',$user->id)->where('id',$memory->id)->get();
        if(count($usersmemory) > 0) {
            return true;
            }
        elseif ($memory->sharedmemoriesuser()->where('user_id', $user->id)->exists()){
            return true;
        }
        else{
            return false;
        }
    }
    public function update(User $user, Memory $memory)
    {
        $usersmemory = $memory->where('user_id',$user->id)->where('id',$memory->id)->get();
        return count($usersmemory) > 0;
    }
}
