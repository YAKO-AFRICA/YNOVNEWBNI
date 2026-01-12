<div class="card">
    <div class="card-header text-center">
        <h5 class="mb-1">Documents requis (en PDF, PNG ou JPEG)</h5>
        <p class="mb-4">Vueillez joindre les documents demander ci-dessous pour finaliser votre demande </p>
    </div>
    <div class="card-body">
        <div class="card mb-3">
            <div class="card-header"> 
               <h5 class="mb-0">Documents relatifs aux contrats</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Quel type de document avez-vous en votre possession ?</label>
                                </div>
                                <div class="card-body">
                                    <select name="typeFile" class="form-select" id="typeFile" required>
                                        <option value="Police">Police du contrat</option>
                                        <option value="bulletin">Bulletin de souscription</option>
                                        <option value="AttestationPerteContrat">Attestation de perte du contrat</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Joindre le document ici !</label>
                                </div>
                                <div class="card-body">
                                    <input id="Police-file-uploa" type="file" class="form-control" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf" required>
                                    <input type="hidden" name="type[]" value="" id="DocName">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"> 
               <h5 class="mb-0">Pièces d'identité du demandeur</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Joindre votre CNI <strong><small>(Recto)</small></strong> </label>
                                </div>
                                <div class="card-body">
                                    <input id="CNIrecto-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png" required>
                                    <input type="hidden" name="type[]" value="CNIrecto">
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Joindre le CNI <strong><small>(Verso)</small></strong> </label>
                                </div>
                                <div class="card-body">
                                    <input id="CNIverso-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png" required>
                                    <input type="hidden" name="type[]" value="CNIverso">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-header"> 
               <h5 class="mb-0">Documents relatifs au compte pour le paiement</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12" id="FicheIDNum">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Fiche d'identification du n° de telephone avec le caché de l'opérateur téléphonique<small> <strong>(Ou la capture d'écran de la vérification par la syntaxe)</strong></small> </label>
                                </div>
                                <div class="card-body">
                                    <input id="FicheID-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf">
                                    <input type="hidden" name="type[]" value="FicheIDNum" required>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-12" id="RIB-file">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Joindre le RIB <strong>(Compte courant)</strong></label>
                                </div>
                                <div class="card-body">
                                    <input id="RIB-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf">
                                    <input type="hidden" name="type[]" value="RIB">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6">

                        <div class="card">

                            <div class="card-body">

                                <div class="mb-3">

                                    <label class="form-label">Signature (Veuillez signer une feuille blanche
                                        précédé de la mention <span class="text-danger">"LU et APPROUVE"</span>
                                        ) et joindre la photo</label>

                                    <div class="input-group">

                                        <input type="file" name="libelle[]" class="form-control"
                                            accept=".jpg, .png, image/jpeg, image/png" required>

                                        <input type="hidden" name="type[]" value="Signature">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</div>