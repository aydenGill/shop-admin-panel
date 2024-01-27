<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Subcategories extends Component
{
    use WithFileUploads;

    public $id;

    #[Rule('required|max:255')]
    public $name;

    #[Rule('mimes:jpeg,png,jpg,gif|max:2048')]
    public $icon;

    #[On('sub-categories')]
    public function GetData($id): void
    {
        $this->reset(['name', 'icon']);
        Category::query()->findOrFail($id);
        $this->id = $id;
    }

    public function save()
    {
        $this->validate();

        Category::query()->create([
            'name' => $this->name,
            'parent' => $this->id ?? 0,
            'icon' => $this->icon ? storeUploadedFile($this->icon, 'upload') : '',
        ]);

        $this->dispatch('reset-modal');
        $this->dispatch('refresh-categories');
    }

    public function render()
    {
        return view('livewire.categories.subcategories');
    }
}
