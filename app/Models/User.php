<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Start: Relationships
    public function services()
    {
        return $this->hasMany(Service::class, 'provider_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'client_id');
    }


    public function feedbacks()
    {
        return $this->hasMany(Review::class, 'provider_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function chatsAsClient()
    {
        return $this->hasMany(Chat::class, 'client_id');
    }

    public function chatsAsProvider()
    {
        return $this->hasMany(Chat::class, 'provider_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    //End: Relationships

    //Start: Accessors
    public function getProfilePictureAttribute()
    {
        return $this->profile_picture ? asset('storage/' . $this->profile_picture) : asset('images/default-profile-picture.png');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getRatingAttribute()
    {
        return $this->feedbacks->avg('rating');
    }

    public function getRatingCountAttribute()
    {
        return $this->feedbacks->count();
    }

    //End: Accessors

    //Start: Mutators

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    //End: Mutators

}
