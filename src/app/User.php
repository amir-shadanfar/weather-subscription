<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'language', 'timezone', 'operating_system', 'access_token', 'plan_id', 'gift_code_id', 'city_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function giftCode()
    {
        return $this->belongsTo(GiftCode::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
