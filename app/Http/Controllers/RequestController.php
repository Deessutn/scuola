<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Instrument;
use App\Models\Request as BandRequest;
use App\Models\RequestApplication;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function index(Band $band)
    {
        $requests = $band->requests()->with('instrument')->get();
        return view('requests.index', compact('band', 'requests'));
    }

    public function create(Band $band)
    {
        $instruments = Instrument::all();
        return view('requests.create', compact('band', 'instruments'));
    }

    public function store(HttpRequest $http, Band $band)
    {
        $data = $http->validate([
            'instrument_id' => 'required|exists:instruments,id',
            'description'   => 'nullable|string',
        ]);

        $band->requests()->create($data);

        return redirect()->route('bands.show', ['band' => $band->id])
                         ->with('success', 'Richiesta creata con successo!');
    }

    public function show(BandRequest $request)
    {
        $request->load(['instrument', 'band', 'applications.user']);

        if (! $request->band) {
            abort(404, 'Band non trovata per questa richiesta.');
        }

        return view('requests.show', ['request' => $request]);
    }

    public function destroy(BandRequest $request)
    {
        $this->authorize('delete', $request->band);
        $request->delete();
        return back()->with('success', 'Richiesta rimossa.');
    }

    public function apply(BandRequest $request)
    {
        $user = auth()->user();

        if ($request->applications()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Hai già fatto domanda per questa richiesta.');
        }

        RequestApplication::create([
            'user_id'    => $user->id,
            'request_id' => $request->id,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Candidatura inviata con successo!');
    }

    public function updateApplicationStatus(BandRequest $request, RequestApplication $application, HttpRequest $http)
{
    $this->authorize('update', $request->band);

    $status = $http->input('status');
    if (! in_array($status, ['accepted', 'rejected'])) {
        abort(422, 'Invalid status');
    }

    $application->status = $status;
    $application->save();

    if ($status === 'accepted') {
        // Aggiungo il membro
        $request->band->members()->syncWithoutDetaching($application->user_id);

        // Salvo l'ID della band per il redirect
        $bandId = $request->band->id;

        // Elimino la richiesta
        $request->delete();

        // Redirect alla pagina della band
        return redirect()
            ->route('bands.show', ['band' => $bandId])
            ->with('success', 'Candidatura accettata e membro aggiunto!');
    }

    // Se è rejected, lascio la richiesta in vita e torno allo show
    return redirect()
        ->route('requests.show', ['request' => $request->id])
        ->with('success', 'Candidatura rifiutata.');
}

}