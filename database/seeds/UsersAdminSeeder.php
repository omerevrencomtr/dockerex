<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Ömer',
            'surname' => 'EVREN',
            'password'=>  Hash::make('asdasd'),
            'email' => 'omerevren06@gmail.com',

            'email_confirmed' => true,
            'email_login_active' => true,

            'phone' => 905303771357,
            'phone_confirmed' => true,
            'phone_login_active' => true,

            'google2fa_secret' => null,
            'google2fa_login_active' => false,

            'login_default_type' => 'phone',

            'confirmed_level' => 'special',

            'confirmed' => true,

            'admin' => true,
            'admin_level' => 'founder',

            'language_code' => 'tr',
            'country_code' => 'tr',
            'active' => true,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
