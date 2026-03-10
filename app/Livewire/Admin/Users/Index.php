<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at'; // Default urutan

    #[Url(history: true)]
    public $sortDir = 'desc'; // Default arah urutan

    // Reset pagination jika ada pencarian baru
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Fungsi untuk mengatur Sorting
    public function setSortBy($sortColumn)
    {
        // Daftar kolom yang diizinkan untuk diurutkan (Keamanan)
        $allowedSorts = ['name', 'email', 'verify', 'created_at'];

        if (!in_array($sortColumn, $allowedSorts)) {
            return;
        }

        if ($this->sortBy === $sortColumn) {
            // Balikkan arah jika kolom yang diklik sama
            $this->sortDir = ($this->sortDir === 'asc') ? 'desc' : 'asc';
            return;
        }

        // Set kolom baru dan default arah 'asc'
        $this->sortBy = $sortColumn;
        $this->sortDir = 'asc';
    }

    #[On('delete-user')]
    public function delete($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('success', 'User berhasil dihapus.');
        }
    }

    #[On('toggle-verify-user')]
    public function toggleVerify($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->verify = !$user->verify;
            $user->save();
            session()->flash('success', 'Status verifikasi user berhasil diubah.');
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(10);

        return view('livewire.admin.users.index', compact('users'));
    }
}
