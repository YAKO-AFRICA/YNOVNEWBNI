<div class="modal fade " id="addNewMotif" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="margin-top:0; margin-right: 0">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Motif</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="btn" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('setting.motifRejetPrestation.store') }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">
                    <fieldset class="border p-3">
                        <legend class="float-none w-auto px-2"><small>Information de le motif</small></legend>
                        <div class="row">
                            <div class="mb-3 col-sm-12 col-md-12 col-lg-12">
                                <label for="libelle" class="form-label">Libelle <span><span class="text-danger">*</span></span></label>
                                <textarea name="libelle" id="libelle" class="form-control" required cols="30" rows="5"></textarea>
                                
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>