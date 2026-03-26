@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Posts</h2>
    <div class="card-body">

        @session('success')
        <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('post.create') }}"> <i class="fa fa-plus"></i> Create New Post</a>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            @can('post.back.admin')
            <a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}"><i class="fa fa-arrow-left"></i> Back</a>
            @endcan
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            @can('post.back.user')
            <a class="btn btn-primary btn-sm" href="{{ route('user.dashboard') }}"><i class="fa fa-arrow-left"></i> Back</a>
            @endcan
        </div>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->description }}</td>


                    <td>

                        <form action="{{ route('post.destroy',$post->id) }}" method="POST">

                            <a class="btn btn-info btn-sm" href="{{ route('post.show',$post->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                            @can('post.edit' , $post)
                            <a class="btn btn-primary btn-sm" href="{{ route('post.edit',$post->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            @endcan

                            @csrf
                            @method('DELETE')
                            @can('post.delete' , $post)
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                            @endcan
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

        {!! $posts->links() !!}

    </div>
</div>
@endsection
