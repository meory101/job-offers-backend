<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cprofile extends Model
{
    use HasFactory;
    protected $table = 'c_profile';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function offer()
    {
        return $this->hasMany(Offer::class, 'id', 'profile_id');
    }
}
