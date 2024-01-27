<?php

namespace App\Livewire\ProductGallery;

use App\Models\Product;
use App\Models\ProductGallery;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $inputs;

    public Product $product;

    public function mount(): void
    {
        $this->fill([
            'inputs' => collect([['alt' => '', 'image' => '']]),
        ]);
    }

    public function render()
    {
        return view('livewire.product-gallery.add');
    }

    public function remove($key): void
    {
        $this->inputs->pull($key);
    }

    public function add(): void
    {
        $this->inputs->push(['alt' => '', 'image' => '']);
    }

    public function save()
    {
        foreach ($this->inputs as $item) {
            $item['image'] = storeUploadedFile($item['image'], 'upload');
            ProductGallery::query()->create([
                'product_id' => $this->product->id,
                'image' => $item['image'],
                'alt' => $item['alt'],
            ]);
        }

        return redirect()->route('admin.products.gallery', $this->product->id);
    }
}
