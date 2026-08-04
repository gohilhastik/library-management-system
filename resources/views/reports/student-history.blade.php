@extends('layouts.app')

@section('title', 'Student History')

@section('content')

<div class="container">

    <h2 class="mb-4">

        Student Book History

    </h2>

    <div class="card mb-4">

        <div class="card-body">

            <h5>

                {{ $student->student_id }}

            </h5>

            <h4>

                {{ $student->first_name }}
                {{ $student->last_name }}

            </h4>

            <p>

                {{ $student->course }}

                -

                Semester {{ $student->semester }}

            </p>

        </div>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>Book</th>

                        <th>Issue Date</th>

                        <th>Due Date</th>

                        <th>Return Date</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($issues as $issue)

                        <tr>

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

                                {{ $issue->return_date
                                    ? date('d-m-Y', strtotime($issue->return_date))
                                    : '-' }}

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