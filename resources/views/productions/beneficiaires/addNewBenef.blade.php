<div class="modal fade" id="addNewBenefModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un nouveau bénéficiaire</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('prod.store.beneficiaires') }}" class="submitForm">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="nomBenef" class="form-label">Nom du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" name="nomBenef" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="prenomBenef" class="form-label">Prénoms du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" name="prenomBenef" class="form-control" placeholder="Prénoms">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="datenaissanceBenef" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" name="datenaissanceBenef">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="lieunaissanceBenef" class="form-label">Lieu de naissance</label>
                            <select name="lieunaissanceBenef" class="form-select">
                                <option selected value="">Sélectionner le lieu</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="lieuresidenceBenef" class="form-label">Lieu de residence</label>
                            <select name="lieuresidenceBenef" class="form-select">
                                <option selected value="">Sélectionner le lieu</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="lienParente" class="form-label">Lien de Parenté</label>
                            <select name="lienParente" class="form-select">
                                <option selected value="">Sélectionner le lien de Parenté</option>
                                 @foreach ($filliations  as $item)
                                    <option value="{{ $item->CodeFiliation }}">{{ $item->MonLibelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input type="text" name="mobileBenef" class="form-control" placeholder="+225" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="emailBenef" class="form-label">Email</label>
                            <input type="email" name="emailBenef" class="form-control" placeholder="exemple@gmail.com">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label for="partBenef" class="form-label">Part en %</label>
                            <input type="number" name="partBenef" class="form-control" placeholder="0">
                        </div>
                    </div>

                    <input type="hidden" id="contrat" name="contrat" value="{{ $contrat->id }}">
                    {{-- <input type="hidden" id="pret_id" name="pret_id" value="{{ $pret->id }}"> --}}
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn border-btn" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-two">Ajouter</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>