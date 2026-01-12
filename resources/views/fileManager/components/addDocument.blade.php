<div class="modal fade" id="addFolderModal" tabindex="-1" aria-labelledby="addFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFolderModalLabel">Nouveau dossier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="folderForm" action="{{ route('file.storeFolder') }}" method="POST" class="submitForm">
                    @csrf
                    <div class="mb-3">
                        <label for="folderName" class="form-label">Nom du dossier</label>
                        <input type="text" name="name" class="form-control" id="folderName" required
                            placeholder="Entrez le nom du dossier">
                    </div>
                    
                    <div class="mb-3">
                        <label for="folderParent" class="form-label">Dossier parent (optionnel)</label>
                        <select class="form-select" name="folderParent_id" id="folderParent">
                            <option value="">-- Racine (aucun dossier parent) --</option>
                            @foreach($allFolders as $folder)
                                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="folderDescription" class="form-label">Description (optionnel)</label>
                        <textarea class="form-control" name="description" id="folderDescription" rows="2"
                            placeholder="Description du dossier"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="isPrivate" value="true" class="form-check-input" id="folderPrivate">
                        <label class="form-check-label" for="folderPrivate">Dossier privé</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submitFolder">
                            <i class="bx bx-save me-2"></i>Créer le dossier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>