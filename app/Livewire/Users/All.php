<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Component;
use Livewire\Attributes\On;

class All extends Component
{
    use RefreshDatabase;

    public $users;

    public function mount(): void
    {
        $this->users = User::query()
            ->select('id','name','mobile','email','is_superuser','is_staff')
                ->get();
    }


    public function render()
    {
        return view('livewire.users.all');
    }

    #[On('goOn-Delete')]
    function delete($id): void
    {
        User::query()->find($id)->delete();
        $this->dispatch('deleted');
    }

    #[On('refresh-users')]
    public function refreshUsers(): void
    {
        $this->users = User::query()
            ->select('id','name','mobile','email','is_superuser','is_staff')
            ->get();
    }

}
