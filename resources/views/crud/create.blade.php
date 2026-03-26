@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Add New Product</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('crud.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Title:</strong></label>
                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    id="inputName"
                    placeholder="Name">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputDetail" class="form-label"><strong>Description:</strong></label>
                <textarea
                    class="form-control @error('detail') is-invalid @enderror"
                    style="height:150px"
                    name="description"
                    id="inputDetail"
                    placeholder="Detail"></textarea>
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputImage" class="form-label"><strong>Image:</strong></label>

                <input
                    type="file"
                    class="form-control @error('image') is-invalid @enderror"
                    name="image"
                    id="inputImage"
                    accept="image/*">

                @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputDetail" class="form-label"><strong>Price:</strong></label>
                <input
                    type="number"
                    name="price"
                    class="form-control @error('price') is-invalid @enderror"
                    placeholder="Price">
                @error('price')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </form>

    </div>
</div>
@endsection