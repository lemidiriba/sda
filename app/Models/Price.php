<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     * MessageRelation function
     *
     * @return void
     */
    public function message()
    {
        return $this->hasMany(Message::class, 'message_type_name', 'message_type');
    }
}
