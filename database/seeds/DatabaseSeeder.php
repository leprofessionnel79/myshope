<?php

use App\Address;
use App\Image;
use App\Product;
use App\User;
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
        // $this->call(UsersTableSeeder::class);
        factory(User::class,70)->create();
        factory(Address::class,170)->create();
        factory(Product::class,500)->create();
        factory(Image::class,2500)->create();
    }
}
