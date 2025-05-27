@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <h2 class="text-3xl font-semibold mb-4">Le Tue Bande</h2>

    <a href="{{ route('bands.create') }}" class="btn btn-primary">Nuova Band</a>

    @if($bands->isEmpty())
        <p class="text-gray-600 mt-4">Non fai parte di nessuna band.</p>
    @else
        <div class="grid md:grid-cols-2 gap-6 mt-4">
            @foreach($bands as $band)
                <div class="card">
                    <h3 class="text-xl font-bold mb-1">{{ $band->name }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $band->genre }}</p>
                    <p class="mb-3">{{ $band->description }}</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('bands.show', $band) }}" class="btn btn-secondary">Vedi</a>
                        @can('update', $band)
                            <a href="{{ route('bands.edit', $band) }}" class="btn btn-primary">Modifica</a>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
