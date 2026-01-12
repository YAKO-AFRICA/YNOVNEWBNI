<div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFileModalLabel">Nouveau fichier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('file.storeFile') }}" method="POST" enctype="multipart/form-data" class="submitForm">
                    @csrf

                    <div class="form-group">
                        <label for="files" class="form-label my-3">Fichiers à uploader (multiple)</label>
                        <input type="file" class="form-control" id="files" name="files[]" multiple required>
                    </div>

                    <div class="form-group my-3">
                        <label for="folder_id">Dossier de destination</label>
                        <select class="form-control" id="folder_id" name="folder_id">
                            <option value="">Racine (aucun dossier)</option>
                            @foreach ($allFolders as $folder)
                                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label my-3">Description (pour tous les fichiers)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary my-3 float-right">Uploader les fichiers</button>
                </form>
            </div>

        </div>
    </div>
</div>
