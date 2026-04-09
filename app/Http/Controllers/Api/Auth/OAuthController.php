<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function googleLogin(Request $request)
{
    $request->validate([
        'access_token' => 'required|string',
    ]);

    try {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->userFromToken($request->access_token);

        $user = User::where('gauth_id', $googleUser->id)->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'gauth_id' => $googleUser->id,
                'gauth_type' => 'google',
                'password' => Hash::make(Str::random(16)),
                'role' => 'student',
                'approve_status' => 'approved',
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}
}
