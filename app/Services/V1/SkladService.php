<?php

namespace App\Services\V1;

use App\Models\V1\Sklad;
use App\Models\V1\SkladActivity;
use Exception;
use Illuminate\Http\JsonResponse;

class SkladService
{
    public function createTovar($data)
    {
        try {
            $existingTovar = Sklad::where('name', $data['name'])->first();
            if ($existingTovar) {
                return response()->json(['message' => 'Product with the same name already exists'], 409);
            }
            $userId = auth()->user();
            $data['idUser'] = $userId->id;
            $newTovar = Sklad::newTovar($data);
            $data['idSklad'] = $newTovar->id;
            $data['add'] = true;
            $newActivity = SkladActivity::newActivity($data);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'New tovar added', 'tovar' => $newTovar, 'activity' => $newActivity], 200);
    }


    public function updateTovar($request, $id)
    {
        try {
            $userId = auth()->user();
            $request['idUser'] = $userId->id;
            $newQuantity = Sklad::newQuantity($request, $id);
            $request['idSklad'] = $newQuantity->id;
            $newActivity = SkladActivity::newActivity($request);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Tovar updated', 'tovar' => $newQuantity, 'activity' => $newActivity], 200);
    }

    public function createActivity($data)
    {
    }
}
