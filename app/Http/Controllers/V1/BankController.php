<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = Bank::allBanks($user->id);

        return response()->json($data);
    }
}
