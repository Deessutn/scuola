@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-bl from-purple-900 via-green-800 to-purple-900 p-8 text-gray-100 rounded-lg shadow-lg max-w-5xl mx-auto">

    <div class="flex justify-between items-start border-b-4 border-green-600 pb-4 mb-6">
        <div>
            <h1 class="text-4xl font-bold text-green-300">{{ $band->name }}</h1>
            <p class="mt-2 text-gray-200">
                Creatore: {{ $band->owner->name }}
            </p>
            @if($band->genre)
                <p class="text-green-400 italic">{{ $band->genre }}</p>
            @endif
            @if($band->description)
                <p class="mt-3 text-gray-300">{{ $band->description }}</p>
            @endif
        </div>
        @can('update', $band)
            <a href="{{ route('bands.edit', $band) }}" class="btn btn-primary">Modifica Band</a>
        @endcan
    </div>

    <div class="mb-8 p-4 bg-yellow-50 rounded">
        <strong class="text-yellow-600">Traccia preferita di {{ optional($band->user)->name ?? '—' }}:</strong>
        @if(optional($band->user)->favorite_track_url)
            <a href="{{ $band->user->favorite_track_url }}" target="_blank" class="text-yellow-800 hover:underline">
                {{ $band->user->favorite_track_name }}
            </a>
        @else
            <span class="italic text-gray-400">Non ha ancora scelto una traccia.</span>
        @endif
    </div>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-green-400 mb-4 border-b-2 border-purple-600 pb-2">Membri</h2>
        @if($members->isEmpty())
            <p class="italic text-gray-400">Nessun membro ancora.</p>
        @else
            <ul class="list-disc list-inside text-gray-200 space-y-1">
                @foreach($members as $member)
                    <li>
                        {{ $member->name }}
                        @if($member->instruments->isNotEmpty())
                            <br>
                            <small class="text-green-300 italic">
                                {{ $member->instruments->pluck('name')->join(', ') }}
                            </small>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <section>
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-2xl font-semibold text-green-400 border-b-2 border-purple-600 pb-2">Richieste</h2>
            @can('update', $band)
                <a href="{{ route('bands.requests.create', $band) }}" class="btn btn-primary px-3 py-1 text-sm">
                    Nuova Richiesta
                </a>
            @endcan
        </div>

        @if($requests->isEmpty())
            <p class="italic text-gray-400">Non ci sono richieste aperte.</p>
        @else
            <ul class="space-y-3">
                @foreach($requests as $req)
                    <li class="flex justify-between items-center bg-purple-800 rounded p-3 shadow hover:bg-purple-700 transition">
                        <div>
                            <strong class="text-green-300">{{ $req->instrument->name }}</strong>
                            @if($req->description)
                                – <span class="text-gray-300">{{ \Illuminate\Support\Str::limit($req->description, 50) }}</span>
                            @endif
                        </div>
                        <a href="{{ route('requests.show', $req) }}" class="btn btn-secondary px-3 py-1 text-sm">
                           Apri
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
@endsection
