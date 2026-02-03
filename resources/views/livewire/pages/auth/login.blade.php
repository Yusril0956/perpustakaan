<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-auth-session-status class="mb-4 text-sm" :status="session('status')" />

    <form wire:submit="login" class="space-y-4">
        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Email" />
            <input wire:model="form.email" id="email" type="email" required autofocus class="form-input w-full mt-1" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-1 text-xs" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" value="Password" />
            <input wire:model="form.password" id="password" type="password" required class="form-input w-full mt-1" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-xs" />
        </div>

        {{-- Remember --}}
        <label class="flex items-center gap-2 text-sm text-muted">
            <input type="checkbox" wire:model="form.remember">
            Remember me
        </label>

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('password.request') }}" wire:navigate class="text-sm underline text-muted hover:text-ink">
                Forgot password?
            </a>

            <button type="submit" class="btn-primary">
                Log in
            </button>
        </div>
    </form>
</div>