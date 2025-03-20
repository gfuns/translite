<?php

namespace Database\Seeders;

use App\Models\IssueTypes;
use Illuminate\Database\Seeder;

class SupportCategories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'category' => 'POS Battery not charing',
            ],
            [
                'id' => 2,
                'category' => 'pos Device not coming on',
            ],

            [
                'id' => 3,
                'category' => 'POS Device screen is not displaying',
            ],
        ];

        foreach ($data as $inv) {
            IssueTypes::updateOrCreate($inv);
        }
    }
}
