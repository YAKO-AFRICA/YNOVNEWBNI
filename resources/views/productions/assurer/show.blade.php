<!-- Modal for Show Details -->
<div class="modal fade" id="showAssureModal{{ $assure->id }}" tabindex="-1" aria-labelledby="showDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDetailsModalLabel">Détails de l'Assuré</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    
                    <!-- Personal Information -->
                    <fieldset class="border p-3 mb-4">
                        <legend class="float-none w-auto px-2"><small><strong>Informations personnelles</strong></small></legend>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Civilité :</strong> <span id="modalCivilite">{{ $assure->civilite ?? '' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <strong>Nom de l'assuré :</strong> <span id="modalNomAssur">{{ $assure->nom ?? '' }}</span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Prénoms de l'assuré :</strong> <span id="modalPrenomAssur">{{ $assure->prenom ?? '' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <strong>Date de naissance :</strong> <span id="modalDateNaissance">{{ $assure->datenaissance ?? '' }}</span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Lieu de naissance :</strong> <span id="modalLieuNaissance">{{ $assure->lieunaissance ?? '' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <strong>Nature de la pièce :</strong> <span id="modalNaturePiece">{{ $assure->naturepiece ?? '' }}</span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Numéro de la pièce :</strong> <span id="modalNumeroPiece">{{ $assure->numeropiece ?? '' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <strong>Lieu de résidence :</strong> <span id="modalLieuResidence">{{ $assure->lieuresidence ?? '' }}</span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Lien de parenté :</strong> <span id="modalLienParente">{{ $assure->lienparente ?? '' }}</span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <strong>Téléphone :</strong> <span id="modalTelephone">{{ $assure->mobile ?? '' }}</span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Email :</strong> <span id="modalEmail">{{ $assure->email ?? '' }}</span>
                            </div>
                        </div>
                    </fieldset>
            
                    {{-- @if ($contrat->codeproduit === "LFFUN" ?? $assure->sante)
                    <hr>
                    <!-- Health Status -->
                    <fieldset class="border p-3">
                        <legend class="float-none w-auto px-2"><small><strong>État de santé</strong></small></legend>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>L'état de santé :</strong> 
                                <span id="modalEtatSante">
                                    {{ $assure->sante->EtatSante ?? '' }}
                                </span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Diabète :</strong>
                                <span id="modalDiabete">
                                    {{ $assure->sante->diabete == 'true' ? 'Oui' : 'Non' }}
                                </span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <strong>Cancer :</strong>
                                <span id="modalCancer">
                                    {{ $assure->sante->cancer == 'true' ? 'Oui' : 'Non' }}
                                </span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>AVC :</strong>
                                <span id="modalAvc">
                                    {{ $assure->sante->avc == 'true' ? 'Oui' : 'Non' }}
                                </span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <strong>Hypertension :</strong>
                                <span id="modalHypertension">
                                    {{ $assure->sante->hypertension == 'true' ? 'Oui' : 'Non' }}
                                </span>
                            </div>
                        </div>
            
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <strong>Insuffisance rénale :</strong>
                                <span id="modalInsuffRenal">
                                    {{ $assure->sante->insuffrenale == 'true' ? 'Oui' : 'Non' }}
                                </span>
                            </div>
                        </div>
                    </fieldset>
                    @endif --}}
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
