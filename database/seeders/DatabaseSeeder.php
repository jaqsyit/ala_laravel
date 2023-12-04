<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//         \App\Models\V1\User::factory()->create([
//             'name' => 'Admin',
//             'password' => '123123',
//         ]);

        DB::table('users')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'Ануар',
                'email' => 'root',
                'password' => '123123',
                'filial' => 'Жаңаөзен'
            ]
        );

        DB::table('users')->updateOrInsert(
            ['id' => 2],
            [
                'name' => 'Актобе',
                'email' => 'aktobe',
                'password' => '123123',
                'filial' => 'Ақтөбе'
            ]
        );

        $dataWorkers = [
            ['id' => 1, 'name' => 'Ибрагим', 'tel' => '+77083620675'],
            ['id' => 2, 'name' => '2 worker', 'tel' => '+77083620675'],
            ['id' => 3, 'name' => '3 worker', 'tel' => '+77083620675'],
        ];
        DB::table('workers')->upsert($dataWorkers, ['id'], ['name', 'tel']);



        DB::table('uslugis')->updateOrInsert(
            ['id' => 1],
            [
                'user_id' => '1',
                'name' => 'Линза орнату',
                'price' => '45000'
            ]
        );
        DB::table('uslugis')->updateOrInsert(
            ['id' => 2],
            [
                'user_id' => '1',
                'name' => 'Рифление тазалау',
                'price' => '20000'
            ]
        );
        DB::table('uslugis')->updateOrInsert(
            ['id' => 3],
            [
                'user_id' => '1',
                'name' => 'Микротрещина тазалау',
                'price' => '20000'
            ]
        );
        DB::table('uslugis')->updateOrInsert(
            ['id' => 4],
            [
                'user_id' => '1',
                'name' => 'Фара токтарын қалыпқа келтіру',
                'price' => '40000'
            ]
        );
        DB::table('uslugis')->updateOrInsert(
            ['id' => 5],
            [
                'user_id' => '1',
                'name' => 'Фараны жылтырату',
                'price' => '30000'
            ]
        );
        DB::table('uslugis')->updateOrInsert(
            ['id' => 6],
            [
                'user_id' => '1',
                'name' => 'Булану себебін анықтау',
                'price' => '10000'
            ]
        );
        DB::table('uslugis')->updateOrInsert(
            ['id' => 7],
            [
                'user_id' => '1',
                'name' => 'Артқы фонарь светодиодтарын ауыстыру',
                'price' => '40000'
            ]
        );
        DB::table('uslugis')->updateOrInsert(
            ['id' => 8],
            [
                'user_id' => '1',
                'name' => 'ДХО ремонттау және орнату',
                'price' => '30000'
            ]
        );

        DB::table('sklads')->updateOrInsert(
            ['id' => 1],
            [
                'user_id' => 1,
                'name' => 'герметик',
                'quantity' => 10,
                'price' => 4000,
                'oz_price' => 4000
            ]
        );

        DB::table('sklads')->updateOrInsert(
            ['id' => 2],
            [
                'user_id' => 1,
                'name' => 'Azoom a5',
                'quantity' => 4,
                'price' => 50000,
                'oz_price' => 30000
            ]
        );

        DB::table('kezeks')->updateOrInsert(
            ['id' => 1],
            [
                'user_id' => 1,
                'status' => false,
                'mark' => 'Kia',
                'model' => 'Cerato',
                'equipment' => 'xl',
                'year' => 2004,
                'id_usluga' => 'sdfsg',
                'linza' => null,
                'sum' => 135000,
                'comment' => null,
                'tel' => '+77083620675',
                'zapis' => '2023-10-20 15:00:00'
            ]
        );

        DB::table('kezeks')->updateOrInsert(
            ['id' => 2],
            [
                'user_id' => 1,
                'status' => false,
                'mark' => 'Toyota',
                'model' => 'Camry',
                'equipment' => 'xle',
                'year' => 2017,
                'id_usluga' => 'Установка линзы',
                'linza' => 'Azoom A5',
                'sum' => 200000,
                'comment' => null,
                'tel' => '+77016425170',
                'zapis' => '2023-10-20'
            ]
        );

    }
}
