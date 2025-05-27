<?php
namespace Database\Seeders;

use App\Models\Band;
use App\Models\User;
use Illuminate\Database\Seeder;

class BandsTableSeeder extends Seeder
{
    public function run()
    {
        $owner = User::first();
        Band::create([
            'name' => 'Gruppetto',
            'description' => 'Band di esempio',
            'genre' => 'Pop',
            'owner_id' => $owner->id,
        ]);
    }
}
