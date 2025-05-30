@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Détails de l'évaluation</h3>
            <div>
                <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
                <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <a href="{{ route('evaluations.attribuer-notes', $evaluation->id) }}" class="btn btn-primary">
                    <i class="bi bi-clipboard-check"></i> Attribuer des notes
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Informations générales</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 30%">Titre</th>
                            <td>{{ $evaluation->Titre }}</td>
                        </tr>
                        <tr>
                            <th>Matière</th>
                            <td>{{ $evaluation->Matière ?: 'Non spécifiée' }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $evaluation->Type ?: 'Non spécifié' }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $evaluation->Date ? date('d/m/Y', strtotime($evaluation->Date)) : 'Non spécifiée' }}</td>
                        </tr>
                        <tr>
                            <th>Enseignant</th>
                            <td>{{ $evaluation->enseignant->nom }} {{ $evaluation->enseignant->prenom }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Statistiques</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nombre d'étudiants notés</th>
                            <td>{{ $evaluation->notes->count() }}</td>
                        </tr>
                        <tr>
                            <th>Note moyenne</th>
                            <td>
                                @if($evaluation->notes->count() > 0)
                                    {{ number_format($evaluation->notes->avg('note'), 2) }}/20
                                @else
                                    Aucune note attribuée
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Note la plus haute</th>
                            <td>
                                @if($evaluation->notes->count() > 0)
                                    {{ number_format($evaluation->notes->max('note'), 2) }}/20
                                @else
                                    Aucune note attribuée
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Note la plus basse</th>
                            <td>
                                @if($evaluation->notes->count() > 0)
                                    {{ number_format($evaluation->notes->min('note'), 2) }}/20
                                @else
                                    Aucune note attribuée
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <h4>Notes des étudiants</h4>
                @if($evaluation->notes->count() > 0)
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Étudiant</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluation->notes as $note)
                                <tr>
                                    <td>{{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</td>
                                    <td>{{ $note->note }}/20</td>
                                    <td>
                                        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </a>
                                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note?')">
                                                <i class="bi bi-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        Aucune note n'a été attribuée pour cette évaluation.
                        <a href="{{ route('evaluations.attribuer-notes', $evaluation->id) }}" class="btn btn-primary btn-sm ms-2">
                            <i class="bi bi-clipboard-check"></i> Attribuer des notes
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
