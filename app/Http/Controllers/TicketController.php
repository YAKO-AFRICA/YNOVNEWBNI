<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\AttachmentService;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request, AttachmentService $attachmentService)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'attachments.*' => 'file|max:10240',
        ]);
    
        $ticket = Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => auth()->id(),
            'status' => 'open',
        ]);
    
        if ($request->hasFile('attachments')) {
            
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $attachmentService->upload($file, $ticket, auth()->id());
                }
            }
        }
    
        return redirect()->route('ticket.ticket.show', $ticket)->with('success', 'Ticket créé avec succès!');
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('tickets.show', compact('ticket'));
    }



    public function adminIndex()
    {
        $tickets = Ticket::with('user')->latest()->get();
        return view('admin.tickets.index', compact('tickets'));
    }
}