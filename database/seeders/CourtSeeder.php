<?php

namespace Database\Seeders;

use App\Models\Court;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1698223261/rlhul4u5fn3bfpak4o8m.jpg',
                'description' => 'Deskripsi lapangan 1'
            ],
            [
                'name' => 'Lapangan 2',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1698223482/ubfppoyptbekrurlv1qw.jpg',
                'description' => 'Deskripsi lapangan 2'
            ],
            [
                'name' => 'Lapangan 3',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1698223261/gu1hdbguygsay8js2rsm.jpg',
                'description' => 'Deskripsi lapangan 3'
            ],
        ];

        $client = new Client();

        foreach ($data as $item) {
            $response = $client->request('GET', $item['image']);
            $extension = pathinfo($item['image'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            Storage::put('public/assets/court/' . $imageName, $response->getBody());

            Court::insert([
                'name' => $item['name'],
                'image' => 'assets/court/' . $imageName,
                'description' => $item['description'],
            ]);
        }
    }
}
