<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    protected $guarded = [];


    //Start: Relationships

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }

    //End: Relationships
}
