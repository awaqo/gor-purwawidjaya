<?php

namespace Database\Seeders;

use App\Models\Court;
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
                'name' => 'Lapangan 1',
                'description' => 'Deskripsi lapangan 1'
            ],
            [
                'name' => 'Lapangan 2',
                'description' => 'Deskripsi lapangan 2'
            ],
            [
                'name' => 'Lapangan 3',
                'description' => 'Deskripsi lapangan 3'
            ],
        ];

        foreach ($data as $item) {
            $slug = Str::slug($item['name'], '-');

            Court::insert([
                'name' => $item['name'],
                'slug' => $slug,
                'description' => $item['description'],
            ]);
        }
    }
}
