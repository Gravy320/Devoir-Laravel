<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Etudiant;
use App\Models\Enseignant;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    /**
     * Affiche la liste des évaluations
     */
    public function index()
    {
        $evaluations = Evaluation::with('enseignant')->get();
        return view('evaluations.index', compact('evaluations'));
    }

    /**
     * Affiche le formulaire de création d'évaluation
     */
    public function create()
    {
        $enseignants = Enseignant::all();
        return view('evaluations.create', compact('enseignants'));
    }

    /**
     * Enregistre une nouvelle évaluation
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'enseignant_id' => 'required|exists:enseignants,id',
            'Titre' => 'required|string|max:45',
            'Date' => 'nullable|date',
            'Matière' => 'nullable|string|max:45',
            'Type' => 'nullable|string|max:45',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Evaluation::create($request->all());
        return redirect()->route('evaluations.index')->with('success', 'Évaluation créée avec succès');
    }

    /**
     * Affiche les détails d'une évaluation
     */
    public function show($id)
    {
        $evaluation = Evaluation::with(['enseignant', 'notes.etudiant'])->findOrFail($id);
        return view('evaluations.show', compact('evaluation'));
    }

    /**
     * Affiche le formulaire d'édition d'une évaluation
     */
    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $enseignants = Enseignant::all();
        return view('evaluations.edit', compact('evaluation', 'enseignants'));
    }

    /**
     * Met à jour une évaluation
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'enseignant_id' => 'required|exists:enseignants,id',
            'Titre' => 'required|string|max:45',
            'Date' => 'nullable|date',
            'Matière' => 'nullable|string|max:45',
            'Type' => 'nullable|string|max:45',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $evaluation = Evaluation::findOrFail($id);
        $evaluation->update($request->all());
        return redirect()->route('evaluations.index')->with('success', 'Évaluation mise à jour avec succès');
    }

    /**
     * Supprime une évaluation
     */
    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();
        return redirect()->route('evaluations.index')->with('success', 'Évaluation supprimée avec succès');
    }

    /**
     * Affiche le formulaire pour attribuer des notes aux étudiants
     */
    public function attribuerNotes($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $etudiants = Etudiant::all();
        
        // Récupérer les notes existantes pour cette évaluation
        $notes = Note::where('evaluation_id', $id)->pluck('note', 'etudiant_id')->toArray();
        
        return view('evaluations.attribuer-notes', compact('evaluation', 'etudiants', 'notes'));
    }

    /**
     * Enregistre les notes des étudiants pour une évaluation
     */
    public function enregistrerNotes(Request $request, $id)
    {
        $evaluation = Evaluation::findOrFail($id);
        
        // Validation des notes
        $validator = Validator::make($request->all(), [
            'notes' => 'required|array',
            'notes.*' => 'nullable|numeric|min:0|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Traiter chaque note
        foreach ($request->notes as $etudiantId => $noteValue) {
            if ($noteValue !== null) {
                // Vérifier si une note existe déjà pour cet étudiant dans cette évaluation
                $note = Note::updateOrCreate(
                    ['etudiant_id' => $etudiantId, 'evaluation_id' => $id],
                    ['note' => $noteValue]
                );
            }
        }
        
        return redirect()->route('evaluations.show', $id)->with('success', 'Notes enregistrées avec succès');
    }
}
