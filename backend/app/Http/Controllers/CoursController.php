<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index() {
         $cours = Cours::with('professeur.user',)->get();
        
         return response()->json($cours);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nom' => 'required|string',
            'professeur_id' => 'required|exists:professeurs,id',
        ]);

        $cours = Cours::create($validated);
        return response()->json($cours, 201);
    }

    public function show($id) {
        return response()->json(Cours::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $cours = Cours::findOrFail($id);
        $cours->update($request->all());
        return response()->json($cours);
    }

    public function destroy($id) {
        Cours::destroy($id);
        return response()->json(['message' => 'Cours supprimé']);
    }
}
