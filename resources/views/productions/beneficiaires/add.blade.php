<div class="modal fade" id="addBenefModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un bénéficiaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="beneficiaryForm">
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="nomBenef" class="form-label">Nom du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" id="nomBenef" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="prenomBenef" class="form-label">Prénoms du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" id="prenomBenef" class="form-control" placeholder="Prénoms">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="datenaissanceBenef" class="form-label">Date de naissance</label>
                            <input type="date" id="datenaissanceBenef" class="form-control" name="datenaissanceBenef">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="lieunaissanceBenef" class="form-label">Lieu de naissance</label>
                            <select id="lieunaissanceBenef" class="form-select">
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
                            <select id="lieuresidenceBenef" class="form-select">
                                <option selected value="">Sélectionner le lieu</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 
                                @endforeach 
                            </select>
                        </div>
                        <select id="lienParenteBenef" class="form-select" name="lienParenteBenef">
                            <option selected value="" disabled>Sélectionner le lien de Parenté</option>
                            
                            @foreach ($filliations as $item)
                                @if(!empty($item->MonLibelle))
                                    <option value="{{ $item->MonLibelle }}">{{ $item->MonLibelle }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input type="text" id="mobileBenef" class="form-control" placeholder="Téléphone">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="emailBenef" class="form-label">Email</label>
                            <input type="email" id="emailBenef" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label for="partBenef" class="form-label">Part en %</label>
                            <input type="number" id="partBenef" class="form-control" placeholder="Part du bénéficiaire" min="0" max="100">
                        </div>
                    </div>
                    <input type="hidden" id="beneficiariesInput" name="beneficiaires">
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn border-btn" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-two" onclick="addBeneficiary()">Ajouter</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>