@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Benvenuto, {{ Auth::user()->name }}!
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Band Finder è una piattaforma dedicata a musicisti e gruppi musicali. Qui puoi creare e gestire le tue band, 
                        pubblicare richieste per nuovi membri, esplorare altri gruppi, e collaborare con altri artisti per trovare la formazione perfetta.
                    </p>
                    <p class="card-text">
                        Usa il menu di navigazione in alto per esplorare le funzionalità offerte e iniziare subito a far parte della community musicale!
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
