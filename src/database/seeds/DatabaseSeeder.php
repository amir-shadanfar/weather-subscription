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
        $this->call('GiftCodesTableSeeder');
        $this->call('PlansTableSeeder');
        $this->call('CitiesTableSeeder');
        $this->call('WeatherForecastTableSeeder');
        $this->call('UsersTableSeeder');
    }
}
