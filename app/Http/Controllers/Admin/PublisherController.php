<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $publishers = Publisher::where(function ($query) use ($search) {

            if (!empty($search)) {

                $query->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('email', 'LIKE', '%' . $search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $search . '%');

            }

        })
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
            'status' => 'required'

        ]);

        Publisher::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status

        ]);

        return redirect()
                ->route('publishers.index')
                ->with('success', 'Publisher Added Successfully.');
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
        $publisher = Publisher::findOrFail($id);

        return view('publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'name' => 'required|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
            'status' => 'required'

        ]);

        $publisher = Publisher::findOrFail($id);

        $publisher->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status

        ]);

        return redirect()
                ->route('publishers.index')
                ->with('success', 'Publisher Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publisher = Publisher::findOrFail($id);

        $publisher->delete();

        return redirect()
                ->route('publishers.index')
                ->with('success', 'Publisher Deleted Successfully.');
    }
}