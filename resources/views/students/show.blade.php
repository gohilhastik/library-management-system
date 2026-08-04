@extends('layouts.app')

@section('title', 'View Student')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-info text-white">

            <h4>Student Details</h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Student ID</th>
                    <td>{{ $student->student_id }}</td>
                </tr>

                <tr>
                    <th>First Name</th>
                    <td>{{ $student->first_name }}</td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td>{{ $student->last_name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $student->email }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $student->phone }}</td>
                </tr>

                <tr>
                    <th>Gender</th>
                    <td>{{ $student->gender }}</td>
                </tr>

                <tr>
                    <th>Course</th>
                    <td>{{ $student->course }}</td>
                </tr>

                <tr>
                    <th>Semester</th>
                    <td>{{ $student->semester }}</td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td>{{ $student->address }}</td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $student->created_at->format('d-m-Y h:i A') }}</td>
                </tr>

                <tr>
                    <th>Updated At</th>
                    <td>{{ $student->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>

            </table>

            <a href="{{ route('students.index') }}"
               class="btn btn-secondary">

                Back

            </a>

            <a href="{{ route('students.edit', $student->id) }}"
               class="btn btn-warning">

                Edit

            </a>

        </div>

    </div>

</div>

@endsection