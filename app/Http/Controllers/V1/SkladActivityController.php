<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\SkladActivity;
use Illuminate\Http\Request;

class SkladActivityController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = SkladActivity::allActives($user->id);

        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
