@extends('layouts.app')

@section('title', 'Overdue Books Report')

@section('content')

<div class="container">

    <h2 class="mb-4">

        Overdue Books Report

    </h2>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>Student</th>

                        <th>Book</th>

                        <th>Due Date</th>

                        <th>Days Late</th>

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

                                {{ date('d-m-Y', strtotime($issue->due_date)) }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($issue->due_date)->diffInDays(now()) }}

                                Days

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="text-center">

                                No Overdue Books.

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