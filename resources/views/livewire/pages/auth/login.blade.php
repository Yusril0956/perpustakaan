<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {

    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(
            default: route('home', absolute: false),
            navigate: true
        );
    }
};
?>

<div class="relative bg-white p-2 border-2 border-ink/20 shadow-2xl">
    <div class="border-[3px] border-ink p-10 md:p-14 relative bg-[#fdfbf7]">

        @if (session('status'))
            <div class="font-medium text-sm text-green-600 mb-4">
                {{ session('status') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="text-center mb-16 border-b-2 border-ink/10 pb-10">
            <h2 class="text-4xl font-serif italic text-ink font-black mb-3">
                Login
            </h2>

            <span
                class="text-[11px] font-mono uppercase tracking-[0.4em] text-ink font-bold py-1 px-4 bg-ink/5 border border-ink/10">
                formulir login
            </span>
        </div>

        <form wire:submit="login" class="space-y-10">

            <div class="grid grid-cols-1 gap-10">

                <x-forms.input label="01. Email" wire:model="form.email" placeholder="test@test.com" type="email" />

                <x-forms.input label="02. Kata Sandi" wire:model="form.password" placeholder="........."
                    type="password" />

                <label class="flex items-center gap-2 text-sm text-muted">
                    <input type="checkbox" wire:model="form.remember">
                    Ingat saya
                </label>

            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-8 border-t-2 border-ink/10">

                <a href="{{ route('register') }}" wire:navigate
                    class="text-sm font-mono text-muted hover:text-ink underline underline-offset-4 transition-colors">
                    Belum punya akun?
                </a>

                <x-ui.button variant="outline" type="submit" iconRight="heroicon-o-arrow-right" size="sm">
                    Daftar
                </x-ui.button>

            </div>

        </form>

    </div>
</div>