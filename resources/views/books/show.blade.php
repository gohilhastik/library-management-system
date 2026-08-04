@extends('layouts.app')

@section('title', 'View Book')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-info text-white">

            <h4>Book Details</h4>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 text-center">

                    @if($book->book_cover)

                        <img src="{{ asset('uploads/books/' . $book->book_cover) }}"
                             class="img-thumbnail"
                             width="250">

                    @else

                        <img src="{{ asset('images/no-image.png') }}"
                             class="img-thumbnail"
                             width="250">

                    @endif

                </div>

                <div class="col-md-8">

                    <table class="table table-bordered">

                        <tr>

                            <th width="30%">Book Title</th>

                            <td>{{ $book->title }}</td>

                        </tr>

                        <tr>

                            <th>Category</th>

                            <td>{{ $book->category->name }}</td>

                        </tr>

                        <tr>

                            <th>Author</th>

                            <td>{{ $book->author->name }}</td>

                        </tr>

                        <tr>

                            <th>Publisher</th>

                            <td>{{ $book->publisher->name }}</td>

                        </tr>

                        <tr>

                            <th>ISBN</th>

                            <td>{{ $book->isbn }}</td>

                        </tr>

                        <tr>

                            <th>Price</th>

                            <td>₹ {{ number_format($book->price, 2) }}</td>

                        </tr>

                        <tr>

                            <th>Quantity</th>

                            <td>{{ $book->quantity }}</td>

                        </tr>

                        <tr>

                            <th>Description</th>

                            <td>{{ $book->description }}</td>

                        </tr>

                        <tr>

                            <th>Created At</th>

                            <td>{{ $book->created_at->format('d-m-Y h:i A') }}</td>

                        </tr>

                        <tr>

                            <th>Updated At</th>

                            <td>{{ $book->updated_at->format('d-m-Y h:i A') }}</td>

                        </tr>

                    </table>

                    <a href="{{ route('books.index') }}"
                       class="btn btn-secondary">

                        Back

                    </a>

                    <a href="{{ route('books.edit', $book->id) }}"
                       class="btn btn-warning">

                        Edit

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection