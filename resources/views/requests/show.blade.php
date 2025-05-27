@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-gray-50 rounded shadow">

    <h1 class="text-3xl font-bold mb-4 text-purple-800">
        Richiesta: {{ $request->instrument->name }} per “{{ $request->band->name }}”
    </h1>

    @if($request->description)
        <p class="mb-6 text-gray-700">{{ $request->description }}</p>
    @endif

    <div class="mb-6 p-4 bg-yellow-50 rounded">
        <strong class="text-yellow-600">
            Traccia preferita di {{ optional($request->band->user)->name ?? '—' }}:
        </strong>
        @if(optional($request->band->user)->favorite_track_url)
            <a href="{{ $request->band->user->favorite_track_url }}" target="_blank" class="text-yellow-800 hover:underline">
                {{ $request->band->user->favorite_track_name }}
            </a>
        @else
            <span class="italic text-gray-400">Non ha ancora scelto una traccia.</span>
        @endif
    </div>

    <h2 class="text-2xl font-semibold mb-4 text-green-700">Candidature</h2>

    @if($request->applications->isEmpty())
        <p class="italic text-gray-500">Ancora nessuna candidatura.</p>
    @else
        <ul class="space-y-4">
            @foreach($request->applications as $app)
                <li class="bg-white rounded p-4 flex justify-between items-center border">
                    <div>
                        <strong>{{ $app->user->name }}</strong>
                        <span class="ml-2 px-2 py-1 text-sm rounded 
                            {{ $app->status==='accepted'? 'bg-green-200 text-green-800' 
                              : ($app->status==='rejected' ? 'bg-red-200 text-red-800' 
                                  : 'bg-yellow-200 text-yellow-800') }}">
                            {{ ucfirst($app->status) }}
                        </span>

                        <div class="mt-2">
                            <small>Traccia preferita:</small>
                            @if(optional($app->user)->favorite_track_url)
                                <a href="{{ $app->user->favorite_track_url }}" target="_blank" class="text-yellow-800 hover:underline">
                                    {{ $app->user->favorite_track_name }}
                                </a>
                            @else
                                <span class="italic text-gray-400">Non selezionata</span>
                            @endif
                        </div>
                    </div>

                    @can('update', $request->band)
                        @if($app->status === 'pending')
                            <form method="POST"
                                  action="{{ route('requests.applications.status', [
                                      'request'     => $request->id,
                                      'application' => $app->id
                                  ]) }}"
                                  class="flex space-x-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="accepted"
                                        class="btn btn-primary px-3 py-1 text-sm">
                                    Accetta
                                </button>
                                <button type="submit" name="status" value="rejected"
                                        class="btn btn-secondary px-3 py-1 text-sm">
                                    Rifiuta
                                </button>
                            </form>
                        @endif
                    @endcan
                </li>
            @endforeach
        </ul>
    @endif

</div>
@endsection
