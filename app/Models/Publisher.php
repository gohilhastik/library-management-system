<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}