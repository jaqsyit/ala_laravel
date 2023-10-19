<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Sklad;
use App\Models\V1\SkladActivity;
use App\Services\V1\SkladService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class SkladController extends Controller
{

    /**
//     * @param AuthRequest $request
     * @param SkladService $service
     * @return JsonResponse
     */

    protected $SkladService;

    public function __construct(SkladService $SkladService)
    {
        $this->SkladService = $SkladService;
    }

    public function index()
    {
        $user = auth()->user();
        $data = Sklad::allTovars($user->id);

        return $data;
    }

    public function create(Request $request)
    {
        return $this->SkladService->createTovar($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->SkladService->updateTovar($request->all(), $id);
    }
}
