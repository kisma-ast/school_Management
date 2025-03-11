<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use Illuminate\Http\Request;

class EmploiDuTempsController extends Controller
{
    public function index()
    {
        // Récupérer tous les emplois du temps avec leurs cours associés
        $emploisDuTemps = EmploiDuTemps::with('cours','classe','professeur.user')->get();
        
        // Retourner la réponse en JSON avec les données des emplois du temps et leurs cours associés
        return response()->json($emploisDuTemps);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'cours_id' => 'required|exists:cours,id',
            'classe_id' => 'required|exists:classes,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'jour_semaine' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'salle' => 'required|string',
        ]);

        $emploiDuTemps = EmploiDuTemps::create($validated);
        return response()->json($emploiDuTemps, 201);
    }

    public function show($id) {
        return response()->json(EmploiDuTemps::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $emploiDuTemps = EmploiDuTemps::findOrFail($id);
        $emploiDuTemps->update($request->all());
        return response()->json($emploiDuTemps);
    }

    public function destroy($id) {
        EmploiDuTemps::destroy($id);
        return response()->json(['message' => 'Emploi du temps supprimé']);
    }
}
