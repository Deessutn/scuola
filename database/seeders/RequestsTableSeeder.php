<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\Band;
use App\Models\Instrument;

class RequestsTableSeeder extends Seeder
{
    public function run()
    {
        $band = Band::first();
        $instrument = Instrument::where('name', 'Batteria')->first();

        Request::create([
            'band_id' => $band->id,
            'instrument_id' => $instrument->id,
            'description' => 'Cerchiamo un batterista.',
        ]);
    }
}
