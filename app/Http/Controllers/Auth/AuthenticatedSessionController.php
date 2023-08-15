<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        // $request->session()->regenerate();

        // Ces 3 lignes ont été ajoutées par moi 
        $user = $request->user();

        // $user->currentAccesToken()->delete();

        $user->tokens()->delete();

        $token = $user->createToken('api-token');

                // J'ai modifié la reponse envoyée afin de renvoyer le user et le token
        return response()->json([

            'user' => $user,
            'token' => $token->plainTextToken, 
            
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
