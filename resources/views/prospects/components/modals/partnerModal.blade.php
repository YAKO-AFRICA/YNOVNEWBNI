<div class="modal fade" id="openPartnerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="z-index: 9999">
            <div class="modal-header">
                <h2>Ajouter un Partenaire</h2>
                <button type="button" class="close-modal" data-bs-dismiss="close">×</button>
            </div>
            <style>


                .partner-card {
                    flex: 1;
                    height: 100px;
                    border: 2px solid #ddd;
                    border-radius: 8px;
                    background: white;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 16px;
                    font-weight: 500;
                    color: #333;
                }

                .partner-card:hover {
                    border-color: #3d8a41;
                    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
                    transform: translateY(-2px);
                }

                .partner-card.selected {
                    border-color: #3d8a41;
                    background-color: #3d8a41;
                    color: white;
                    box-shadow: 0 4px 12px rgba(18, 102, 11, 0.3);
                }
            </style>
            <div class="modal-body">
                <div class="form-grid" id="partnerForm">

                    <input type="hidden" name="partner_type" id="partner_type" value="">   
                    {{-- donné du type chargé dynamic --}}

                    <fieldset class="mt-3 p-3">
                        <legend class="float-none w-auto px-2 border rounded bg-white">
                            <small>Informations Personnelles</small>
                        </legend>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Civilité</label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="partner_civilite" value="M"> M.
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="partner_civilite" value="Mme"> Mme
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="partner_civilite" value="Dr"> Dr
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="partner_civilite" value="Pr"> Pr
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Genre</label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="partner_genre" value="M"> Masculin
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="partner_genre" value="F"> Féminin
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label class="required">Nom</label>
                                <input type="text" id="partner_nom" required>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label class="required">Prénom</label>
                                <input type="text" id="partner_prenom" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Date de Naissance</label>
                                <input type="date" id="partner_dateNaissance">
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Lieu de Naissance</label>
                                <input type="text" id="partner_lieuNaissance">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-3 p-3">
                        <legend class="float-none w-auto px-2 border rounded bg-white">
                            <small>Pièce d'Identité</small>
                        </legend>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Nature Pièce</label>
                                <select id="partner_naturepiece">
                                    <option value="">Sélectionner</option>
                                    <option value="CNI">CNI</option>
                                    <option value="Passeport">Passeport</option>
                                    <option value="Permis">Permis de conduire</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Numéro Pièce</label>
                                <input type="text" id="partner_numeropiece">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-3 p-3">
                        <legend class="float-none w-auto px-2 border rounded bg-white">
                            <small>Coordonnées</small>
                        </legend>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Email</label>
                                <input type="email" id="partner_email">
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Mobile</label>
                                <input type="tel" id="partner_mobile">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Lieu de Résidence</label>
                            <input type="text" id="partner_lieuResidence">
                        </div>
                        
                        <div class="form-group full-width">
                            <label>Adresse Complète</label>
                            <textarea id="partner_adresseComplete" rows="2"></textarea>
                        </div>
                    </fieldset>

                    <fieldset class="mt-3 p-3">
                        <legend class="float-none w-auto px-2 border rounded bg-white">
                            <small>Situation Personnelle et Professionnelle</small>
                        </legend>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Situation Matrimoniale</label>
                                <select id="partner_situationMatrimoniale">
                                    <option value="">Sélectionner</option>
                                    <option value="celibataire">Célibataire</option>
                                    <option value="marie">Marié(e)</option>
                                    <option value="divorce">Divorcé(e)</option>
                                    <option value="veuf">Veuf(ve)</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Type de Relation</label>
                                <select id="partner_filliation_code">
                                    <option value="">Sélectionner</option>
                                    <option value="conjoint">Conjoint(e)</option>
                                    <option value="enfant">Enfant</option>
                                    <option value="parent">Parent</option>
                                    <option value="frere_soeur">Frère/Sœur</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Profession</label>
                                <input type="text" id="partner_profession">
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Employeur</label>
                                <input type="text" id="partner_employeur">
                            </div>
                        </div>
                    </fieldset>
                </div>
                
                <div style="margin-top: 20px; text-align: right;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin-right: 10px;">
                        Annuler
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addPartner()">
                        Ajouter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
