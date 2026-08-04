@extends('layouts.app')

@section('title', 'Issue Book')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">

            <h4>Issue Book</h4>

        </div>

        <div class="card-body">

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            <form action="{{ route('issues.store') }}" method="POST">

                @csrf

                <div class="row">

                    <!-- Student -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Student <span class="text-danger">*</span>

                        </label>

                        <select
                            name="student_id"
                            class="form-select @error('student_id') is-invalid @enderror">

                            <option value="">Select Student</option>

                            @foreach($students as $student)

                                <option
                                    value="{{ $student->id }}"
                                    {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                    {{ $student->student_id }}
                                    -
                                    {{ $student->first_name }}
                                    {{ $student->last_name }}

                                </option>

                            @endforeach

                        </select>

                        @error('student_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Book -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Book <span class="text-danger">*</span>

                        </label>

                        <select
                            name="book_id"
                            class="form-select @error('book_id') is-invalid @enderror">

                            <option value="">Select Book</option>

                            @foreach($books as $book)

                                <option
                                    value="{{ $book->id }}"
                                    {{ old('book_id') == $book->id ? 'selected' : '' }}>

                                    {{ $book->title }}

                                    (Available :
                                    {{ $book->quantity }})

                                </option>

                            @endforeach

                        </select>

                        @error('book_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <div class="row">

                    <!-- Issue Date -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Issue Date <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            name="issue_date"
                            value="{{ old('issue_date', date('Y-m-d')) }}"
                            class="form-control @error('issue_date') is-invalid @enderror">

                        @error('issue_date')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Due Date -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Due Date <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            class="form-control @error('due_date') is-invalid @enderror">

                        @error('due_date')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Issue Book

                </button>

                <a
                    href="{{ route('issues.index') }}"
                    class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

@endsection