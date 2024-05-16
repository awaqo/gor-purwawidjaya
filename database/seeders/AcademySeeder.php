<?php

namespace Database\Seeders;

use App\Models\Academy;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'coach_name' => 'Rayhan Putra',
                'coach_profile' => 'Hallo perkenalkan nama saya Rayhan Putra, saya siap melatih anda',
                'price_academy' => '300000',
                'day_schedule' => 'Senin & Selasa',
                'meeting' => '9',
                'time_schedule_start' => '14:00',
                'time_schedule_end' => '16:00',
                'difficulty_academy' => 'Pemula & Menengah',
                'slot_academy' => '10',
                'location_academy' => 'GOR Purwawidjaya',
            ],
            [
                'coach_name' => 'Putra Rayhan',
                'coach_profile' => 'Deskripsi Perlombaan 2',
                'price_academy' => '350000',
                'day_schedule' => 'Kamis & Sabtu',
                'meeting' => '10',
                'time_schedule_start' => '19:00',
                'time_schedule_end' => '21:00',
                'difficulty_academy' => 'Pemula & Menengah',
                'slot_academy' => '15',
                'location_academy' => 'GOR Purwawidjaya',
            ],
        ];

        foreach ($data as $item) {
            $slug = Str::slug($item['coach_name'], '-');

            Academy::insert([
                'coach_name' => $item['coach_name'],
                'slug' => $slug,
                'coach_profile' => $item['coach_profile'],
                'price_academy' => $item['price_academy'],
                'day_schedule' => $item['day_schedule'],
                'meeting' => $item['meeting'],
                'time_schedule_start' => $item['time_schedule_start'],
                'time_schedule_end' => $item['time_schedule_end'],
                'difficulty_academy' => $item['difficulty_academy'],
                'slot_academy' => $item['slot_academy'],
                'location_academy' => $item['location_academy'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
