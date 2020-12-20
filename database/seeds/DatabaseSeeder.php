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
        // factory(App\Models\Admin\Logs\Changelog::class, 1)->create();
        factory(\App\Models\Auth\User::class, 1000)->create();
    }
}
