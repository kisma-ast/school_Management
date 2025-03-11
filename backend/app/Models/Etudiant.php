<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'classe_id', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function classe() {
        return $this->belongsTo(Classe::class);
    }
}

