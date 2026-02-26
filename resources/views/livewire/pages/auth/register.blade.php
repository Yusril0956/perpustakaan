<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $address = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        $user->assignRole('anggota');

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="space-y-4">
        {{-- Name --}}
        <div>
            <x-input-label for="name" value="Name" />
            <input wire:model="name" id="name" type="text" required class="form-input w-full mt-1">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Email" />
            <input wire:model="email" id="email" type="email" required class="form-input w-full mt-1">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        {{-- Address --}}
        <div>
            <x-input-label for="address" value="Address" />
            <input wire:model="address" id="address" type="text" required class="form-input w-full mt-1">
            <x-input-error :messages="$errors->get('address')" class="mt-1 text-xs" />
        </div>

        {{-- Phone --}}
        <div>
            <x-input-label for="phone" value="Phone Number" />
            <input wire:model="phone" id="phone" type="number" required class="form-input w-full mt-1" maxlength="12">
            <x-input-error :messages="$errors->get('phone')" class="mt-1 text-xs" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" value="Password" />
            <input wire:model="password" id="password" type="password" required class="form-input w-full mt-1">
        </div>

        {{-- Confirm --}}
        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <input wire:model="password_confirmation" id="password_confirmation" type="password" required
                class="form-input w-full mt-1">
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('login') }}" wire:navigate class="text-sm underline text-muted hover:text-ink">
                Already registered?
            </a>

            <button type="submit" class="btn-primary">
                Register
            </button>
        </div>
    </form>
</div>