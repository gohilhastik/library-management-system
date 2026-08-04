@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-warning">

            <h4>Edit Student</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('students.update', $student->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Student ID -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Student ID <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="student_id"
                            value="{{ old('student_id', $student->student_id) }}"
                            class="form-control @error('student_id') is-invalid @enderror">

                        @error('student_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- First Name -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            First Name <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="first_name"
                            value="{{ old('first_name', $student->first_name) }}"
                            class="form-control @error('first_name') is-invalid @enderror">

                        @error('first_name')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <div class="row">

                    <!-- Last Name -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Last Name <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="last_name"
                            value="{{ old('last_name', $student->last_name) }}"
                            class="form-control @error('last_name') is-invalid @enderror">

                        @error('last_name')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Email -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $student->email) }}"
                            class="form-control @error('email') is-invalid @enderror">

                        @error('email')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <div class="row">

                    <!-- Phone -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Phone

                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $student->phone) }}"
                            class="form-control @error('phone') is-invalid @enderror">

                        @error('phone')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Gender -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Gender <span class="text-danger">*</span>

                        </label>

                        <select
                            name="gender"
                            class="form-select @error('gender') is-invalid @enderror">

                            <option value="">Select Gender</option>

                            <option value="Male"
                                {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Female"
                                {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>

                        </select>

                        @error('gender')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <div class="row">

                    <!-- Course -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Course <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="course"
                            value="{{ old('course', $student->course) }}"
                            class="form-control @error('course') is-invalid @enderror">

                        @error('course')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Semester -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Semester <span class="text-danger">*</span>

                        </label>

                        <select
                            name="semester"
                            class="form-select @error('semester') is-invalid @enderror">

                            <option value="">Select Semester</option>

                            @for($i = 1; $i <= 8; $i++)

                                <option
                                    value="{{ $i }}"
                                    {{ old('semester', $student->semester) == $i ? 'selected' : '' }}>

                                    Semester {{ $i }}

                                </option>

                            @endfor

                        </select>

                        @error('semester')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

                <!-- Address -->

                <div class="mb-3">

                    <label class="form-label">

                        Address

                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        class="form-control @error('address') is-invalid @enderror">{{ old('address', $student->address) }}</textarea>

                    @error('address')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Update Student

                </button>

                <a
                    href="{{ route('students.index') }}"
                    class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

@endsection