<?php

namespace Database\Seeders;

use App\Models\Maps;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'source' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.9232047240325!2d109.25846477454742!3d-7.362505272447043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655f699d44a499%3A0x6d00c6597a775097!2sGOR%20PURWAWIDJAYA!5e0!3m2!1sen!2sid!4v1705942037315!5m2!1sen!2sid',
            ],
        ];

        foreach ($data as $item) {
            Maps::insert([
                'source' => $item['source'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
