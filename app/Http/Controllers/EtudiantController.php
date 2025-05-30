<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('Etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        // Cette méthode affiche le formulaire de création d'un étudiant
        return view('Etudiants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
        ]);

        Etudiant::create($request->all());

        return redirect()->route('etudiants.index')->with('success', 'Étudiant créé avec succès.');
    }

    public function show($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('Etudiants.show', compact('etudiant'));
    }

    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('Etudiants.edit', compact('etudiant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
        ]);

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->update($request->all());

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();
        
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
    }
}