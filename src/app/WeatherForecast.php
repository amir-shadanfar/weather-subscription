<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    protected $table = 'weather_forecast';

    protected $fillable = [
        'humidity','temp','date','city_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
