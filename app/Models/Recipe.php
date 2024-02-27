<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    public function typeoffoods()
    {
        return $this->HasOne('App\Models\Typeoffood');
    }

    public function recipefile()
    {
        return $this->HasOne(Recipefile::class);
    }
}
