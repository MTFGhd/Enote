<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientsRequest;
use App\Models\Clients;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Throwable;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Clients::query()
            ->orderBy('Nom')
            ->paginate(15);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientsRequest $request)
    {
        $data = $request->validated();

        try {
            $client = new Clients($data);
            $client->IdClient = (string) Str::uuid();
            $client->save();

            return redirect()
                ->route('clients.index')
                ->with('success', 'Client créé avec succès.');
        } catch (QueryException $e) {
            return back()
                ->withErrors(['error' => "Erreur base de données lors de la création du client."])
                ->withInput();
        } catch (Throwable $e) {
            return back()
                ->withErrors(['error' => "Une erreur est survenue lors de la création du client."])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Clients $client)
    {
        $client->load('Commandes');

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientsRequest $request, Clients $client)
    {
        $data = $request->validated();

        try {
            $client->update($data);

            return redirect()
                ->route('clients.index')
                ->with('success', 'Client mis à jour avec succès.');
        } catch (QueryException $e) {
            return back()
                ->withErrors(['error' => "Erreur base de données lors de la mise à jour du client."])
                ->withInput();
        } catch (Throwable $e) {
            return back()
                ->withErrors(['error' => "Une erreur est survenue lors de la mise à jour du client."])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clients $client)
    {
        try {
            $client->delete();

            return redirect()
                ->route('clients.index')
                ->with('success', 'Client supprimé avec succès.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Impossible de supprimer ce client (contraintes BD).']);
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'Impossible de supprimer ce client.']);
        }
    }
}
