<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5 ; $i++) {
            $dataInsert = [
                'full_name' => 'Nguyễn Văn A ' . $i,
                'address' => 'Street ' . $i,
                'phone' => '123456789' . $i,
                'email' => 'nguyenvana' . $i . '@gmail.com',
                'password' => bcrypt('123456'),
            ];
            DB::table('customers')->insert($dataInsert);
        }
    }
}
