@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-gray-900 rounded-lg shadow-lg p-8 text-gray-100">
    <h1 class="text-3xl font-bold mb-6 border-b-4 border-green-500 pb-2">
        Crea Nuova Band
    </h1>

    <form action="{{ route('bands.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block mb-2 font-semibold text-purple-300">Nome Band</label>
            <input type="text" name="name" id="name"
                   class="w-full rounded bg-gray-800 border border-purple-600 text-gray-100 px-4 py-2"
                   value="{{ old('name') }}" required>
            @error('name')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="genre" class="block mb-2 font-semibold text-purple-300">Genere</label>
            <input type="text" name="genre" id="genre"
                   class="w-full rounded bg-gray-800 border border-purple-600 text-gray-100 px-4 py-2"
                   value="{{ old('genre') }}">
            @error('genre')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-2 font-semibold text-purple-300">Descrizione</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full rounded bg-gray-800 border border-purple-600 text-gray-100 px-4 py-2">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg">
                Salva Band
            </button>
        </div>
    </form>
</div>
@endsection
