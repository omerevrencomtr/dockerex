<?php

use Illuminate\Database\Seeder;
use App\Models\Exchange\ExchangeCommission;

class ExchangeCommissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commissions = [
            [
                //TL/BTC
                'exchange_id' => '16ff2427-d548-41e6-b7e0-c49ef4332735',
                'min' => 0,
                'max' => 20000,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //TL/BTC
                'exchange_id' => '16ff2427-d548-41e6-b7e0-c49ef4332735',
                'min' => 20001,
                'max' => 50000,
                'maker' =>0.0015,
                'taker' =>0.0020,
            ],
            [
                //TL/BTC
                'exchange_id' => '16ff2427-d548-41e6-b7e0-c49ef4332735',
                'min' => 50001,
                'max' => 100000,
                'maker' =>0.0012,
                'taker' =>0.0015,
            ],
            [
                //TL/BTC
                'exchange_id' => '16ff2427-d548-41e6-b7e0-c49ef4332735',
                'min' => 100001,
                'max' => 500000,
                'maker' =>0.001,
                'taker' =>0.0012,
            ],
            [
                //TL/BTC
                'exchange_id' => '16ff2427-d548-41e6-b7e0-c49ef4332735',
                'min' => 500001,
                'max' => 9999999,
                'maker' =>0.0005,
                'taker' =>0.001,
            ],
            [
                //TL/LTC
                'exchange_id' => '663a27ea-0d85-45bc-bd75-f63ea62944a8',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //TL/ETH
                'exchange_id' => 'b866ce80-a819-40cc-88a2-c3154e23a27d',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //TL/DASH
                'exchange_id' => '056073f1-3961-44d8-a563-452f9e57e1c4',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //BTC/LTC
                'exchange_id' => '2f89cc38-ee72-415d-a5c4-350d5ec68ac0',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //BTC/ETH
                'exchange_id' => 'e382af7b-c5e3-49b9-b590-da357227e19e',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //BTC/DASH
                'exchange_id' => '4e24616f-bd9c-46ce-a068-3aeb403d9fab',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //ETH/DASH
                'exchange_id' => '414e3c10-905d-4a38-b27b-e5ff236a2f25',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ],
            [
                //ETH/LTC
                'exchange_id' => '7c86cd55-b26e-4d59-92ba-a5f11226d364',
                'min' => 0,
                'max' => 9999999,
                'maker' =>0.002,
                'taker' =>0.0025,
            ]
        ];

        foreach ($commissions as $commission) {
            ExchangeCommission::create($commission);
        }
    }
}
