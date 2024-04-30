<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156e75ea",
            'name' => 'admin',
            'email' => 'admin@yopmail.com',
            'password' => 'password',
            'is_admin' => true,
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);

        User::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156e75eb",
            'name' => 'Sari Purnawati',
            'email' => 'sari@yopmail.com',
            'password' => 'password',
            'is_admin' => false,
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);

        User::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156e75ec",
            'name' => 'Hanif Wardana',
            'email' => 'hanif@yopmail.com',
            'password' => 'password',
            'is_admin' => false,
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);
    }
}
