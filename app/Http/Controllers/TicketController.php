<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        $tickets=Ticket::with(['ticketType','customer','order'])->paginate(env('NUMBER_OF_PAGES'));
        return view('admin.tickets.tickets')->with([
            'tickets'=>$tickets,
        ]);
    }
}
