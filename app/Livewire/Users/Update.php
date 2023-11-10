<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Update extends Component
{

    public $id;

    #[Rule('required')]
    public $name,$email,$mobile;

    #[On('edit-user')]
    public function edit($id){
        $user = User::query()
            ->select('id','name','mobile','email')
            ->find($id);

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
    }

    public function update(){
        $p=User::query()->findOrFail($this->id);
        $p->update([
            'name' => $this->name,
            'mobile' => $this->mobile
        ]);

        $this->dispatch('refresh-users');
        $this->dispatch('reset-modal');
    }
    public function render()
    {
        return view('livewire.users.update');
    }
}
