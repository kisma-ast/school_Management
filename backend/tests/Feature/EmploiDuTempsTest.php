<?php

use App\Models\EmploiDuTemps;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmploiDuTempsTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_creer_emploi_du_temps()
    {
        $edt = EmploiDuTemps::factory()->create();
        $this->assertDatabaseHas('emplois_du_temps', ['date' => $edt->date]);
    }

    public function test_peut_modifier_emploi_du_temps()
    {
        $edt = EmploiDuTemps::factory()->create();
        $edt->update(['heure_debut' => '10:00:00']);
        $this->assertDatabaseHas('emplois_du_temps', ['heure_debut' => '10:00:00']);
    }

    public function test_peut_supprimer_emploi_du_temps()
    {
        $edt = EmploiDuTemps::factory()->create();
        $edt->delete();
        $this->assertDatabaseMissing('emplois_du_temps', ['date' => $edt->date]);
    }
}
