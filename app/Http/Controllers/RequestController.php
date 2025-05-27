<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Instrument;
use App\Models\Request as BandRequest;
use App\Models\RequestApplication;
use Illuminate\Http\Request;

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

    public function store(Request $request, Band $band)
    {
        $data = $request->validate([
            'instrument_id' => 'required|exists:instruments,id',
            'description' => 'nullable|string',
        ]);

        $band->requests()->create($data);

        return redirect()
            ->route('bands.show', $band)
            ->with('success', 'Richiesta creata con successo!');
    }

    public function show(BandRequest $request)
    {
        $request->load('band', 'instrument', 'applications.user');
        return view('requests.show', compact('request'));
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
            'user_id' => $user->id,
            'request_id' => $request->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Candidatura inviata con successo!');
    }
    public function updateApplicationStatus(
        \App\Models\Request $requestModel,
        \App\Models\RequestApplication $application,
        Request $http
    ) {
        $this->authorize('update', $requestModel->band);

        $status = $http->input('status');
        if (!in_array($status, ['accepted', 'rejected'])) {
            abort(422, 'Invalid status');
        }

        $application->status = $status;
        $application->save();

        if ($status === 'accepted') {
            $requestModel->band
                ->members()
                ->syncWithoutDetaching($application->user_id);

            $requestModel->delete();
        }

        return back()->with('success', "Candidatura {$status} con successo!");
    }
}
