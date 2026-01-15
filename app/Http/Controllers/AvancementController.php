<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandesRequest;
use App\Models\Clients;
use App\Models\Commandes;
use Illuminate\Database\QueryException;
use Throwable;

class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commandes::query()
            ->with('Clients')
            ->orderByDesc('DateCmd')
            ->paginate(15);

        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Clients::query()
            ->orderBy('Nom')
            ->get();

        return view('commandes.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommandesRequest $request)
    {
        $data = $request->validated();

        try {
            Commandes::create($data);

            return redirect()
                ->route('commandes.index')
                ->with('success', 'Commande créée avec succès.');
        } catch (QueryException $e) {
            return back()
                ->withErrors(['error' => 'Erreur base de données lors de la création de la commande.'])
                ->withInput();
        } catch (Throwable $e) {
            return back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de la commande.'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commandes $commande)
    {
        $commande->load(['Clients', 'Facture']);

        return view('commandes.show', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commandes $commande)
    {
        $clients = Clients::query()
            ->orderBy('Nom')
            ->get();

        return view('commandes.edit', compact('commande', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommandesRequest $request, Commandes $commande)
    {
        $data = $request->validated();

        try {
            $commande->update($data);

            return redirect()
                ->route('commandes.index')
                ->with('success', 'Commande mise à jour avec succès.');
        } catch (QueryException $e) {
            return back()
                ->withErrors(['error' => 'Erreur base de données lors de la mise à jour de la commande.'])
                ->withInput();
        } catch (Throwable $e) {
            return back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour de la commande.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commandes $commande)
    {
        try {
            $commande->delete();

            return redirect()
                ->route('commandes.index')
                ->with('success', 'Commande supprimée avec succès.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Impossible de supprimer cette commande (contraintes BD).']);
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'Impossible de supprimer cette commande.']);
        }
    }
}
