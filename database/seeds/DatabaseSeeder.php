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
        factory(mundifood\User::class)->create(['email'=>'admin@admin.com', 'type'=>'admin']);
        factory(mundifood\User::class, 10)->create();
    }
}
