<?php

namespace App\Livewire\Member\Profile;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class IdentityCard extends Component
{
    use WithFileUploads;

    #[Validate('nullable|image|max:5120')]
    public $photo = null;

    public function uploadPhoto()
    {
        $this->validate();

        if ($this->photo) {
            $path = $this->photo->storePublicly('profile-photos', 'public');
            auth()->user()->update(['profile_photo_path' => $path]);
            $this->photo = null;
            $this->dispatch('photo-uploaded');
        }
    }

    public function deletePhoto()
    {
        if (auth()->user()->profile_photo_path) {
            \Storage::disk('public')->delete(auth()->user()->profile_photo_path);
            auth()->user()->update(['profile_photo_path' => null]);
            $this->dispatch('photo-deleted');
        }
    }

    public function render()
    {
        return view('livewire.member.profile.identity-card');
    }
}
