<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    // types
    const FREE = 1;
    const MONETARY = 2;

    protected $table = 'plans';

    protected $fillable = [
        'name', 'type', 'is_default'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
