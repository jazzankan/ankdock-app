<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');

    }
    public function scopeShared($query, $myname, $project)
    {
        $sharing = array();
        $user = User::all();
        foreach($user as $u) {
            foreach($u->projects as $p) {
                if ($p->id == $project->id) {
                    array_push($sharing, $u->name);
                }
            }
        }

        if (($key = array_search($myname, $sharing)) !== false) {
            unset($sharing[$key]);
        }
        return $sharing;
    }
}
