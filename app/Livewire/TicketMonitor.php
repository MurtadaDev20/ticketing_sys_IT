<?php

namespace App\Livewire;

use App\Models\Support;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
class TicketMonitor extends Component
{
    use WithPagination;

    public $search = '';
    protected $listeners = ['createdTicket' => 'render'];

    public function render()
    {
        $supports = Support::all();

        // Fetch tickets with pagination and searching
        $tickets = Ticket::whereIn('status_id', ['1', '2'])
            ->with('support', 'catigory', 'status', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.ticket-monitor', compact('tickets', 'supports'));
    }
}
