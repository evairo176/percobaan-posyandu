<?php

namespace Database\Seeders;

use App\Models\User;
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
        DB::table('users')->delete();

        $users = [
            [
                'posyandu_id' => 1,
                'name' => 'Dicki Prasetya',
                'email' => 'semenjakpetang176@gmail.com',
                'password' => bcrypt('123456'),
                'picture' => 'default.jpg',
                'gender' => 'Laki-Laki',
                'role' => 'super-admin',
            ],
            [
                'posyandu_id' => 1,
                'name' => 'Petugas',
                'email' => 'coba1@gmail.com',
                'password' => bcrypt('123456'),
                'picture' => 'default.jpg',
                'gender' => 'Laki-Laki',
                'role' => 'petugas'
            ],
        ];

        User::insert($users);
    }
}
