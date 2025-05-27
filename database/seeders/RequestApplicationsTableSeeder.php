<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\User;

class RequestApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        $request = Request::first();
        $applicants = User::skip(4)->take(2)->get();

        foreach ($applicants as $user) {
            $request->applications()->create([
                'user_id' => $user->id,
                'message' => 'Vorrei unirmi alla band!',
                'status' => 'pending',
            ]);
        }
    }
}
