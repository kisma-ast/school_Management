<?php

use App\Models\Professeur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfesseurTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_creer_professeur()
    {
        $prof = Professeur::factory()->create();
        $this->assertDatabaseHas('professeurs', ['email' => $prof->email]);
    }

    public function test_peut_modifier_professeur()
    {
        $prof = Professeur::factory()->create();
        $prof->update(['nom' => 'Nouveau Nom']);
        $this->assertDatabaseHas('professeurs', ['nom' => 'Nouveau Nom']);
    }

    public function test_peut_supprimer_professeur()
    {
        $prof = Professeur::factory()->create();
        $prof->delete();
        $this->assertDatabaseMissing('professeurs', ['email' => $prof->email]);
    }
}

