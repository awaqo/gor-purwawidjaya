<?php

namespace Database\Seeders;

use App\Models\Facility;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'fac_name' => 'Mushola'
            ],
            [
                'fac_name' => 'Toilet'
            ],
            [
                'fac_name' => 'Snack'
            ],
            [
                'fac_name' => 'Makanan'
            ],
            [
                'fac_name' => 'Minuman'
            ],
            [
                'fac_name' => 'Grip'
            ],
            [
                'fac_name' => 'Bedak'
            ],
            [
                'fac_name' => 'Shuttlecock'
            ],
        ];

        foreach ($data as $item) {
            Facility::insert([
                'fac_name' => $item['fac_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
