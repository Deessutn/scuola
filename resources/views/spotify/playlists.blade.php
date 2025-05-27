@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Le Tue Playlist Spotify</h1>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if(!$playlists)
        <a href="{{ route('spotify.connect') }}" class="btn btn-primary">
            Collega il tuo account Spotify
        </a>
    @else
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($playlists as $pl)
                <li class="border rounded overflow-hidden">
                    <img src="{{ $pl['images'][0]['url'] ?? 'https://via.placeholder.com/300' }}"
                         alt="{{ $pl['name'] }}" class="w-full h-48 object-cover">
                    <div class="p-3">
                        <h2 class="font-semibold">{{ $pl['name'] }}</h2>
                        <p class="text-sm">{{ $pl['tracks']['total'] }} brani</p>
                        <a href="{{ $pl['external_urls']['spotify'] }}"
                           target="_blank" class="text-blue-600 underline text-sm">
                            Apri in Spotify
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
