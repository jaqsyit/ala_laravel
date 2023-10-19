<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Kezek;
use App\Services\V1\KezekService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KezekController extends Controller
{
    /**
    //     * @param AuthRequest $request
     * @param KezekService $service
     * @return JsonResponse
     */

    protected $KezekService;

    public function __construct(KezekService $KezekService)
    {
        $this->KezekService = $KezekService;
    }

    public function index()
    {
        $user = auth()->user();
        $data = Kezek::allKezek($user->id);

        return $data;
    }

    public function create(Request $request)
    {
        return $this->KezekService->createKezek($request->all());
    }
}
