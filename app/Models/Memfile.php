<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memfile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function memories()
    {
        return $this->belongsTo('App\Models\Memory');
    }
}
