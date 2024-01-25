<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function uprofile()
    {
        return $this->hasOne(Uprofile::class, 'id', 'user_id');
    }
    public function offer()
    {
        return $this->belongsToMany(offer::class, 'user_offer', 'id', 'user_id');
    }
    public function user_offer()
    {
        return $this->belongsTo(User_Offer::class, 'id', 'user_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'id', 'user_id');
    }
}
