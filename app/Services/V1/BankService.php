<?php

namespace App\Services\V1;

use App\Models\V1\Bank;
use App\Models\V1\User;
use Exception;

class BankService
{
    public function allList() {
        try {
            $user = auth()->user();
            $usersData = []; // Для хранения данных пользователей

            $startDate = request('startDate', date("Y-m-01")); // Получаем из запроса или используем первое число месяца
            $endDate = request('endDate', date("Y-m-d 23:59:59")); // Получаем из запроса или используем сегодняшнюю дату

            if ($user->id == 1) {
                $allUsers = User::all();

                foreach ($allUsers as $u) {
                    $userStatistics = [
                        'income' => 0,
                        'profit' => 0,
                        'expense' => 0,
                    ];

                    $allData = Bank::where('user_id', $u->id)
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->get();

                    foreach ($allData as $bankRecord) {
                        $userStatistics['income'] += $bankRecord->income;
                        $userStatistics['profit'] += $bankRecord->profit;
                        $userStatistics['expense'] += $bankRecord->expense;
                    }

                    $userData = [
                        'id' => $u->id,
                        'name' => $u->name,
                        'email' => $u->email,
                        'bank' => $allData,
                        'statistics' => $userStatistics, // Добавляем статистику для каждого пользователя
                    ];

                    $usersData[] = $userData;
                }
            } else {
                // Для текущего пользователя, если он не админ
                $userStatistics = [
                    'income' => 0,
                    'profit' => 0,
                    'expense' => 0,
                ];

                $allData = Bank::where('user_id', $user->id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->get();

                foreach ($allData as $bankRecord) {
                    $userStatistics['income'] += $bankRecord->income;
                    $userStatistics['profit'] += $bankRecord->profit;
                    $userStatistics['expense'] += $bankRecord->expense;
                }

                $userData = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'bank' => $allData,
                    'statistics' => $userStatistics, // Добавляем статистику для текущего пользователя
                ];

                $usersData[] = $userData;
            }

            return response()->json(['users' => $usersData], 200);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function createNewRow($data)
    {
        try {
            $user = auth()->user();
            $data['filialId'] = $user->id;
            $newRow = Bank::newRow($data);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'New kezek added', 'kezek' => $newRow], 200);
    }

    public function deleteRow($id)
    {
        try {
            $row = Bank::find($id);
            if (!$row) {
                return response()->json(['message' => 'Kezek not found', 'bank' => $row], 404);
            }

            $row->delete();
            return response()->json(['success' => 'Bank deleted', 'bank' => $row], 200);
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
