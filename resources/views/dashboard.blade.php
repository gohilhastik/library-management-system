@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Dashboard
    </h2>

    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card bg-primary text-white">

                <div class="card-body">

                    <h5>Total Books</h5>

                    <h2>{{ $totalBooks }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-success text-white">

                <div class="card-body">

                    <h5>Total Students</h5>

                    <h2>{{ $totalStudents }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-warning text-dark">

                <div class="card-body">

                    <h5>Issued Books</h5>

                    <h2>{{ $issuedBooks }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-info text-white">

                <div class="card-body">

                    <h5>Returned Books</h5>

                    <h2>{{ $returnedBooks }}</h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card bg-secondary text-white">

                <div class="card-body">

                    <h5>Available Books</h5>

                    <h2>{{ $availableBooks }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-danger text-white">

                <div class="card-body">

                    <h5>Categories</h5>

                    <h2>{{ $totalCategories }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-dark text-white">

                <div class="card-body">

                    <h5>Authors</h5>

                    <h2>{{ $totalAuthors }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card text-white"
                 style="background:#6f42c1;">

                <div class="card-body">

                    <h5>Publishers</h5>

                    <h2>{{ $totalPublishers }}</h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card mt-4">

        <div class="card-header">

            <h5 class="mb-0">

                Recently Issued Books

            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>Student</th>

                        <th>Book</th>

                        <th>Issue Date</th>

                        <th>Due Date</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentIssues as $issue)

                        <tr>

                            <td>

                                {{ $issue->student->first_name }}
                                {{ $issue->student->last_name }}

                            </td>

                            <td>

                                {{ $issue->book->title }}

                            </td>

                            <td>

                                {{ date('d-m-Y', strtotime($issue->issue_date)) }}

                            </td>

                            <td>

                                {{ date('d-m-Y', strtotime($issue->due_date)) }}

                            </td>

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

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                No Records Found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection