<?php

use Illuminate\Database\Seeder;
use App\Models\Announcement\AnnouncementCategory;
use Carbon\Carbon;

class AnnouncementCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Genel',
                'slug' => 'genel',
                'meta_key' => 'genel kategorisi',
                'meta_description' => 'koinbo meta açıklama',
                'icon' => 'fa fa-bullhorn',
                'active' => true,
            ],
            [
                'title' => 'Güvenlik',
                'slug' => 'Güvenlik',
                'meta_key' => 'Güvenlik',
                'meta_description' => 'Güvenlik',
                'icon' => 'fa fa-lock',
                'active' => true,
            ],
            [
                'title' => 'Para Yatırma Çekme',
                'slug' => 'Para Yatırma Çekme',
                'meta_key' => 'Para Yatırma Çekme',
                'meta_description' => 'Para Yatırma Çekme',
                'icon' => 'fa fa-money',
                'active' => true,
            ],
        ];

        foreach ($categories as $category) {
            AnnouncementCategory::create($category);
        }
    }
}
