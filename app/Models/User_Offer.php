<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Offer extends Model
{
    use HasFactory;
    protected $table = 'user_offer';
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
