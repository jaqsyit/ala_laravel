<?php

namespace App\Services\V1;

use App\Models\V1\Bank;
use App\Models\V1\Sklad;
use App\Models\V1\SkladActivity;
use Exception;
use Illuminate\Http\JsonResponse;

class SkladService
{
    public function createTovar($data)
    {
        try {
            $userId = auth()->user();
            $data['idUser'] = $userId->id;
            $existingTovar = Sklad::where('name', $data['name'])->where('user_id', $data['idUser'])->first();
            if ($existingTovar) {
                return response()->json(['message' => 'Product with the same name already exists'], 409);
            }
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
            $user = auth()->user();
            $request['idUser'] = $user->id;
            $tovar = Sklad::checkQuantity($id);
            if (!$tovar) {
                return response()->json(['message' => 'Tovar not found'], 404);
            }
            $currentQuantity = $tovar->quantity;
            $newQuantity = $request['quantity'];
            if ($currentQuantity === $newQuantity) {
                return response()->json(['message' => 'No changes required'], 200);
            }
            $request['add'] = $newQuantity > $currentQuantity;
            $updated = Sklad::newQuantity($request, $id);
            if ($updated) {
                $request['idSklad'] = $id;
                $newActivity = SkladActivity::newActivity($request);
                if (!$request['add']) {
                    $dataForBank['filialId'] = $request['idUser'];
                    $dataForBank['name'] = 'Сатылым '. $tovar->name;
                    $dataForBank['income'] = $tovar->price * ($currentQuantity-$newQuantity);
                    $dataForBank['profit'] = ($tovar->price - $tovar->oz_price) * ($currentQuantity-$newQuantity);
                    $dataForBank['expense'] = 0;
                    Bank::newRow($dataForBank);
                }
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Tovar updated', 'tovar' => $tovar, 'activity' => $newActivity], 200);
    }

}
