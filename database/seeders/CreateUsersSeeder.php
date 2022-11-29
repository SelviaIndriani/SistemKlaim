<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Admin TTR',
                'username' => 'Admin321',
                'role' => 1,
                'password' => bcrypt('123'),
            ],
            [
                'nama' => 'Manager TTR',
                'username' => 'Manager321',
                'role' => 2,
                'password' => bcrypt('123'),
            ],
            [
                'nama' => 'Technical TTR',
                'username' => 'Technical321',
                'role' => 0,
                'password' => bcrypt('123'),
            ],

        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
