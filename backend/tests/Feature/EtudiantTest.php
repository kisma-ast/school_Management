<?php

use App\Models\Etudiant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EtudiantTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_creer_etudiant()
    {
        $etudiant = Etudiant::factory()->create();
        $this->assertDatabaseHas('etudiants', ['email' => $etudiant->email]);
    }

    public function test_peut_modifier_etudiant()
    {
        $etudiant = Etudiant::factory()->create();
        $etudiant->update(['nom' => 'Nom Modifié']);
        $this->assertDatabaseHas('etudiants', ['nom' => 'Nom Modifié']);
    }

    public function test_peut_supprimer_etudiant()
    {
        $etudiant = Etudiant::factory()->create();
        $etudiant->delete();
        $this->assertDatabaseMissing('etudiants', ['email' => $etudiant->email]);
    }
}

