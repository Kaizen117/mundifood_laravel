<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(['email'=>'admin@admin.com', 'type'=>'admin']);
        factory(App\User::class, 10)->create();
    }
}
