<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AuthRequest;
use App\Services\V1\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    /**
     * @param AuthRequest $request
     * @param AuthService $service
     * @return JsonResponse
     */

    protected $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    public function actionLoginUser(Request $request)
    {
        return $this->AuthService->login($request->all());
    }

    public function actionLogoutUser()
    {
        return $this->AuthService->logout();
    }

    public function actionRefreshToken()
    {
        return $this->AuthService->refreshToken();
    }
    public function actionCheckUser()
    {
        $user = Auth::user();

        return $user;
    }
}
