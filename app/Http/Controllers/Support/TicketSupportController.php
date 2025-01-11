<?php

namespace App\Http\Controllers\Support;

use App\Exports\TicketExport;
use App\Http\Controllers\Controller;
use App\Models\Catigory;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TicketSupportController extends Controller
{
    public function index(Request $request)
    {

        return view('layouts.support.backend.monitor_tickets_support');
    }

    public function completeTickets()
    {
        $tickets = Ticket::where('status_id','3')
            ->with('support', 'catigory', 'status','user')
            ->orderBy('created_at', 'desc')
            ->take(500)
            ->paginate(20);


        return view('layouts.support.backend.complete_tickets_support',compact('tickets'));
    }


    public function exportData()
        {
            return Excel::download(new TicketExport, 'tickets.xlsx');
        }

        public function downloadFile(Ticket $file)
        {
            $filePath = storage_path('app/public/' . $file->ticket_image);
            return response()->download($filePath);
        }


}
