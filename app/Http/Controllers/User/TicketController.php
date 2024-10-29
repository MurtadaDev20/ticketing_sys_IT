<?php

namespace App\Http\Controllers\User;

use App\Events\TicketCreated;
use App\Http\Controllers\Controller;
use App\Mail\TicketCreatedMail;
use App\Models\Catigory;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $tickets = Ticket::where('user_id', $user_id)
                 ->with('support', 'catigory', 'status')
                 ->orderBy('created_at', 'desc')
                 ->paginate(20);
        return view('layouts.user.backend.show_all_tickets_user',compact('tickets'));
    }

    public function addTicket()
    {
        $user_id = Auth::user()->id;
        $categories = Catigory::get();
        $ticketData = Ticket::where('user_id', $user_id);
        return view('layouts.user.backend.add_new_ticket',compact('ticketData','categories'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        // Validate the request
        $validator = Validator::make($request->all(), [
            'ticket_title' => 'required|string|max:255',
            'ticket_description' => 'required|string',
            'category' => 'required|exists:catigories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If validation fails, return back with error messages
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/ticket'), $imageName);
        } else {
            $imageName = 'upload/no_image.jpg';
        }

        $ticket = Ticket::create([
            'ticket_title' => $request->ticket_title,
            'ticket_desc' => $request->ticket_description,
            'ticket_cat_id' => $request->category,
            'user_id' => $user_id,
            'status_id'=>'1',
            'degree'=>'0',
        ]);

        $primaryRecipient = ['murtadait20@gmail.com' , 'murtada.luqman@mansourbank.com'];
        // $ccRecipients = ['cc1@example.com', 'cc2@example.com'];

        try {
            Mail::to($primaryRecipient)->send(new TicketCreatedMail($ticket));
        } catch (\Exception $e) {
            toastr()->error('Failed to send Email');
        }


        event(new TicketCreated($ticket));
        // if (hasInternetConnection()) {

        // } else {
        //     Log::warning('No internet connection. Could not dispatch TicketCreated event.');
        // }

        toastr()->success('Add Ticket Successfully');
        return  redirect()->route('user.AllTickets');

    }


}
