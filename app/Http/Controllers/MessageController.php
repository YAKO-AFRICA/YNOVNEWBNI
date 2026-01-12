<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Services\AttachmentService;

class MessageController extends Controller
{

     

// Modifiez la méthode store
    // public function store(Request $request, Ticket $ticket, AttachmentService $attachmentService)
    // {
    //     $this->authorize('view', $ticket);

    //     $request->validate([
    //         'content' => 'required_without:attachments|string|nullable',
    //         // 'attachments.*' => 'file|max:10240',
    //     ]);

    //     $message = new Message([
    //         'content' => $request->content,
    //         'user_id' => auth()->id(),
    //     ]);

    //     $ticket->messages()->save($message);

    //     // Gestion des pièces jointes
    //     if ($request->hasFile('attachments')) {
    //         foreach ($request->file('attachments') as $file) {
    //             $attachmentService->upload($file, $message, auth()->id());
    //         }
    //     }

    //     $ticket->update(['status' => 'answered']);

    //     return back()->with('success', 'Message envoyé avec succès!');
    // }

    public function store(Request $request, Ticket $ticket, AttachmentService $attachmentService)
    {
        $this->authorize('view', $ticket);

        $request->validate([
            'content' => 'required_without:attachments|string|nullable',
            'attachments.*' => 'file|max:10240',
        ]);

        $message = new Message([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        $ticket->messages()->save($message);

        // Gestion des pièces jointes
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachmentService->upload($file, $message, auth()->id());
            }
        }

        $ticket->update(['status' => 'answered']);

        // Charger les relations nécessaires pour la réponse
        $message->load(['user.membre', 'attachments']);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}