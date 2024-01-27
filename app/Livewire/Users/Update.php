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
    public $name;

    public $email;

    public $mobile;

    #[Rule('mimes:jpeg,png,jpg,gif|max:2048')]
    public $image;

    #[On('edit-user')]
    public function edit($id): void
    {
        $user = User::query()
            ->select('id', 'name', 'mobile', 'email')
            ->find($id);

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
    }

    public function update(): void
    {
        User::query()->findOrFail($this->id)->update([
            'name' => $this->name,
            'mobile' => $this->mobile ?? '',
            'profile_photo_path' => $this->image ? storeUploadedFile($this->image, 'upload') : '',
        ]);

        $this->dispatch('refresh-users');
        $this->dispatch('reset-modal');
    }

    public function render()
    {
        return view('livewire.users.update');
    }
}
