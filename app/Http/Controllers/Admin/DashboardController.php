<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Student;

class DashboardController extends controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $totalStudents = Student::count();

        $totalAuthors = Author::count();

        $totalPublishers = Publisher::count();

        $totalCategories = Category::count();

        $issuedBooks = BookIssue::where('status', 'Issued')->count();

        $returnedBooks = BookIssue::where('status', 'Returned')->count();

        $availableBooks = Book::sum('quantity');

        $recentIssues = BookIssue::with(['student', 'book'])
                                ->latest()
                                ->take(10)
                                ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalStudents',
            'totalAuthors',
            'totalPublishers',
            'totalCategories',
            'issuedBooks',
            'returnedBooks',
            'availableBooks',
            'recentIssues'
        ));
    }
}



