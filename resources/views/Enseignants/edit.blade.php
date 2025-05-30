@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier un enseignant</h1>
    
    <form action="{{ route('enseignants.update', $enseignant->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="nom">Nom</label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $enseignant->nom) }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', $enseignant->prenom) }}" required>
            @error('prenom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', $enseignant->telephone) }}" required>
            @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="matiere">Matière</label>
            <input type="text" class="form-control @error('matiere') is-invalid @enderror" id="matiere" name="matiere" value="{{ old('matiere', $enseignant->matiere) }}" required>
            @error('matiere')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
