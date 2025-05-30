@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Évaluations</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-3">
        <a href="{{ route('evaluations.create') }}" class="btn btn-primary">Créer une évaluation</a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Toutes les évaluations</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Matière</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Enseignant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($evaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->id }}</td>
                            <td>{{ $evaluation->Titre }}</td>
                            <td>{{ $evaluation->Matière }}</td>
                            <td>{{ $evaluation->Type }}</td>
                            <td>{{ $evaluation->Date }}</td>
                            <td>{{ $evaluation->enseignant->nom }} {{ $evaluation->enseignant->prenom }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                    <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </a>
                                    <a href="{{ route('evaluations.attribuer-notes', $evaluation->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-clipboard-check"></i> Attribuer des notes
                                    </a>
                                    <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation?')">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucune évaluation trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
