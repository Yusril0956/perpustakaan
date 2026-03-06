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
        $validated['verify'] = false;

        event(new Registered($user = User::create($validated)));

        $user->assignRole('anggota');

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
};
?>

<div class="relative bg-white p-2 border-2 border-ink/20 shadow-2xl">
    <div class="border-[3px] border-ink p-10 md:p-14 relative bg-[#fdfbf7]">

        {{-- Header --}}
        <div class="text-center mb-16 border-b-2 border-ink/10 pb-10">
            <h2 class="text-4xl font-serif italic text-ink font-black mb-3">
                Registrasi Pengguna Baru
            </h2>

            <span
                class="text-[11px] font-mono uppercase tracking-[0.4em] text-ink font-bold py-1 px-4 bg-ink/5 border border-ink/10">
                formulir pendaftaran
            </span>
        </div>

        <form wire:submit="register" class="space-y-10">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">

                <div class="space-y-10">

                    <x-forms.input label="01. Nama Lengkap" wire:model="name" placeholder="..." />

                    <x-forms.input label="02. Alamat Email" wire:model="email" placeholder="test@test.com"
                        type="email" />

                    <x-forms.input label="03. Nomor Telepon" wire:model="phone" placeholder="08xxxxxxxxxx" type="tel" />

                </div>

                <div class="space-y-10">

                    <x-forms.input label="04. Alamat Lengkap" wire:model="address" placeholder="..." />

                    <x-forms.input label="05. Kata Sandi" wire:model="password" placeholder="........."
                        type="password" />

                    <x-forms.input label="06. Konfirmasi Kata Sandi" wire:model="password_confirmation"
                        placeholder="........." type="password" />

                </div>

            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-6 border-t-2 border-ink/10">

                <a href="{{ route('login') }}" wire:navigate class="text-sm underline text-muted hover:text-ink">
                    Sudah punya akun?
                </a>

                <x-ui.button variant="outline" type="submit">
                    Daftar
                </x-ui.button>

            </div>

        </form>

    </div>
</div>