<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uprofile extends Model
{
    use HasFactory;
    protected $table='u_profile';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function exp()
    {
        return $this->hasMany(Experience::class, 'id', 'profile_id');
    }
}
