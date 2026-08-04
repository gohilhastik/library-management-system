<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [

        'student_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'course',
        'semester',
        'address'

    ];

    public function issues()
    {
        return $this->hasMany(BookIssue::class);
    }
}