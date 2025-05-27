<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\Band;
use Illuminate\Http\Request;

class RequestApiController extends Controller
{
    public function allInstruments()
    {
        return Instrument::select('id', 'name')->orderBy('name')->get();
    }

    public function bandsByInstrument(Instrument $instrument)
    {
        $bands = Band::whereHas('requests', function ($query) use ($instrument) {
            $query->where('instrument_id', $instrument->id);
        })->with(['requests' => function ($query) use ($instrument) {
            $query->where('instrument_id', $instrument->id);
        }])->get();

        return $bands;
    }
}
