<?php

namespace App\Livewire\Products;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $title;

    public $slug;

    public $description;

    public $price;

    public $inventory;

    public $category_id;

    #[Rule('mimes:jpeg,png,jpg,gif|max:2048')]
    public $image;

    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.products.add');
    }

    public function add()
    {
        $this->image = storeUploadedFile($this->image, 'upload');

        auth()->user()->products()->create([
            'title' => $this->title,
            'slug' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'inventory' => $this->inventory,
            'category_id' => $this->category_id,
            'image' => $this->image,
        ]);

        return redirect()->route('admin.products');
    }
}
