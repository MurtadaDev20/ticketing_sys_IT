<?php

namespace App\Livewire;

use App\Events\TicketCreated;
use App\Jobs\SendEmailToApprovedBy;
use App\Jobs\SendEmailToRejectTicket;
use App\Models\Approval;
use App\Models\Comment;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovalUser extends Component
{
    use WithPagination;

    public $commentText;

    protected $rules = [
        'commentText' => 'required|string|min:5|max:500',
    ];
    public function approvedTicket(Ticket $ticketId )
    {

        // dd($ticketId->id);
        if ($ticketId) {
            $ticketId->update([
                'status_id' => 5,
                'approved_by'=>auth()->user()->id,
                'comment_id' => null
            ]);
            SendEmailToApprovedBy::dispatch($ticketId);
            toastr()->success('Ticket Approved Successfully!');
            event(new TicketCreated($ticketId));
        }
    }
    public function rejectTicket(Ticket $ticketId )
    {


        $this->validate(); // Validate input before proceeding

        if ($ticketId) {
            $comment = Comment::create([
                'comment' => $this->commentText,
            ]);

            $ticketId->update([
                'status_id' => 6,
                'approved_by' => auth()->user()->id,
                'comment_id' => $comment->id
            ]);

            SendEmailToRejectTicket::dispatch($ticketId);

            $this->reset('commentText'); // Reset field after successful action

            toastr()->success('Ticket Rejected');
            event(new TicketCreated($ticketId));
        }
    }


    public function render()
    {

        $categoryIds = Approval::where('user_id', auth()->user()->id)->pluck('category_id');
        $tickets = Ticket::whereIn('ticket_cat_id', $categoryIds)
            ->whereIn('status_id', [4, 5, 6])
            ->paginate(10);

        return view('livewire.approval-user' , [
            'tickets' => $tickets
        ]);
    }
}
