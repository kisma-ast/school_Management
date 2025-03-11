<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index() {
        $etudiant = Etudiant::with('user','classe',)->get();
        return response()->json($etudiant);
    }

    public function store(Request $request) {
        // Validation des données d'entrée
        $validated = $request->validate([
           
            'classe_id' => 'required|exists:classes,id',
            // Retirer 'user_id' de la validation
        ]);
    
        // Créer un utilisateur
        $user = User::create([
            'name' => $request->nom, // Exemple, vous pouvez adapter
            'email' => $request->email,
            'password' => bcrypt('default_password'), // Mot de passe par défaut ou personnalisé
        ]);
    
        // Ajouter l'user_id dans les données validées pour l'étudiant
        $validated['user_id'] = $user->id;
    
        // Créer un étudiant avec l'ID de l'utilisateur
        $etudiant = Etudiant::create($validated);
    
        // Retourner la réponse
        return response()->json($etudiant, 201);
    }
    

    public function show($id) {
        return response()->json(Etudiant::findOrFail($id));
    }

    public function update(Request $request, $id) {
        // Validation des données d'entrée
        $validated = $request->validate([
            'nom' => 'required|string|max:255',  // Validation du nom
            'email' => 'required|email|unique:users,email,' . $id,  // Validation de l'email unique (en excluant l'utilisateur actuel)
            'classe_id' => 'required|exists:classes,id',  // Validation de l'ID de la classe
        ]);
    
        try {
            // Trouver l'étudiant avec l'ID fourni
            $etudiant = Etudiant::findOrFail($id);
    
            // Trouver l'utilisateur associé à cet étudiant
            $user = $etudiant->user;
    
            // Mettre à jour les informations de l'utilisateur
            $user->update([
                'name' => $request->nom,
                'email' => $request->email,
                // Ne pas modifier le mot de passe à moins qu'il ne soit fourni
                'password' => $request->password ? bcrypt($request->password) : $user->password,  // Si un mot de passe est fourni, on le hash
            ]);
    
            // Mettre à jour les informations de l'étudiant
            $etudiant->update([
                'classe_id' => $request->classe_id,
                // Vous pouvez ajouter d'autres champs ici à mettre à jour si nécessaire
            ]);
    
            // Retourner la réponse avec l'étudiant mis à jour
            return response()->json($etudiant, 200);
        } catch (\Exception $e) {
            // Retourner une réponse d'erreur en cas d'échec
            return response()->json(['error' => 'Impossible de mettre à jour l\'étudiant'], 500);
        }
    }
    

    public function destroy($id) {
        Etudiant::destroy($id);
        return response()->json(['message' => 'Étudiant supprimé']);
    }
}

