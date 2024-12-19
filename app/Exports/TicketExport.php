<?php
namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $tickets = Ticket::whereIn('status_id', ['3'])
                ->with('support', 'catigory', 'status', 'user')
                ->take(500) 
                ->get();

        // Modify the collection to return the relevant data for export
        $exportData = $tickets->map(function ($ticket) {
            return [
                'ID' => $ticket->id,
                'User' => $ticket->user->name ?? 'N/A',
                'Email' => $ticket->user->email ?? 'N/A',
                'Ticket_Title' => $ticket->ticket_title ?? 'N/A',
                'catigory' => $ticket->catigory->cat_name ?? 'N/A', // Corrected 'catigory' to 'category'
                'Status' => $ticket->status->name ?? 'N/A',
                'Support' => $ticket->support->name ?? 'N/A',
                'Degree' => $ticket->degree ?? 'N/A',
                'Created At' => $ticket->created_at,
                'Closed At' => $ticket->close_ticket_at,
            ];
        });

        return $exportData;
    }

    /**
     * Add headings to the exported file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Email',
            'Ticket_Title',
            'Category',
            'Status',
            'Support',
            'Degree',
            'Created At',
            'Closed At'
        ];
    }
}
