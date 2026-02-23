<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ShowProfile extends Component
{
    public function render()
    {
        return view('livewire.member.show-profile');
    }
}
