<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ingrediants()
    {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    public function typeoffoods()
    {
        return $this->HasOne('App\Models\Typeoffood');
    }
}
