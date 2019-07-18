<?php

use Illuminate\Database\Seeder;
use App\Models\Country\Country;


class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = [
            [
                'id' => '1',
                'iso' => 'AF',
                'name' => 'AFGHANISTAN',
                'full_name' => 'Afghanistan',
                'iso3' => 'AFG',
                'number_code' => '4',
                'phone_code' => '93'
            ],
            [
                'id' => '2',
                'iso' => 'AL',
                'name' => 'ALBANIA',
                'full_name' => 'Albania',
                'iso3' => 'ALB',
                'number_code' => '8',
                'phone_code' => '355'
            ],
            [
                'id' => '3',
                'iso' => 'DZ',
                'name' => 'ALGERIA',
                'full_name' => 'Algeria',
                'iso3' => 'DZA',
                'number_code' => '12',
                'phone_code' => '213'
            ],
            [
                'id' => '4',
                'iso' => 'AS',
                'name' => 'AMERICAN SAMOA',
                'full_name' => 'American Samoa',
                'iso3' => 'ASM',
                'number_code' => '16',
                'phone_code' => '1684'
            ],
            [
                'id' => '5',
                'iso' => 'AD',
                'name' => 'ANDORRA',
                'full_name' => 'Andorra',
                'iso3' => 'AND',
                'number_code' => '20',
                'phone_code' => '376'
            ],
            [
                'id' => '6',
                'iso' => 'AO',
                'name' => 'ANGOLA',
                'full_name' => 'Angola',
                'iso3' => 'AGO',
                'number_code' => '24',
                'phone_code' => '244'
            ],
            [
                'id' => '7',
                'iso' => 'AI',
                'name' => 'ANGUILLA',
                'full_name' => 'Anguilla',
                'iso3' => 'AIA',
                'number_code' => '660',
                'phone_code' => '1264'
            ],
            [
                'id' => '8',
                'iso' => 'AQ',
                'name' => 'ANTARCTICA',
                'full_name' => 'Antarctica',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '0'
            ],
            [
                'id' => '9',
                'iso' => 'AG',
                'name' => 'ANTIGUA AND BARBUDA',
                'full_name' => 'Antigua and Barbuda',
                'iso3' => 'ATG',
                'number_code' => '28',
                'phone_code' => '1268'
            ],
            [
                'id' => '10',
                'iso' => 'AR',
                'name' => 'ARGENTINA',
                'full_name' => 'Argentina',
                'iso3' => 'ARG',
                'number_code' => '32',
                'phone_code' => '54'
            ],
            [
                'id' => '11',
                'iso' => 'AM',
                'name' => 'ARMENIA',
                'full_name' => 'Armenia',
                'iso3' => 'ARM',
                'number_code' => '51',
                'phone_code' => '374'
            ],
            [
                'id' => '12',
                'iso' => 'AW',
                'name' => 'ARUBA',
                'full_name' => 'Aruba',
                'iso3' => 'ABW',
                'number_code' => '533',
                'phone_code' => '297'
            ],
            [
                'id' => '13',
                'iso' => 'AU',
                'name' => 'AUSTRALIA',
                'full_name' => 'Australia',
                'iso3' => 'AUS',
                'number_code' => '36',
                'phone_code' => '61'
            ],
            [
                'id' => '14',
                'iso' => 'AT',
                'name' => 'AUSTRIA',
                'full_name' => 'Austria',
                'iso3' => 'AUT',
                'number_code' => '40',
                'phone_code' => '43'
            ],
            [
                'id' => '15',
                'iso' => 'AZ',
                'name' => 'AZERBAIJAN',
                'full_name' => 'Azerbaijan',
                'iso3' => 'AZE',
                'number_code' => '31',
                'phone_code' => '994'
            ],
            [
                'id' => '16',
                'iso' => 'BS',
                'name' => 'BAHAMAS',
                'full_name' => 'Bahamas',
                'iso3' => 'BHS',
                'number_code' => '44',
                'phone_code' => '1242'
            ],
            [
                'id' => '17',
                'iso' => 'BH',
                'name' => 'BAHRAIN',
                'full_name' => 'Bahrain',
                'iso3' => 'BHR',
                'number_code' => '48',
                'phone_code' => '973'
            ],
            [
                'id' => '18',
                'iso' => 'BD',
                'name' => 'BANGLADESH',
                'full_name' => 'Bangladesh',
                'iso3' => 'BGD',
                'number_code' => '50',
                'phone_code' => '880'
            ],
            [
                'id' => '19',
                'iso' => 'BB',
                'name' => 'BARBADOS',
                'full_name' => 'Barbados',
                'iso3' => 'BRB',
                'number_code' => '52',
                'phone_code' => '1246'
            ],
            [
                'id' => '20',
                'iso' => 'BY',
                'name' => 'BELARUS',
                'full_name' => 'Belarus',
                'iso3' => 'BLR',
                'number_code' => '112',
                'phone_code' => '375'
            ],
            [
                'id' => '21',
                'iso' => 'BE',
                'name' => 'BELGIUM',
                'full_name' => 'Belgium',
                'iso3' => 'BEL',
                'number_code' => '56',
                'phone_code' => '32'
            ],
            [
                'id' => '22',
                'iso' => 'BZ',
                'name' => 'BELIZE',
                'full_name' => 'Belize',
                'iso3' => 'BLZ',
                'number_code' => '84',
                'phone_code' => '501'
            ],
            [
                'id' => '23',
                'iso' => 'BJ',
                'name' => 'BENIN',
                'full_name' => 'Benin',
                'iso3' => 'BEN',
                'number_code' => '204',
                'phone_code' => '229'
            ],
            [
                'id' => '24',
                'iso' => 'BM',
                'name' => 'BERMUDA',
                'full_name' => 'Bermuda',
                'iso3' => 'BMU',
                'number_code' => '60',
                'phone_code' => '1441'
            ],
            [
                'id' => '25',
                'iso' => 'BT',
                'name' => 'BHUTAN',
                'full_name' => 'Bhutan',
                'iso3' => 'BTN',
                'number_code' => '64',
                'phone_code' => '975'
            ],
            [
                'id' => '26',
                'iso' => 'BO',
                'name' => 'BOLIVIA',
                'full_name' => 'Bolivia',
                'iso3' => 'BOL',
                'number_code' => '68',
                'phone_code' => '591'
            ],
            [
                'id' => '27',
                'iso' => 'BA',
                'name' => 'BOSNIA AND HERZEGOVINA',
                'full_name' => 'Bosnia and Herzegovina',
                'iso3' => 'BIH',
                'number_code' => '70',
                'phone_code' => '387'
            ],
            [
                'id' => '28',
                'iso' => 'BW',
                'name' => 'BOTSWANA',
                'full_name' => 'Botswana',
                'iso3' => 'BWA',
                'number_code' => '72',
                'phone_code' => '267'
            ],
            [
                'id' => '29',
                'iso' => 'BV',
                'name' => 'BOUVET ISLAND',
                'full_name' => 'Bouvet Island',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '0'
            ],
            [
                'id' => '30',
                'iso' => 'BR',
                'name' => 'BRAZIL',
                'full_name' => 'Brazil',
                'iso3' => 'BRA',
                'number_code' => '76',
                'phone_code' => '55'
            ],
            [
                'id' => '31',
                'iso' => 'IO',
                'name' => 'BRITISH INDIAN OCEAN TERRITORY',
                'full_name' => 'British Indian Ocean Territory',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '246'
            ],
            [
                'id' => '32',
                'iso' => 'BN',
                'name' => 'BRUNEI DARUSSALAM',
                'full_name' => 'Brunei Darussalam',
                'iso3' => 'BRN',
                'number_code' => '96',
                'phone_code' => '673'
            ],
            [
                'id' => '33',
                'iso' => 'BG',
                'name' => 'BULGARIA',
                'full_name' => 'Bulgaria',
                'iso3' => 'BGR',
                'number_code' => '100',
                'phone_code' => '359'
            ],
            [
                'id' => '34',
                'iso' => 'BF',
                'name' => 'BURKINA FASO',
                'full_name' => 'Burkina Faso',
                'iso3' => 'BFA',
                'number_code' => '854',
                'phone_code' => '226'
            ],
            [
                'id' => '35',
                'iso' => 'BI',
                'name' => 'BURUNDI',
                'full_name' => 'Burundi',
                'iso3' => 'BDI',
                'number_code' => '108',
                'phone_code' => '257'
            ],
            [
                'id' => '36',
                'iso' => 'KH',
                'name' => 'CAMBODIA',
                'full_name' => 'Cambodia',
                'iso3' => 'KHM',
                'number_code' => '116',
                'phone_code' => '855'
            ],
            [
                'id' => '37',
                'iso' => 'CM',
                'name' => 'CAMEROON',
                'full_name' => 'Cameroon',
                'iso3' => 'CMR',
                'number_code' => '120',
                'phone_code' => '237'
            ],
            [
                'id' => '38',
                'iso' => 'CA',
                'name' => 'CANADA',
                'full_name' => 'Canada',
                'iso3' => 'CAN',
                'number_code' => '124',
                'phone_code' => '1'
            ],
            [
                'id' => '39',
                'iso' => 'CV',
                'name' => 'CAPE VERDE',
                'full_name' => 'Cape Verde',
                'iso3' => 'CPV',
                'number_code' => '132',
                'phone_code' => '238'
            ],
            [
                'id' => '40',
                'iso' => 'KY',
                'name' => 'CAYMAN ISLANDS',
                'full_name' => 'Cayman Islands',
                'iso3' => 'CYM',
                'number_code' => '136',
                'phone_code' => '1345'
            ],
            [
                'id' => '41',
                'iso' => 'CF',
                'name' => 'CENTRAL AFRICAN REPUBLIC',
                'full_name' => 'Central African Republic',
                'iso3' => 'CAF',
                'number_code' => '140',
                'phone_code' => '236'
            ],
            [
                'id' => '42',
                'iso' => 'TD',
                'name' => 'CHAD',
                'full_name' => 'Chad',
                'iso3' => 'TCD',
                'number_code' => '148',
                'phone_code' => '235'
            ],
            [
                'id' => '43',
                'iso' => 'CL',
                'name' => 'CHILE',
                'full_name' => 'Chile',
                'iso3' => 'CHL',
                'number_code' => '152',
                'phone_code' => '56'
            ],

            [
                'id' => '45',
                'iso' => 'CX',
                'name' => 'CHRISTMAS ISLAND',
                'full_name' => 'Christmas Island',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '61'
            ],
            [
                'id' => '46',
                'iso' => 'CC',
                'name' => 'COCOS (KEELING) ISLANDS',
                'full_name' => 'Cocos (Keeling) Islands',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '672'
            ],
            [
                'id' => '47',
                'iso' => 'CO',
                'name' => 'COLOMBIA',
                'full_name' => 'Colombia',
                'iso3' => 'COL',
                'number_code' => '170',
                'phone_code' => '57'
            ],
            [
                'id' => '48',
                'iso' => 'KM',
                'name' => 'COMOROS',
                'full_name' => 'Comoros',
                'iso3' => 'COM',
                'number_code' => '174',
                'phone_code' => '269'
            ],
            [
                'id' => '49',
                'iso' => 'CG',
                'name' => 'CONGO',
                'full_name' => 'Congo',
                'iso3' => 'COG',
                'number_code' => '178',
                'phone_code' => '242'
            ],
            [
                'id' => '50',
                'iso' => 'CD',
                'name' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
                'full_name' => 'Congo, the Democratic Republic of the',
                'iso3' => 'COD',
                'number_code' => '180',
                'phone_code' => '242'
            ],
            [
                'id' => '51',
                'iso' => 'CK',
                'name' => 'COOK ISLANDS',
                'full_name' => 'Cook Islands',
                'iso3' => 'COK',
                'number_code' => '184',
                'phone_code' => '682'
            ],
            [
                'id' => '52',
                'iso' => 'CR',
                'name' => 'COSTA RICA',
                'full_name' => 'Costa Rica',
                'iso3' => 'CRI',
                'number_code' => '188',
                'phone_code' => '506'
            ],
            [
                'id' => '53',
                'iso' => 'CI',
                'name' => 'COTE D\'IVOIRE',
                'full_name' => 'Cote D\'Ivoire',
                'iso3' => 'CIV',
                'number_code' => '384',
                'phone_code' => '225'
            ],
            [
                'id' => '54',
                'iso' => 'HR',
                'name' => 'CROATIA',
                'full_name' => 'Croatia',
                'iso3' => 'HRV',
                'number_code' => '191',
                'phone_code' => '385'
            ],
            [
                'id' => '55',
                'iso' => 'CU',
                'name' => 'CUBA',
                'full_name' => 'Cuba',
                'iso3' => 'CUB',
                'number_code' => '192',
                'phone_code' => '53'
            ],
            [
                'id' => '56',
                'iso' => 'CY',
                'name' => 'CYPRUS',
                'full_name' => 'Cyprus',
                'iso3' => 'CYP',
                'number_code' => '196',
                'phone_code' => '357'
            ],
            [
                'id' => '57',
                'iso' => 'CZ',
                'name' => 'CZECH REPUBLIC',
                'full_name' => 'Czech Republic',
                'iso3' => 'CZE',
                'number_code' => '203',
                'phone_code' => '420'
            ],
            [
                'id' => '58',
                'iso' => 'DK',
                'name' => 'DENMARK',
                'full_name' => 'Denmark',
                'iso3' => 'DNK',
                'number_code' => '208',
                'phone_code' => '45'
            ],
            [
                'id' => '59',
                'iso' => 'DJ',
                'name' => 'DJIBOUTI',
                'full_name' => 'Djibouti',
                'iso3' => 'DJI',
                'number_code' => '262',
                'phone_code' => '253'
            ],
            [
                'id' => '60',
                'iso' => 'DM',
                'name' => 'DOMINICA',
                'full_name' => 'Dominica',
                'iso3' => 'DMA',
                'number_code' => '212',
                'phone_code' => '1767'
            ],
            [
                'id' => '61',
                'iso' => 'DO',
                'name' => 'DOMINICAN REPUBLIC',
                'full_name' => 'Dominican Republic',
                'iso3' => 'DOM',
                'number_code' => '214',
                'phone_code' => '1809'
            ],
            [
                'id' => '62',
                'iso' => 'EC',
                'name' => 'ECUADOR',
                'full_name' => 'Ecuador',
                'iso3' => 'ECU',
                'number_code' => '218',
                'phone_code' => '593'
            ],
            [
                'id' => '63',
                'iso' => 'EG',
                'name' => 'EGYPT',
                'full_name' => 'Egypt',
                'iso3' => 'EGY',
                'number_code' => '818',
                'phone_code' => '20'
            ],
            [
                'id' => '64',
                'iso' => 'SV',
                'name' => 'EL SALVADOR',
                'full_name' => 'El Salvador',
                'iso3' => 'SLV',
                'number_code' => '222',
                'phone_code' => '503'
            ],
            [
                'id' => '65',
                'iso' => 'GQ',
                'name' => 'EQUATORIAL GUINEA',
                'full_name' => 'Equatorial Guinea',
                'iso3' => 'GNQ',
                'number_code' => '226',
                'phone_code' => '240'
            ],
            [
                'id' => '66',
                'iso' => 'ER',
                'name' => 'ERITREA',
                'full_name' => 'Eritrea',
                'iso3' => 'ERI',
                'number_code' => '232',
                'phone_code' => '291'
            ],
            [
                'id' => '67',
                'iso' => 'EE',
                'name' => 'ESTONIA',
                'full_name' => 'Estonia',
                'iso3' => 'EST',
                'number_code' => '233',
                'phone_code' => '372'
            ],
            [
                'id' => '68',
                'iso' => 'ET',
                'name' => 'ETHIOPIA',
                'full_name' => 'Ethiopia',
                'iso3' => 'ETH',
                'number_code' => '231',
                'phone_code' => '251'
            ],
            [
                'id' => '69',
                'iso' => 'FK',
                'name' => 'FALKLAND ISLANDS (MALVINAS)',
                'full_name' => 'Falkland Islands (Malvinas)',
                'iso3' => 'FLK',
                'number_code' => '238',
                'phone_code' => '500'
            ],
            [
                'id' => '70',
                'iso' => 'FO',
                'name' => 'FAROE ISLANDS',
                'full_name' => 'Faroe Islands',
                'iso3' => 'FRO',
                'number_code' => '234',
                'phone_code' => '298'
            ],
            [
                'id' => '71',
                'iso' => 'FJ',
                'name' => 'FIJI',
                'full_name' => 'Fiji',
                'iso3' => 'FJI',
                'number_code' => '242',
                'phone_code' => '679'
            ],
            [
                'id' => '72',
                'iso' => 'FI',
                'name' => 'FINLAND',
                'full_name' => 'Finland',
                'iso3' => 'FIN',
                'number_code' => '246',
                'phone_code' => '358'
            ],
            [
                'id' => '73',
                'iso' => 'FR',
                'name' => 'FRANCE',
                'full_name' => 'France',
                'iso3' => 'FRA',
                'number_code' => '250',
                'phone_code' => '33'
            ],
            [
                'id' => '74',
                'iso' => 'GF',
                'name' => 'FRENCH GUIANA',
                'full_name' => 'French Guiana',
                'iso3' => 'GUF',
                'number_code' => '254',
                'phone_code' => '594'
            ],
            [
                'id' => '75',
                'iso' => 'PF',
                'name' => 'FRENCH POLYNESIA',
                'full_name' => 'French Polynesia',
                'iso3' => 'PYF',
                'number_code' => '258',
                'phone_code' => '689'
            ],
            [
                'id' => '76',
                'iso' => 'TF',
                'name' => 'FRENCH SOUTHERN TERRITORIES',
                'full_name' => 'French Southern Territories',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '0'
            ],
            [
                'id' => '77',
                'iso' => 'GA',
                'name' => 'GABON',
                'full_name' => 'Gabon',
                'iso3' => 'GAB',
                'number_code' => '266',
                'phone_code' => '241'
            ],
            [
                'id' => '78',
                'iso' => 'GM',
                'name' => 'GAMBIA',
                'full_name' => 'Gambia',
                'iso3' => 'GMB',
                'number_code' => '270',
                'phone_code' => '220'
            ],
            [
                'id' => '79',
                'iso' => 'GE',
                'name' => 'GEORGIA',
                'full_name' => 'Georgia',
                'iso3' => 'GEO',
                'number_code' => '268',
                'phone_code' => '995'
            ],
            [
                'id' => '80',
                'iso' => 'DE',
                'name' => 'GERMANY',
                'full_name' => 'Germany',
                'iso3' => 'DEU',
                'number_code' => '276',
                'phone_code' => '49'
            ],
            [
                'id' => '81',
                'iso' => 'GH',
                'name' => 'GHANA',
                'full_name' => 'Ghana',
                'iso3' => 'GHA',
                'number_code' => '288',
                'phone_code' => '233'
            ],
            [
                'id' => '82',
                'iso' => 'GI',
                'name' => 'GIBRALTAR',
                'full_name' => 'Gibraltar',
                'iso3' => 'GIB',
                'number_code' => '292',
                'phone_code' => '350'
            ],
            [
                'id' => '83',
                'iso' => 'GR',
                'name' => 'GREECE',
                'full_name' => 'Greece',
                'iso3' => 'GRC',
                'number_code' => '300',
                'phone_code' => '30'
            ],
            [
                'id' => '84',
                'iso' => 'GL',
                'name' => 'GREENLAND',
                'full_name' => 'Greenland',
                'iso3' => 'GRL',
                'number_code' => '304',
                'phone_code' => '299'
            ],
            [
                'id' => '85',
                'iso' => 'GD',
                'name' => 'GRENADA',
                'full_name' => 'Grenada',
                'iso3' => 'GRD',
                'number_code' => '308',
                'phone_code' => '1473'
            ],
            [
                'id' => '86',
                'iso' => 'GP',
                'name' => 'GUADELOUPE',
                'full_name' => 'Guadeloupe',
                'iso3' => 'GLP',
                'number_code' => '312',
                'phone_code' => '590'
            ],
            [
                'id' => '87',
                'iso' => 'GU',
                'name' => 'GUAM',
                'full_name' => 'Guam',
                'iso3' => 'GUM',
                'number_code' => '316',
                'phone_code' => '1671'
            ],
            [
                'id' => '88',
                'iso' => 'GT',
                'name' => 'GUATEMALA',
                'full_name' => 'Guatemala',
                'iso3' => 'GTM',
                'number_code' => '320',
                'phone_code' => '502'
            ],
            [
                'id' => '89',
                'iso' => 'GN',
                'name' => 'GUINEA',
                'full_name' => 'Guinea',
                'iso3' => 'GIN',
                'number_code' => '324',
                'phone_code' => '224'
            ],
            [
                'id' => '90',
                'iso' => 'GW',
                'name' => 'GUINEA-BISSAU',
                'full_name' => 'Guinea-Bissau',
                'iso3' => 'GNB',
                'number_code' => '624',
                'phone_code' => '245'
            ],
            [
                'id' => '91',
                'iso' => 'GY',
                'name' => 'GUYANA',
                'full_name' => 'Guyana',
                'iso3' => 'GUY',
                'number_code' => '328',
                'phone_code' => '592'
            ],
            [
                'id' => '92',
                'iso' => 'HT',
                'name' => 'HAITI',
                'full_name' => 'Haiti',
                'iso3' => 'HTI',
                'number_code' => '332',
                'phone_code' => '509'
            ],
            [
                'id' => '93',
                'iso' => 'HM',
                'name' => 'HEARD ISLAND AND MCDONALD ISLANDS',
                'full_name' => 'Heard Island and Mcdonald Islands',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '0'
            ],
            [
                'id' => '94',
                'iso' => 'VA',
                'name' => 'HOLY SEE (VATICAN CITY STATE)',
                'full_name' => 'Holy See (Vatican City State)',
                'iso3' => 'VAT',
                'number_code' => '336',
                'phone_code' => '39'
            ],
            [
                'id' => '95',
                'iso' => 'HN',
                'name' => 'HONDURAS',
                'full_name' => 'Honduras',
                'iso3' => 'HND',
                'number_code' => '340',
                'phone_code' => '504'
            ],
            [
                'id' => '96',
                'iso' => 'HK',
                'name' => 'HONG KONG',
                'full_name' => 'Hong Kong',
                'iso3' => 'HKG',
                'number_code' => '344',
                'phone_code' => '852'
            ],
            [
                'id' => '97',
                'iso' => 'HU',
                'name' => 'HUNGARY',
                'full_name' => 'Hungary',
                'iso3' => 'HUN',
                'number_code' => '348',
                'phone_code' => '36'
            ],
            [
                'id' => '98',
                'iso' => 'IS',
                'name' => 'ICELAND',
                'full_name' => 'Iceland',
                'iso3' => 'ISL',
                'number_code' => '352',
                'phone_code' => '354'
            ],
            [
                'id' => '99',
                'iso' => 'IN',
                'name' => 'INDIA',
                'full_name' => 'India',
                'iso3' => 'IND',
                'number_code' => '356',
                'phone_code' => '91'
            ],
            [
                'id' => '100',
                'iso' => 'ID',
                'name' => 'INDONESIA',
                'full_name' => 'Indonesia',
                'iso3' => 'IDN',
                'number_code' => '360',
                'phone_code' => '62'
            ],
            [
                'id' => '101',
                'iso' => 'IR',
                'name' => 'IRAN, ISLAMIC REPUBLIC OF',
                'full_name' => 'Iran, Islamic Republic of',
                'iso3' => 'IRN',
                'number_code' => '364',
                'phone_code' => '98'
            ],
            [
                'id' => '102',
                'iso' => 'IQ',
                'name' => 'IRAQ',
                'full_name' => 'Iraq',
                'iso3' => 'IRQ',
                'number_code' => '368',
                'phone_code' => '964'
            ],
            [
                'id' => '103',
                'iso' => 'IE',
                'name' => 'IRELAND',
                'full_name' => 'Ireland',
                'iso3' => 'IRL',
                'number_code' => '372',
                'phone_code' => '353'
            ],
            [
                'id' => '104',
                'iso' => 'IL',
                'name' => 'ISRAEL',
                'full_name' => 'Israel',
                'iso3' => 'ISR',
                'number_code' => '376',
                'phone_code' => '972'
            ],
            [
                'id' => '105',
                'iso' => 'IT',
                'name' => 'ITALY',
                'full_name' => 'Italy',
                'iso3' => 'ITA',
                'number_code' => '380',
                'phone_code' => '39'
            ],
            [
                'id' => '106',
                'iso' => 'JM',
                'name' => 'JAMAICA',
                'full_name' => 'Jamaica',
                'iso3' => 'JAM',
                'number_code' => '388',
                'phone_code' => '1876'
            ],
            [
                'id' => '107',
                'iso' => 'JP',
                'name' => 'JAPAN',
                'full_name' => 'Japan',
                'iso3' => 'JPN',
                'number_code' => '392',
                'phone_code' => '81'
            ],
            [
                'id' => '108',
                'iso' => 'JO',
                'name' => 'JORDAN',
                'full_name' => 'Jordan',
                'iso3' => 'JOR',
                'number_code' => '400',
                'phone_code' => '962'
            ],
            [
                'id' => '109',
                'iso' => 'KZ',
                'name' => 'KAZAKHSTAN',
                'full_name' => 'Kazakhstan',
                'iso3' => 'KAZ',
                'number_code' => '398',
                'phone_code' => '7'
            ],
            [
                'id' => '110',
                'iso' => 'KE',
                'name' => 'KENYA',
                'full_name' => 'Kenya',
                'iso3' => 'KEN',
                'number_code' => '404',
                'phone_code' => '254'
            ],
            [
                'id' => '111',
                'iso' => 'KI',
                'name' => 'KIRIBATI',
                'full_name' => 'Kiribati',
                'iso3' => 'KIR',
                'number_code' => '296',
                'phone_code' => '686'
            ],
            [
                'id' => '112',
                'iso' => 'KP',
                'name' => 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF',
                'full_name' => 'Korea, Democratic People\'s Republic of',
                'iso3' => 'PRK',
                'number_code' => '408',
                'phone_code' => '850'
            ],

            [
                'id' => '114',
                'iso' => 'KW',
                'name' => 'KUWAIT',
                'full_name' => 'Kuwait',
                'iso3' => 'KWT',
                'number_code' => '414',
                'phone_code' => '965'
            ],
            [
                'id' => '115',
                'iso' => 'KG',
                'name' => 'KYRGYZSTAN',
                'full_name' => 'Kyrgyzstan',
                'iso3' => 'KGZ',
                'number_code' => '417',
                'phone_code' => '996'
            ],
            [
                'id' => '116',
                'iso' => 'LA',
                'name' => 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC',
                'full_name' => 'Lao People\'s Democratic Republic',
                'iso3' => 'LAO',
                'number_code' => '418',
                'phone_code' => '856'
            ],
            [
                'id' => '117',
                'iso' => 'LV',
                'name' => 'LATVIA',
                'full_name' => 'Latvia',
                'iso3' => 'LVA',
                'number_code' => '428',
                'phone_code' => '371'
            ],
            [
                'id' => '118',
                'iso' => 'LB',
                'name' => 'LEBANON',
                'full_name' => 'Lebanon',
                'iso3' => 'LBN',
                'number_code' => '422',
                'phone_code' => '961'
            ],
            [
                'id' => '119',
                'iso' => 'LS',
                'name' => 'LESOTHO',
                'full_name' => 'Lesotho',
                'iso3' => 'LSO',
                'number_code' => '426',
                'phone_code' => '266'
            ],
            [
                'id' => '120',
                'iso' => 'LR',
                'name' => 'LIBERIA',
                'full_name' => 'Liberia',
                'iso3' => 'LBR',
                'number_code' => '430',
                'phone_code' => '231'
            ],
            [
                'id' => '121',
                'iso' => 'LY',
                'name' => 'LIBYAN ARAB JAMAHIRIYA',
                'full_name' => 'Libyan Arab Jamahiriya',
                'iso3' => 'LBY',
                'number_code' => '434',
                'phone_code' => '218'
            ],
            [
                'id' => '122',
                'iso' => 'LI',
                'name' => 'LIECHTENSTEIN',
                'full_name' => 'Liechtenstein',
                'iso3' => 'LIE',
                'number_code' => '438',
                'phone_code' => '423'
            ],
            [
                'id' => '123',
                'iso' => 'LT',
                'name' => 'LITHUANIA',
                'full_name' => 'Lithuania',
                'iso3' => 'LTU',
                'number_code' => '440',
                'phone_code' => '370'
            ],
            [
                'id' => '124',
                'iso' => 'LU',
                'name' => 'LUXEMBOURG',
                'full_name' => 'Luxembourg',
                'iso3' => 'LUX',
                'number_code' => '442',
                'phone_code' => '352'
            ],
            [
                'id' => '125',
                'iso' => 'MO',
                'name' => 'MACAO',
                'full_name' => 'Macao',
                'iso3' => 'MAC',
                'number_code' => '446',
                'phone_code' => '853'
            ],
            [
                'id' => '126',
                'iso' => 'MK',
                'name' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
                'full_name' => 'Macedonia, the Former Yugoslav Republic of',
                'iso3' => 'MKD',
                'number_code' => '807',
                'phone_code' => '389'
            ],
            [
                'id' => '127',
                'iso' => 'MG',
                'name' => 'MADAGASCAR',
                'full_name' => 'Madagascar',
                'iso3' => 'MDG',
                'number_code' => '450',
                'phone_code' => '261'
            ],
            [
                'id' => '128',
                'iso' => 'MW',
                'name' => 'MALAWI',
                'full_name' => 'Malawi',
                'iso3' => 'MWI',
                'number_code' => '454',
                'phone_code' => '265'
            ],
            [
                'id' => '129',
                'iso' => 'MY',
                'name' => 'MALAYSIA',
                'full_name' => 'Malaysia',
                'iso3' => 'MYS',
                'number_code' => '458',
                'phone_code' => '60'
            ],
            [
                'id' => '130',
                'iso' => 'MV',
                'name' => 'MALDIVES',
                'full_name' => 'Maldives',
                'iso3' => 'MDV',
                'number_code' => '462',
                'phone_code' => '960'
            ],
            [
                'id' => '131',
                'iso' => 'ML',
                'name' => 'MALI',
                'full_name' => 'Mali',
                'iso3' => 'MLI',
                'number_code' => '466',
                'phone_code' => '223'
            ],
            [
                'id' => '132',
                'iso' => 'MT',
                'name' => 'MALTA',
                'full_name' => 'Malta',
                'iso3' => 'MLT',
                'number_code' => '470',
                'phone_code' => '356'
            ],
            [
                'id' => '133',
                'iso' => 'MH',
                'name' => 'MARSHALL ISLANDS',
                'full_name' => 'Marshall Islands',
                'iso3' => 'MHL',
                'number_code' => '584',
                'phone_code' => '692'
            ],
            [
                'id' => '134',
                'iso' => 'MQ',
                'name' => 'MARTINIQUE',
                'full_name' => 'Martinique',
                'iso3' => 'MTQ',
                'number_code' => '474',
                'phone_code' => '596'
            ],
            [
                'id' => '135',
                'iso' => 'MR',
                'name' => 'MAURITANIA',
                'full_name' => 'Mauritania',
                'iso3' => 'MRT',
                'number_code' => '478',
                'phone_code' => '222'
            ],
            [
                'id' => '136',
                'iso' => 'MU',
                'name' => 'MAURITIUS',
                'full_name' => 'Mauritius',
                'iso3' => 'MUS',
                'number_code' => '480',
                'phone_code' => '230'
            ],
            [
                'id' => '137',
                'iso' => 'YT',
                'name' => 'MAYOTTE',
                'full_name' => 'Mayotte',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '269'
            ],
            [
                'id' => '138',
                'iso' => 'MX',
                'name' => 'MEXICO',
                'full_name' => 'Mexico',
                'iso3' => 'MEX',
                'number_code' => '484',
                'phone_code' => '52'
            ],
            [
                'id' => '139',
                'iso' => 'FM',
                'name' => 'MICRONESIA, FEDERATED STATES OF',
                'full_name' => 'Micronesia, Federated States of',
                'iso3' => 'FSM',
                'number_code' => '583',
                'phone_code' => '691'
            ],
            [
                'id' => '140',
                'iso' => 'MD',
                'name' => 'MOLDOVA, REPUBLIC OF',
                'full_name' => 'Moldova, Republic of',
                'iso3' => 'MDA',
                'number_code' => '498',
                'phone_code' => '373'
            ],
            [
                'id' => '141',
                'iso' => 'MC',
                'name' => 'MONACO',
                'full_name' => 'Monaco',
                'iso3' => 'MCO',
                'number_code' => '492',
                'phone_code' => '377'
            ],
            [
                'id' => '142',
                'iso' => 'MN',
                'name' => 'MONGOLIA',
                'full_name' => 'Mongolia',
                'iso3' => 'MNG',
                'number_code' => '496',
                'phone_code' => '976'
            ],
            [
                'id' => '143',
                'iso' => 'MS',
                'name' => 'MONTSERRAT',
                'full_name' => 'Montserrat',
                'iso3' => 'MSR',
                'number_code' => '500',
                'phone_code' => '1664'
            ],
            [
                'id' => '144',
                'iso' => 'MA',
                'name' => 'MOROCCO',
                'full_name' => 'Morocco',
                'iso3' => 'MAR',
                'number_code' => '504',
                'phone_code' => '212'
            ],
            [
                'id' => '145',
                'iso' => 'MZ',
                'name' => 'MOZAMBIQUE',
                'full_name' => 'Mozambique',
                'iso3' => 'MOZ',
                'number_code' => '508',
                'phone_code' => '258'
            ],
            [
                'id' => '146',
                'iso' => 'MM',
                'name' => 'MYANMAR',
                'full_name' => 'Myanmar',
                'iso3' => 'MMR',
                'number_code' => '104',
                'phone_code' => '95'
            ],
            [
                'id' => '147',
                'iso' => 'NA',
                'name' => 'NAMIBIA',
                'full_name' => 'Namibia',
                'iso3' => 'NAM',
                'number_code' => '516',
                'phone_code' => '264'
            ],
            [
                'id' => '148',
                'iso' => 'NR',
                'name' => 'NAURU',
                'full_name' => 'Nauru',
                'iso3' => 'NRU',
                'number_code' => '520',
                'phone_code' => '674'
            ],
            [
                'id' => '149',
                'iso' => 'NP',
                'name' => 'NEPAL',
                'full_name' => 'Nepal',
                'iso3' => 'NPL',
                'number_code' => '524',
                'phone_code' => '977'
            ],
            [
                'id' => '150',
                'iso' => 'NL',
                'name' => 'NETHERLANDS',
                'full_name' => 'Netherlands',
                'iso3' => 'NLD',
                'number_code' => '528',
                'phone_code' => '31'
            ],
            [
                'id' => '151',
                'iso' => 'AN',
                'name' => 'NETHERLANDS ANTILLES',
                'full_name' => 'Netherlands Antilles',
                'iso3' => 'ANT',
                'number_code' => '530',
                'phone_code' => '599'
            ],
            [
                'id' => '152',
                'iso' => 'NC',
                'name' => 'NEW CALEDONIA',
                'full_name' => 'New Caledonia',
                'iso3' => 'NCL',
                'number_code' => '540',
                'phone_code' => '687'
            ],
            [
                'id' => '153',
                'iso' => 'NZ',
                'name' => 'NEW ZEALAND',
                'full_name' => 'New Zealand',
                'iso3' => 'NZL',
                'number_code' => '554',
                'phone_code' => '64'
            ],
            [
                'id' => '154',
                'iso' => 'NI',
                'name' => 'NICARAGUA',
                'full_name' => 'Nicaragua',
                'iso3' => 'NIC',
                'number_code' => '558',
                'phone_code' => '505'
            ],
            [
                'id' => '155',
                'iso' => 'NE',
                'name' => 'NIGER',
                'full_name' => 'Niger',
                'iso3' => 'NER',
                'number_code' => '562',
                'phone_code' => '227'
            ],
            [
                'id' => '156',
                'iso' => 'NG',
                'name' => 'NIGERIA',
                'full_name' => 'Nigeria',
                'iso3' => 'NGA',
                'number_code' => '566',
                'phone_code' => '234'
            ],
            [
                'id' => '157',
                'iso' => 'NU',
                'name' => 'NIUE',
                'full_name' => 'Niue',
                'iso3' => 'NIU',
                'number_code' => '570',
                'phone_code' => '683'
            ],
            [
                'id' => '158',
                'iso' => 'NF',
                'name' => 'NORFOLK ISLAND',
                'full_name' => 'Norfolk Island',
                'iso3' => 'NFK',
                'number_code' => '574',
                'phone_code' => '672'
            ],
            [
                'id' => '159',
                'iso' => 'MP',
                'name' => 'NORTHERN MARIANA ISLANDS',
                'full_name' => 'Northern Mariana Islands',
                'iso3' => 'MNP',
                'number_code' => '580',
                'phone_code' => '1670'
            ],
            [
                'id' => '160',
                'iso' => 'NO',
                'name' => 'NORWAY',
                'full_name' => 'Norway',
                'iso3' => 'NOR',
                'number_code' => '578',
                'phone_code' => '47'
            ],
            [
                'id' => '161',
                'iso' => 'OM',
                'name' => 'OMAN',
                'full_name' => 'Oman',
                'iso3' => 'OMN',
                'number_code' => '512',
                'phone_code' => '968'
            ],
            [
                'id' => '162',
                'iso' => 'PK',
                'name' => 'PAKISTAN',
                'full_name' => 'Pakistan',
                'iso3' => 'PAK',
                'number_code' => '586',
                'phone_code' => '92'
            ],
            [
                'id' => '163',
                'iso' => 'PW',
                'name' => 'PALAU',
                'full_name' => 'Palau',
                'iso3' => 'PLW',
                'number_code' => '585',
                'phone_code' => '680'
            ],
            [
                'id' => '164',
                'iso' => 'PS',
                'name' => 'PALESTINIAN TERRITORY, OCCUPIED',
                'full_name' => 'Palestinian Territory, Occupied',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '970'
            ],
            [
                'id' => '165',
                'iso' => 'PA',
                'name' => 'PANAMA',
                'full_name' => 'Panama',
                'iso3' => 'PAN',
                'number_code' => '591',
                'phone_code' => '507'
            ],
            [
                'id' => '166',
                'iso' => 'PG',
                'name' => 'PAPUA NEW GUINEA',
                'full_name' => 'Papua New Guinea',
                'iso3' => 'PNG',
                'number_code' => '598',
                'phone_code' => '675'
            ],
            [
                'id' => '167',
                'iso' => 'PY',
                'name' => 'PARAGUAY',
                'full_name' => 'Paraguay',
                'iso3' => 'PRY',
                'number_code' => '600',
                'phone_code' => '595'
            ],
            [
                'id' => '168',
                'iso' => 'PE',
                'name' => 'PERU',
                'full_name' => 'Peru',
                'iso3' => 'PER',
                'number_code' => '604',
                'phone_code' => '51'
            ],
            [
                'id' => '169',
                'iso' => 'PH',
                'name' => 'PHILIPPINES',
                'full_name' => 'Philippines',
                'iso3' => 'PHL',
                'number_code' => '608',
                'phone_code' => '63'
            ],
            [
                'id' => '170',
                'iso' => 'PN',
                'name' => 'PITCAIRN',
                'full_name' => 'Pitcairn',
                'iso3' => 'PCN',
                'number_code' => '612',
                'phone_code' => '0'
            ],
            [
                'id' => '171',
                'iso' => 'PL',
                'name' => 'POLAND',
                'full_name' => 'Poland',
                'iso3' => 'POL',
                'number_code' => '616',
                'phone_code' => '48'
            ],
            [
                'id' => '172',
                'iso' => 'PT',
                'name' => 'PORTUGAL',
                'full_name' => 'Portugal',
                'iso3' => 'PRT',
                'number_code' => '620',
                'phone_code' => '351'
            ],
            [
                'id' => '173',
                'iso' => 'PR',
                'name' => 'PUERTO RICO',
                'full_name' => 'Puerto Rico',
                'iso3' => 'PRI',
                'number_code' => '630',
                'phone_code' => '1787'
            ],
            [
                'id' => '174',
                'iso' => 'QA',
                'name' => 'QATAR',
                'full_name' => 'Qatar',
                'iso3' => 'QAT',
                'number_code' => '634',
                'phone_code' => '974'
            ],
            [
                'id' => '175',
                'iso' => 'RE',
                'name' => 'REUNION',
                'full_name' => 'Reunion',
                'iso3' => 'REU',
                'number_code' => '638',
                'phone_code' => '262'
            ],
            [
                'id' => '176',
                'iso' => 'RO',
                'name' => 'ROMANIA',
                'full_name' => 'Romania',
                'iso3' => 'ROM',
                'number_code' => '642',
                'phone_code' => '40'
            ],
            [
                'id' => '177',
                'iso' => 'RU',
                'name' => 'RUSSIAN FEDERATION',
                'full_name' => 'Russian Federation',
                'iso3' => 'RUS',
                'number_code' => '643',
                'phone_code' => '70'
            ],
            [
                'id' => '178',
                'iso' => 'RW',
                'name' => 'RWANDA',
                'full_name' => 'Rwanda',
                'iso3' => 'RWA',
                'number_code' => '646',
                'phone_code' => '250'
            ],
            [
                'id' => '179',
                'iso' => 'SH',
                'name' => 'SAINT HELENA',
                'full_name' => 'Saint Helena',
                'iso3' => 'SHN',
                'number_code' => '654',
                'phone_code' => '290'
            ],
            [
                'id' => '180',
                'iso' => 'KN',
                'name' => 'SAINT KITTS AND NEVIS',
                'full_name' => 'Saint Kitts and Nevis',
                'iso3' => 'KNA',
                'number_code' => '659',
                'phone_code' => '1869'
            ],
            [
                'id' => '181',
                'iso' => 'LC',
                'name' => 'SAINT LUCIA',
                'full_name' => 'Saint Lucia',
                'iso3' => 'LCA',
                'number_code' => '662',
                'phone_code' => '1758'
            ],
            [
                'id' => '182',
                'iso' => 'PM',
                'name' => 'SAINT PIERRE AND MIQUELON',
                'full_name' => 'Saint Pierre and Miquelon',
                'iso3' => 'SPM',
                'number_code' => '666',
                'phone_code' => '508'
            ],
            [
                'id' => '183',
                'iso' => 'VC',
                'name' => 'SAINT VINCENT AND THE GRENADINES',
                'full_name' => 'Saint Vincent and the Grenadines',
                'iso3' => 'VCT',
                'number_code' => '670',
                'phone_code' => '1784'
            ],
            [
                'id' => '184',
                'iso' => 'WS',
                'name' => 'SAMOA',
                'full_name' => 'Samoa',
                'iso3' => 'WSM',
                'number_code' => '882',
                'phone_code' => '684'
            ],
            [
                'id' => '185',
                'iso' => 'SM',
                'name' => 'SAN MARINO',
                'full_name' => 'San Marino',
                'iso3' => 'SMR',
                'number_code' => '674',
                'phone_code' => '378'
            ],
            [
                'id' => '186',
                'iso' => 'ST',
                'name' => 'SAO TOME AND PRINCIPE',
                'full_name' => 'Sao Tome and Principe',
                'iso3' => 'STP',
                'number_code' => '678',
                'phone_code' => '239'
            ],
            [
                'id' => '187',
                'iso' => 'SA',
                'name' => 'SAUDI ARABIA',
                'full_name' => 'Saudi Arabia',
                'iso3' => 'SAU',
                'number_code' => '682',
                'phone_code' => '966'
            ],
            [
                'id' => '188',
                'iso' => 'SN',
                'name' => 'SENEGAL',
                'full_name' => 'Senegal',
                'iso3' => 'SEN',
                'number_code' => '686',
                'phone_code' => '221'
            ],
            [
                'id' => '189',
                'iso' => 'CS',
                'name' => 'SERBIA AND MONTENEGRO',
                'full_name' => 'Serbia and Montenegro',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '381'
            ],
            [
                'id' => '190',
                'iso' => 'SC',
                'name' => 'SEYCHELLES',
                'full_name' => 'Seychelles',
                'iso3' => 'SYC',
                'number_code' => '690',
                'phone_code' => '248'
            ],
            [
                'id' => '191',
                'iso' => 'SL',
                'name' => 'SIERRA LEONE',
                'full_name' => 'Sierra Leone',
                'iso3' => 'SLE',
                'number_code' => '694',
                'phone_code' => '232'
            ],

            [
                'id' => '193',
                'iso' => 'SK',
                'name' => 'SLOVAKIA',
                'full_name' => 'Slovakia',
                'iso3' => 'SVK',
                'number_code' => '703',
                'phone_code' => '421'
            ],
            [
                'id' => '194',
                'iso' => 'SI',
                'name' => 'SLOVENIA',
                'full_name' => 'Slovenia',
                'iso3' => 'SVN',
                'number_code' => '705',
                'phone_code' => '386'
            ],
            [
                'id' => '195',
                'iso' => 'SB',
                'name' => 'SOLOMON ISLANDS',
                'full_name' => 'Solomon Islands',
                'iso3' => 'SLB',
                'number_code' => '90',
                'phone_code' => '677'
            ],
            [
                'id' => '196',
                'iso' => 'SO',
                'name' => 'SOMALIA',
                'full_name' => 'Somalia',
                'iso3' => 'SOM',
                'number_code' => '706',
                'phone_code' => '252'
            ],
            [
                'id' => '197',
                'iso' => 'ZA',
                'name' => 'SOUTH AFRICA',
                'full_name' => 'South Africa',
                'iso3' => 'ZAF',
                'number_code' => '710',
                'phone_code' => '27'
            ],
            [
                'id' => '198',
                'iso' => 'GS',
                'name' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
                'full_name' => 'South Georgia and the South Sandwich Islands',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '0'
            ],
            [
                'id' => '199',
                'iso' => 'ES',
                'name' => 'SPAIN',
                'full_name' => 'Spain',
                'iso3' => 'ESP',
                'number_code' => '724',
                'phone_code' => '34'
            ],
            [
                'id' => '200',
                'iso' => 'LK',
                'name' => 'SRI LANKA',
                'full_name' => 'Sri Lanka',
                'iso3' => 'LKA',
                'number_code' => '144',
                'phone_code' => '94'
            ],
            [
                'id' => '201',
                'iso' => 'SD',
                'name' => 'SUDAN',
                'full_name' => 'Sudan',
                'iso3' => 'SDN',
                'number_code' => '736',
                'phone_code' => '249'
            ],
            [
                'id' => '202',
                'iso' => 'SR',
                'name' => 'SURINAME',
                'full_name' => 'Suriname',
                'iso3' => 'SUR',
                'number_code' => '740',
                'phone_code' => '597'
            ],
            [
                'id' => '203',
                'iso' => 'SJ',
                'name' => 'SVALBARD AND JAN MAYEN',
                'full_name' => 'Svalbard and Jan Mayen',
                'iso3' => 'SJM',
                'number_code' => '744',
                'phone_code' => '47'
            ],
            [
                'id' => '204',
                'iso' => 'SZ',
                'name' => 'SWAZILAND',
                'full_name' => 'Swaziland',
                'iso3' => 'SWZ',
                'number_code' => '748',
                'phone_code' => '268'
            ],
            [
                'id' => '205',
                'iso' => 'SE',
                'name' => 'SWEDEN',
                'full_name' => 'Sweden',
                'iso3' => 'SWE',
                'number_code' => '752',
                'phone_code' => '46'
            ],
            [
                'id' => '206',
                'iso' => 'CH',
                'name' => 'SWITZERLAND',
                'full_name' => 'Switzerland',
                'iso3' => 'CHE',
                'number_code' => '756',
                'phone_code' => '41'
            ],
            [
                'id' => '207',
                'iso' => 'SY',
                'name' => 'SYRIAN ARAB REPUBLIC',
                'full_name' => 'Syrian Arab Republic',
                'iso3' => 'SYR',
                'number_code' => '760',
                'phone_code' => '963'
            ],
            [
                'id' => '208',
                'iso' => 'TW',
                'name' => 'TAIWAN, PROVINCE OF CHINA',
                'full_name' => 'Taiwan, Province of China',
                'iso3' => 'TWN',
                'number_code' => '158',
                'phone_code' => '886'
            ],
            [
                'id' => '209',
                'iso' => 'TJ',
                'name' => 'TAJIKISTAN',
                'full_name' => 'Tajikistan',
                'iso3' => 'TJK',
                'number_code' => '762',
                'phone_code' => '992'
            ],
            [
                'id' => '210',
                'iso' => 'TZ',
                'name' => 'TANZANIA, UNITED REPUBLIC OF',
                'full_name' => 'Tanzania, United Republic of',
                'iso3' => 'TZA',
                'number_code' => '834',
                'phone_code' => '255'
            ],
            [
                'id' => '211',
                'iso' => 'TH',
                'name' => 'THAILAND',
                'full_name' => 'Thailand',
                'iso3' => 'THA',
                'number_code' => '764',
                'phone_code' => '66'
            ],
            [
                'id' => '212',
                'iso' => 'TL',
                'name' => 'TIMOR-LESTE',
                'full_name' => 'Timor-Leste',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '670'
            ],
            [
                'id' => '213',
                'iso' => 'TG',
                'name' => 'TOGO',
                'full_name' => 'Togo',
                'iso3' => 'TGO',
                'number_code' => '768',
                'phone_code' => '228'
            ],
            [
                'id' => '214',
                'iso' => 'TK',
                'name' => 'TOKELAU',
                'full_name' => 'Tokelau',
                'iso3' => 'TKL',
                'number_code' => '772',
                'phone_code' => '690'
            ],
            [
                'id' => '215',
                'iso' => 'TO',
                'name' => 'TONGA',
                'full_name' => 'Tonga',
                'iso3' => 'TON',
                'number_code' => '776',
                'phone_code' => '676'
            ],
            [
                'id' => '216',
                'iso' => 'TT',
                'name' => 'TRINIDAD AND TOBAGO',
                'full_name' => 'Trinidad and Tobago',
                'iso3' => 'TTO',
                'number_code' => '780',
                'phone_code' => '1868'
            ],
            [
                'id' => '217',
                'iso' => 'TN',
                'name' => 'TUNISIA',
                'full_name' => 'Tunisia',
                'iso3' => 'TUN',
                'number_code' => '788',
                'phone_code' => '216'
            ],
            [
                'id' => '218',
                'iso' => 'TR',
                'name' => 'TURKEY',
                'full_name' => 'Turkey',
                'iso3' => 'TUR',
                'number_code' => '792',
                'phone_code' => '90'
            ],
            [
                'id' => '219',
                'iso' => 'TM',
                'name' => 'TURKMENISTAN',
                'full_name' => 'Turkmenistan',
                'iso3' => 'TKM',
                'number_code' => '795',
                'phone_code' => '7370'
            ],
            [
                'id' => '220',
                'iso' => 'TC',
                'name' => 'TURKS AND CAICOS ISLANDS',
                'full_name' => 'Turks and Caicos Islands',
                'iso3' => 'TCA',
                'number_code' => '796',
                'phone_code' => '1649'
            ],
            [
                'id' => '221',
                'iso' => 'TV',
                'name' => 'TUVALU',
                'full_name' => 'Tuvalu',
                'iso3' => 'TUV',
                'number_code' => '798',
                'phone_code' => '688'
            ],
            [
                'id' => '222',
                'iso' => 'UG',
                'name' => 'UGANDA',
                'full_name' => 'Uganda',
                'iso3' => 'UGA',
                'number_code' => '800',
                'phone_code' => '256'
            ],
            [
                'id' => '223',
                'iso' => 'UA',
                'name' => 'UKRAINE',
                'full_name' => 'Ukraine',
                'iso3' => 'UKR',
                'number_code' => '804',
                'phone_code' => '380'
            ],
            [
                'id' => '224',
                'iso' => 'AE',
                'name' => 'UNITED ARAB EMIRATES',
                'full_name' => 'United Arab Emirates',
                'iso3' => 'ARE',
                'number_code' => '784',
                'phone_code' => '971'
            ],
            [
                'id' => '225',
                'iso' => 'GB',
                'name' => 'UNITED KINGDOM',
                'full_name' => 'United Kingdom',
                'iso3' => 'GBR',
                'number_code' => '826',
                'phone_code' => '44'
            ],
            /*
             [
                'id' => '44',
                'iso' => 'CN',
                'name' => 'CHINA',
                'full_name' => 'China',
                'iso3' => 'CHN',
                'number_code' => '156',
                'phone_code' => '86'
            ],
            [
                'id' => '226',
                'iso' => 'US',
                'name' => 'UNITED STATES',
                'full_name' => 'United States',
                'iso3' => 'USA',
                'number_code' => '840',
                'phone_code' => '1'
            ],
            [
                'id' => '113',
                'iso' => 'KR',
                'name' => 'KOREA, REPUBLIC OF',
                'full_name' => 'Korea, Republic of',
                'iso3' => 'KOR',
                'number_code' => '410',
                'phone_code' => '82'
            ],

            [
                'id' => '192',
                'iso' => 'SG',
                'name' => 'SINGAPORE',
                'full_name' => 'Singapore',
                'iso3' => 'SGP',
                'number_code' => '702',
                'phone_code' => '65'
            ],


            */
            [
                'id' => '227',
                'iso' => 'UM',
                'name' => 'UNITED STATES MINOR OUTLYING ISLANDS',
                'full_name' => 'United States Minor Outlying Islands',
                'iso3' => '',
                'number_code' => '',
                'phone_code' => '1'
            ],
            [
                'id' => '228',
                'iso' => 'UY',
                'name' => 'URUGUAY',
                'full_name' => 'Uruguay',
                'iso3' => 'URY',
                'number_code' => '858',
                'phone_code' => '598'
            ],
            [
                'id' => '229',
                'iso' => 'UZ',
                'name' => 'UZBEKISTAN',
                'full_name' => 'Uzbekistan',
                'iso3' => 'UZB',
                'number_code' => '860',
                'phone_code' => '998'
            ],
            [
                'id' => '230',
                'iso' => 'VU',
                'name' => 'VANUATU',
                'full_name' => 'Vanuatu',
                'iso3' => 'VUT',
                'number_code' => '548',
                'phone_code' => '678'
            ],
            [
                'id' => '231',
                'iso' => 'VE',
                'name' => 'VENEZUELA',
                'full_name' => 'Venezuela',
                'iso3' => 'VEN',
                'number_code' => '862',
                'phone_code' => '58'
            ],
            [
                'id' => '232',
                'iso' => 'VN',
                'name' => 'VIET NAM',
                'full_name' => 'Viet Nam',
                'iso3' => 'VNM',
                'number_code' => '704',
                'phone_code' => '84'
            ],
            [
                'id' => '233',
                'iso' => 'VG',
                'name' => 'VIRGIN ISLANDS, BRITISH',
                'full_name' => 'Virgin Islands, British',
                'iso3' => 'VGB',
                'number_code' => '92',
                'phone_code' => '1284'
            ],
            [
                'id' => '234',
                'iso' => 'VI',
                'name' => 'VIRGIN ISLANDS, U.S.',
                'full_name' => 'Virgin Islands, U.s.',
                'iso3' => 'VIR',
                'number_code' => '850',
                'phone_code' => '1340'
            ],
            [
                'id' => '235',
                'iso' => 'WF',
                'name' => 'WALLIS AND FUTUNA',
                'full_name' => 'Wallis and Futuna',
                'iso3' => 'WLF',
                'number_code' => '876',
                'phone_code' => '681'
            ],
            [
                'id' => '236',
                'iso' => 'EH',
                'name' => 'WESTERN SAHARA',
                'full_name' => 'Western Sahara',
                'iso3' => 'ESH',
                'number_code' => '732',
                'phone_code' => '212'
            ],
            [
                'id' => '237',
                'iso' => 'YE',
                'name' => 'YEMEN',
                'full_name' => 'Yemen',
                'iso3' => 'YEM',
                'number_code' => '887',
                'phone_code' => '967'
            ],
            [
                'id' => '238',
                'iso' => 'ZM',
                'name' => 'ZAMBIA',
                'full_name' => 'Zambia',
                'iso3' => 'ZMB',
                'number_code' => '894',
                'phone_code' => '260'
            ],
            [
                'id' => '239',
                'iso' => 'ZW',
                'name' => 'ZIMBABWE',
                'full_name' => 'Zimbabwe',
                'iso3' => 'ZWE',
                'number_code' => '716',
                'phone_code' => '263'
            ],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
