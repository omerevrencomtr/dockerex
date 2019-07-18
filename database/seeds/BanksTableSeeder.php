<?php

use Illuminate\Database\Seeder;
use App\Models\Bank\Bank;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                'code' => '100',
                'name' => 'Adabank',
                'icon' => ''
            ],
            [
                'code' => '46',
                'name' => 'Akbank',
                'icon' => ''
            ],
            [
                'code' => '143',
                'name' => 'Aktif Yatirim Bankasi',
                'icon' => ''
            ],
            [
                'code' => '203',
                'name' => 'Albaraka Türk Katilim Bankasi',
                'icon' => 'albaraka.png'
            ],
            [
                'code' => '124',
                'name' => 'Alternatif Bank',
                'icon' => ''
            ],
            [
                'code' => '135',
                'name' => 'Anadolu Bank',
                'icon' => ''
            ],
            [
                'code' => '91',
                'name' => 'Arap T\'urk Bankasi',
                'icon' => ''
            ],
            [
                'code' => '94',
                'name' => 'Bank Mellat',
                'icon' => ''
            ],
            [
                'code' => '147',
                'name' => 'Bank of Tokyo-Mitsubishi UFJ Turkey',
                'icon' => ''
            ],
            [
                'code' => '142',
                'name' => 'Bankpozitif Kredi ve Kalkinma Bankasi',
                'icon' => ''
            ],
            [
                'code' => '29',
                'name' => 'Birlesik Fon Bankasi',
                'icon' => ''
            ],
            [
                'code' => '125',
                'name' => 'Burgan Bank',
                'icon' => 'burgan.png'
            ],
            [
                'code' => '92',
                'name' => 'Citibank',
                'icon' => 'city.png'
            ],
            [
                'code' => '134',
                'name' => 'Denizbank',
                'icon' => 'deniz.png'
            ],
            [
                'code' => '115',
                'name' => 'Deutsche Bank',
                'icon' => ''
            ],
            [
                'code' => '138',
                'name' => 'Dilerbank',
                'icon' => ''
            ],
            [
                'code' => '16',
                'name' => 'Eximbank',
                'icon' => ''
            ],
            [
                'code' => '103',
                'name' => 'Fibabanka',
                'icon' => 'fiba.png'
            ],
            [
                'code' => '111',
                'name' => 'Finansbank',
                'icon' => 'qnb.png'
            ],
            [
                'code' => '62',
                'name' => 'Garanti Bankasi',
                'icon' => 'garanti.png'
            ],
            [
                'code' => '139',
                'name' => 'GSD Bank',
                'icon' => ''
            ],
            [
                'code' => '12',
                'name' => 'Halkbank',
                'icon' => 'halkbank.png'
            ],
            [
                'code' => '123',
                'name' => 'HSBC',
                'icon' => 'hsbc.png'
            ],
            [
                'code' => '109',
                'name' => 'ICBC Turkey Bank',
                'icon' => ''
            ],
            [
                'code' => '99',
                'name' => 'ING Bank',
                'icon' => 'ing.png'
            ],
            [
                'code' => '148',
                'name' => 'Intesa Sanpaolo S.p.A',
                'icon' => ''
            ],
            [
                'code' => '4',
                'name' => 'Iller Bankasi',
                'icon' => ''
            ],
            [
                'code' => '64',
                'name' => 'Is Bankasi',
                'icon' => 'is.png'
            ],
            [
                'code' => '98',
                'name' => 'JPMorgan Chase Bank',
                'icon' => ''
            ],
            [
                'code' => '17',
                'name' => 'Kalkinma Bankasi',
                'icon' => ''
            ],
            [
                'code' => '205',
                'name' => 'Kuveyt T\'urk Katilim Bankasi',
                'icon' => 'kuveyt.png'
            ],
            [
                'code' => '806',
                'name' => 'Merkezi Kayit Kurulusu',
                'icon' => ''
            ],
            [
                'code' => '129',
                'name' => 'Merrill Lynch Yatirim Bank',
                'icon' => ''
            ],
            [
                'code' => '141',
                'name' => 'Nurol Yatirim Bankasi',
                'icon' => ''
            ],
            [
                'code' => '146',
                'name' => 'Odea Bank',
                'icon' => 'odea.png'
            ],
            [
                'code' => '116',
                'name' => 'Pasha Yatirim Bankasi',
                'icon' => ''
            ],
            [
                'code' => '137',
                'name' => 'Rabobank',
                'icon' => ''
            ],
            [
                'code' => '14',
                'name' => 'Sinai Kalkinma Bankasi',
                'icon' => ''
            ],
            [
                'code' => '122',
                'name' => 'Societe Generale',
                'icon' => ''
            ],
            [
                'code' => '121',
                'name' => 'Standard Chartered Yatirim Bankasi',
                'icon' => ''
            ],
            [
                'code' => '59',
                'name' => 'Sekerbank',
                'icon' => 'seker.png'
            ],
            [
                'code' => '132',
                'name' => 'Takasbank',
                'icon' => ''
            ],
            [
                'code' => '1',
                'name' => 'TC Merkez Bankasi',
                'icon' => ''
            ],
            [
                'code' => '96',
                'name' => 'Turkish Bank',
                'icon' => ''
            ],
            [
                'code' => '108',
                'name' => 'Turkland Bank',
                'icon' => ''
            ],
            [
                'code' => '32',
                'name' => 'T\'urk Ekonomi Bankasi',
                'icon' => ''
            ],
            [
                'code' => '206',
                'name' => 'T\'urkiye Finans Katilim Bankasi',
                'icon' => 'turkiyefinans.png'
            ],
            [
                'code' => '210',
                'name' => 'Vakif Katilim Bankasi',
                'icon' => 'vakif_katilim.png'
            ],
            [
                'code' => '15',
                'name' => 'Vakiflar Bankasi',
                'icon' => 'vakif.png'
            ],
            [
                'code' => '67',
                'name' => 'Yapi ve Kredi Bankasi',
                'icon' => 'yapikredi.png'
            ],
            [
                'code' => '10',
                'name' => 'Ziraat Bankasi',
                'icon' => 'ziraat.png'
            ],
            [
                'code' => '209',
                'name' => 'Ziraat Katilim Bankasi',
                'icon' => 'ziraat_katilim.png'
            ]
        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }
    }
}
