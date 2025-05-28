@extends('layouts.app')

@section('content')
<div class="container py-8">
    <h2 class="text-3xl font-semibold mb-6">Band Disponibili con Richieste Aperte</h2>

    @php
        $bandsWithRequests = $bands->filter(fn($band) => $band->requests->isNotEmpty());
    @endphp

    @if($bandsWithRequests->isEmpty())
        <p class="text-gray-500">Non ci sono band con richieste aperte in questo momento.</p>
    @else
        <div class="space-y-4">
            @foreach($bandsWithRequests as $band)
                <details class="bg-white rounded shadow overflow-hidden">
                    <summary class="cursor-pointer px-6 py-4 flex justify-between items-center hover:bg-gray-100">
                        <div>
                            <h3 class="text-xl font-bold">{{ $band->name }}</h3>
                            @if($band->genre)
                                <span class="text-sm text-gray-500">{{ $band->genre }}</span>
                            @endif
                        </div>
                        <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        @if($band->description)
                            <p class="mb-4">{{ $band->description }}</p>
                        @endif

                        <p class="font-semibold mb-2">Richieste aperte:</p>
                        <ul class="space-y-2">
                            @foreach($band->requests as $req)
                                <li class="flex justify-between items-center bg-white rounded p-3 shadow">
                                    <div>
                                        <strong>{{ $req->instrument->name }}</strong>
                                        @if($req->description)
                                            – {{ \Illuminate\Support\Str::limit($req->description, 50) }}
                                        @endif
                                    </div>
                                    @unless($req->applications->pluck('user_id')->contains(auth()->id()))
                                        <form action="{{ route('requests.apply', $req) }}" method="POST">
                                            @csrf
                                            <button class="text-green-600 hover:text-green-800 font-semibold">
                                                Candidati
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 italic">Già candidato</span>
                                    @endunless
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </details>
            @endforeach
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('details').forEach(el => {
        el.addEventListener('toggle', () => {
            const svg = el.querySelector('summary svg');
            if (el.open) svg.classList.add('transform', 'rotate-180');
            else svg.classList.remove('transform', 'rotate-180');
        });
    });
</script>
@endsection
