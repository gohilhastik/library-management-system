@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-warning">

            <h4>Edit Book</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('books.update', $book->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Category -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Category <span class="text-danger">*</span>

                        </label>

                        <select
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">

                            <option value="">Select Category</option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('category_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Author -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Author <span class="text-danger">*</span>

                        </label>

                        <select
                            name="author_id"
                            class="form-select @error('author_id') is-invalid @enderror">

                            <option value="">Select Author</option>

                            @foreach($authors as $author)

                                <option
                                    value="{{ $author->id }}"
                                    {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>

                                    {{ $author->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('author_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Publisher -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Publisher <span class="text-danger">*</span>

                        </label>

                        <select
                            name="publisher_id"
                            class="form-select @error('publisher_id') is-invalid @enderror">

                            <option value="">Select Publisher</option>

                            @foreach($publishers as $publisher)

                                <option
                                    value="{{ $publisher->id }}"
                                    {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>

                                    {{ $publisher->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('publisher_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Book Title

                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $book->title) }}"
                            class="form-control @error('title') is-invalid @enderror">

                        @error('title')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            ISBN

                        </label>

                        <input
                            type="text"
                            name="isbn"
                            value="{{ old('isbn', $book->isbn) }}"
                            class="form-control @error('isbn') is-invalid @enderror">

                        @error('isbn')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Price

                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            value="{{ old('price', $book->price) }}"
                            class="form-control @error('price') is-invalid @enderror">

                        @error('price')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Quantity

                        </label>

                        <input
                            type="number"
                            name="quantity"
                            value="{{ old('quantity', $book->quantity) }}"
                            class="form-control @error('quantity') is-invalid @enderror">

                        @error('quantity')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>

                    @error('description')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Current Book Cover

                    </label>

                    <br>

                    @if($book->book_cover)

                        <img src="{{ asset('uploads/books/' . $book->book_cover) }}"
                             id="preview"
                             width="150"
                             class="img-thumbnail">

                    @else

                        <img src="{{ asset('images/no-image.png') }}"
                             id="preview"
                             width="150"
                             class="img-thumbnail">

                    @endif

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Change Book Cover

                    </label>

                    <input
                        type="file"
                        name="book_cover"
                        id="book_cover"
                        class="form-control @error('book_cover') is-invalid @enderror"
                        accept="image/*">

                    @error('book_cover')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Update Book

                </button>

                <a href="{{ route('books.index') }}"
                   class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>

document.getElementById('book_cover').addEventListener('change', function(event){

    const file = event.target.files[0];

    if(file){

        document.getElementById('preview').src = URL.createObjectURL(file);

    }

});

</script>

@endsection