<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'timeStart' => '06',
                'timeEnd' => '07',
                'price' => '15000',
            ],
            [
                'timeStart' => '07',
                'timeEnd' => '08',
                'price' => '15000',
            ],
            [
                'timeStart' => '08',
                'timeEnd' => '09',
                'price' => '15000',
            ],
            [
                'timeStart' => '09',
                'timeEnd' => '10',
                'price' => '15000',
            ],
            [
                'timeStart' => '10',
                'timeEnd' => '11',
                'price' => '15000',
            ],
            [
                'timeStart' => '11',
                'timeEnd' => '12',
                'price' => '15000',
            ],
            [
                'timeStart' => '12',
                'timeEnd' => '13',
                'price' => '15000',
            ],
            [
                'timeStart' => '13',
                'timeEnd' => '14',
                'price' => '15000',
            ],
            [
                'timeStart' => '14',
                'timeEnd' => '15',
                'price' => '15000',
            ],
            [
                'timeStart' => '15',
                'timeEnd' => '16',
                'price' => '15000',
            ],
            [
                'timeStart' => '16',
                'timeEnd' => '17',
                'price' => '15000',
            ],
            [
                'timeStart' => '17',
                'timeEnd' => '18',
                'price' => '15000',
            ],
            [
                'timeStart' => '18',
                'timeEnd' => '19',
                'price' => '20000',
            ],
            [
                'timeStart' => '19',
                'timeEnd' => '20',
                'price' => '20000',
            ],
            [
                'timeStart' => '20',
                'timeEnd' => '21',
                'price' => '20000',
            ],
            [
                'timeStart' => '21',
                'timeEnd' => '22',
                'price' => '20000',
            ],
            [
                'timeStart' => '22',
                'timeEnd' => '23',
                'price' => '20000',
            ],
            [
                'timeStart' => '23',
                'timeEnd' => '24',
                'price' => '20000',
            ],
            [
                'timeStart' => '24',
                'timeEnd' => '01',
                'price' => '20000',
            ],
        ];

        foreach ($data as $item) {
            Schedule::insert([
                'timeStart' => $item['timeStart'],
                'timeEnd' => $item['timeEnd'],
                'price' => $item['price'],
            ]);
        }
    }
}
