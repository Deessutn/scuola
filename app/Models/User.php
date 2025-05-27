<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'spotify_token',
        'favorite_track_id',
        'favorite_track_name',
        'favorite_track_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function instruments()
    {
        return $this->belongsToMany(Instrument::class);
    }

    public function bands()
    {
        return $this->belongsToMany(Band::class)
            ->withTimestamps();
    }

    public function ownedBands()
    {
        return $this->hasMany(Band::class, 'owner_id');
    }

    public function applications()
    {
        return $this->hasMany(RequestApplication::class);
    }

}
