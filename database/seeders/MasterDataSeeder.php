<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /**
         * SEEDER DOCTORS
         */
        Doctor::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156edoca",
            'name' => 'Martin Johnson',
            'specialization' => 'Dokter Umum',
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);

        Doctor::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156edocb",
            'name' => 'Yenny Suroto',
            'specialization' => 'Dokter Umum',
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);

        Doctor::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156edocc",
            'name' => 'Hadi Suhadi',
            'specialization' => 'Dokter Mata',
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);

        Doctor::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156edocd",
            'name' => 'Ade Abdurahman',
            'specialization' => 'Dokter Gigi',
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);



        /**
         * SEEDER TREATMENT
         */
        Treatment::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156etrea",
            'name' => 'Poli Umum',
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);

        Treatment::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156etreb",
            'name' => 'Poli Gigi',
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);

        Treatment::create([
            "id" => "0186b5c7-7a7b-4b0d-9586-b2ac156etrec",
            'name' => 'Poli Mata',
            "updated_at" => "2024-04-29T13:36:49.000000Z",
            "created_at" => "2024-04-29T13:36:49.000000Z"
        ]);
    }
}
