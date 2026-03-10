<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Livewire\Forms\Admin\Users\UserForm;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Edit extends Component
{
    public UserForm $form;

    public function mount(User $user)
    {
        $this->authorize('update', $user);
        $this->form->setUser($user);
    }

    public function save()
    {
        $this->form->update();

        session()->flash('success', 'User berhasil diperbarui.');
        return $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
