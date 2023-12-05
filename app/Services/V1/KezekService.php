<?php

namespace App\Services\V1;

use App\Models\V1\Bank;
use App\Models\V1\Kezek;
use App\Models\V1\Workers;
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

    public function updateRow($id, $request)
    {
        try {
            $kezek = Kezek::findOrFail($id);

            $kezek->update([
                'status' => $request['status'],
                'sum' => $request['sum'],
                'sum_prepayment' => $request['sum_prepayment'],
                'sum_usluga' => $request['sum_usluga'],
            ]);

            $userId = auth()->user()->id;
            $workersArray = json_decode($request['workers'], true);

            foreach ($workersArray as $index => $expenseAmount) {
                if ($expenseAmount == 0) {
                    continue;
                }
                $workerId = $index + 1;
                $worker = Workers::find($workerId);
                if ($worker) {
                    Bank::updateOrCreate(
                        [
                            'kezek_id' => $kezek->id,
                            'name' => $worker->name
                        ],
                        [
                            'user_id' => $userId,
                            'income' => 0,
                            'profit' => 0,
                            'expense' => $expenseAmount
                        ]
                    );
                }
                $allExpenseAmount += $expenseAmount;
            }
            Bank::updateOrCreate(
                [
                    'kezek_id' => $kezek->id,
                    'name' => $kezek->mark . ' ' . $kezek->model
                ],
                [
                    'user_id' => $userId,
                    'income' => $request['sum'],
                    'profit' => $request['sum_usluga'] - $allExpenseAmount,
                    'expense' => 0
                ]
            );

            return response()->json(['success' => 'Kezek updated', 'kezek' => $kezek], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }

}
