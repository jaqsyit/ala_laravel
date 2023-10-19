<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UslugiResource;
use App\Models\V1\User;
use App\Models\V1\Uslugi;

class UslugiController extends Controller
{
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

}
