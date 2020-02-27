<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCode extends Model
{
    protected $table = 'gift_codes';

    protected $fillable = [
        'code','expired_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
