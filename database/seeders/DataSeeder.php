<?php

namespace Database\Seeders;

use App\Models\GeneralSettings;
use App\Models\ServiceProviders;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSettings::create([
            'setting' => 'app_mobile_key',
            'setting_value' => 'PMFB-MOBILE-6VRWW-JKMF0G-H2FUTUXZ',
        ]);

        $data = [
            [
                'id' => 1,
                'provider' => 'MTN',
                'logo' => 'https://res.cloudinary.com/audanepad/image/upload/v1687803955/tahqztbhmpnxffkjwevx.png',
                'category' => 'airtime/data',
            ],
            [
                'id' => 2,
                'provider' => 'Glo',
                'logo' => 'https://res.cloudinary.com/audanepad/image/upload/v1687804197/tebhg9mekjbf66sc5ksj.jpg',
                'category' => 'airtime/data',
            ],

            [
                'id' => 3,
                'provider' => 'Airtel',
                'logo' => 'https://res.cloudinary.com/audanepad/image/upload/v1687804412/dcwzbr7davvuxldfnq6d.png',
                'category' => 'airtime/data',
            ],
            [
                'id' => 4,
                'provider' => 'Etisalat',
                'logo' => 'https://res.cloudinary.com/audanepad/image/upload/v1687806491/ajhudhwu13zmglejtpap.png',
                'category' => 'airtime/data',
            ],
            [
                'id' => 5,
                'provider' => 'DSTV',
                'logo' => 'https://res.cloudinary.com/audanepad/image/upload/v1687848867/kcycdvbskrix0kqmcrem.png',
                'category' => 'tv',
            ],
            [
                'id' => 6,
                'provider' => 'GOTV',
                'logo' => 'https://res.cloudinary.com/audanepad/image/upload/v1687848938/cl5bd4ygefzflu2kkjxz.png',
                'category' => 'tv',
            ],
            [
                'id' => 7,
                'provider' => 'StarTimes',
                'logo' => 'https://res.cloudinary.com/audanepad/image/upload/v1687848960/mmqzsbt2dabyudkcsj8n.jpg',
                'category' => 'tv',
            ],
        ];

        foreach ($data as $inv) {
            ServiceProviders::updateOrCreate($inv);
        }
    }
}
