<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Memory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function sharedmemoriesuser(): HasMany
    {
        return $this->hasMany(SharedMemory::class, 'shared_memory_id');
    }
}
