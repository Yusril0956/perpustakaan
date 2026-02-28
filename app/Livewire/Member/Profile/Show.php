<?php

namespace App\Livewire\Member\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    public $loans = [];
    public $activeLoans = [];

    protected $rules = [
        'photo' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadLoans();
    }

    public function loadLoans()
    {
        $this->activeLoans = $this->user->activeLoans()->get();
        $this->loans = $this->user->loans()
            ->with('book')
            ->latest()
            ->limit(10)
            ->get();
    }

    public function savePhoto()
    {
        if (!$this->photo)
            return;

        $this->validate();

        if ($this->user->profile_photo_path) {
            Storage::disk('public')->delete($this->user->profile_photo_path);
        }

        $this->user->profile_photo_path = $this->photo->store('profile-photos', 'public');
        $this->user->save();

        $this->photo = null;

        $this->dispatch('photo-saved');
    }

    public function removePhoto()
    {
        if ($this->user->profile_photo_path) {
            Storage::disk('public')->delete($this->user->profile_photo_path);
        }

        $this->user->profile_photo_path = null;
        $this->user->save();

        $this->dispatch('photo-removed');
    }

    public function render()
    {
        return view('livewire.member.profile.show');
    }
}