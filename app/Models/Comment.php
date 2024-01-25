<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
   protected $table = 'comment';

   public function offer(){
    return $this->belongsTo(Offer::class,'offer_id','id');
   }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
