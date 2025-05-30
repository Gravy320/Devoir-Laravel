@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'enseignant</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $enseignant->nom }} {{ $enseignant->prenom }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $enseignant->id }}</p>
            <p class="card-text"><strong>Téléphone:</strong> {{ $enseignant->telephone }}</p>
            <p class="card-text"><strong>Matière:</strong> {{ $enseignant->matiere }}</p>
            <p class="card-text"><strong>Créé le:</strong> {{ $enseignant->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Mis à jour le:</strong> {{ $enseignant->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('enseignants.edit', $enseignant->id) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">Retour à la liste</a>
        
        <form action="{{ route('enseignants.destroy', $enseignant->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
