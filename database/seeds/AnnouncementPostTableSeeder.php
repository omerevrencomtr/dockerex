<?php

use Illuminate\Database\Seeder;
use App\Models\Announcement\AnnouncementPost;
use App\Models\Announcement\AnnouncementCategory;
use Carbon\Carbon;

class AnnouncementPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $posts = [
            [
                'announcement_category_id' => $faker->randomElement(AnnouncementCategory::pluck('id')->toArray()),
                'title' => 'Genel',
                'slug' => 'genel kategorisi',
                'meta_key' => ' meta açıklama',
                'meta_description' => 'fa fa-bullhorn',
                'content' => 'test',
                'active' => true,
            ],
            [
                'announcement_category_id' => $faker->randomElement(AnnouncementCategory::pluck('id')->toArray()),
                'title' => 'Test1',
                'slug' => 'Test1',
                'meta_key' => 'Test1',
                'meta_description' => 'Test1',
                'content' => 'test',
                'active' => true,
            ],
            [
                'announcement_category_id' => $faker->randomElement(AnnouncementCategory::pluck('id')->toArray()),
                'title' => 'Title post',
                'slug' => 'Slug Post',
                'meta_key' => 'Meta Key',
                'meta_description' => 'Meta Desc',
                'content' => 'içerik ',
                'active' => true,
            ],
        ];

        foreach ($posts as $post) {
            AnnouncementPost::create($post);
        }
    }
}
