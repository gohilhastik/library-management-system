<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $categories = Category::when($search, function ($query) use ($search) {

            $query->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');

        })
        ->orderBy('name', 'ASC')
        ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:100|unique:categories,name',

            'description' => 'nullable'

        ]);

        Category::create([

            'name' => $request->name,

            'description' => $request->description

        ]);

        return redirect()
                ->route('categories.index')
                ->with('success', 'Category Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'name' => 'required|max:100|unique:categories,name,' . $id,

            'description' => 'nullable'

        ]);

        $category = Category::findOrFail($id);

        $category->update([

            'name' => $request->name,

            'description' => $request->description

        ]);

        return redirect()
                ->route('categories.index')
                ->with('success', 'Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()
                ->route('categories.index')
                ->with('success', 'Category Deleted Successfully.');
    }
}