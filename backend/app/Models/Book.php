<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'isbn',
        'title',
        'subtitle',
        'author_id',
        'publisher_id',
        'category_id',
        'shelf_id',
        'genre',
        'publication_year',
        'edition',
        'total_pages',
        'language',
        'synopsis',
        'cover',
        'is_active'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
}
