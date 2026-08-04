@extends('layouts.app')

@section('title','Edit Author')

@section('content')

<div class="container">

<h2>Edit Author</h2>

<form

action="{{ route('authors.update',$author->id) }}"

method="POST">

@csrf

@method('PUT')

<div class="mb-3">

<label>Name</label>

<input

type="text"

name="name"

class="form-control"

value="{{ old('name',$author->name) }}">

</div>

<div class="mb-3">

<label>Email</label>

<input

type="email"

name="email"

class="form-control"

value="{{ old('email',$author->email) }}">

</div>

<div class="mb-3">

<label>Biography</label>

<textarea

name="biography"

class="form-control"

rows="5">{{ old('biography',$author->biography) }}</textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select

name="status"

class="form-select">

<option value="1"

{{ $author->status==1?'selected':'' }}>

Active

</option>

<option value="0"

{{ $author->status==0?'selected':'' }}>

Inactive

</option>

</select>

</div>

<button

class="btn btn-success">

Update Author

</button>

<a

href="{{ route('authors.index') }}"

class="btn btn-secondary">

Back

</a>

</form>

</div>

@endsection