<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class All extends Component
{
    use WithFileUploads;

    public $categories;

    public function render()
    {
        return view('livewire.categories.all');
    }

    #[On('refresh-categories')]
    public function refreshCategories(): void
    {
        $this->loadCategories();
    }

    public function mount(): void
    {
        $this->loadCategories();
    }

    private function loadCategories(): void
    {
        $this->categories = Category::query()->select('id', 'name', 'parent', 'icon')->get();
    }

    #[On('goOn-Delete')]
    public function delete($id): void
    {
        Category::query()->find($id)->delete();
        $this->dispatch('deleted');
    }
}
