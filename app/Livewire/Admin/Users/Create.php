<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Livewire\Forms\Admin\Users\UserForm;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Create extends Component
{
    public UserForm $form;

    public function mount(): void
    {
        $this->authorize('create', User::class);
    }

    public function save()
    {
        $this->form->store();

        session()->flash('success', 'User berhasil ditambahkan.');
        return $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.users.create');
    }
}
