<?php

namespace App\Livewire\ProductGallery;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Attributes\On;
use Livewire\Component;

class All extends Component
{
    use RefreshDatabase;

    public $galleries;

    public Product $product;

    public function mount()
    {
        $this->galleries = $this->product->galleries;
    }

    public function render()
    {
        return view('livewire.product-gallery.all');
    }

    #[On('delete-prompt')]
    public function delete($id)
    {
        ProductGallery::query()->find($id)->delete();
        $this->dispatch('deleted');
    }

    #[On('refresh-galleries')]
    public function refreshGalleries(): void
    {
        $this->galleries = $this->product->galleries;
    }
}
