<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,20)->create()->each(function($u) {
            $u->books()->save(factory('App\Book')->make());
        });
    }
}
