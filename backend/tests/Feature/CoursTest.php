<?php

use App\Models\Cours;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoursTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_creer_cours()
    {
        $cours = Cours::factory()->create();
        $this->assertDatabaseHas('cours', ['nom' => $cours->nom]);
    }

    public function test_peut_modifier_cours()
    {
        $cours = Cours::factory()->create();
        $cours->update(['nom' => 'Nouveau Cours']);
        $this->assertDatabaseHas('cours', ['nom' => 'Nouveau Cours']);
    }

    public function test_peut_supprimer_cours()
    {
        $cours = Cours::factory()->create();
        $cours->delete();
        $this->assertDatabaseMissing('cours', ['nom' => $cours->nom]);
    }
}
