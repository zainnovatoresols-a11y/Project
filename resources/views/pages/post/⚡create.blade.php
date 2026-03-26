<?php

use Livewire\Component;
use App\Models\Post;

new class extends Component {
    public string $name = '';
    public string $user_id = '';

    public string $description = '';

    public function save()
    {
       $validated= $this->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        $post = Post::create($validated);
        // dd($this->name, $this->description);
        return $this->redirect('/post');
    }
};
?>

<form wire:submit="save">
    <label>
        Name
        <input type="text" wire:model="name">
        @error('name') <span style="color: red;">{{ $message }}</span> @enderror
    </label>

    <label>
        description
        <textarea wire:model="description" rows="5"></textarea>
        @error('description') <span style="color: red;">{{ $message }}</span> @enderror
    </label>
    <input type="user_id" wire:model="user_id" value="1">

    <button type="submit">Save Post</button>
</form>