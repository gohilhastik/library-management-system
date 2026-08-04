<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Student;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $issues = BookIssue::with(['student', 'book'])

            ->when($search, function ($query) use ($search) {

                $query->whereHas('student', function ($q) use ($search) {

                    $q->where('student_id', 'LIKE', "%{$search}%")
                      ->orWhere('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%");

                })

                ->orWhereHas('book', function ($q) use ($search) {

                    $q->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('isbn', 'LIKE', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('book_issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('first_name')->get();

        $books = Book::where('quantity', '>', 0)
                     ->orderBy('title')
                     ->get();

        return view(
            'book_issues.create',
            compact(
                'students',
                'books'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'student_id' => 'required|exists:students,id',

            'book_id' => 'required|exists:books,id',

            'issue_date' => 'required|date',

            'due_date' => 'required|date|after_or_equal:issue_date'

        ]);

        $alreadyIssued = BookIssue::where('student_id', $request->student_id)
                                  ->where('book_id', $request->book_id)
                                  ->where('status', 'Issued')
                                  ->exists();

        if ($alreadyIssued) {

            return back()
                ->withInput()
                ->with('error', 'This student already has this book.');

        }

        $book = Book::findOrFail($request->book_id);

        if ($book->quantity <= 0) {

            return back()
                ->withInput()
                ->with('error', 'Book is currently out of stock.');

        }

        BookIssue::create([

            'student_id' => $request->student_id,

            'book_id' => $request->book_id,

            'issue_date' => $request->issue_date,

            'due_date' => $request->due_date,

            'status' => 'Issued'

        ]);

        $book->decrement('quantity');

        return redirect()
                ->route('issues.index')
                ->with('success', 'Book Issued Successfully.');
    }
        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $issue = BookIssue::with(['student', 'book'])->findOrFail($id);

        return view('book_issues.show', compact('issue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $issue = BookIssue::findOrFail($id);

        $students = Student::orderBy('first_name')->get();

        $books = Book::orderBy('title')->get();

        return view(
            'book_issues.edit',
            compact(
                'issue',
                'students',
                'books'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'student_id' => 'required|exists:students,id',

            'book_id' => 'required|exists:books,id',

            'issue_date' => 'required|date',

            'due_date' => 'required|date|after_or_equal:issue_date',

            'status' => 'required|in:Issued,Returned',

            'return_date' => 'nullable|date'

        ]);

        $issue = BookIssue::findOrFail($id);

        /*
        |-------------------------------------------------------
        | If book is returned for the first time
        |-------------------------------------------------------
        */

        if (
            $issue->status == 'Issued' &&
            $request->status == 'Returned'
        ) {

            $book = Book::findOrFail($issue->book_id);

            $book->increment('quantity');

            $issue->return_date = $request->return_date ?? date('Y-m-d');
        }

        /*
        |-------------------------------------------------------
        | If returned book becomes issued again
        |-------------------------------------------------------
        */

        if (
            $issue->status == 'Returned' &&
            $request->status == 'Issued'
        ) {

            $book = Book::findOrFail($request->book_id);

            if ($book->quantity <= 0) {

                return back()
                    ->withInput()
                    ->with('error', 'Book is out of stock.');

            }

            $book->decrement('quantity');

            $issue->return_date = null;
        }

        $issue->student_id = $request->student_id;

        $issue->book_id = $request->book_id;

        $issue->issue_date = $request->issue_date;

        $issue->due_date = $request->due_date;

        $issue->status = $request->status;

        $issue->save();

        return redirect()
                ->route('issues.index')
                ->with('success', 'Book Issue Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $issue = BookIssue::findOrFail($id);

        /*
        |-----------------------------------------
        | Return quantity before deleting
        |-----------------------------------------
        */

        if ($issue->status == 'Issued') {

            $book = Book::findOrFail($issue->book_id);

            $book->increment('quantity');
        }

        $issue->delete();

        return redirect()
                ->route('issues.index')
                ->with('success', 'Record Deleted Successfully.');
    }
    /**
 * Return Book
 */
    public function return(string $id)
{
    $bookIssue = BookIssue::findOrFail($id);

    if ($bookIssue->status == 'Returned') {
        return redirect()
            ->route('issues.index')
            ->with('error', 'This book has already been returned.');
    }

    $bookIssue->status = 'Returned';
    $bookIssue->return_date = date('Y-m-d');
    $bookIssue->save();

    $book = Book::findOrFail($bookIssue->book_id);
    $book->increment('quantity');

    return redirect()
        ->route('issues.index')
        ->with('success', 'Book Returned Successfully.');
}
}