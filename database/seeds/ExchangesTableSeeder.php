<?php

use Illuminate\Database\Seeder;
use App\Models\Exchange\Exchange;
use Carbon\Carbon;

class ExchangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TL/BTC
        Exchange::insert([
            'id' => '16ff2427-d548-41e6-b7e0-c49ef4332735',

            'currency_selling_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
            'currency_buying_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',

            'currency_selling_name' => 'TL',
            'currency_buying_name' => 'BTC',

            'currency_selling_short_name'=>'TL',
            'currency_buying_short_name'=>'BTC',

            'currency_selling_long_name'=>'Türk Lirası',
            'currency_buying_long_name'=>'Bitcoin',

            'currency_selling_icon'=>'fa fa-try',
            'currency_buying_icon'=>'cf cf-btc',

            'active' => true,
            'order' => 1,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //TL/LTC
        Exchange::insert([
            'id' => '663a27ea-0d85-45bc-bd75-f63ea62944a8',

            'currency_selling_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
            'currency_buying_id' => '6029412e-8b7f-4889-a9b9-c862317b0dd8',

            'currency_selling_name' => 'TL',
            'currency_buying_name' => 'LTC',

            'currency_selling_long_name'=>'Türk Lirası',
            'currency_buying_long_name'=>'Litecoin',

            'currency_selling_short_name'=>'TL',
            'currency_buying_short_name'=>'LTC',

            'currency_selling_icon'=>'fa fa-try',
            'currency_buying_icon'=>'cf cf-ltc',

            'active' => true,
            'order' => 2,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //TL/ETH
        Exchange::insert([
            'id' => 'b866ce80-a819-40cc-88a2-c3154e23a27d',

            'currency_selling_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
            'currency_buying_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',

            'currency_selling_name' => 'TL',
            'currency_buying_name' => 'ETH',


            'currency_selling_short_name'=>'TL',
            'currency_buying_short_name'=>'ETH',

            'currency_selling_long_name'=>'Türk Lirası',
            'currency_buying_long_name'=>'Ethereum',

            'currency_selling_icon'=>'fa fa-try',
            'currency_buying_icon'=>'cf cf-eth',

            'active' => true,
            'order' => 3,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //TL/DASH
        Exchange::insert([
            'id' => '056073f1-3961-44d8-a563-452f9e57e1c4',

            'currency_selling_id' => 'f32b2332-da55-4eb4-8e86-3b20aac09b58',
            'currency_buying_id' => '992d17f4-b78f-4ca3-be85-30a03f634361',

            'currency_selling_name' => 'TL',
            'currency_buying_name' => 'DASH',


            'currency_selling_short_name'=>'TL',
            'currency_buying_short_name'=>'DASH',

            'currency_selling_long_name'=>'Türk Lirası',
            'currency_buying_long_name'=>'Dash',

            'currency_selling_icon'=>'fa fa-try',
            'currency_buying_icon'=>'cf cf-dash',

            'active' => true,
            'order' => 4,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //BTC/LTC
        Exchange::insert([
            'id' => '2f89cc38-ee72-415d-a5c4-350d5ec68ac0',

            'currency_selling_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',
            'currency_buying_id' => '6029412e-8b7f-4889-a9b9-c862317b0dd8',

            'currency_selling_name' => 'BTC',
            'currency_buying_name' => 'LTC',

            'currency_selling_short_name'=>'BTC',
            'currency_buying_short_name'=>'LTC',

            'currency_selling_long_name'=>'Bitcoin',
            'currency_buying_long_name'=>'Litecoin',

            'currency_selling_icon'=>'cf cf-btc',
            'currency_buying_icon'=>'cf cf-ltc',

            'active' => true,
            'order' => 5,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //BTC/ETH
        Exchange::insert([
            'id' => 'e382af7b-c5e3-49b9-b590-da357227e19e',

            'currency_selling_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',
            'currency_buying_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',

            'currency_selling_name' => 'BTC',
            'currency_buying_name' => 'ETH',


            'currency_selling_short_name'=>'BTC',
            'currency_buying_short_name'=>'ETH',

            'currency_selling_long_name'=>'Bitcoin',
            'currency_buying_long_name'=>'Ethereum',

            'currency_selling_icon'=>'cf cf-btc',
            'currency_buying_icon'=>'cf cf-eth',

            'active' => true,
            'order' => 6,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //BTC/DASH
        Exchange::insert([
            'id' => '4e24616f-bd9c-46ce-a068-3aeb403d9fab',

            'currency_selling_id' => 'c40e437e-4b46-4dc7-b1d5-5bd40198d3d4',
            'currency_buying_id' => '992d17f4-b78f-4ca3-be85-30a03f634361',

            'currency_selling_name' => 'BTC',
            'currency_buying_name' => 'DASH',


            'currency_selling_short_name'=>'BTC',
            'currency_buying_short_name'=>'DASH',

            'currency_selling_long_name'=>'Bitcoin',
            'currency_buying_long_name'=>'Dash',

            'currency_selling_icon'=>'cf cf-btc',
            'currency_buying_icon'=>'cf cf-dash',

            'active' => true,
            'order' => 7,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //ETH/DASH
        Exchange::insert([
            'id' => '414e3c10-905d-4a38-b27b-e5ff236a2f25',

            'currency_selling_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',
            'currency_buying_id' => '992d17f4-b78f-4ca3-be85-30a03f634361',

            'currency_selling_name' => 'ETH',
            'currency_buying_name' => 'DASH',

            'currency_selling_short_name'=>'ETH',
            'currency_buying_short_name'=>'DASH',

            'currency_selling_long_name'=>'Ethereum',
            'currency_buying_long_name'=>'Dash',

            'currency_selling_icon'=>'cf cf-eth',
            'currency_buying_icon'=>'cf cf-dash',

            'active' => true,
            'order' => 8,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //ETH/LTC
        Exchange::insert([
            'id' => '7c86cd55-b26e-4d59-92ba-a5f11226d364',

            'currency_selling_id' => '03d903b3-4c2b-4a03-aaca-eab9d38cb937',
            'currency_buying_id' => '6029412e-8b7f-4889-a9b9-c862317b0dd8',

            'currency_selling_name' => 'ETH',
            'currency_buying_name' => 'LTC',

            'currency_selling_short_name'=>'ETH',
            'currency_buying_short_name'=>'LTC',

            'currency_selling_long_name'=>'Ethereum',
            'currency_buying_long_name'=>'Litecoin',

            'currency_selling_icon'=>'cf cf-eth',
            'currency_buying_icon'=>'cf cf-ltc',

            'active' => true,
            'order' => 9,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
