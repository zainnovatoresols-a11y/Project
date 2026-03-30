<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    public $search = '';

    public function render()
    {
        $result = [];

        if (strlen($this->search) >= 1) {
            $result = Product::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')

                ->limit(7)
                ->get();
        }

        return view('livewire.product-search', [
            'product' => $result
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}; ?>

<div>

    <form>
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Search product..."
            class="border p-2 w-full">
    </form>
    <div class="mt-4 bg-white shadow rounded">
        @if(!empty($product) && count($product) > 0)
        <ul>
            @foreach($product as $product)
            <li class="p-2 border-b">
                <strong>{{ $product->name }}</strong><br>
                <small>Price: {{ $product->price }}</small><br>
                <small>{{ $product->description }}</small>
            </li>
            @endforeach
        </ul>
        @elseif(strlen($search) > 0)
        <p class="p-2 text-gray-500">No products found</p>
        @endif
    </div>
</div>