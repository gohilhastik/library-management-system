@extends('layouts.app')

@section('title','Authors')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Author Management</h2>

        <a href="{{ route('authors.create') }}" class="btn btn-primary">
            + Add New Author
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <form method="GET">

        <div class="row mb-3">

            <div class="col-md-4">

                <input type="text"
                       name="search"
                       class="form-control"
                       value="{{ request('search') }}"
                       placeholder="Search Author">

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

                <th>ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>Status</th>

                <th width="180">Action</th>

            </tr>

        </thead>

        <tbody>

        @forelse($authors as $author)

            <tr>

                <td>{{ $author->id }}</td>

                <td>{{ $author->name }}</td>

                <td>{{ $author->email }}</td>

                <td>

                    @if($author->status)

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

                    <a href="{{ route('authors.edit',$author->id) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form action="{{ route('authors.destroy',$author->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf

                        @method('DELETE')

                        <button
                            onclick="return confirm('Are you sure?')"
                            class="btn btn-danger btn-sm">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5" class="text-center">

                    No Author Found

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    {{ $authors->links() }}

</div>

@endsection