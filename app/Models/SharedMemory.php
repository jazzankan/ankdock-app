<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SharedMemory extends Model
{
    protected $guarded = [];
    protected $table = "shared_memory_user";

    public function sharingusers()
    {
        return $this->belongsToMany('App\Models\User');
    }
    public function memory() : BelongsTo
    {
        return $this->belongsTo('App\Models\Memory');
    }
}
