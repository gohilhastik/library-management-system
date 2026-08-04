@extends('layouts.app')

@section('title','Add Author')

@section('content')

<div class="container">

<h2>Add New Author</h2>

<form action="{{ route('authors.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Name</label>

<input

type="text"

name="name"

class="form-control"

value="{{ old('name') }}">

@error('name')

<div class="text-danger">

{{ $message }}

</div>

@enderror

</div>

<div class="mb-3">

<label>Email</label>

<input

type="email"

name="email"

class="form-control"

value="{{ old('email') }}">

@error('email')

<div class="text-danger">

{{ $message }}

</div>

@enderror

</div>

<div class="mb-3">

<label>Biography</label>

<textarea

name="biography"

class="form-control"

rows="5">{{ old('biography') }}</textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select

name="status"

class="form-select">

<option value="1">

Active

</option>

<option value="0">

Inactive

</option>

</select>

</div>

<button

class="btn btn-primary">

Save Author

</button>

<a

href="{{ route('authors.index') }}"

class="btn btn-secondary">

Cancel

</a>

</form>

</div>

@endsection