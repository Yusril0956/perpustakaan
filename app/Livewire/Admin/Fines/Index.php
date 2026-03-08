<?php

namespace App\Livewire\Admin\Fines;

use App\Models\Fine;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $filterStatus = ''; // '', 'UNPAID', 'PAID'

    public function markAsPaid(int $fineId): void
    {
        $fine = Fine::findOrFail($fineId);

        if ($fine->status === 'PAID') {
            return; // Guard: jangan proses dua kali
        }

        $fine->update([
            'status' => 'PAID',
            'paid_at' => now(),
        ]);

        session()->flash('success', 'Denda berhasil ditandai lunas.');
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $fines = Fine::with(['borrowing.user', 'borrowing.book'])
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->latest()
            ->paginate(15);

        $stats = [
            'total_unpaid' => Fine::where('status', 'UNPAID')->count(),
            'total_paid' => Fine::where('status', 'PAID')->count(),
            'revenue' => Fine::where('status', 'PAID')->sum('amount'),
        ];

        return view('livewire.admin.fines.index', compact('fines', 'stats'));
    }
}