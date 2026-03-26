@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Edit Product</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('crud.update', $crud->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><strong>Title:</strong></label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $crud->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Enter title">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Description:</strong></label>
                <textarea
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    style="height:150px"
                    placeholder="Enter description">{{ old('description', $crud->description) }}</textarea>
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Price:</strong></label>
                <input
                    type="number"
                    name="price"
                    value="{{ old('price', $crud->price) }}"
                    class="form-control @error('price') is-invalid @enderror"
                    placeholder="Enter price">
                @error('price')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Current Image:</strong></label><br>
                @if($crud->image)
                <img src="{{ asset('images/' . $crud->image) }}" width="120">
                @else
                <img src="{{ asset('images/no-image.png') }}" width="120">
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Change Image:</strong></label>
                <input
                    type="file"
                    name="image"
                    class="form-control @error('image') is-invalid @enderror"
                    accept="image/*">
                @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-floppy-disk"></i> Update
            </button>
        </form>

    </div>
</div>
@endsection