<?php

namespace App\Livewire;

use App\Events\TicketClose;
use App\Mail\TicketClosed;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Jobs\SendTicketClosedEmail;
use App\Models\Comment;

class SupportTicketMonitor extends Component
{
    use WithPagination;

    public $search = ''; // For search functionality

    public $commentText;
    protected $rules = [
        'commentText' => 'required|string|max:500',
    ];
    protected $listeners = ['asginTo' => 'render'];
    protected $paginationTheme = 'bootstrap';




    public function closeTicket($ticket_id)
    {
        $this->validate();

        $ticket = Ticket::findOrFail($ticket_id);
        $category = $ticket->catigory;
        $category_degree = $category->cat_grade;

        $comment = Comment::create([
            'comment' => $this->commentText,
        ]);

        // Update ticket status and degree
        $ticket->status_id = '3';
        $ticket->close_ticket_at = now();
        $ticket->degree = $category_degree;
        $ticket->comment_id = $comment->id;
        $ticket->save();




        toastr()->success('Ticket closed successfully!');
        $this->reset(['commentText']);
        $this->render();

        event(new TicketClose($ticket));
        // Dispatch the jobs to queue
        SendTicketClosedEmail::dispatch($ticket);
    }

    public function render()
    {
        $support_id = Auth::guard('support')->user()->id;

        // Filtering tickets based on search input and status
        $tickets = Ticket::where('support_id', $support_id)
            ->whereIn('status_id', ['1', '2'])
            ->where(function($query) {
                if ($this->search) {
                    $query->where('ticket_title', 'like', '%'.$this->search.'%')
                          ->orWhereHas('user', function ($q) {
                              $q->where('name', 'like', '%'.$this->search.'%')
                                ->orWhere('email', 'like', '%'.$this->search.'%');
                          });
                }
            })
            ->with('admin', 'catigory', 'status', 'user','subCategory','comment')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.support-ticket-monitor', compact('tickets'));
    }
}
