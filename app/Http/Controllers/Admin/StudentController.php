<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::when($search, function ($query) use ($search) {

            $query->where('student_id', 'LIKE', "%{$search}%")
                  ->orWhere('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('course', 'LIKE', "%{$search}%");

        })
        ->orderBy('first_name')
        ->paginate(10)
        ->withQueryString();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'student_id' => 'required|unique:students,student_id|max:20',

            'first_name' => 'required|max:100',

            'last_name' => 'required|max:100',

            'email' => 'nullable|email|max:100',

            'phone' => 'nullable|max:20',

            'gender' => 'required',

            'course' => 'required|max:100',

            'semester' => 'required|integer|min:1|max:8',

            'address' => 'nullable'

        ]);

        Student::create($request->only([
            'student_id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'gender',
            'course',
            'semester',
            'address'
        ]));

        return redirect()
            ->route('students.index')
            ->with('success', 'Student Added Successfully.');
    }
        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'student_id' => 'required|max:20|unique:students,student_id,' . $id,

            'first_name' => 'required|max:100',

            'last_name' => 'required|max:100',

            'email' => 'nullable|email|max:100',

            'phone' => 'nullable|max:20',

            'gender' => 'required',

            'course' => 'required|max:100',

            'semester' => 'required|integer|min:1|max:8',

            'address' => 'nullable'

        ]);

        $student = Student::findOrFail($id);

        $student->update($request->only([
            'student_id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'gender',
            'course',
            'semester',
            'address'
        ]));

        return redirect()
                ->route('students.index')
                ->with('success', 'Student Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        if ($student->issues()->count() > 0) {

            return redirect()
                    ->route('students.index')
                    ->with('error', 'This student cannot be deleted because books have been issued.');

        }

        $student->delete();

        return redirect()
                ->route('students.index')
                ->with('success', 'Student Deleted Successfully.');
    }
}