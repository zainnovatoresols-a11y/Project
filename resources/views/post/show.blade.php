@extends('products.layout')

@section('content')
<div class="container mt-5">

    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Show Product</h2>
            <a class="btn btn-primary btn-sm" href="{{ url()->previous()}}">
                <i class="fa fa-arrow-left"></i> Back
            </a>

        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Name:</strong>
                <p class="mb-0">{{ $post->name }}</p>
            </div>
            <div class="mb-3">
                <strong>Description:</strong>
                <p class="mb-0">{{ $post->description }}</p>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add Comment</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit Comment</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Comments</h4>
        </div>
        <div class="card-body">
            @forelse($comments as $comment)
            <div class="mb-3 border-bottom pb-2">
                <strong>{{ $comment->user->name }}</strong>:
                <p class="mb-0">{{ $comment->comment }}</p>
            </div>
            @empty
            <p class="text-muted">No comments yet. Be the first to comment!</p>
            @endforelse

            <div class="mt-3">
                {!! $comments->links() !!}
            </div>
        </div>
    </div>

</div>
@endsection