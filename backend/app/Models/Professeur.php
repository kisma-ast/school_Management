<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cours() {
        return $this->hasMany(Cours::class);
    }

    public function emploisDuTemps() {
        return $this->hasMany(EmploiDuTemps::class);
    }
}

