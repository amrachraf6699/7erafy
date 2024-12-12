<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    //Start: Relationships

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    //End: Relationships
}
