@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-gray-900 rounded-lg shadow-lg p-8 text-gray-100">
    <h1 class="text-3xl font-bold mb-6 border-b-4 border-green-500 pb-2">
        Nuova Richiesta per “{{ $band->name }}”
    </h1>

    <form action="{{ route('bands.requests.store', ['band' => $band->id]) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="instrument_id" class="block mb-2 font-semibold text-purple-300">Strumento</label>
            <select name="instrument_id" id="instrument_id"
                class="w-full rounded bg-gray-800 border border-purple-600 text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">Seleziona...</option>
                @foreach($instruments as $instr)
                    <option value="{{ $instr->id }}" {{ old('instrument_id') == $instr->id ? 'selected' : '' }}>
                        {{ $instr->name }}
                    </option>
                @endforeach
            </select>
            @error('instrument_id')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-2 font-semibold text-purple-300">Descrizione</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full rounded bg-gray-800 border border-purple-600 text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="btn btn-primary">Crea Richiesta</button>
            <a href="{{ route('bands.show', $band) }}" class="btn btn-secondary">Torna alla Band</a>
        </div>
    </form>
</div>
@endsection
