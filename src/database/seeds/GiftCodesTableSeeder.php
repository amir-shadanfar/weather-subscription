<?php

use Illuminate\Database\Seeder;

class GiftCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\GiftCode::truncate();

        factory(\App\GiftCode::class, 100)->create();
    }
}
