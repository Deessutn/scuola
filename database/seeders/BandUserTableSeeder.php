<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Band;
use App\Models\User;

class BandUserTableSeeder extends Seeder
{
    public function run()
    {
        $band = Band::first();
        $members = User::skip(1)->take(3)->get();

        foreach ($members as $user) {
            $band->members()->attach($user->id);
        }
    }
}
