<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\User;
use App\Mailers\AppMailer;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(): View
    {
        $categories = Category::all();
        $tickets = Ticket::with('user')->latest()->paginate(10);
        return view('tickets.index', compact('tickets'), compact('categories'));
        
    }

    public function create(): View
    {
        //
        $categories = Category::all();
        return view('tickets.index', compact('categories'));
    }

    public function store(Request $request, AppMailer $mailer)
    {
        // Store Ticket info
        // check that the description does not exceed 255 characters....
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        
        $user_id=auth()->user()->id;
        $title = $request->input('title');
        $category = $request->input('category');
        $message = $request->input('message');
        $data=array('title'=>$title,"category"=>$category,"message"=>$message);
        $ticket = new Ticket([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'category_id' => $request->input('category'),
            'message' => $request->input('message'),
            'status' => "Open"
        ]);
        $ticket->save();        
        return redirect(route('tickets.index'));
        
    }
    
    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        return view('tickets.user_tickets', compact('tickets'));
    }

    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        return view('tickets.show', compact('ticket'));
    }
    
    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();
        $ticketOwner = $ticket->user;
        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        return redirect()->back()->with("status", "The ticket has been closed.");
    }

    public function edit(Ticket $ticket): View
    {
        $this->authorize('update', $ticket);
 
        return view('tickets.edit', [
            'ticket' => $ticket,
        ]);
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        //
        $this->authorize('update', $ticket);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $ticket->update($validated);
 
        return redirect(route('tickets.index'));
    }

    public function destroy(Ticket $ticket)
    {
        //
    }
}
