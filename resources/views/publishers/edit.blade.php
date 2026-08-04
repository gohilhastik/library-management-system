@extends('layouts.app')

@section('title', 'Edit Publisher')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-warning">

            <h4>Edit Publisher</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">Publisher Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $publisher->name) }}">

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
                        value="{{ old('email', $publisher->email) }}">

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
                        value="{{ old('phone', $publisher->phone) }}">

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
                        class="form-control">{{ old('address', $publisher->address) }}</textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="1" {{ $publisher->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ $publisher->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Update Publisher

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