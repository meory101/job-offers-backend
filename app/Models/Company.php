<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'company';
    public function cprofile()
    {
        return $this->hasOne(Cprofile::class, 'id', 'company_id');
    }
}
