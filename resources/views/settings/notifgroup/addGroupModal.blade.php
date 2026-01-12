<div class="modal fade" id="addNewGroup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('setting.addGroup') }}" class="submitForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un groupe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branche</label>
                        <select name="branche" class="form-select">
                            <option value="BANKASS">BANKASS</option>
                            <option value="COM">COM</option>
                            <option value="COURTIER">COURTIER</option>
                            <option value="IND">IND</option>
                            <option value="PARTICULIER">PARTICULIER</option>
                            <option value="OTHER">OTHER</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
