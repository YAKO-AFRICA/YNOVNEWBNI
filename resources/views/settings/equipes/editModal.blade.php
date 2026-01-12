<div class="modal fade " id="EditEquipe{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="margin-top:0; margin-right: 0">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une equipe</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="btn" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('setting.equipe.update', $item->id) }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">
                    
                        <!-- Fieldset equipe -->
                        <fieldset class="border p-3">

                            <legend class="float-none w-auto px-2"><small>Information de l'equipe</small></legend>
                            
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-12 col-lg-12">
                                    <label for="libelle" class="form-label">Libellé</label>
                                    <input type="text" id="libelle" name="libelleequipe" class="form-control" value="{{ $item->libelleequipe }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="nomresponsable" class="form-label">Nom du Responsable</label>
                                    <input type="text" id="nomresponsable" name="nomresponsable" class="form-control" value="{{ $item->nomresponsable }}" required>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="coderesponsable" class="form-label">Code Responsable</label>
                                    <input type="text" id="coderesponsable" name="coderesponsable" class="form-control" value="{{ $item->coderesponsable }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6 form-group">
                                    <label for="codezone" class="form-label">Zone</label>
                                    <select name="codezone" id="codezone" id="codezone" class="form-select">
                                        <option value="{{ $item->codezone }}">{{ $item->zone->libellezone }}</option>
                                        @foreach ($zones as $zone)
                                            <option class="form-control" value="{{ $zone->id }}">{{ $zone->libellezone }}</option> 
                                        @endforeach
                                    </select>
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