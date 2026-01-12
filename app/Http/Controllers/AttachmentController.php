<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Services\AttachmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function download(Attachment $attachment)
    {
        // Vérifiez les autorisations ici selon votre logique
        if (!Storage::disk('public')->exists($attachment->path)) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $attachment->path,
            $attachment->original_name
        );
    }

    public function destroy(Attachment $attachment, AttachmentService $attachmentService)
    {
        $this->authorize('delete', $attachment);
        
        $attachmentService->delete($attachment);
        
        return back()->with('success', 'Pièce jointe supprimée avec succès');
    }
}