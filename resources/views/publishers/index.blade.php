@extends('layouts.app')

@section('title', 'Publisher Management')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Publisher Management</h2>

        <a href="{{ route('publishers.create') }}" class="btn btn-primary">
            + Add New Publisher
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <form method="GET" action="{{ route('publishers.index') }}">

        <div class="row mb-3">

            <div class="col-md-4">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search Publisher"
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-2">

                <button class="btn btn-success">

                    Search

                </button>

            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>

                <th width="70">ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Status</th>

                <th width="180">Action</th>

            </tr>

        </thead>

        <tbody>

            @forelse($publishers as $publisher)

                <tr>

                    <td>{{ $publisher->id }}</td>

                    <td>{{ $publisher->name }}</td>

                    <td>{{ $publisher->email }}</td>

                    <td>{{ $publisher->phone }}</td>

                    <td>

                        @if($publisher->status)

                            <span class="badge bg-success">

                                Active

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Inactive

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('publishers.edit', $publisher->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('publishers.destroy', $publisher->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this publisher?')">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No Publisher Found.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="mt-3">

        {{ $publishers->links() }}

    </div>

</div>

@endsection