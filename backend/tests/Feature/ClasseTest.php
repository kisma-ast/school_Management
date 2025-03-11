<?php

use App\Models\Classe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClasseTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_creer_classe()
    {
        $classe = Classe::factory()->create();
        $this->assertDatabaseHas('classes', ['nom' => $classe->nom]);
    }

    public function test_peut_modifier_classe()
    {
        $classe = Classe::factory()->create();
        $classe->update(['nom' => 'Nouvelle Classe']);
        $this->assertDatabaseHas('classes', ['nom' => 'Nouvelle Classe']);
    }

    public function test_peut_supprimer_classe()
    {
        $classe = Classe::factory()->create();
        $classe->delete();
        $this->assertDatabaseMissing('classes', ['nom' => $classe->nom]);
    }
}
