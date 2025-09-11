<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * User registration.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $validated['image'] = ''; // default kosong, bisa sesuaikan
        $validated['email_verified_at'] = now();
        $validated['password'] = Hash::make($validated['password']);

        if ('instructor' === $validated['role']) {
            if ($request->hasFile('document')) {
                $validated['document'] = $request->file('document')->store('documents', 'public');
            } else {
                return $this->sendError('Dokumen wajib diupload untuk instructor.', 422);
            }
            $validated['approve_status'] = 'pending';
        } elseif ('student' === $validated['role']) {
            $validated['approve_status'] = 'approved';
        } else {
            return $this->sendError('Role tidak valid.', 400);
        }

        $user = User::create($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 'User berhasil terdaftar.', 201);
    }

    /**
     * Login user.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('Email atau password salah.', 401);
        }

        if ('approved' !== $user->approve_status) {
            return $this->sendError('Akun Anda belum disetujui.', 403);
        }

        $token = $user->createToken($user->role . '-token')->plainTextToken;
        $user->tokens()
    ->latest('id')
    ->first()
    ->update([
        'expires_at' => now()->addHour(),
    ]);

        return $this->sendResponse([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 'Login berhasil.');
    }

    /**
     * Logout user and revoke current token.
     */
    public function logout(Request $request): JsonResponse
    {
        // Hapus token akses saat ini
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(null, 'Logout berhasil.');
    }
}
