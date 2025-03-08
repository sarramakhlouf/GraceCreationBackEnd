<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class ClientAuthController extends Controller {

    public function index(Request $request) {
        $query = Order::select('name', 'email', 'address', 'phone')
                      ->groupBy('name', 'email', 'address', 'phone'); // On groupe par ces champs pour éviter les doublons

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $clients = $query->get();
        return view('clients.index', compact('clients'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        return response()->json(['message' => 'Compte client créé avec succès'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->where('role', 'client')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => 'Identifiants incorrects']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id', 
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::find($request->id); 

        if (!$user) {
            return response()->json(['error' => 'Utilisateur introuvable'], 404);
        }

        if ($request->filled('current_password') && !Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Mot de passe actuel incorrect'], 400);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return response()->json(['message' => 'Profil mis à jour avec succès']);
    }

}
