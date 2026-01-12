<div class="modal fade " tabindex="-1" id="addBenefAuTermeModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Voulez vous ajouter l'adherent comme un beneficiaires ?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('prod.store.beneficiaires') }}" class="submitForm">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="nomBenef" class="form-label">Nom du bénéficiaire <span class="text-danger">*</span></label>
                        <input type="text" id="nomBenef" value="{{ $contrat->adherent->nom ?? ''}}" class="form-control" placeholder="Nom" name="nomBenef" readonly>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="prenomBenef" class="form-label">Prénoms du bénéficiaire <span class="text-danger">*</span></label>
                        <input type="text" id="prenomBenef" class="form-control" value="{{ $contrat->adherent->prenom ?? ''}}" placeholder="Prénoms" name="prenomBenef" readonly>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="datenaissanceBenef" class="form-label">Date de naissance</label>
                        <input type="date" id="datenaissanceBenef" class="form-control" value="{{ $contrat->adherent->datenaissance ?? ''}}" name="datenaissanceBenef" readonly>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="lieunaissanceBenef" class="form-label">Lieu de naissance</label>
                        <select id="lieunaissanceBenef" class="form-select" name="lieunaissanceBenef" value="{{ $contrat->adherent->lieunaissance ?? ''}}" readonly>
                            <option value="{{ $contrat->adherent->lieunaissance ?? ''}}">{{ $contrat->adherent->lieunaissance ?? ''}}</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="lieuresidenceBenef" class="form-label">Lieu de residence</label>
                        <select id="lieuresidenceBenef" class="form-select" name="lieuresidenceBenef" @readonly(true) value="{{ $contrat->adherent->lieuresidence ?? ''}}">
                            <option value="{{ $contrat->adherent->lieuresidence ?? ''}}">{{ $contrat->adherent->lieuresidence ?? ''}}</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="lienParente" class="form-label">Lien de Parenté</abel>
                        <select id="lienParente" class="form-select" name="lienParente">
                            <option value="moi-meme">Moi Meme</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" id="mobileBenef" class="form-control" placeholder="Téléphone" name="mobileBenef" value="{{ $contrat->adherent->mobile ?? ''}}" readonly>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="emailBenef" class="form-label">Email</label>
                        <input type="email" id="emailBenef" class="form-control" placeholder="Email" name="emailBenef" value="{{ $contrat->adherent->email ?? ''}}" readonly>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label for="partBenef" class="form-label">Part en %</label>
                        <input type="number" id="partBenef" class="form-control" placeholder="Part du bénéficiaire" name="partBenef" value="100" readonly>
                    </div>
                </div>
                <input type="hidden" name="contrat" value="{{ $contrat->id }}">
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form> 
        </div>
      </div>
    </div>
</div>