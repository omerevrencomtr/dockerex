<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Language\Language;
use App\Models\Country\Country;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'password'=>  Hash::make($faker->password),
                'email' => $faker->unique()->email,

                'email_confirmed' => (bool)rand(0,1),
                'email_login_active' => (bool)rand(0,1),

                'phone' => str_replace('+','',$faker->unique()->e164PhoneNumber),
                'phone_confirmed' => (bool)rand(0,1),
                'phone_login_active' => (bool)rand(0,1),

                'google2fa_secret' => null,
                'google2fa_login_active' => false,

                'login_default_type' => $faker->randomElement(['email', 'phone','google2fa']),

                'confirmed_level' => $faker->randomElement(['starter', 'approved','special','custom']),

                'confirmed' => (bool)rand(0,1),

                'admin' => false,
                'admin_level' => null,

                'language_code' => $faker->randomElement(Language::pluck('iso')->toArray()),
                'country_code' => $faker->randomElement(Country::pluck('iso')->toArray()),
                'active' => (bool)rand(0,1),



            ]);
        }
    }
}
