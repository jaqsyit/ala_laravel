<?php


namespace App\Services\V1;

use App\Models\V1\User;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function login($data): JsonResponse
    {
        try {
            $user = User::chechEmail($data['email']);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            if ($user->password !== $data['password']) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'Could not create token'], 500);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => $e], 500);
        }

        return response()->json([
            'token' => $token,
            'name' => $user['name']
        ]);
    }


    public function refreshToken(): JsonResponse
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();
            return response()->json(['access_token' => $newToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }

    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logout successful']);
    }
}
