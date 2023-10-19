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
                'name' => 'admin',
                'email' => 'root',
                'password' => '123123'
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

    }
}
