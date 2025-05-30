<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enseignant;

class EnseignantController extends Controller
{
    public function index(){
        $enseignants = Enseignant::paginate(10);
        return view('Enseignants.listeEnseignants', compact('enseignants'));
    }

    public function create()
    {
        return view('Enseignants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'matiere' => 'required|string|max:255',
        ]);

        Enseignant::create($request->all());

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant ajouté avec succès!');
    }

    public function show($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('Enseignants.show', compact('enseignant'));
    }

    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('Enseignants.edit', compact('enseignant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'matiere' => 'required|string|max:255',
        ]);

        $enseignant = Enseignant::findOrFail($id);
        $enseignant->update($request->all());

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant modifié avec succès!');
    }

    public function destroy($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $enseignant->delete();

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant supprimé avec succès!');
    }
}
