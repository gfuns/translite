<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'lastName' => 'Tompolo',
            'firstName' => 'Jeremiah',
            'otherNames' => null,
            'email' => 'tompolojeremiah@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer',
        ]);

        $user = Business::create([
            'user_id' => $user->id,
            'businessName' => 'Test Business',
            'businessAddress' => '1301 Akin Adesola Stree, Victoria Island, Lagos State',
            'email' => 'tompolojeremiah@example.com',
            'password' => Hash::make('password'),
            'accountOfficerCode' => '003',
            'productCode' => '101',
            'bankName' => 'Peace MFB',
            'accountNumber' => '1100035444',
            'bankOneAccountNumber' => '00480011010003544',
            'customerId' => '003544',
            'bankId' => '204540',
            'agentFirstName' => 'Test',
            'agentLastName' => 'Agent',
            'agentPhoneNumber' => '09012345679',
        ]);
    }
}
