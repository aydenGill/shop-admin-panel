<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    #[Rule('required|max:255')]
    public $name;

    public $parent;

    #[Rule('mimes:jpeg,png,jpg,gif|max:2048')]
    public $icon;

    public function render()
    {
        return view('livewire.categories.add');
    }

    #[On('add-categories')]
    public function reset_data(): void
    {
        $this->reset(['name', 'parent', 'icon']);
    }

    public function save(): void
    {
        $this->validate();

        Category::query()->create([
            'name' => $this->name,
            'parent' => $this->parent ?? 0,
            'icon' => $this->icon ? storeUploadedFile($this->icon, 'upload') : '',
        ]);

        $this->reset_data();
        $this->dispatch('reset-modal');
        $this->dispatch('refresh-categories');
    }
}
