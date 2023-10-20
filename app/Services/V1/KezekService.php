<?php

namespace App\Services\V1;

use App\Models\V1\Kezek;
use Exception;

class KezekService
{
    public function createKezek($data)
    {
        try {
            $existingTovar = Kezek::where('tel', $data['tel'])
                ->where('status', 0)
                ->first();
            if ($existingTovar) {
                return response()->json(['message' => 'Kezek with the same name already exists'], 409);
            }
            $newKezek = Kezek::newKezek($data);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'New kezek added', 'kezek' => $newKezek], 200);
    }

    public function deleteKezek($id)
    {
        $kezek = Kezek::find($id);
        if (!$kezek) {
            return response()->json(['message' => 'Kezek not found', 'kezek' => $kezek], 404);
        }
        $kezek->delete();
        return response()->json(['success' => 'Kezek deleted', 'kezek' => $kezek], 200);
    }
}
