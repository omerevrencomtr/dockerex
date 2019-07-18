<?php

use Illuminate\Database\Seeder;
use App\Models\Currency\CurrencyTransferAddress;
class CurrencyTransferAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencyTransferAddresses = [
            [
                //'name' => 'TL',
                'currency_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
                'address' => 'TR04 0004 6006 4688 8001 0019 82',
            ],
            [
                //'name' => 'TL',
                'currency_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
                'address' => 'TR96 0006 2000 4110 0000 0019 81',
            ],
            [
                //'name' => 'BTC',
                'currency_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',
                'address' => '1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX',
            ],
            [
                //'name' => 'BTC',
                'currency_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',
                'address' => '3MviaDfcXizhFGKgzW48udhaXEfQNP3rvT',
            ],
            [
                //'name' => 'LTC',
                'currency_id' => '6029412e-8b7f-4889-a9b9-c862317b0dd8',
                'address' => '3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj',
            ],
            [
                //'name' => 'LTC',
                'currency_id' => '6029412e-8b7f-4889-a9b9-c862317b0dd8',
                'address' => '3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAA',
            ],
            [
                //'name' => 'ETH',
                'currency_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',
                'address' => '0x0a185e263186fc601bf68bfb556d64b2ab44d004',
            ],
            [
                //'name' => 'ETH',
                'currency_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',
                'address' => '0xfaf1d7751fc4a82309b955f9a94d2fcfe7ae30e5',
            ],
            [
                //'name' => 'DASH',
                'currency_id' => '992d17f4-b78f-4ca3-be85-30a03f634361',
                'address' => 'XqHt831rFj5tr4PVjqEcJmh6VKvHP62Qiq',
            ],
            [
                //'name' => 'DASH',
                'currency_id' => '992d17f4-b78f-4ca3-be85-30a03f634361',
                'address' => 'Xta96EZeLS9oDuRHme635pbkH1G8auWwm4',
            ]

        ];

        foreach ($currencyTransferAddresses as $currencyTransferAddress) {
            CurrencyTransferAddress::create($currencyTransferAddress);
        }
    }
}
