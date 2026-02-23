<?php

namespace App\Livewire\Member\Profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    #[Validate('required|current_password')]
    public $current_password = '';

    #[Validate('required|string|min:8|confirmed')]
    public $password = '';

    #[Validate('required|string|min:8')]
    public $password_confirmation = '';

    public $success = false;

    public function updatePassword()
    {
        $this->validate();

        auth()->user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset();
        $this->success = true;

        $this->dispatch('password-updated');
        $this->js('setTimeout(() => { window.location.reload(); }, 2000)');
    }

    public function render()
    {
        return view('livewire.member.profile.update-password-form');
    }
}
