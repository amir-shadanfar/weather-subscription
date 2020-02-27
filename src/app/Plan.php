<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'name','type','is_default'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
