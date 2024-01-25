<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offer';
    public function cprofile()
    {
        return $this->belongsTo(Cprofile::class, 'profile_id', 'id');
    }
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_offer', 'id', 'offer_id');
    }
    public function user_offer()
    {
        return $this->belongsTo(User_Offer::class, 'id', 'offer_id');
    }
    public function comment(){
        return $this->hasMany(Comment::class,'id','offer_id');
    }
}
