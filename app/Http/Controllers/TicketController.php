<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketActivity;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create_ticket(Request $request) {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type; 

        $ticket = Ticket::create([
            'tenant_id' => $request->tenant_id
        ]);

        $activity = TicketActivity::create([
            'ticket_id' => $ticket->id
        ]);

        return back();

    }

    public function list_tickets(Request $request) {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;        

        $tickets = Ticket::all();
        if ($profile_type == 'admin' || $profile_type == 'staff') {
            return view('ticket.staff-list', compact('tickets'));
        } else if ($profile_type == 'tenant') {
            
        } else {

        }

    }

    public function detail_ticket(Request $request) {

        $user = $request->user();
        $profile = $user->profile;
        $profile_id = $profile->id; 
        $profile_type = $profile->type; 
        $tenant_id = $profile->tenant_id;

        $ticket_id = (int) $request->route('ticket_id');        

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $ticket = Ticket::find($ticket_id);
            return view('ticket.staff-detail', compact('ticket'));
        } else if ($profile_type == 'tenant') {
            $ticket = Ticket::where([
                ['id', '=', $ticket_id],
                ['tenant_id','=', $tenant_id]
            ])->first();
            return view('ticket.tenant-detail', compact('ticket'));
        } else {
            return back();
        }
    }

    public function update_ticket(Request $request) {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type; 
        $tenant_id = $profile->tenant_id;

        $ticket_id = (int) $request->route('ticket_id');        

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $ticket = Ticket::find($ticket_id);
            
            $ticket->update([]);
        } else if ($profile_type == 'tenant') {
            $ticket = Ticket::where([
                ['id', '=', $ticket_id],
                ['tenant_id','=', $tenant_id]
            ])->first();
            
            $ticket->update([]);
        } else {
            
        }        

        return back();
    }
}
