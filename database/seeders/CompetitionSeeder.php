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
                'title' => 'Banteran Championship',
                'description' => 'Perlombaan badminton yang diadakan di Gor Purwawidjaya memperingati hari jadi Gor Purwawidjaya ke 7 tahun dengan diadakan perlombaan badminton',
                'price_competition' => '50000',
                'date_start' => '2024-06-11',
                'slot_competition' => '32',
                'category_competition' => 'Ganda Putra',
                'difficulty_competition' => 'Pemula & Menengah',
                'location_competition' => 'GOR Purwawidjaya',
            ],
            [
                'title' => 'Championship Banteran',
                'description' => 'Deskripsi Perlombaan 2',
                'price_competition' => '35000',
                'date_start' => '2024-07-02',
                'slot_competition' => '20',
                'category_competition' => 'Ganda Campuran',
                'difficulty_competition' => 'Pemula & Menengah',
                'location_competition' => 'GOR Purwawidjaya',
            ],
        ];

        foreach ($data as $item) {
            $slug = Str::slug($item['title'], '-');

            Competition::insert([
                'title' => $item['title'],
                'slug' => $slug,
                'description' => $item['description'],
                'price_competition' => $item['price_competition'],
                'date_start' => $item['date_start'],
                'slot_competition' => $item['slot_competition'],
                'category_competition' => $item['category_competition'],
                'difficulty_competition' => $item['difficulty_competition'],
                'location_competition' => $item['location_competition'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
