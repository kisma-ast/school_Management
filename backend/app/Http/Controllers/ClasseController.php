<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index() {
        return response()->json(Classe::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nom' => 'required|string',
            'niveau' => 'required|string',
        ]);

        $classe = Classe::create($validated);
        return response()->json($classe, 201);
    }

    public function show($id) {
        return response()->json(Classe::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $classe = Classe::findOrFail($id);
        $classe->update($request->all());
        return response()->json($classe);
    }

    public function destroy($id) {
        Classe::destroy($id);
        return response()->json(['message' => 'Classe supprimée']);
    }
}
