<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class All extends Component
{

    use WithFileUploads;

    public $categories;

    public $name , $parent , $icon;

    public $upd_id,$upd_name,$upd_parent_id,$sub_id,$sub_name,$sub_icon,$upd_icon;

    public function mount(){
        $this->categories = Category::query()->select('id','name','icon')->with('child')->get();
    }

    public function OpenAddCategoryModal(): void
    {
        $this->name = '';
        $this->parent = 0;
        $this->icon = '';

        $this->dispatch('OpenAddModal');
    }

    public function deleteConfirm($id){
        $category = Category::query()->findOrFail($id);
        $category->delete();
        $this->dispatch('refresh-categories');
    }

    public function save(): void
    {
        $data = [
            'name' => $this->name,
            'parent' => $this->parent ?? 0
        ];

        if (!is_null($this->icon)) {
            $imageUrl = $this->storeUploadedFile();
            $data['icon'] = $imageUrl;
        }

        Category::query()->create($data);

        $this->dispatch('reset-modal');
        $this->dispatch('refresh-categories');
    }

    public function openEditCategoryModal($id)
    {
        $categories = Category::query()->findOrFail($id);
        $this->upd_name = $categories->name;
        $this->upd_parent_id = $categories->parent;
        $this->upd_id = $id;

        $this->dispatch('refresh-categories');
        $this->dispatch('OpenEditModal');
    }

    public function update(): void
    {
        $this->validate([
            'upd_name' => 'required|min:3|max:255',
        ]);

        $data = [
            'name' => $this->upd_name,
            'parent' => $this->upd_parent_id ?? 0
        ];

        if (!is_null($this->upd_icon)) {
            $imageUrl = $this->storeUploadedUpdateFile();
            $data['icon'] = $imageUrl;
        }

        Category::query()->findOrFail($this->upd_id)->update($data);

        $this->dispatch('reset-modal');
        $this->dispatch('refresh-categories');
    }


    public function render()
    {
        return view('livewire.categories.all');
    }

    #[On('refresh-categories')]
    public function refreshCategories(): void
    {
        $this->categories = Category::query()->select('id','name','icon')->with('child')->get();
    }

    public function openSubCategoryModal($id)
    {
        $this->sub_name = '';
        $this->sub_id = $id;
        $this->dispatch('OpenSubModal');
    }

    public function saveSub()
    {
        Category::query()->create([
            'name' => $this->sub_name,
            'parent' => $this->sub_id,
            'icon' => $this->sub_icon
        ]);
    }

    private function storeUploadedFile(): string
    {
        $extension = $this->icon->getClientOriginalExtension();
        $randomName = uniqid('image_', true) . '.' . $extension;
        return $this->icon->storeAs('uploads', $randomName, 'public');
    }

    private function storeUploadedUpdateFile(): string
    {
        $extension = $this->upd_icon->getClientOriginalExtension();
        $randomName = uniqid('image_', true) . '.' . $extension;
        return $this->upd_icon->storeAs('uploads', $randomName, 'public');
    }


    private function storeUploadedSubFile(): string
    {
        $extension = $this->sub_icon->getClientOriginalExtension();
        $randomName = uniqid('image_', true) . '.' . $extension;
        return $this->sub_icon->storeAs('uploads', $randomName, 'public');
    }
}
