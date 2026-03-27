@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Add New Post</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('post.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <form id="postForm" action="{{ route('post.store') }}" method="POST">
            @csrf

            <div id="clientErrors"></div>

            <div class="mb-3">

                <label for="inputName" class="form-label"><strong>Name:</strong></label>
                @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    id="inputName"
                    placeholder="Name">

            </div>

            <div class="mb-3">
                <label for="inputDetail" class="form-label"><strong>Description:</strong></label>
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                <textarea
                    class="form-control @error('detail') is-invalid @enderror"
                    style="height:150px"
                    name="description"
                    id="inputDetail"
                    placeholder="Description"></textarea>
                @error('detail')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </form>

    </div>
</div>

<script>
    const form = document.getElementById('postForm');
    const errorBox = document.getElementById('clientErrors');

    const nameInput = document.getElementById('inputName');
    const descriptionInput = document.getElementById('inputDetail');

    function validate() {
        let errors = [];

        let name = nameInput.value.trim();
        let description = descriptionInput.value.trim();

        if (name === '') {
            errors.push("Name is required.");
        } else if (name.length > 255) {
            errors.push("Name cannot exceed 255 characters.");
        }

        if (description === '') {
            errors.push("Description is required.");
        } else if (description.length < 10) {
            errors.push("Description must be at least 10 characters.");
        }

        errorBox.innerHTML = '';
        errors.forEach(err => {
            errorBox.innerHTML += `<div class="text-danger">${err}</div>`;
        });

        return errors.length === 0;
    }

    nameInput.addEventListener('input', validate);
    descriptionInput.addEventListener('input', validate);

    form.addEventListener('submit', function(e) {
        if (!validate()) {
            e.preventDefault();
        }
    });
</script>


@endsection