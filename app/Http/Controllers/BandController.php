<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Instrument;
use App\Models\RequestApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class BandController extends Controller
{
    public function index()
    {
        $bands = Auth::user()->bands()->with('owner')->get();
        return view('bands.index', compact('bands'));
    }

    public function create()
    {
        return view('bands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $band = Band::create([
                'name' => $request->name,
                'genre' => $request->genre,
                'description' => $request->description,
                'owner_id' => auth()->id(),
            ]);
            $band->users()->attach(auth()->id());

            return redirect()->route('bands.index')->with('success', 'Band created successfully!');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
              
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'You already have a band with this name.');
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'An unexpected error occurred while creating the band.');
        }
    }

    public function show(Band $band)
    {
        $band->load('members.instruments', 'requests.instrument', 'requests.applications');

        $members = $band->members;
        $requests = $band->requests;

        return view('bands.show', compact('band', 'members', 'requests'));
    }
    public function edit(Band $band)
    {
        $this->authorize('update', $band);
        return view('bands.edit', compact('band'));
    }

    public function browse()
    {
        $bands = Band::with('owner')->get();

        return view('bands.browse', compact('bands'));
    }

    public function update(Request $request, Band $band)
    {
        $this->authorize('update', $band);
        $data = $request->validate([
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
        ]);
        $band->update($data);
        return back()->with('success', 'Band aggiornata!');
    }

    public function destroy(Band $band)
    {
        $this->authorize('delete', $band);
        $band->delete();
        return redirect()->route('bands.index')->with('success', 'Band rimossa.');
    }
    public function explore()
    {
        $user = auth()->user();

        // Get all bands the user is NOT part of
        $bands = Band::whereDoesntHave('members', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('requests.instrument', 'requests.applications')->get();

        return view('bands.explore', compact('bands'));
    }
    public function apply(Request $request)
{
    $user = Auth::user();

    // Verifica se l'utente ha già fatto domanda
    $alreadyApplied = RequestApplication::where('request_id', $request->id)
        ->where('user_id', $user->id)
        ->exists();

    if ($alreadyApplied) {
        return redirect()->back()->with('error', 'Hai già fatto domanda per questa richiesta.');
    }

    // Crea la candidatura
    RequestApplication::create([
        'request_id' => $request->id,
        'user_id' => $user->id,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Candidatura inviata con successo!');
}
}
