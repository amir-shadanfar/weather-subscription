<?php

use Illuminate\Database\Seeder;

class WeatherForecastTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\WeatherForecast::truncate();

        factory(\App\WeatherForecast::class, 20)->create();

    }
}
