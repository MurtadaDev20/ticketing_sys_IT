<?php

namespace App\Livewire;

use App\Models\Approval;
use App\Models\Catigory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovalManager extends Component
{
    use WithPagination;
    public $categories;
    public $users;
    public $selectedCategory;
    public $selectedUser;

    public function mount()
    {
        $this->categories = Catigory::all();
        $this->users = User::all();
    }

    public function addApproval()
    {
        $this->validate([
            'selectedCategory' => 'required|exists:catigories,id',
            'selectedUser' => 'required|exists:users,id',
        ]);

        Approval::create([
            'category_id' => $this->selectedCategory,
            'user_id' => $this->selectedUser,
        ]);

        session()->flash('success', 'Approval added successfully.');
        $this->reset(['selectedCategory', 'selectedUser']);
    }

    public function render()
    {
        return view('livewire.approval-manager', [
            'approvals' => Approval::with(['user', 'category'])->latest()->paginate(10)
        ]);
    }
}
