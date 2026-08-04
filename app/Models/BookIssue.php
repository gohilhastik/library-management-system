<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    protected $table = 'book_issues';

    protected $fillable = [

        'student_id',
        'book_id',
        'issue_date',
        'due_date',
        'return_date',
        'status'

    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}