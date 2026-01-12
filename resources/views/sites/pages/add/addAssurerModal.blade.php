<style>
    .table-responsive {
        max-height: 400px;
        overflow-y: auto;
    }

    #tableAssuresBody tr {
        transition: all 0.3s ease;
    }

    #tableAssuresBody tr:hover {
        background-color: #f8f9fa;
    }
</style>

<!-- Modal Ajouter/Éditer Assuré -->
<div class="modal fade" id="createAssurerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog">
        <div class="modal-content">
            <form id="assurerForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Ajouter un(e) assuré(e)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="assurerIndex" value="-1">
                    
                    <div class="row g-3">
                        <!-- Civilité -->
                        <div class="col-12">
                            <label class="form-label">Civilité <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="assurerCivilite" id="civiliteMadame" value="Madame" required>
                                <label class="form-check-label" for="civiliteMadame">Madame</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="assurerCivilite" id="civiliteMademoiselle" value="Mademoiselle">
                                <label class="form-check-label" for="civiliteMademoiselle">Mademoiselle</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="assurerCivilite" id="civiliteMonsieur" value="Monsieur">
                                <label class="form-check-label" for="civiliteMonsieur">Monsieur</label>
                            </div>
                        </div>

                        <!-- Nom et Prénoms -->
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="assurerNom" id="assurerNom" class="form-control" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Prénoms <span class="text-danger">*</span></label>
                            <input type="text" name="assurerPrenom" id="assurerPrenom" class="form-control" required>
                        </div>

                        <!-- Date et lieu de naissance -->
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" name="assurerDatenaissance" id="assurerDatenaissance" class="form-control" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
                            <input type="text" name="assurerLieunaissance" id="assurerLieunaissance" class="form-control" required>
                            {{-- <select class="form-select lieunaissance" name="assurerLieunaissance" id="assurerLieunaissance" required>
                                <option value="" disabled selected>Sélectionner le lieu</option>
                            </select> --}}
                        </div>

                        <!-- Filiation et Sexe -->
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Filiation</label>
                            {{-- <input type="text" name="assurerFiliation" id="assurerFiliation" class="form-control"> --}}
                            <select id="assurerFiliation" class="form-select" name="assurerFiliation">
                                <option selected value="" disabled>Sélectionner le lien de Parenté</option>
                                @foreach ($filliations as $filliation)
                                    <option value="{{ $filliation->MonLibelle }}">{{ $filliation->MonLibelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Sexe <span class="text-danger">*</span></label>
                            <select class="form-select" name="assurerSexe" id="assurerSexe" required>
                                <option value="" disabled selected>Sélectionner</option>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>

                        <!-- Pièce d'identité -->
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Nature de la pièce <span class="text-danger">*</span></label>
                            <select class="form-select" name="assurerNaturepiece" id="assurerNaturepiece" required>
                                <option value="" disabled selected>Sélectionner</option>
                                <option value="CNI">CNI</option>
                                <option value="AT">Attestation</option>
                                <option value="Passport">Passeport</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Numéro de la pièce <span class="text-danger">*</span></label>
                            <input type="text" name="assurerNumeropiece" id="assurerNumeropiece" class="form-control" required>
                        </div>

                        <!-- Lieu de résidence -->
                        

                        <div class="row my-3 col-sm-12 col-md-12 col-lg-12">
                            <div class="col-sm-12 col-md-6 col-lg-8">
                                <label class="form-label">Lieu de résidence <span class="text-danger">*</span></label>
                                <input type="text" name="assurerLieuresidence" id="assurerLieuresidence" class="form-control" required>
                               
                            </div>
                            @if ($codePartner == "DIRECTENTREPRISE")
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="justifResidence" class="form-label">Justificatif de résidence </label>
                                    <input type="file" name="justifResidence" class="form-control" id="justifResidence" accept="application/pdf,image/jpeg,image/jpg,image/png">
                                </div>
                            @else
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="justifResidence" class="form-label">Justificatif de résidence <span class="text-danger">*</span></label>
                                    <input type="file" name="justifResidence" class="form-control" id="justifResidence" required accept="application/pdf,image/jpeg,image/jpg,image/png">
                                </div>
                            @endif
                            
                        </div>

                        <!-- Profession et Employeur -->
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Profession</label>
                            <select class="form-select profession" name="assurerProfession" id="assurerProfession">
                                <option value="" disabled selected>Sélectionner la profession</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Secteur d'activités</label>
                            <select class="form-select" name="assurerEmployeur" id="assurerEmployeur">
                                <option value="" disabled selected>Sélectionner le secteur</option>
                                @foreach ($secteurActivites as $secteurActivite)
                                    <option value="{{ $secteurActivite->MonLibelle }}">{{ $secteurActivite->MonLibelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Contacts -->
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="assurerEmail" id="assurerEmail" class="form-control">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" name="assurerTelephone" id="assurerTelephone" class="form-control" minlength="10" maxlength="15">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="form-label">Téléphone 2</label>
                            <input type="tel" name="assurerTelephone1" id="assurerTelephone1" class="form-control" minlength="10" maxlength="15">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="form-label">Mobile <span class="text-danger">*</span></label>
                            <input type="tel" name="assurerMobile" id="assurerMobile" class="form-control" minlength="10" maxlength="15" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="storeAssurerBtn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>




