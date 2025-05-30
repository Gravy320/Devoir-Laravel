@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Enseignants</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-3">
        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">Ajouter un enseignant</a>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Matière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enseignants as $enseignant)
                <tr>
                    <td>{{ $enseignant->id }}</td>
                    <td>{{ $enseignant->nom }}</td>
                    <td>{{ $enseignant->prenom }}</td>
                    <td>{{ $enseignant->telephone }}</td>
                    <td>{{ $enseignant->matiere }}</td>
                    <td>
                        <a href="{{ route('enseignants.show', $enseignant->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('enseignants.edit', $enseignant->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('enseignants.destroy', $enseignant->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $enseignants->links() }}
</div>
@endsection
