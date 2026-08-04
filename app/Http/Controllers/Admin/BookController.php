<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $books = Book::with(['category', 'author', 'publisher'])

            ->when($search, function ($query) use ($search) {

                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('isbn', 'LIKE', "%{$search}%")
                      ->orWhereHas('category', function ($q) use ($search) {
                          $q->where('name', 'LIKE', "%{$search}%");
                      })
                      ->orWhereHas('author', function ($q) use ($search) {
                          $q->where('name', 'LIKE', "%{$search}%");
                      })
                      ->orWhereHas('publisher', function ($q) use ($search) {
                          $q->where('name', 'LIKE', "%{$search}%");
                      });

            })

            ->orderBy('title', 'ASC')

            ->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        $authors = Author::orderBy('name')->get();

        $publishers = Publisher::orderBy('name')->get();

        return view(
            'books.create',
            compact(
                'categories',
                'authors',
                'publishers'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'category_id' => 'required|exists:categories,id',

            'author_id' => 'required|exists:authors,id',

            'publisher_id' => 'required|exists:publishers,id',

            'title' => 'required|max:255',

            'isbn' => 'required|unique:books,isbn',

            'price' => 'required|numeric|min:0',

            'quantity' => 'required|integer|min:0',

            'book_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'description' => 'nullable'

        ]);

        $imageName = null;

        if ($request->hasFile('book_cover')) {

            $image = $request->file('book_cover');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/books'), $imageName);
        }

        Book::create([

            'category_id' => $request->category_id,

            'author_id' => $request->author_id,

            'publisher_id' => $request->publisher_id,

            'title' => $request->title,

            'isbn' => $request->isbn,

            'price' => $request->price,

            'quantity' => $request->quantity,

            'book_cover' => $imageName,

            'description' => $request->description

        ]);

        return redirect()
                ->route('books.index')
                ->with('success', 'Book Added Successfully.');
    }
        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['category', 'author', 'publisher'])
                    ->findOrFail($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        $categories = Category::orderBy('name')->get();

        $authors = Author::orderBy('name')->get();

        $publishers = Publisher::orderBy('name')->get();

        return view(
            'books.edit',
            compact(
                'book',
                'categories',
                'authors',
                'publishers'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'category_id' => 'required|exists:categories,id',

            'author_id' => 'required|exists:authors,id',

            'publisher_id' => 'required|exists:publishers,id',

            'title' => 'required|max:255',

            'isbn' => 'required|unique:books,isbn,' . $id,

            'price' => 'required|numeric|min:0',

            'quantity' => 'required|integer|min:0',

            'book_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'description' => 'nullable'

        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('book_cover')) {

            if (
                $book->book_cover &&
                File::exists(public_path('uploads/books/' . $book->book_cover))
            ) {
                File::delete(public_path('uploads/books/' . $book->book_cover));
            }

            $image = $request->file('book_cover');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/books'), $imageName);

            $book->book_cover = $imageName;
        }

        $book->category_id = $request->category_id;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book->description = $request->description;

        $book->save();

        return redirect()
                ->route('books.index')
                ->with('success', 'Book Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if (
            $book->book_cover &&
            File::exists(public_path('uploads/books/' . $book->book_cover))
        ) {
            File::delete(public_path('uploads/books/' . $book->book_cover));
        }

        $book->delete();

        return redirect()
                ->route('books.index')
                ->with('success', 'Book Deleted Successfully.');
    }
}