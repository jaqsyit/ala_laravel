<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UslugiResource;
use App\Models\V1\User;
use App\Models\V1\Uslugi;
use App\Services\V1\UslugiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UslugiController extends Controller
{

    /**
    //     * @param AuthRequest $request
     * @param UslugiService $service
     * @return JsonResponse
     */

    protected $UslugiService;

    public function __construct(UslugiService $UslugiService)
    {
        $this->UslugiService = $UslugiService;
    }

    public function index()
    {
        $user = auth()->user();
        $data = [];

        if ($user->id == 1) {
            $allUsers = User::all();

            foreach ($allUsers as $u) {
                $uslugi = Uslugi::allUslugi($u->id);

                $userData = [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'uslugi' => $uslugi,
                ];

                $data[] = $userData;
            }
        } else {
            $uslugi = Uslugi::allUslugi($user->id);

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'uslugi' => $uslugi,
            ];
            $data[] = $userData;
        }

        return response()->json($data);
    }

    public function create(Request $request)
    {
        return $this->UslugiService->createUsluga($request->all());
    }

    public function destroy($id)
    {
        $usluga = Uslugi::find($id);

        if (!$usluga) {
            return response()->json(['message' => 'Usluga not found'], 404);
        }

        $usluga->delete();

        return response()->json(['message' => 'Usluga deleted'], 200);
    }
}
