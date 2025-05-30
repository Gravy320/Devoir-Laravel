@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Attribuer des notes - {{ $evaluation->Titre }}</h3>
            <div>
                <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour aux détails
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Matière:</strong> {{ $evaluation->Matière ?: 'Non spécifiée' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Type:</strong> {{ $evaluation->Type ?: 'Non spécifié' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Date:</strong> {{ $evaluation->Date ? date('d/m/Y', strtotime($evaluation->Date)) : 'Non spécifiée' }}</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('evaluations.enregistrer-notes', $evaluation->id) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 45%">Étudiant</th>
                                <th style="width: 25%">Note sur 20</th>
                                <th style="width: 25%">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->id }}</td>
                                    <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                                    <td>
                                        <input type="number" 
                                            class="form-control @error('notes.' . $etudiant->id) is-invalid @enderror" 
                                            name="notes[{{ $etudiant->id }}]" 
                                            value="{{ old('notes.' . $etudiant->id, isset($notes[$etudiant->id]) ? $notes[$etudiant->id] : '') }}" 
                                            min="0" 
                                            max="20" 
                                            step="0.25">
                                        @error('notes.' . $etudiant->id)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        @if(isset($notes[$etudiant->id]))
                                            <span class="badge bg-success">Note déjà attribuée</span>
                                        @else
                                            <span class="badge bg-warning">En attente</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun étudiant trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Enregistrer les notes
                    </button>
                    <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
