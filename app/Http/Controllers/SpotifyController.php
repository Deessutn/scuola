<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SpotifyController extends Controller
{
    public function redirectToSpotify()
    {
        $query = http_build_query([
            'client_id'     => config('services.spotify.client_id'),
            'response_type' => 'code',
            'redirect_uri'  => route('spotify.callback'),
            'scope'         => 'user-library-read playlist-read-private',
        ]);
        return redirect('https://accounts.spotify.com/authorize?'.$query);
    }

    public function handleCallback(Request $request)
    {
        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type'    => 'authorization_code',
            'code'          => $request->code,
            'redirect_uri'  => route('spotify.callback'),
            'client_id'     => config('services.spotify.client_id'),
            'client_secret' => config('services.spotify.client_secret'),
        ]);

        $access = $response->json()['access_token'];
        $user = Auth::user();
        $user->spotify_token = $access;
        $user->save();

        return redirect()->route('home')->with('success','Collegato a Spotify!');
    }

    public function showPlaylists()
    {
        $user = Auth::user();
        $response = Http::withToken($user->spotify_token)
            ->get('https://api.spotify.com/v1/me/playlists');

        $playlists = $response->json()['items'] ?? [];
        return view('spotify.playlists', compact('playlists'));
    }
}
