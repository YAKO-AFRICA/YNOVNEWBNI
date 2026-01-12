 <!-- Reply Form -->
 <div class="card shadow-sm">
    <div class="card-header bg-light">
        <h4 class="h5 mb-0"><i class="fas fa-reply me-2"></i>Répondre</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('ticket.messages.store', $ticket) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">Message</label>
                <textarea name="content" id="content" rows="4" class="form-control" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="attachments" class="form-label">Pièces jointes</label>
                <input type="file" name="attachments[]" id="attachments" class="form-control" multiple>
                <div class="form-text">Formats acceptés : PDF, images, documents. Max 10MB par fichier.</div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-1"></i> Envoyer
                </button>
            </div>
        </form>
    </div>
</div>