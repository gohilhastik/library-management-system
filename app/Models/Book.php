<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [

        'category_id',
        'author_id',
        'publisher_id',
        'title',
        'isbn',
        'price',
        'quantity',
        'book_cover',
        'description'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function issues()
    {
        return $this->hasMany(BookIssue::class);
    }
}