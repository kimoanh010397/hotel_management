<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataInsert = [
            [
                'name' => 'Test name',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];

        DB::table('users')->insert($dataInsert);
    }
}
