<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Plan::truncate();

        \App\Plan::insert([
            [
                'name' => 'ücretli', 'type' => \App\Plan::MONETARY, 'is_default' => 1
            ], [
                'name' => 'ücretsiz', 'type' => \App\Plan::FREE, 'is_default' => 0
            ]
        ]);
    }
}
