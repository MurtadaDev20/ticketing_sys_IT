<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\Ticket;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $supports = Support::get();
        return view('layouts.admin.backend.evaluation_support',compact('supports'));
    }

    public function evaluation(Request $request)
    {
        $request->validate([
            'support' => 'required',
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $from = $request->input('from');
        $to = $request->input('to');

        $tickets = Ticket::where('support_id', $request->support)
            ->whereBetween('created_at', [$from, $to])
            ->with('user', 'catigory', 'status', 'support')
            ->get();

        // $sumDegrees = $tickets->sum('degree');
         $sumDegrees = $tickets->count('degree');
        $averageDegree = $tickets->isNotEmpty() ? $tickets->avg('degree') : 0;

        // Fetch support name
        $support = Support::find($request->support);

        return response()->json([
            'support_name' => $support->name,
            'from' => $from,
            'to' => $to,
            'sumDegrees' => $sumDegrees,
            'averageDegree' => $averageDegree,
        ]);
    }

}
