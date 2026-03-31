<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

new class extends Component {
    use WithPagination;

    public $search = '';

    protected $rules = [
        'search' => 'nullable|string|max:255',
    ];

    public function updatedSearch()
    {
        // Normalize input
        $this->search = trim($this->search);

        // Validate input
        $this->validateOnly('search');

        $this->resetPage();
    }

    public function render()
    {
        // Escape LIKE wildcards to prevent abuse
        $search = addcslashes($this->search, '%_');

        $posts = Post::with('user')
            ->when(strlen($search) >= 1, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(3);

        return view('components.⚡posts-search', [
            'posts' => $posts
        ]);
    }
}; ?>

<div>
    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search Posts" class="border p-2 w-full p-2 mb-4">

    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th width="80px">No</th>
                <th>Name</th>
                <th>Created By</th>
                <th>Details</th>
                <th width="250px">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->name }}</td>
                <td>{{ $post->user->name ?? 'N/A' }}</td>
                <td>{{ $post->description }}</td>
                <td>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('post.show', $post->id) }}">Show</a>
                        @can('post.edit', $post)
                        <a class="btn btn-primary btn-sm" href="{{ route('post.edit', $post->id) }}"> Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('post.delete', $post)
                        <button type="submit" class="btn btn-danger btn-sm"></i> Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No posts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $posts->links('pagination::bootstrap-5') }}
</div>