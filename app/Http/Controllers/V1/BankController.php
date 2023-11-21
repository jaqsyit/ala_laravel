<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Bank;
use App\Models\V1\User;
use App\Services\V1\BankService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
    //     * @param AuthRequest $request
     * @param BankService $service
     * @return JsonResponse
     */

    protected $service;

    public function __construct(BankService $service)
    {
        $this->BankService = $service;
    }

    public function index()
    {
        return $this->BankService->allList();
    }

    public function create(Request $request)
    {
        return $this->BankService->createNewRow($request->all());
    }

    public function destroy($id)
    {
        return $this->BankService->deleteRow($id);
    }
}
