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
        $this->call('VendorsTableSeeder');
        $this->call('ProductsTableSeeder');

        $this->call('PartnersTableSeeder');
        $this->call('OrdersTableSeeder');
        $this->call('OrdersProductsTableSeeder');
    }
}
