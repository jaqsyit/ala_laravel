<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Workers;

class WorkerController extends Controller
{
    public function index(){
        $list = Workers::get();
        return response()->json(['workers' => $list, 'workers_count' => $list->count()],200);
    }
}
