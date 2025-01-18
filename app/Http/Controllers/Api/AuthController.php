<?php

// app/Http/Controllers/Api/AuthController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * Handle user login and generate token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user using the username and password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // If login is successful, get the authenticated user
            $user = Auth::user();
            // Generate a personal access token (if using Laravel Sanctum)
            $token = $user->createToken('todoapp')->plainTextToken;

            // Return the user and token in the response
            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // If authentication fails, throw a validation exception with a message
        throw ValidationException::withMessages([
            'username' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Logout the user and revoke the token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the user's token(s)
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        // Return a success message
        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }
}
