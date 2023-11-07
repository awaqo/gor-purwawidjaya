<?php

namespace Database\Seeders;

use App\Models\CourtImages;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CourtImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'court_id' => '1',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1698223261/rlhul4u5fn3bfpak4o8m.jpg',
            ],
            [
                'court_id' => '1',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1699368326/iswen22zosj1k6nmi7t0.jpg',
            ],
            [
                'court_id' => '1',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1699368327/vvr1xxjak4xxrfjw9axf.jpg',
            ],

            [
                'court_id' => '2',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1698223482/ubfppoyptbekrurlv1qw.jpg',
            ],
            [
                'court_id' => '2',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1699368327/ttxqgccvsif90etjecvf.jpg',
            ],
            [
                'court_id' => '2',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1699368327/mahh6flufkpl6efv5fly.jpg',
            ],

            [
                'court_id' => '3',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1698223261/gu1hdbguygsay8js2rsm.jpg',
            ],
            [
                'court_id' => '3',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1699368329/ehgneyyerhq4jmfmkqms.jpg',
            ],
            [
                'court_id' => '3',
                'image' => 'https://res.cloudinary.com/dn6fh7ecb/image/upload/v1699368326/x3vowxwf54gbm538mopr.jpg',
            ],
        ];

        $client = new Client();

        foreach ($data as $item) {
            $response = $client->request('GET', $item['image']);
            $extension = pathinfo($item['image'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            Storage::put('public/assets/court/' . $imageName, $response->getBody());

            CourtImages::insert([
                'court_id' => $item['court_id'],
                'image' => 'assets/court/' . $imageName,
            ]);
        }
    }
}
