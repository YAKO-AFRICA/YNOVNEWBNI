<div class="modal fade " id="EditReseau{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="margin-top:0; margin-right: 0">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le reseau</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="btn" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('setting.reseau.update', $item->id) }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body" id="editReseau{{ $item->id }}">
                    
                        <!-- Fieldset Réseau -->
                        <fieldset class="border p-3" id="fieldsetReseau{{ $item->id }}">

                            <legend class="float-none w-auto px-2"><small>Information du reseau</small></legend>
                            
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-12 col-lg-12">
                                    <label for="libelle" class="form-label">Libellé</label>
                                    <input type="text" id="libelle" name="libelle" class="form-control" value="{{ $item->libelle }}" required>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="nomresponsable" class="form-label">Nom du Responsable</label>
                                    <input type="text" id="nomresponsable" name="nomresponsable" class="form-control" value="{{ $item->nomresponsable }}" required>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="coderesponsable" class="form-label">Code Responsable</label>
                                    <input type="text" id="coderesponsable" name="coderesponsable" value="{{ $item->coderesponsable }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="codebranche" class="form-label">Code Branche</label>
                                    <input type="text" id="codebranche" name="codebranche" value="{{ $item->codebranche }}" class="form-control">
                                </div>
                                
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="codepartenaire" class="form-label">Code Partenaire</label>
                                    <input type="text" id="codepartenaire" name="codepartenaire" value="{{ $item->codepartenaire }}" class="form-control">
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