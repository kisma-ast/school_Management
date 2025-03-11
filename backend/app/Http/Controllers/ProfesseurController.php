<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use App\Models\User;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    public function index() {
        $professeurs = Professeur::with('user',)->get();
        return response()->json($professeurs);

    }
    public function store(Request $request) {
      
    
        // Créer un utilisateur
        $user = User::create([
            'name' => $request->nom, // Exemple, vous pouvez adapter
            'email' => $request->email,
            'password' => bcrypt('default_password'), // Mot de passe par défaut ou personnalisé
        ]);
    
        // Ajouter l'user_id dans les données validées pour l'étudiant
        $validated['user_id'] = $user->id;
    
        // Créer un étudiant avec l'ID de l'utilisateur
        $etudiant = Professeur::create($validated);
    
        // Retourner la réponse
        return response()->json($etudiant, 201);
    }

    public function update(Request $request, $id) {
        // Trouver le professeur avec l'ID fourni
        $professeur = Professeur::findOrFail($id);
    
        // Trouver l'utilisateur associé à ce professeur
        $user = $professeur->user;
    
        // Initialisation des règles de validation
        $rules = [
            'nom' => 'required|string|max:255',  // Validation du nom
            'password' => 'nullable|string|min:6',  // Validation du mot de passe (si fourni)
        ];
    
        // Conditionner la validation de l'email uniquement si l'email change
        if ($request->has('email') && $request->email !== $user->email) {
            // Si l'email est modifié, appliquer la validation unique
            $rules['email'] = 'required|email|unique:users,email,' . $user->id;
        }
    
        // Validation des données d'entrée
        $validated = $request->validate($rules);
    
        try {
            // Mettre à jour les informations de l'utilisateur
            $user->update([
                'name' => $request->nom,
                'email' => $request->email ?? $user->email, // Si l'email est omis, on garde l'email actuel
                'password' => $request->password ? bcrypt($request->password) : $user->password,  // Si un mot de passe est fourni, on le hash
            ]);
    
            // Mettre à jour des informations supplémentaires pour le professeur si nécessaire
            // Exemple : $professeur->update([...]);
    
            // Retourner la réponse avec le professeur mis à jour
            return response()->json($professeur, 200);
        } catch (\Exception $e) {
            // Retourner une réponse d'erreur en cas d'échec
            return response()->json(['error' => 'Impossible de mettre à jour le professeur'], 500);
        }
    }
    
    
    public function show($id) {
        return response()->json(Professeur::findOrFail($id));
    }

  

    public function destroy($id) {
        Professeur::destroy($id);
        return response()->json(['message' => 'Professeur supprimé']);
    }
}
