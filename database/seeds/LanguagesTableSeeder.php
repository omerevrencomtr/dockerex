<?php

use Illuminate\Database\Seeder;
use App\Models\Language\Language;
use Carbon\Carbon;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $languages = [
            [
                'name' => 'Türkçe',
                'iso' => 'tr',
                'active' => true,
            ],
            [
                'name' => 'English',
                'iso' => 'en',
                'active' => true,
            ],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
