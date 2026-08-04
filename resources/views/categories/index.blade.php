@extends('layouts.app')

@section('title', 'Category Management')

@section('content')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Category Management</h2>

        <a href="{{ route('categories.create') }}"
           class="btn btn-primary">

            + Add New Category

        </a>

    </div>

    <form method="GET" action="{{ route('categories.index') }}">

        <div class="row mb-3">

            <div class="col-md-5">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search Category..."
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-2">

                <button type="submit"
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

                        <th width="35%">Category Name</th>

                        <th>Description</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td>

                                {{ $category->name }}

                            </td>

                            <td>

                                {{ $category->description }}

                            </td>

                            <td>

                                <a href="{{ route('categories.edit', $category->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3"
                                class="text-center">

                                No Categories Found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $categories->links() }}

            </div>

        </div>

    </div>

</div>

@endsection