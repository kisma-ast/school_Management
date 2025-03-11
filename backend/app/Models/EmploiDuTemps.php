<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    use HasFactory;

    protected $table = 'emplois_du_temps';
    protected $fillable = ['cours_id', 'classe_id', 'professeur_id', 'date', 'heure_debut', 'heure_fin', 'salle','jour_semaine'];

    public function cours() {
        return $this->belongsTo(Cours::class);
    }

    public function classe() {
        return $this->belongsTo(Classe::class);
    }

    public function professeur() {
        return $this->belongsTo(Professeur::class);
    }
}
