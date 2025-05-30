<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Etudiant;
use App\Models\Evaluation;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes'; // Nom de la table associée
    protected $fillable = [
        'etudiant_id',
        'evaluation_id',
        'note'
    ]; // Attributs remplissables

    // Relation avec l'étudiant
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    // Relation avec l'évaluation
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
