<?php

namespace App\Livewire\Admin\Loans;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Validation extends Component
{
    public function render()
    {
        return view('livewire.admin.loans.validation');
    }
}
