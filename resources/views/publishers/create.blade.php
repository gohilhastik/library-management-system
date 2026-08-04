@extends('layouts.app')

@section('title', 'Add Publisher')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">

            <h4>Add New Publisher</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('publishers.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">Publisher Name <span class="text-danger">*</span></label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Enter Publisher Name">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="Enter Email">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Phone</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}"
                        placeholder="Enter Phone Number">

                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Address</label>

                    <textarea
                        name="address"
                        rows="4"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Enter Address">{{ old('address') }}</textarea>

                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="1" selected>

                            Active

                        </option>

                        <option value="0">

                            Inactive

                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Save Publisher

                </button>

                <a
                    href="{{ route('publishers.index') }}"
                    class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

@endsection