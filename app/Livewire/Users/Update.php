<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{

    use WithFileUploads;

    public $id;

    #[Rule('required')]
    public $name,$email,$mobile;

    #[Rule('mimes:jpeg,png,jpg,gif|max:2048')]
    public $image;

    #[On('edit-user')]
    public function edit($id): void
    {
        $user = User::query()
            ->select('id','name','mobile','email')
            ->find($id);

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
    }

    public function update(): void
    {
        $user = User::query()->findOrFail($this->id);

        $data = [
            'name' => $this->name,
            'mobile' => $this->mobile,
        ];

        if (!is_null($this->image)) {
            $imageUrl = $this->storeUploadedFile();
            $data['profile_photo_path'] = $imageUrl;
        }

        $user->update($data);

        $this->dispatch('refresh-users');
        $this->dispatch('reset-modal');
    }


    private function storeUploadedFile(): string
    {
        $extension = $this->image->getClientOriginalExtension();
        $randomName = uniqid('image_', true) . '.' . $extension;
        return $this->image->storeAs('uploads', $randomName, 'public');
    }

    public function render()
    {
        return view('livewire.users.update');
    }
}
