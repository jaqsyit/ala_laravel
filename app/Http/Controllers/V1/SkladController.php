<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Sklad;
use App\Models\V1\SkladActivity;
use App\Models\V1\User;
use App\Services\V1\SkladService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class SkladController extends Controller
{

    /**
     * //     * @param AuthRequest $request
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
        $data = [];

        if ($user->id == 1) {
            $allUsers = User::all();

            foreach ($allUsers as $u) {
                $sklad = Sklad::allSklad($u->id);

                $userData = [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'sklad' => $sklad,
                ];

                $data[] = $userData;
            }
        } else {
            $sklad = Sklad::allSklad($user->id);

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'sklad' => $sklad,
            ];
            $data[] = $userData;
        }

        return response()->json(['data' => $data], 200);
    }

    public function create(Request $request)
    {
        return $this->SkladService->createTovar($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->SkladService->updateTovar($request->all(), $id);
    }

    public function destroy($id)
    {
        $usluga = Sklad::find($id);
        if (!$usluga) {
            return response()->json(['message' => 'Tovar not found'], 404);
        }
        SkladActivity::where('sklad_id', $id)->delete();
        $usluga->delete();

        return response()->json(['message' => 'Tovar deleted'], 200);
    }

}
