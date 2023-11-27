<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Kezek;
use App\Models\V1\User;
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
        $data = [];

        if ($user->id == 1) {
            $allUsers = User::all();

            foreach ($allUsers as $u) {
                $kezek = Kezek::allKezek($u->id);

                $userData = [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'kezek' => $kezek,
                ];

                $data[] = $userData;
            }
        } else {
            $kezek = Kezek::allKezek($user->id);

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'kezek' => $kezek,
            ];
            $data[] = $userData;
        }

        return response()->json(['data'=>$data],200);
    }

    public function create(Request $request)
    {
        return $this->KezekService->createKezek($request->all());
    }

    public function update($id)
    {
        return $this->KezekService->updateRow($id);
    }

    public function destroy($id)
    {
        return $this->KezekService->deleteKezek($id);
    }
}
