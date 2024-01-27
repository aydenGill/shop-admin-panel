<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Attributes\On;
use Livewire\Component;

class All extends Component
{
    use RefreshDatabase;

    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.products.all');
    }

    #[On('deleted-prompt')]
    public function delete($id): void
    {
        Product::query()->find($id)->delete();
        $this->dispatch('deleted');
    }

    #[On('refresh-products')]
    public function refreshProducts(): void
    {
        $this->products = Product::all();
    }
}
