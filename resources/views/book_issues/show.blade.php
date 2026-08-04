@extends('layouts.app')

@section('title', 'Book Issue Details')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-info text-white">

            <h4>Book Issue Details</h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="25%">Student ID</th>

                    <td>{{ $issue->student->student_id }}</td>

                </tr>

                <tr>

                    <th>Student Name</th>

                    <td>

                        {{ $issue->student->first_name }}
                        {{ $issue->student->last_name }}

                    </td>

                </tr>

                <tr>

                    <th>Book Title</th>

                    <td>{{ $issue->book->title }}</td>

                </tr>

                <tr>

                    <th>ISBN</th>

                    <td>{{ $issue->book->isbn }}</td>

                </tr>

                <tr>

                    <th>Author</th>

                    <td>{{ $issue->book->author->name }}</td>

                </tr>

                <tr>

                    <th>Publisher</th>

                    <td>{{ $issue->book->publisher->name }}</td>

                </tr>

                <tr>

                    <th>Category</th>

                    <td>{{ $issue->book->category->name }}</td>

                </tr>

                <tr>

                    <th>Issue Date</th>

                    <td>

                        {{ \Carbon\Carbon::parse($issue->issue_date)->format('d-m-Y') }}

                    </td>

                </tr>

                <tr>

                    <th>Due Date</th>

                    <td>

                        {{ \Carbon\Carbon::parse($issue->due_date)->format('d-m-Y') }}

                    </td>

                </tr>

                <tr>

                    <th>Return Date</th>

                    <td>

                        @if($issue->return_date)

                            {{ \Carbon\Carbon::parse($issue->return_date)->format('d-m-Y') }}

                        @else

                            -

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>Status</th>

                    <td>

                        @if($issue->status == 'Issued')

                            <span class="badge bg-warning text-dark">

                                Issued

                            </span>

                        @else

                            <span class="badge bg-success">

                                Returned

                            </span>

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>Created At</th>

                    <td>

                        {{ $issue->created_at->format('d-m-Y h:i A') }}

                    </td>

                </tr>

                <tr>

                    <th>Updated At</th>

                    <td>

                        {{ $issue->updated_at->format('d-m-Y h:i A') }}

                    </td>

                </tr>

            </table>

            <a
                href="{{ route('issues.index') }}"
                class="btn btn-secondary">

                Back

            </a>

            <a
                href="{{ route('issues.edit', $issue->id) }}"
                class="btn btn-warning">

                Edit

            </a>

        </div>

    </div>

</div>

@endsection