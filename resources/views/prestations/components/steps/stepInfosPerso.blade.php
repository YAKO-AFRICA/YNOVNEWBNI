

<div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
    <div class="card" style="background-color: #E7F0EB">
        <div class="card-header text-center">
            <h5 class="mb-1">Vos informations personnelles</h5>
            <p class="mb-4">Nous avons besoin de connaitre l'identité du demandeur afin de pouvoir traiter votre demande</p>
            <p class="mb-4">
                <strong>Pour toutes modifications de vos informations personnelles, veuillez Cliquez
                    <i><a href="javascript:;"
                            class="deleteConfirmation text-danger underline text-decoration-none fw-bold star"
                            data-type="confirmation_redirect" data-placement="top" data-token="{{ csrf_token() }}"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Modifier vos informations personnelles"
                            data-url="{{ route('prestation.modifyInfosPerso', $contractDetails['IdProposition']) }}"
                            data-title="Vous souhaitez modifier vos informations personnelles ?"
                            data-id="{{ $contractDetails['IdProposition'] }}" data-param="0"
                            data-route="{{ route('prestation.modifyInfosPerso', $contractDetails['IdProposition']) }}">
                            ici
                        </a></i>
                     pour faire la demande
                </strong>
            </p>
        </div>
        <div class="card-body">
            <!-- Étape 1 -->
            <div class="etape" id="etape1">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="nom" class="form-label">Quel est votre nom ?</label>
                        <input type="text" class="form-control" id="nom" name="nom" 
                               value="{{ $contractDetails['nomSous'] ?? '' }}" 
                               placeholder="Votre Nom" readonly>
                        <input type="hidden" name="typeprestation" value="{{ $typePrestation->libelle ?? '' }}">
                        
                        <input type="hidden" name="idclient" value="{{ $membreDetails->idmembre ?? '' }}">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="prenom" class="form-label">Quel est votre prénom ?</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" 
                               value="{{ $contractDetails['PrenomSous'] ?? '' }}" 
                               placeholder="Votre Prénom" readonly>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="datenaissance" class="form-label">Quelle est votre date de naissance ?</label>
                        <input type="text" class="form-control datepicke" id="datenaissance" name="datenaissance" 
                               value="{{ $contractDetails['DateNaissance'] ? \Carbon\Carbon::createFromFormat('d/m/Y', $contractDetails['DateNaissance'])->format('d/m/Y') : '' }}" 
                               placeholder="dd/mm/yyyy" readonly>
                    </div>
                    

                    <div class="col-12 col-lg-6">
                        <label for="lieunaissance" class="form-label">Où êtes-vous né(e) ?</label>
                        <input type="text" class="form-control" id="lieunaissance" name="lieunaissance" 
                               value="{{ $contractDetails['LieuNaissance'] ?? '' }}" 
                               placeholder="" readonly>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="cel" class="form-label">N° de téléphone principal</label>
                        <input type="number" class="form-control" id="cel" name="celPrincipal" 
                               value="{{ substr(
                                        preg_replace('/\D/', '', 
                                            $membreDetails->mobile 
                                            ?? $membreDetails->mobile1 
                                            ?? $membreDetails->telephone 
                                            ?? $membreDetails->telephone1 
                                            ?? ''
                                        ),
                                        -10
                                    ) }}" placeholder="Téléphone principal" readonly> 
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="cel" class="form-label">Sur quelle N° de téléphone pouvons nous vous contacter ? <span class="star">*</span></label>
                        <input type="number" class="form-control" id="cel" name="cel" 
                               value="{{ substr(
                                        preg_replace('/\D/', '', 
                                            $membreDetails->mobile 
                                            ?? $membreDetails->mobile1 
                                            ?? $membreDetails->telephone 
                                            ?? $membreDetails->telephone1 
                                            ?? ''
                                        ),
                                        -10
                                    ) }}" placeholder="Téléphone principal" required> 
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="email" class="form-label">Quelle est votre adresse email ? <span class="star">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{$membreDetails->email ?? ''}}" 
                               placeholder="Votre adresse email" required>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="lieuresidence" class="form-label">Où habitez-vous ? <span class="star">*</span> </label>
                        <input type="text" class="form-control" id="lieuresidence" name="lieuresidence" 
                               value="{{$membreDetails->lieuresidence ?? ''}}" 
                               placeholder="Votre lieu de résidence" required>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="tel" class="form-label">Votre N° de téléphone WhatsApp</label>
                        <input type="number" class="form-control" id="tel" name="tel" 
                               value="{{ substr(
                                        preg_replace('/\D/', '', 
                                            $membreDetails->mobile 
                                            ?? $membreDetails->mobile1 
                                            ?? $membreDetails->telephone 
                                            ?? $membreDetails->telephone1 
                                            ?? ''
                                        ),
                                        -10
                                    ) }}" placeholder="Téléphone WhatsApp">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="genre" class="form-label">Quel est votre genre ?</label>
                        <select name="sexe" id="genre" class="form-control" readonly>
                            <option value=""></option>
                            <option value="M" {{ !empty($membreDetails) ? $membreDetails->sexe === 'M' ? 'selected' : '' : '' }}>Masculin</option>
                            <option value="F" {{ !empty($membreDetails) ? $membreDetails->sexe === 'F' ? 'selected' : '' : '' }}>Feminin</option>
                        </select>
                    </div>
                </div> 
                <p class="text-center"><small class="text-danger"><i>Les champs obligatoires sont marqués par (<strong>*</strong>) </i></small></p>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end gap-3">
                        <button class="btn btn-primary next-step-btn" type="button">Suivant <i
                            class='bx bx-right-arrow-alt fs-4 ms-2'></i></button>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
        {{-- <button class="btn-prime btn-prime-two next-step-btn" type="button" onclick="stepper1.next()" data-bs-toggle="modal" data-bs-target="#exampleModal">Étape 2 <i --}}

</div>
