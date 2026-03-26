@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Properties</h2>
    <div class="card-body">

        @session('success')
        <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('crud.create') }}"> <i class="fa fa-plus"></i> Create New Post</a>
        </div>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($crud as $crud)
                <tr>
                    <td>{{ $crud->id }}</td>
                    <td>{{ $crud->title }}</td>
                    <td>{{ $crud->description }}</td>
                    <td>
                        @if($crud->image)
                        <img src="{{ asset('images/' . $crud->image) }}" width="100">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $crud->price }}</td>
                    <td>
                        <form action="{{ route('crud.destroy',$crud->id) }}" method="POST">

                            <a class="btn btn-info btn-sm" href="{{ route('crud.show',$crud->id) }}"><i class="fa-solid fa-list"></i> Show</a>

                            <a class="btn btn-primary btn-sm" href="{{ route('crud.edit',$crud->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>


                </tr>
                @empty
                <tr>
                    <td colspan="4">There are no data.</td>
                </tr>
                @endforelse

            </tbody>

        </table>



    </div>
</div>
@endsection