<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '08123456789',
                'password' => bcrypt('admin123'),
                'role' => 'Admin'
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'phone_number' => '098776512312',
                'password' => bcrypt('user123'),
                'role' => 'User'
            ],
        ];

        foreach ($data as $value) {
            User::insert([
                'name' => $value['name'],
                'email' => $value['email'],
                'phone_number' => $value['phone_number'],
                'password' => $value['password'],
                'role' => $value['role'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
