<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LanguagesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UsersAdminSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(ExchangesTableSeeder::class);
        $this->call(ExchangeOrdersTableSeeder::class);
        $this->call(ExchangeOrderCompletedsTableSeeder::class);
        $this->call(CurrencyTransferCommissionsTableSeeder::class);
        $this->call(CurrencyTransferAddressesTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(ExchangeCommissionsTableSeeder::class);

        //$this->call(AnnouncementCategoriesTableSeeder::class);
        //$this->call(AnnouncementPostTableSeeder::class);
        /*

        $this->call(UserAnnouncementsTableSeeder::class);




        $this->call(BlogCategoriesTableSeeder::class);
        $this->call(BlogPostsTableSeeder::class);

        $this->call(SupportCategoriesTableSeeder::class);
        $this->call(SupportPostTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(TicketPostsTableSeeder::class);


        $this->call(UserCurrencyTransferOrdersTableSeeder::class);
        $this->call(UserCurrencyTransferOrderCompletedsTableSeeder::class);
        $this->call(ContactFormsTableSeeder::class);
        $this->call(SystemSettingsTableSeeder::class);
        */

    }
}
