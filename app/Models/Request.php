<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'band_id', 'instrument_id', 'description'
    ];

    public function band()
    {
        return $this->belongsTo(Band::class);
    }

    public function applications()
{
    return $this->hasMany(RequestApplication::class);
}

public function instrument()
{
    return $this->belongsTo(Instrument::class);
}

}
