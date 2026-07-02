<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'code',
    'name',
    'email',
    'password',
    'phone',
    'gender',
    'address',
    'photo',
    'role',
    'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
