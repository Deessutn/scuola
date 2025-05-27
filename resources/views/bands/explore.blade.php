@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Band Disponibili</h2>

    @if($bands->isEmpty())
        <p class="text-muted">Non ci sono band disponibili al momento.</p>
    @else
        <ul class="list-group">
            @foreach($bands as $band)
                <li class="list-group-item">
                    <h5 class="mb-1">{{ $band->name }}</h5>
                    @if($band->genre)
                        <small class="text-muted">{{ $band->genre }}</small>
                    @endif
                    @if($band->description)
                        <p class="mt-1">{{ $band->description }}</p>
                    @endif

                    @if($band->requests->isNotEmpty())
                        <p class="fw-bold mt-2">Richieste aperte:</p>
                        <ul>
                            @foreach($band->requests as $req)
                                <li class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $req->instrument->name }}</strong>
                                        @if($req->description)
                                            – {{ Str::limit($req->description, 50) }}
                                        @endif
                                    </div>
                                    @unless($req->applications->pluck('user_id')->contains(auth()->id()))
                                        <form action="{{ route('requests.apply', $req) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-success">Candidati</button>
                                        </form>
                                    @else
                                        <span class="badge bg-secondary">Hai già fatto domanda</span>
                                    @endunless
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Nessuna richiesta attiva.</p>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
