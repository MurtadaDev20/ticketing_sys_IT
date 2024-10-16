<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Catigory;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketSupportController extends Controller
{
    public function index(Request $request)
    {

        return view('layouts.support.backend.monitor_tickets_support');
    }

    

}
