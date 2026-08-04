@extends('layouts.app')

@section('title', 'Book Issue Management')

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

        <h2>Book Issue Management</h2>

        <a href="{{ route('issues.create') }}"
           class="btn btn-primary">

            + Issue Book

        </a>

    </div>

    <form method="GET"
          action="{{ route('issues.index') }}">

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

                        <th>Student</th>

                        <th>Book</th>

                        <th>Issue Date</th>

                        <th>Due Date</th>

                        <th>Return Date</th>

                        <th>Status</th>

                        <th width="220">Action</th>

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

                                {{ \Carbon\Carbon::parse($issue->issue_date)->format('d-m-Y') }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($issue->due_date)->format('d-m-Y') }}

                            </td>

                            <td>

                                @if($issue->return_date)

                                    {{ \Carbon\Carbon::parse($issue->return_date)->format('d-m-Y') }}

                                @else

                                    -

                                @endif

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

<td>

    <a
        href="{{ route('issues.show', $issue->id) }}"
        class="btn btn-info btn-sm">

        View

    </a>

    @if($issue->status == 'Issued')

        <form
            action="{{ route('issues.return', $issue->id) }}"
            method="POST"
            class="d-inline">

            @csrf
            @method('PATCH')

            <button
                type="submit"
                class="btn btn-success btn-sm"
                onclick="return confirm('Return this book?')">

                Return

            </button>

        </form>

    @endif

    <a
        href="{{ route('issues.edit', $issue->id) }}"
        class="btn btn-warning btn-sm">

        Edit

    </a>

    <form
        action="{{ route('issues.destroy', $issue->id) }}"
        method="POST"
        class="d-inline">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Delete this record?')">

            Delete

        </button>

    </form>

</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center">

                                No Records Found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $issues->links() }}

            </div>

        </div>

    </div>

</div>

@endsection