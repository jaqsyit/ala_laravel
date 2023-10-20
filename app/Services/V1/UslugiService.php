<?php

namespace App\Services\V1;

use App\Models\V1\Uslugi;
use Exception;
use Illuminate\Http\JsonResponse;

class UslugiService
{
    public function createUsluga($data)
    {
        try {
            $existingTovar = Uslugi::where('name', $data['name'])->first();
            if ($existingTovar) {
                return response()->json(['message' => 'Usluga with the same name already exists'], 409);
            }
            $userId = auth()->user();
            $data['idUser'] = $userId->id;
            $newUsluga = Uslugi::newUsluga($data);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'New tovar added', 'usluga' => $newUsluga], 200);
    }


    public function deleteUsluga($request, $id)
    {
        try {
            $userId = auth()->user();
            $request['idUser'] = $userId->id;
            $newQuantity = Uslugi::newQuantity($request, $id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Usluga deleted', 'usluga' => $newQuantity], 200);
    }
}
