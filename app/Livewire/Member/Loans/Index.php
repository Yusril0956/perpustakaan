<?php

namespace App\Livewire\Member\Loans;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.member.loans.index');
    }
}
