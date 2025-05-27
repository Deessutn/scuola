<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Request as BandRequest;

class Band extends Model
{
    protected $fillable = [
        'name',
        'genre',
        'description',
        'owner_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

 
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'band_user',     
            'band_id',       
            'user_id'       
        )->withTimestamps();
    }

    
    public function users(): BelongsToMany
    {
        return $this->members();
    }

 
    public function requests(): HasMany
    {
        return $this->hasMany(BandRequest::class, 'band_id');
    }
}
