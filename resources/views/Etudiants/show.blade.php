@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'étudiant</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $etudiant->nom }} {{ $etudiant->prenom }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $etudiant->id }}</p>
            <p class="card-text"><strong>Date de naissance:</strong> {{ $etudiant->date_naissance }}</p>
            <p class="card-text"><strong>Créé le:</strong> {{ $etudiant->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Mis à jour le:</strong> {{ $etudiant->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Retour à la liste</a>
        
        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
