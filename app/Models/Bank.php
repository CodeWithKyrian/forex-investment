<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'bank_code'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'bank_code');
    }
}