<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Routes pour les étudiants
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiants/{id}', [EtudiantController::class, 'show'])->name('etudiants.show');
Route::get('/etudiants/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiants/{id}', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiants/{id}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');

// Routes pour les enseignants
Route::get('/enseignants', [EnseignantController::class, 'index'])->name('enseignants.index');
Route::get('/enseignants/create', [EnseignantController::class, 'create'])->name('enseignants.create');
Route::post('/enseignants', [EnseignantController::class, 'store'])->name('enseignants.store');
Route::get('/enseignants/{id}', [EnseignantController::class, 'show'])->name('enseignants.show');
Route::get('/enseignants/{id}/edit', [EnseignantController::class, 'edit'])->name('enseignants.edit');
Route::put('/enseignants/{id}', [EnseignantController::class, 'update'])->name('enseignants.update');
Route::delete('/enseignants/{id}', [EnseignantController::class, 'destroy'])->name('enseignants.destroy');

// Routes pour les évaluations
Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
Route::get('/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');
Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
Route::get('/evaluations/{id}', [EvaluationController::class, 'show'])->name('evaluations.show');
Route::get('/evaluations/{id}/edit', [EvaluationController::class, 'edit'])->name('evaluations.edit');
Route::put('/evaluations/{id}', [EvaluationController::class, 'update'])->name('evaluations.update');
Route::delete('/evaluations/{id}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');
Route::get('/evaluations/{id}/attribuer-notes', [EvaluationController::class, 'attribuerNotes'])->name('evaluations.attribuer-notes');
Route::post('/evaluations/{id}/enregistrer-notes', [EvaluationController::class, 'enregistrerNotes'])->name('evaluations.enregistrer-notes');

// Routes pour les notes
Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
Route::get('/etudiants/{etudiantId}/notes', [NoteController::class, 'notesEtudiant'])->name('notes.etudiant');
Route::get('/evaluations/{evaluationId}/notes', [NoteController::class, 'notesEvaluation'])->name('notes.evaluation');