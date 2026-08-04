@extends('layouts.app')

@section('title', 'Book Management')

@section('content')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Book Management</h2>

        <a href="{{ route('books.create') }}"
           class="btn btn-primary">

            + Add New Book

        </a>

    </div>

    <form method="GET" action="{{ route('books.index') }}">

        <div class="row mb-3">

            <div class="col-md-5">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search Book..."
                    value="{{ request('search') }}">

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

                        <th>Cover</th>

                        <th>Title</th>

                        <th>Category</th>

                        <th>Author</th>

                        <th>Publisher</th>

                        <th>ISBN</th>

                        <th>Price</th>

                        <th>Quantity</th>

                        <th width="220">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($books as $book)

                        <tr>

                            <td width="90">

                                @if($book->book_cover)

                                    <img src="{{ asset('uploads/books/'.$book->book_cover) }}"
                                         width="70"
                                         height="90"
                                         class="img-thumbnail">

                                @else

                                    <img src="{{ asset('images/no-image.png') }}"
                                         width="70"
                                         height="90"
                                         class="img-thumbnail">

                                @endif

                            </td>

                            <td>{{ $book->title }}</td>

                            <td>{{ $book->category->name }}</td>

                            <td>{{ $book->author->name }}</td>

                            <td>{{ $book->publisher->name }}</td>

                            <td>{{ $book->isbn }}</td>

                            <td>₹ {{ number_format($book->price,2) }}</td>

                            <td>{{ $book->quantity }}</td>

                            <td>

                                <a href="{{ route('books.show',$book->id) }}"
                                   class="btn btn-info btn-sm">

                                    View

                                </a>

                                <a href="{{ route('books.edit',$book->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('books.destroy',$book->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this book?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center">

                                No Books Found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $books->links() }}

            </div>

        </div>

    </div>

</div>

@endsection