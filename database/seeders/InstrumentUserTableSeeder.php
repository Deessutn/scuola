<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instrument;

class InstrumentUserTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $instruments = Instrument::all();

        foreach ($users as $user) {
            $user->instruments()->attach($instruments->random(2));
        }
    }
}
