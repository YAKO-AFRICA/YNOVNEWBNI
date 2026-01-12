<!-- Create Ticket Modal -->
<div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('ticket.ticket.store') }}" method="POST" enctype="multipart/form-data" id="ticketForm">
                @csrf
                <div class="modal-header bg-light text-success">
                    <h5 class="modal-title" id="createTicketModalLabel">Nouveau ticket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Sujet *</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">Priorité *</label>
                            <select class="form-select" id="priority" name="priority" required>
                                <option value="low">Faible</option>
                                <option value="medium" selected>Moyenne</option>
                                <option value="high">Haute</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Pièces jointes</label>
                        <input class="form-control" type="file" id="attachments" name="attachments[]" multiple>
                        <div class="form-text">Formats acceptés : PDF, images, documents. Max 10MB par fichier.</div>
                    </div>
                    
                    <div id="filePreview" class="d-flex flex-wrap gap-2 mb-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i> Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>