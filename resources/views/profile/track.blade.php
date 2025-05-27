@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-purple-800">Scegli la tua traccia preferita</h1>

    <form action="{{ route('profile.track.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($tracks as $track)
                <label class="block border rounded p-4 cursor-pointer hover:bg-gray-100">
                    <input
                        type="radio"
                        name="track_id"
                        value="{{ $track['id'] }}"
                        class="sr-only"
                        {{ $user->favorite_track_id === $track['id'] ? 'checked' : '' }}
                    />

                    <div class="flex items-center space-x-4">
                        @if($track['cover'])
                            <img src="{{ $track['cover'] }}" alt="cover" class="w-12 h-12 rounded">
                        @endif
                        <div>
                            <p class="font-semibold">{{ $track['name'] }}</p>
                            <p class="text-sm text-gray-500">{{ $track['artist'] }} – {{ $track['album'] }}</p>
                        </div>
                    </div>

                    <input type="hidden" name="track_name" value="{{ $track['name'] }}">
                    <input type="hidden" name="track_url" value="{{ $track['url'] }}">
                </label>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Salva Traccia</button>
    </form>
</div>
@endsection
