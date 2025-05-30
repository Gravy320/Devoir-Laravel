<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Etudiant;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Affiche la liste des notes
     */
    public function index()
    {
        $notes = Note::with(['etudiant', 'evaluation'])->get();
        return view('notes.index', compact('notes'));
    }

    /**
     * Affiche le formulaire de création d'une note
     */
    public function create()
    {
        $etudiants = Etudiant::all();
        $evaluations = Evaluation::all();
        return view('notes.create', compact('etudiants', 'evaluations'));
    }

    /**
     * Enregistre une nouvelle note
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'etudiant_id' => 'required|exists:etudiants,id',
            'evaluation_id' => 'required|exists:evaluations,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Vérifier si une note existe déjà pour cet étudiant dans cette évaluation
        $existingNote = Note::where('etudiant_id', $request->etudiant_id)
                            ->where('evaluation_id', $request->evaluation_id)
                            ->first();

        if ($existingNote) {
            $existingNote->update(['note' => $request->note]);
            $message = 'Note mise à jour avec succès';
        } else {
            Note::create($request->all());
            $message = 'Note créée avec succès';
        }

        return redirect()->route('notes.index')->with('success', $message);
    }

    /**
     * Affiche les détails d'une note
     */
    public function show($id)
    {
        $note = Note::with(['etudiant', 'evaluation'])->findOrFail($id);
        return view('notes.show', compact('note'));
    }

    /**
     * Affiche le formulaire d'édition d'une note
     */
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $etudiants = Etudiant::all();
        $evaluations = Evaluation::all();
        return view('notes.edit', compact('note', 'etudiants', 'evaluations'));
    }

    /**
     * Met à jour une note
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'etudiant_id' => 'required|exists:etudiants,id',
            'evaluation_id' => 'required|exists:evaluations,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $note = Note::findOrFail($id);
        $note->update($request->all());
        return redirect()->route('notes.index')->with('success', 'Note mise à jour avec succès');
    }

    /**
     * Supprime une note
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note supprimée avec succès');
    }

    /**
     * Affiche les notes d'un étudiant
     */
    public function notesEtudiant($etudiantId)
    {
        $etudiant = Etudiant::findOrFail($etudiantId);
        $notes = Note::with('evaluation')->where('etudiant_id', $etudiantId)->get();
        return view('notes.etudiant', compact('etudiant', 'notes'));
    }

    /**
     * Affiche les notes d'une évaluation
     */
    public function notesEvaluation($evaluationId)
    {
        $evaluation = Evaluation::findOrFail($evaluationId);
        $notes = Note::with('etudiant')->where('evaluation_id', $evaluationId)->get();
        return view('notes.evaluation', compact('evaluation', 'notes'));
    }
}
