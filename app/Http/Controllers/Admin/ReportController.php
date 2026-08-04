<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookIssue;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Reports Home Page
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Issued Books Report
     */
    public function issuedBooks(Request $request)
    {
        $search = $request->search;

        $issues = BookIssue::with(['student', 'book'])

            ->where('status', 'Issued')

            ->when($search, function ($query) use ($search) {

                $query->whereHas('student', function ($q) use ($search) {

                    $q->where('student_id', 'LIKE', "%{$search}%")
                      ->orWhere('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");

                })

                ->orWhereHas('book', function ($q) use ($search) {

                    $q->where('title', 'LIKE', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('reports.issued-books', compact('issues'));
    }

    /**
     * Returned Books Report
     */
    public function returnedBooks(Request $request)
    {
        $search = $request->search;

        $issues = BookIssue::with(['student', 'book'])

            ->where('status', 'Returned')

            ->when($search, function ($query) use ($search) {

                $query->whereHas('student', function ($q) use ($search) {

                    $q->where('student_id', 'LIKE', "%{$search}%")
                      ->orWhere('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");

                })

                ->orWhereHas('book', function ($q) use ($search) {

                    $q->where('title', 'LIKE', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('reports.returned-books', compact('issues'));
    }

    /**
     * Overdue Books Report
     */
    public function overdueBooks()
    {
        $issues = BookIssue::with(['student', 'book'])

            ->where('status', 'Issued')

            ->whereDate('due_date', '<', date('Y-m-d'))

            ->latest()

            ->paginate(10);

        return view('reports.overdue-books', compact('issues'));
    }

    /**
     * Student History
     */
    public function studentHistory($id)
    {
        $student = Student::findOrFail($id);

        $issues = BookIssue::with('book')

            ->where('student_id', $id)

            ->latest()

            ->paginate(10);

        return view(
            'reports.student-history',
            compact(
                'student',
                'issues'
            )
        );
    }
}