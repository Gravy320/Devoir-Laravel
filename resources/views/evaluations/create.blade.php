@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Créer une nouvelle évaluation</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('evaluations.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Titre" class="form-label">Titre de l'évaluation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('Titre') is-invalid @enderror" id="Titre" name="Titre" value="{{ old('Titre') }}" required>
                            @error('Titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="enseignant_id" class="form-label">Enseignant <span class="text-danger">*</span></label>
                            <select class="form-select @error('enseignant_id') is-invalid @enderror" id="enseignant_id" name="enseignant_id" required>
                                <option value="">Sélectionner un enseignant</option>
                                @foreach($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id }}" {{ old('enseignant_id') == $enseignant->id ? 'selected' : '' }}>
                                        {{ $enseignant->nom }} {{ $enseignant->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('enseignant_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Matière" class="form-label">Matière</label>
                            <input type="text" class="form-control @error('Matière') is-invalid @enderror" id="Matière" name="Matière" value="{{ old('Matière') }}">
                            @error('Matière')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Type" class="form-label">Type d'évaluation</label>
                            <select class="form-select @error('Type') is-invalid @enderror" id="Type" name="Type">
                                <option value="">Sélectionner un type</option>
                                <option value="Devoir" {{ old('Type') == 'Devoir' ? 'selected' : '' }}>Devoir</option>
                                <option value="Examen" {{ old('Type') == 'Examen' ? 'selected' : '' }}>Examen</option>
                                <option value="Contrôle" {{ old('Type') == 'Contrôle' ? 'selected' : '' }}>Contrôle</option>
                                <option value="Projet" {{ old('Type') == 'Projet' ? 'selected' : '' }}>Projet</option>
                            </select>
                            @error('Type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Date" class="form-label">Date de l'évaluation</label>
                            <input type="date" class="form-control @error('Date') is-invalid @enderror" id="Date" name="Date" value="{{ old('Date') }}">
                            @error('Date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
