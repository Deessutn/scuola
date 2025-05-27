<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            InstrumentsTableSeeder::class,
            BandsTableSeeder::class,
            InstrumentUserTableSeeder::class,
            BandUserTableSeeder::class,
            RequestsTableSeeder::class,
            RequestApplicationsTableSeeder::class,
        ]);
    }

}
