<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherForecastTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'weather_forecast';

    /**
     * Run the migrations.
     * @table weather_forecast
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->float('humidity')->nullable();
            $table->float('temp');
            $table->date('date');
            $table->integer('cities_id');

            $table->index(["cities_id"], 'fk_weather_forecast_cities1_idx');


            $table->foreign('cities_id', 'fk_weather_forecast_cities1_idx')
                ->references('id')->on('cities')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
