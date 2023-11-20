<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Bank;
use App\Models\V1\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = [];

        if ($user->id == 1) {
            $allUsers = User::all();

            foreach ($allUsers as $u) {
                $allData = Bank::allBanks($u->id);

                $userData = [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'bank' => $allData,
                ];

                $data[] = $userData;
            }
        } else {
            $allData = Bank::allBanks($user->id);

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'bank' => $allData,
            ];
            $data[] = $userData;
        }

        return response()->json(['data' => $data], 200);
    }
}
