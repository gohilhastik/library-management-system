@extends('layouts.app')

@section('title', 'Student Management')

@section('content')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>

        </div>

    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Student Management</h2>

        <a href="{{ route('students.create') }}"
           class="btn btn-primary">

            + Add New Student

        </a>

    </div>

    <form method="GET" action="{{ route('students.index') }}">

        <div class="row mb-3">

            <div class="col-md-6">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search Student..."
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-2">

                <button
                    type="submit"
                    class="btn btn-success w-100">

                    Search

                </button>

            </div>

        </div>

    </form>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Student ID</th>

                        <th>Student Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Course</th>

                        <th>Semester</th>

                        <th width="220">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($students as $student)

                        <tr>

                            <td>{{ $student->student_id }}</td>

                            <td>

                                {{ $student->first_name }}
                                {{ $student->last_name }}

                            </td>

                            <td>{{ $student->email }}</td>

                            <td>{{ $student->phone }}</td>

                            <td>{{ $student->course }}</td>

                            <td>{{ $student->semester }}</td>

                            <td>

                                <a
                                    href="{{ route('students.show',$student->id) }}"
                                    class="btn btn-info btn-sm">

                                    View

                                </a>

                                <a
                                    href="{{ route('students.edit',$student->id) }}"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('students.destroy',$student->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this student?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                No Students Found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $students->links() }}

            </div>

        </div>

    </div>

</div>

@endsection