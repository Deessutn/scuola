@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <h2 class="text-2xl font-semibold">Modifica Band: {{ $band->name }}</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong>Oops!</strong> Ci sono alcuni problemi con i tuoi dati.<br><br>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bands.update', $band) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium text-sm">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name', $band->name) }}" 
                class="w-full mt-1 border border-gray-300 rounded px-4 py-2" required>
        </div>

        <div>
            <label for="genre" class="block font-medium text-sm">Genere</label>
            <input type="text" name="genre" id="genre" value="{{ old('genre', $band->genre) }}" 
                class="w-full mt-1 border border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label for="description" class="block font-medium text-sm">Descrizione</label>
            <textarea name="description" id="description" rows="4"
                class="w-full mt-1 border border-gray-300 rounded px-4 py-2">{{ old('description', $band->description) }}</textarea>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('bands.index') }}" class="px-4 py-2 bg-gray-200 text-black rounded">Annulla</a>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Salva</button>
        </div>
    </form>
</div>
@endsection
