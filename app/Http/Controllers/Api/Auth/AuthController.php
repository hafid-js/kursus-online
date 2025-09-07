<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * User registration.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $validated['image'] = '';
        $validated['email_verified_at'] = now();
        $validated['password'] = bcrypt($validated['password']);

        if ('instructor' === $validated['role']) {
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
        } elseif ('student' === $validated['role']) {
            $validated['approve_status'] = 'approved';
        } else {
            return response()->json([
                'success' => false,
                'statusCode' => 400,
                'message' => 'Role tidak valid.',
            ], 400);
        }

        $user = User::create($validated);

        // Generate token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'statusCode' => 201,
            'message' => 'User has been registered successfully.',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ],
        ], 201);
    }

    /**
     * Login user.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email or password is incorrect.',
            ], 401);
        }

        if ('approved' !== $user->approve_status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your account is not approved yet.',
            ], 403);
        }

        // Generate Sanctum token
        $token = $user->createToken($user->role . '-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ],
        ]);
    }

    /**
     * Logout user and revoke tokens.
     */
    public function destroy(Request $request): JsonResponse
    {
        // Revoke current access token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully.',
        ]);
    }
}
