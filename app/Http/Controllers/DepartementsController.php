<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacturesRequest;
use App\Models\Commandes;
use App\Models\Factures;
use Illuminate\Database\QueryException;
use Throwable;

class FacturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Factures::query()
            ->with('Commande')
            ->orderByDesc('DateFact')
            ->paginate(15);

        return view('factures.index', compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commandes = Commandes::query()
            ->with('Clients')
            ->orderByDesc('DateCmd')
            ->get();

        return view('factures.create', compact('commandes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacturesRequest $request)
    {
        $data = $request->validated();

        try {
            Factures::create($data);

            return redirect()
                ->route('factures.index')
                ->with('success', 'Facture créée avec succès.');
        } catch (QueryException $e) {
            return back()
                ->withErrors(['error' => 'Erreur base de données lors de la création de la facture.'])
                ->withInput();
        } catch (Throwable $e) {
            return back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de la facture.'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Factures $facture)
    {
        $facture->load(['Commande.Clients']);

        return view('factures.show', compact('facture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factures $facture)
    {
        $commandes = Commandes::query()
            ->with('Clients')
            ->orderByDesc('DateCmd')
            ->get();

        return view('factures.edit', compact('facture', 'commandes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacturesRequest $request, Factures $facture)
    {
        $data = $request->validated();

        try {
            $facture->update($data);

            return redirect()
                ->route('factures.index')
                ->with('success', 'Facture mise à jour avec succès.');
        } catch (QueryException $e) {
            return back()
                ->withErrors(['error' => 'Erreur base de données lors de la mise à jour de la facture.'])
                ->withInput();
        } catch (Throwable $e) {
            return back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour de la facture.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factures $facture)
    {
        try {
            $facture->delete();

            return redirect()
                ->route('factures.index')
                ->with('success', 'Facture supprimée avec succès.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Impossible de supprimer cette facture (contraintes BD).']);
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'Impossible de supprimer cette facture.']);
        }
    }
}
