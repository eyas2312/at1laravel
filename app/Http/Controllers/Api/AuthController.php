<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function connexion(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Identifiants incorrects.'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie.',
            'user' => $user,
            'token' => $token,
        ]);
    }
}