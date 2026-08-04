<div class="mb-3">

<label>Name</label>

<input

type="text"

name="name"

class="form-control"

value="{{ old('name',$category->name ?? '') }}">

</div>

<div class="mb-3">

<label>Description</label>

<textarea

name="description"

class="form-control">

{{ old('description',$category->description ?? '') }}

</textarea>

</div>