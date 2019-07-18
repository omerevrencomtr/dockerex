<?php

use Illuminate\Database\Seeder;
use App\Models\Currency\CurrencyTransferCommission;

class CurrencyTransferCommissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencyTransferCommissions = [
            [
                //'name' => 'TL',
                'currency_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
                'key' => 'normal',
                'direction' => 'withdraw',
                'amount' => '3',
            ],
            [
                //'name' => 'TL',
                'currency_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
                'key' => 'fast',
                'direction' => 'withdraw',
                'amount' => '5',
            ],
            [
                //'name' => 'BTC',
                'currency_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',
                'key' => 'normal',
                'direction' => 'withdraw',
                'amount' => '0.0005',
            ],
            [
                //'name' => 'BTC',
                'currency_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',
                'key' => 'fast',
                'direction' => 'withdraw',
                'amount' => '0.0006',
            ],
            [
                //'name' => 'LTC',
                'currency_id' => '6029412e-8b7f-4889-a9b9-c862317b0dd8',
                'key' => 'normal',
                'direction' => 'withdraw',
                'amount' => '0.0005',
            ],
            [
                //'name' => 'LTC',
                'currency_id' => '6029412e-8b7f-4889-a9b9-c862317b0dd8',
                'key' => 'fast',
                'direction' => 'withdraw',
                'amount' => '0.0006',
            ],
            [
                //'name' => 'ETH',
                'currency_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',
                'key' => 'normal',
                'direction' => 'withdraw',
                'amount' => '0.0005',
            ],
            [
                //'name' => 'ETH',
                'currency_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',
                'key' => 'fast',
                'direction' => 'withdraw',
                'amount' => '0.0006',
            ],
            [
                //'name' => 'DASH',
                'currency_id' => '992d17f4-b78f-4ca3-be85-30a03f634361',
                'key' => 'normal',
                'direction' => 'withdraw',
                'amount' => '0.0007',
            ],
            [
                //'name' => 'DASH',
                'currency_id' => '992d17f4-b78f-4ca3-be85-30a03f634361',
                'key' => 'fast',
                'direction' => 'withdraw',
                'amount' => '0.0007',
            ]

        ];

        foreach ($currencyTransferCommissions as $currencyTransferCommission) {
            CurrencyTransferCommission::create($currencyTransferCommission);
        }
    }
}
