<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'niveau'];

    public function etudiants() {
        return $this->hasMany(Etudiant::class);
    }

    public function emploisDuTemps() {
        return $this->hasMany(EmploiDuTemps::class);
    }
}
