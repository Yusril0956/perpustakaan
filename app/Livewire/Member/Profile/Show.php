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
    public $name;
    public $email;
    public $phone;
    public $address;
    public $photo;
    public $isEditing = false;

    public $loans = [];
    public $activeLoans = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'photo' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
        $this->address = $this->user->address ?? '';
        $this->loadLoans();
    }

    public function loadLoans()
    {
        $this->activeLoans = $this->user->activeLoans()->get();
        $this->loans = $this->user->loans()
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    public function toggleEdit()
    {
        $this->isEditing = !$this->isEditing;
        if (!$this->isEditing) {
            // Reset values if canceling edit
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->phone = $this->user->phone ?? '';
            $this->address = $this->user->address ?? '';
            $this->photo = null;
        }
    }

    public function save()
    {
        $this->validate();

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->phone = $this->phone;
        $this->user->address = $this->address;

        if ($this->photo) {
            // Delete old photo if exists
            if ($this->user->profile_photo_path) {
                Storage::disk('public')->delete($this->user->profile_photo_path);
            }

            $path = $this->photo->store('profile-photos', 'public');
            $this->user->profile_photo_path = $path;
        }

        $this->user->save();
        $this->isEditing = false;
        $this->photo = null;

        session()->flash('success', 'Profil berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.member.profile.show');
    }
}
