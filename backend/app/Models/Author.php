<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'name',
        'slug',
        'bio',
        'birth_date',
        'nationality',
        'photo',
        'is_active'
    ];
}
