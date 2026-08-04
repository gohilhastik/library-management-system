@extends('layouts.app')

@section('title', 'Issued Books Report')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Issued Books Report</h2>

        <button
            onclick="window.print()"
            class="btn btn-primary">

            Print Report

        </button>

    </div>

    <form method="GET"
          action="{{ route('reports.issued') }}">

        <div class="row mb-3">

            <div class="col-md-6">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Search Student or Book">

            </div>

            <div class="col-md-2">

                <button
                    class="btn btn-success w-100">

                    Search

                </button>

            </div>

        </div>

    </form>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>Student</th>

                        <th>Book</th>

                        <th>Issue Date</th>

                        <th>Due Date</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($issues as $issue)

                        <tr>

                            <td>

                                {{ $issue->student->student_id }}

                                <br>

                                <strong>

                                    {{ $issue->student->first_name }}
                                    {{ $issue->student->last_name }}

                                </strong>

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

                                <span class="badge bg-warning text-dark">

                                    Issued

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center">

                                No Records Found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            {{ $issues->links() }}

        </div>

    </div>

</div>

@endsection