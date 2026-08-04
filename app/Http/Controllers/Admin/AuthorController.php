<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $authors = Author::when($search, function ($query) use ($search) {

            $query->where('name', 'LIKE', "%{$search}%");

        })->paginate(10);

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:100',

            'email' => 'nullable|email'

        ]);

        Author::create([

            'name' => $request->name,

            'email' => $request->email,

            'biography' => $request->biography,

            'status' => true

        ]);

        return redirect()

            ->route('authors.index')

            ->with('success', 'Author Added Successfully');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([

            'name' => 'required|max:100',

            'email' => 'nullable|email'

        ]);

        $author->update([

            'name' => $request->name,

            'email' => $request->email,

            'biography' => $request->biography,

            'status' => $request->status

        ]);

        return redirect()

            ->route('authors.index')

            ->with('success', 'Author Updated Successfully');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()

            ->route('authors.index')

            ->with('success', 'Author Deleted Successfully');
    }
}