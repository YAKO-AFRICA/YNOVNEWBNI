<!-- Modal for Show Details -->
<div class="modal fade" id="showBenefModal{{ $beneficiaire->id }}" tabindex="-1" aria-labelledby="showDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDetailsModalLabel">Détails du Beneficiaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <fieldset class="border p-3 mb-4">
                        <legend class="float-none w-auto px-2"><small><strong>Informations sur le bénéficiaire</strong></small></legend>
        
                        <div class="row mb-3">
                            <div class="col-12 col-lg-6">
                                <label class="form-label"><strong>Nom :</strong></label>
                                <span>{{ $beneficiaire->nom ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label class="form-label"><strong>Prénoms :</strong></label>
                                <span>{{ $beneficiaire->prenom ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-12 col-lg-6">
                                <label class="form-label"><strong>Lieu de résidence :</strong></label>
                                <span>{{ $beneficiaire->lieuresidence ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label class="form-label"><strong>Lien de Parenté :</strong></label>
                                <span>{{ $beneficiaire->filiation ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-12 col-lg-6">
                                <label class="form-label"><strong>Téléphone :</strong></label>
                                <span>{{ $beneficiaire->mobile ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label class="form-label"><strong>Email :</strong></label>
                                <span>{{ $beneficiaire->email ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label"><strong>Part en % :</strong></label>
                                <span>{{ $beneficiaire->part ?? 'Non renseigné' }}%</span>
                            </div>
                        </div>
                    </fieldset>
            
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
