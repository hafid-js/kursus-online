<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * User registration
     */

    // registeration new user
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $validated['image'] = '/frontend/assets/images/default.png';
        $validated['email_verified_at'] = now();
        $validated['password'] = bcrypt($validated['password']);

        if ($validated['role'] === 'instructor') {
            if ($request->hasFile('document')) {
                $validated['document'] = $request->file('document')->store('documents', 'public');
            } else {
                return response()->json([
                    'success' => false,
                    'statusCode' => 422,
                    'message' => 'Dokumen wajib diupload untuk instructor.',
                ], 422);
            }
            $validated['approve_status'] = 'pending';
        } elseif ($validated['role'] === 'student') {
            $validated['approve_status'] = 'approved';
        } else {
            return response()->json([
                'success' => false,
                'statusCode' => 400,
                'message' => 'Role tidak valid.',
            ], 400);
        }

        $user = User::create($validated);

        // Generate token langsung tanpa HTTP request
        $tokenResult = $user->createToken('auth_token');

        $user['token'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at,
        ];

        return response()->json([
            'success' => true,
            'statusCode' => 201,
            'message' => 'User has been registered successfully.',
            'data' => $user,
        ], 201);
    }


    /**
     * Login user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Email or password is incorrect.'],
            ]);
        }

        $user = Auth::user();

        // Check if user is approved (optional)
        if ($user->approve_status !== 'approved') {
            return response()->json([
                'status' => 'error',
                'message' => 'Your account is not approved.',
            ], 403);
        }

        // Generate token via Passport
        $tokenResult = $user->createToken('API Token');
        $token = $tokenResult->accessToken;
        $expiresAt = $tokenResult->token->expires_at;

        return response()->json([
            'status'  => 'success',
            'message' => 'Login successful',
            'data'    => [
                'user'  => $user,
                'token' => $token,
                'token_expires_at' => $expiresAt,
            ]
        ]);
    }

    /**
     * Get current authenticated user
     */
    public function me(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Authenticated user info.',
            'data' => $user,
        ], 200);
    }

    /**
     * Refresh access token
     */
    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PASSWORD_CLIENT_SECRET'),
            'scope' => '',
        ]);

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Token refreshed.',
            'data' => $response->json(),
        ], 200);
    }

    /**
     * Logout user and revoke tokens
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->tokens->each(function ($token) {
            $token->revoke();
        });

        return response()->json([
            'status' => 'success',
            'message' => 'All tokens revoked. Logged out successfully.',
        ]);
    }
}
