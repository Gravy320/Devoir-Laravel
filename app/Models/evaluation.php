<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Note;

class evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations'; 
    protected $fillable = [
        'enseignant_id',
        'Titre',
        'Date',
        'Matière',
        'Type'  
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
    public function etudiant()
    {
        return $this->belongsToMany(Etudiant::class)
                    ->withPivot('note')
                    ->as('note')
                    ->withTimestamps();
    }   
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
     
}
