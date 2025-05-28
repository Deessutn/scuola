@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h1 class="display-5">Richiesta per “{{ $request->instrument?->name ?? 'Strumento non disponibile' }}”</h1>
        <p class="text-secondary">Band: <strong>{{ $request->band->name ?? 'Band non disponibile' }}</strong></p>
    </div>

    @if($request->description)
        <div class="mb-4">
            <p>{{ $request->description }}</p>
        </div>
    @endif

    <h3>Candidature</h3>
    @if($request->applications->isEmpty())
        <p class="text-muted mb-4">Nessuna candidatura.</p>
    @else
        <ul class="list-group mb-4">
            @foreach($request->applications as $app)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="h6">{{ $app->user->name }}</span>
                        <span class="badge
                            {{ $app->status==='accepted' ? 'bg-success'
                              : ($app->status==='rejected' ? 'bg-danger'
                                  : 'bg-warning text-dark') }}">
                            {{ ucfirst($app->status) }}
                        </span>
                    </div>

                    @can('update', $request->band)
                        @if($app->status === 'pending')
                            <div class="btn-group" role="group">
                                {{-- Accept --}}
                                <form method="POST"
                                      action="{{ route('requests.applications.status', ['request' => $request->id, 'application' => $app->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-sm btn-success">Accetta</button>
                                </form>

                                {{-- Reject --}}
                                <form method="POST"
                                      action="{{ route('requests.applications.status', ['request' => $request->id, 'application' => $app->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger">Rifiuta</button>
                                </form>
                            </div>
                        @endif
                    @endcan
                </li>
            @endforeach
        </ul>
    @endif

    @if($request->band)
        <a href="{{ route('bands.show', ['band' => $request->band->id]) }}" class="btn btn-secondary">
            Torna alla Band
        </a>
    @endif
</div>
@endsection