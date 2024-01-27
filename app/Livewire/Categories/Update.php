<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $id;

    #[Rule('required|max:255')]
    public $name;

    public $parent;

    #[Rule('mimes:jpeg,png,jpg,gif|max:2048')]
    public $icon;

    public function render()
    {
        return view('livewire.categories.update');
    }

    #[On('update-categories')]
    public function GetData($id): void
    {
        $this->reset(['name', 'parent', 'icon']);
        $category = Category::query()->findOrFail($id);

        $this->id = $id;
        $this->name = $category->name;
        $this->parent = $category->parent;
    }

    public function update(): void
    {
        $this->validate();

        Category::query()->findOrFail($this->id)->update([
            'name' => $this->name,
            'parent' => $this->parent ?? 0,
            'icon' => $this->icon ? storeUploadedFile($this->icon, 'upload') : '',
        ]);

        $this->dispatch('reset-modal');
        $this->dispatch('refresh-categories');
    }
}
