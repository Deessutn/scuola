@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-6 text-purple-800">Modifica Profilo</h1>

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block font-medium">Nome</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', auth()->user()->name) }}"
                class="mt-1 w-full rounded border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                required
            >
            @error('name')
                <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', auth()->user()->email) }}"
                class="mt-1 w-full rounded border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                required
            >
            @error('email')
                <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block font-medium">Nuova Password</label>
            <input
                id="password"
                name="password"
                type="password"
                class="mt-1 w-full rounded border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                autocomplete="new-password"
            >
            @error('password')
                <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block font-medium">Conferma Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 w-full rounded border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                autocomplete="new-password"
            >
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">Aggiorna Profilo</button>
        </div>
    </form>

    <hr class="my-8">

    <h2 class="text-xl font-semibold mb-4 text-purple-800">Traccia Preferita</h2>

    @if(auth()->user()->spotify_token)
        @if(auth()->user()->favorite_track_url)
            <p class="mb-2">
                Attuale:
                <a href="{{ auth()->user()->favorite_track_url }}" target="_blank"
                   class="text-yellow-600 hover:underline">
                    {{ auth()->user()->favorite_track_name }}
                </a>
            </p>
        @else
            <p class="italic text-gray-500 mb-2">Non hai ancora scelto una traccia.</p>
        @endif

        <a href="{{ route('profile.track.edit') }}" class="btn btn-secondary">
            Cambia Traccia
        </a>
    @else
        <p class="italic text-gray-500 mb-4">
            Devi collegare il tuo account a Spotify per scegliere una traccia.
        </p>
        <a href="{{ route('spotify.connect') }}" class="btn btn-primary">
            Collega a Spotify
        </a>
    @endif

</div>
@endsection
