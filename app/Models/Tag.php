<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function memories()
    {
        return $this->belongsToMany('App\Models\Memory');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
