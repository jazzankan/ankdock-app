<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipefile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe');
    }
}
