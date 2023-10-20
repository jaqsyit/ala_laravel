<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\SkladActivity;
use App\Models\V1\User;
use App\Services\V1\SkladActivityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkladActivityController extends Controller
{
    /**
    //     * @param AuthRequest $request
     * @param SkladActivityService $service
     * @return JsonResponse
     */

    protected $SkladActivityService;

    public function __construct(SkladActivityService $SkladActivityService)
    {
        $this->SkladActivityService = $SkladActivityService;
    }
    public function index()
    {
        $user = auth()->user();
        $data = [];

        if ($user->id == 1) {
            $allUsers = User::all();

            foreach ($allUsers as $u) {
                $skladActivity = SkladActivity::allSkladActivity($u->id);

                $userData = [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'skladActivity' => $skladActivity,
                ];

                $data[] = $userData;
            }
        } else {
            $skladActivity = SkladActivity::allSkladActivity($user->id);

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'skladActivity' => $skladActivity,
            ];
            $data[] = $userData;
        }

        return response()->json($data);
    }
//    public function index()
//    {
//        $user = auth()->user();
//        $data = SkladActivity::allActives($user->id);
//
//        return response()->json($data);
//    }
}
