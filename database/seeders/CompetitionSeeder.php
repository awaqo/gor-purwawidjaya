<?php

namespace Database\Seeders;

use App\Models\Competition;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Perlombaan 1',
                'location' => 'Lokasi Perlombaan 1',
                'date_start' => '2024-02-01',
                'date_end' => '2024-02-03',
                'description' => 'Deskripsi Perlombaan 1'
            ],
            [
                'title' => 'Perlombaan 2',
                'location' => 'Lokasi Perlombaan 2',
                'date_start' => '2024-02-10',
                'date_end' => '2024-02-13',
                'description' => 'Deskripsi Perlombaan 2'
            ],
        ];

        foreach ($data as $item) {
            $slug = Str::slug($item['title'], '-');

            Competition::insert([
                'title' => $item['title'],
                'slug' => $slug,
                'location' => $item['location'],
                'date_start' => $item['date_start'],
                'date_end' => $item['date_end'],
                'description' => $item['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
