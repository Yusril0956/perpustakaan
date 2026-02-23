<?php

namespace App\Livewire\Member\Profile;

use Livewire\Component;

class PersonalShelf extends Component
{
    public function render()
    {
        $activeLoans = auth()->user()->activeLoans()->get();

        return view('livewire.member.profile.personal-shelf', [
            'loans' => $activeLoans,
        ]);
    }
}
