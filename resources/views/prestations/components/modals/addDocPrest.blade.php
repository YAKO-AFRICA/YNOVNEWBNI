<div class="modal fade" id="add-doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="mb-1">Documents de prestation</h5>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>



            <form action="{{ route('prestation.add.docPrest') }}" method="POST" enctype="multipart/form-data"
                class="submitForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="code" value="{{ $prestation->code }}">
                    <input type="hidden" name="idcontrat" value="{{ $prestation->idcontrat }}">
                    @if (
                        !$conditionsInvalides)

                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-light-success text-success">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Aucun autre fichier à joindre</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row g-3">

                            @unless (
                                $types['Police'] == 'Police' ||
                                    $types['bulletin'] == 'bulletin' ||
                                    $types['AttestationPerteContrat'] == 'AttestationPerteContrat')
                                <!-- document contrat -->
                                <div class="col-xl-9 mx-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Quel type de document avez-vous en votre
                                                    possession ?</label>
                                                <select name="typeFile" class="form-select" id="typeFile" required>
                                                    <option value="" selected>Veuillez sélectionner le type de
                                                        document</option>
                                                    <option value="Police">Police du contrat</option>
                                                    <option value="bulletin">Bulletin de souscription</option>
                                                    <option value="AttestationPerteContrat">Attestation de perte du contrat
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <div class="mb-3" id="typeDocFile">
                                                    <label class="form-label">Joindre le document <span id="typeDocName"
                                                            style="font-weight: bold"></span> ici ! </label>

                                                    <div class="input-group">
                                                        <input type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            class="form-control"
                                                            onchange="previewFilesPrest(event, 'previewDocName')" required>
                                                            <input type="hidden" name="filename[]" value=".">
                                                        <input type="hidden" name="type[]" value="" id="DocName"
                                                            required>
                                                    </div>

                                                    <div id="previewDocName" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endunless


                            @unless ($types['CNI'] == 'CNI')
                                <!-- Pièce justificatif d'identité (CNI) -->
                                <div class="col-xl-9 mx-auto">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-1">Pièce justificatif d'identité (CNI)</h5>
                                        </div>

                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Joindre votre CNI
                                                    <strong><small>(Recto)</small></strong> </label>
                                                <div class="input-group">
                                                    <input id="CNIrecto-file-uploa" class="form-control" type="file"
                                                        name="libelle[]" accept=".jpg, .png, image/jpeg, image/png"
                                                        onchange="previewFilesPrest(event, 'previewCNIrecto')" required>
                                                    <input type="hidden" name="filename[]" value="CNI recto">
                                                    <input type="hidden" name="type[]" value="CNIrecto">
                                                </div>
                                                <div id="previewCNIrecto" class="mt-3 preview-area"></div>
                                            </div>
                                            <div class="mb-3">

                                                <label class="form-label">Joindre le CNI
                                                    <strong><small>(Verso)</small></strong> </label>
                                                <div class="input-group">
                                                    <input id="CNIverso-file-uploa" class="form-control" type="file"
                                                        name="libelle[]" accept=".jpg, .png, image/jpeg, image/png"
                                                        onchange="previewFilesPrest(event, 'previewCNIverso')" required>
                                                    <input type="hidden" name="filename[]" value="CNI verso">
                                                    <input type="hidden" name="type[]" value="CNIverso">
                                                </div>

                                                <div id="previewCNIverso" class="mt-3 preview-area"></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endunless

                            @unless ($types['FicheIDNum'] == 'FicheIDNum')
                                @if ($prestation->moyenPaiement == 'Mobile_Money')
                                    <!-- Fiche d'identification du n° de telephone avec le caché de l'opérateur téléphonique -->
                                    <div class="col-xl-9 mx-auto">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Fiche d'identification du n° de telephone avec
                                                        le
                                                        caché de l'opérateur téléphonique<small> <strong>(Ou la capture
                                                                d'écran
                                                                de la vérification par la syntaxe)</strong></small></label>
                                                    <div class="input-group">
                                                        <input id="FicheID-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrest(event, 'previewFicheIDNum')"
                                                            required>
                                                        <input type="hidden" name="filename[]" value="Fiche d'identification du numero de téléphone">
                                                        <input type="hidden" name="type[]" value="FicheIDNum" required>
                                                    </div>
                                                    <div id="previewFicheIDNum" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endunless

                            @unless ($types['RIB'] == 'RIB')
                                @if ($prestation->moyenPaiement == 'Virement_Bancaire')
                                    <!-- RIB -->
                                    <div class="col-xl-9 mx-auto">

                                        <div class="card">

                                            <div class="card-body">

                                                <div class="mb-3">

                                                    <label class="form-label">Joindre le RIB <strong>(Compte
                                                            courant)</strong></label>

                                                    <div class="input-group">

                                                        <input type="file" name="libelle[]" class="form-control"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrest(event, 'previewRIB')" required>
                                                        <input type="hidden" name="filename[]" value="RIB">
                                                        <input type="hidden" name="type[]" value="RIB">
                                                    </div>
                                                    <div id="previewRIB" class="mt-3 preview-area"></div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endif
                            @endunless

                            @unless ($types['AttestationClotureCompte'] == 'AttestationClotureCompte')
                                <!-- Attestation de cloture du compte -->
                                <div class="col-xl-9 mx-auto">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="mb-3">

                                                <label class="form-label">Attestation de cloture du compte ou tout autre document justifiant de la cloture du compte</label>

                                                <div class="input-group">

                                                    <input type="file" name="libelle[]" class="form-control"
                                                        accept=".jpg, .png, image/jpeg, image/png"
                                                        onchange="previewFilesPrest(event, 'previewAttestationClotureCompte')" required>
                                                    <input type="hidden" name="filename[]" value="Attestation de cloture du compte">
                                                    <input type="hidden" name="type[]" value="AttestationClotureCompte">
                                                </div>

                                                <div id="previewAttestationClotureCompte" class="mt-3 preview-area"></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endunless
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    {{-- @if (
                        $types['Police'] == null ||
                            $types['bulletin'] == null ||
                            $types['AttestationPerteContrat'] == null ||
                            $types['CNI'] == null ||
                            $types['FicheIDNum'] == null ||
                            $types['RIB'] == null ||
                            $types['Signature'] == null) --}}
                    @if (
                        $conditionsInvalides)
                        <button type="submit" class="btn btn-success px-4">Sauvegarder <i
                                class='bx bx-check'></i></button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>
