<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function store(Request $request): RedirectResponse
    {
        // Store Ticket info
        // check that the description does not exceed 255 characters....
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        
        // If the length is confirmed, write the ticket
        $request->user()->tickets()->create($validated);*/
        $this->validate($request, [
            
            'message' => 'required'
        ]);
        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id' => $request->input('category'),
            'message' => $request->input('message'),
            'status' => "Open"
        ]);
        $ticket->save();
        //$request->user()->tickets()->create($ticket);
        
        return redirect(route('tickets.index'));
        
    }

    public function show(Ticket $ticket)
    {
        //
        
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
