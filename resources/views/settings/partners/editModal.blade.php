<div class="modal fade" id="EditPartner{{ $item->id }}" tabindex="-1" aria-labelledby="mreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le partenaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('setting.partner.update', $item->id) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                
                        <!-- Informations Générales -->
                        <fieldset class="border p-3 mb-4">
                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Informations Générales</h5></small></legend>
                
                            <div class="form-group mb-3">
                                <label for="code" class="form-label">Code </label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $item->code) }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="logo" class="form-label">Logo </label>
                                <input type="file" name="logo" id="logo" class="form-control">
                                @if($item->logo)
                                    <img src="{{ asset('logos/' . $item->logo) }}" alt="Logo" width="100" class="mt-2">
                                @endif
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="designation" class="form-label">Raison sociale <span class="text-danger">*</span></label>
                                    <input type="text" name="designation" id="designation" class="form-control" value="{{ old('designation', $item->designation) }}" required>
                                </div>
                                <div class="mb-3 col">
                                    <label for="activitesprincipales" class="form-label">Activité principale</label>
                                    <input type="text" name="activitesprincipales" id="activitesprincipales" class="form-control" value="{{ old('activitesprincipales', $item->activitesprincipales) }}">
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="capital" class="form-label">Capital</label>
                                    <input type="number" name="capital" id="capital" class="form-control" value="{{ old('capital', $item->capital) }}">
                                </div>
                                <div class="mb-3 col">
                                    <label for="nrc" class="form-label">N° RC</label>
                                    <input type="text" name="nrc" id="nrc" class="form-control" value="{{ old('nrc', $item->nrc) }}">
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="forme_juridique" class="form-label">Forme juridique</label>
                                    <input type="text" name="forme_juridique" id="forme_juridique" class="form-control" value="{{ old('forme_juridique', $item->formejuridique) }}">
                                </div>
                                <div class="mb-3 col">
                                    <label for="compte_contribuable" class="form-label">Compte contribuable</label>
                                    <input type="text" name="compte_contribuable" id="compte_contribuable" class="form-control" value="{{ old('compte_contribuable', $item->comptecontribuable) }}">
                                </div>
                            </div>
                        </fieldset>
                
                        <!-- Personnes Ressources -->
                        <fieldset class="border p-3 mb-4">
                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Personnes Ressources</h5></small></legend>
                
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="mobile1" class="form-label">Mobile 1</label>
                                    <input type="tel" name="mobile1" id="mobile1" class="form-control" value="{{ old('mobile1', $item->mobile1) }}" placeholder="00 00 00 00 00">
                                </div>
                                <div class="mb-3 col">
                                    <label for="mobile2" class="form-label">Mobile 2</label>
                                    <input type="tel" name="mobile2" id="mobile2" class="form-control" value="{{ old('mobile2', $item->mobile2) }}" placeholder="00 00 00 00 00">
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="adresseemail" id="email" class="form-control" value="{{ old('adresseemail', $item->adresseemail) }}" required>
                                </div>
                                <div class="mb-3 col">
                                    <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                    <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $item->telephone) }}" placeholder="00 00 00 00 00" required>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="mb-3">
                                    <label for="siteweb" class="form-label">Site web</label>
                                    <input type="text" name="siteweb" id="siteweb" class="form-control" value="{{ old('siteweb', $item->siteweb) }}">
                                </div>
                            </div>
                        </fieldset>
                
                        <!-- Comptes/Produits -->
                        <fieldset class="border p-3 mb-4">
                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Comptes/Produits</h5></small></legend>
                
                            <div class="mb-3">
                                <label for="convention" class="form-label">Ajouter une convention au produit</label>
                                <input type="file" name="convention" id="convention" class="form-control">
                                @if($item->convention)
                                    <a href="{{ asset('conventions/' . $item->convention) }}" class="mt-2">Voir la convention actuelle</a>
                                @endif
                            </div>
                        </fieldset>
                
                    </div>
                
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>