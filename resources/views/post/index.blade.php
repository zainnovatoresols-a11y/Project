@extends('products.layout')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Posts</h2>
    <div class="card-body">

        @session('success')
        <div class="alert alert-success" role="alert">{{ $value }}</div>
        @endsession

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('post.create') }}">Create New Post</a>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            @can('post.back.admin')
            <a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}">Back</a>
            @endcan
            @can('post.back.user')
            <a class="btn btn-primary btn-sm" href="{{ route('user.dashboard') }}">Back</a>
            @endcan
        </div>

        <livewire:posts-search />

    </div>
</div>
@endsection