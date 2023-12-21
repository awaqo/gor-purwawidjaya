<?php

namespace Database\Seeders;

use App\Models\Court;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'court_name' => 'Lapangan 1',
                'description' => 'Deskripsi lapangan 1'
            ],
            [
                'court_name' => 'Lapangan 2',
                'description' => 'Deskripsi lapangan 2'
            ],
            [
                'court_name' => 'Lapangan 3',
                'description' => 'Deskripsi lapangan 3'
            ],
        ];

        foreach ($data as $item) {
            $slug = Str::slug($item['court_name'], '-');

            Court::insert([
                'court_name' => $item['court_name'],
                'slug' => $slug,
                'description' => $item['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
