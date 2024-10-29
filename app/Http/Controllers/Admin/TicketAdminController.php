<?php

namespace App\Http\Controllers\Admin;

use App\Events\TicketAsginTo;
use App\Events\TicketDelete;
use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Exports\TicketExport;
use App\Mail\TicketAssigned;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TicketAdminController extends Controller
{

    public function index(Request $request)
    {
        $supports =Support::get();

        $tickets = Ticket::whereIn('status_id',['1','2'])
                 ->with('support', 'catigory', 'status','user')
                 ->orderBy('created_at', 'desc')
                 ->paginate(20);
        return view('layouts.admin.backend.monitor_tickets_admin',compact('tickets','supports'));
    }

    public function assignTo(Request $request, $ticket_id, $support_id)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->support_id = $support_id;
        $ticket->status_id = '2';
        $ticket->admin_id = $admin_id;
        $ticket->save();


        try {
            Mail::to($ticket->support->email)->send(new TicketAssigned($ticket));
        } catch (\Exception $e) {
            toastr()->error('Failed to send Email');
        }
        event(new TicketAsginTo($ticket));


        toastr()->success('Ticket assigned successfully!');
        return  redirect()->route('admin.AllTickets');
    }

    public function completeTickets()
    {
        $tickets = Ticket::where('status_id','3')
                 ->with('support', 'catigory', 'status','user')
                 ->orderBy('created_at', 'desc')
                 ->paginate(20);


        return view('layouts.admin.backend.complete_tickets_admin',compact('tickets'));
    }

    public function exportData()
        {
            return Excel::download(new TicketExport, 'tickets.xlsx');
        }

        public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $fullPath =public_path('upload/ticket/' . $ticket->ticket_image);
    if ($ticket->ticket_image && file_exists($fullPath)) {
        unlink($fullPath);
    }
    if (hasInternetConnection()) {
        event(new TicketDelete($ticket));
    } else {
        Log::warning('No internet connection. Could not dispatch TicketCreated event.');
    }
        $ticket->delete();

        toastr()->success('Delete Ticket Successfully');
        return  redirect()->route('admin.AllTickets');
    }
}
