<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'name',
        'location',
        'description',
        'is_active'
    ];
}
