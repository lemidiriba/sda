<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * PriceRelation function
     *
     * @return void
     */
    public function messageprice()
    {
        return $this->hasOne(Price::class, 'message_type', 'message_type_name');
    }
}