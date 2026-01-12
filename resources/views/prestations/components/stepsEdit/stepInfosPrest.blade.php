

<div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

    <div class="card">
        <div class="card-header text-center">
            <h5 class="mb-1">Informations liée à la prestation</h5>
            <p class="mb-4">Veuillez renseigner les informations relatives à la prestation</p>
            <p class="mb-4"><span class="form-label star"><small><i>YAKO AFRICA décline toute responsabilité si les
                            informations communiquées sont incorrectes </i></small></span></p>
        </div>
        <div class="card-body">
            <div class="etapeEditPrest" id="etapeEditPrest1">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button">
                                <h5>ID Contrat et montant souhaité</h5>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-lg-6">

                                        <label for="idcontratEdit" class="form-label">Pour quel Contrat
                                            demandez-vous la prestation ?</label>
                                        <select class="form-select" name="idcontrat" id="idcontratEdit"
                                            data-placeholder="Veuillez sélectionner l'ID du contrat" required readonly>
                                            <option></option>
                                            <option value="{{ $prestation->idcontrat ?? '' }}" selected>
                                                {{ $prestation->idcontrat ?? '' }}</option>
                                        </select>
                                        <input type="hidden" id="Capital" name="Capital" value="">
                                        {{-- <input type="hidden" id="TotalEncaissement" name="TotalEncaissement" value="{{ $TotalEncaissement ?? '' }}"> --}}
                                        
                                        <div id="spinner" style="display: none;">
                                            <div class="spinner-border" style="color: #076633;" role="status">
                                                <span class="visually-hidden">Chargement...</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h5 id="Produit" class="mt-2 col-lg-6 col-md-6 col-12 text-start"></h5>
                                            <p class="col-lg-6 col-md-6 col-12 text-end mt-2"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#detailContratModal" title="Voir plus de détails" class="" id="DetailContratBtn"><i class='bx bxs-show py-1 px-2 fs-5 border border-secondary rounded bg-light'></i></a></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="montant" class="form-label">Quel est le montant que vous
                                            souhaitez
                                            demander ? <span class="star">*</span></label>
                                        <input type="text" class="form-control" min="0"
                                            name="montantSouhaite" id="montantSouhaite"
                                            placeholder="Saisir le montant souhaité" value="{{ $prestation->montantSouhaite ?? '' }}" required readonly >
                                        <small><i id="msgerror" class="text-danger"></i></small>
                                        <small><i id="msgesucces" class="text-success"></i></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start gap-3">
                                        <button class="btn btn-primary px-4" type="button"
                                            onclick="stepper1.previous()"><i
                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">
                                        <button type="button" class="collapsed btn btn-primary px-4" type="button"
                                            data-bs-toggle="collapse" id="btnContratVersMDP" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">Suivant <i
                                                class='bx bx-right-arrow-alt fs-4'></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button">
                                <h5>Moyen de paiement</h5>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row g-3 mb-3 text-center">
                                    <span class="form-label">Par quel moyen de paiement souhaitez-vous être payé ?
                                        <span class="star">*</span></span>
                                    <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                                        <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="moyenPaiement" value="Mobile_Money"
                                                id="mobileMoney" class="moyenPaiement-input">
                                            <label for="mobileMoney"
                                                class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="moyenPaiement-icon"><i class='bx bx-money'></i></span>
                                                <span class="moyenPaiement-text">Mobile Money</span>
                                            </label>
                                        </div>
                                        <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="moyenPaiement" value="Virement_Bancaire"
                                                id="virementBancaire" class="moyenPaiement-input">
                                            <label for="virementBancaire"
                                                class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="moyenPaiement-icon"><i class='bx bxs-bank'></i></span>
                                                <span class="moyenPaiement-text">Virement Bancaire</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 mb-3 text-center" id="Operateur">
                                    <span class="form-label">Quel opérateur souhaitez-vous utiliser ?</span>

                                    <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="Operateur" value="Orange_money"
                                                id="Orange" class="Operateur-input">
                                            <label for="Orange"
                                                class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="Operateur-icon">
                                                    <img src="https://seeklogo.com/images/O/orange-money-logo-8F2AED308D-seeklogo.com.png"
                                                        alt="Orange Money">
                                                </span>
                                                <span class="Operateur-text">Orange Money</span>
                                            </label>
                                        </div>
                                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="Operateur" value="MTN_money" id="MTN"
                                                class="Operateur-input">
                                            <label for="MTN"
                                                class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="Operateur-icon">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/MTN_Logo.svg/2048px-MTN_Logo.svg.png"
                                                        alt="MTN Money">
                                                </span>
                                                <span class="Operateur-text">MTN Money</span>
                                            </label>
                                        </div>
                                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="Operateur" value="Moov_money" id="Moov"
                                                class="Operateur-input">
                                            <label for="Moov"
                                                class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="Operateur-icon">
                                                    <img src="https://play-lh.googleusercontent.com/P0fu0Qo5Y7JjS6duZRTa8Z5KJCbNDiHo1W714pz9qN9IoX8ufR0L7SE_FkDUWpZZRi_x=w240-h480-rw"
                                                        alt="Moov Money">
                                                </span>
                                                <span class="Operateur-text">Moov Money</span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-4">
                                        <span id="clearChoise" class="">Supprimer mon choix</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-3" id="IBANPaiement">
                                    <div class="col-12 px-0">
                                        <label for="IBAN" class="form-label">Quel est votre RIB sur lequel vous souhaitez
                                            recevoir le paiement <span class="star">*</span></label>
                                        <div class="rib-container">
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mb-3 text-center">
                                                    <label for="codebanque" class="form-label">Code Banque</label><br>
                                                    <input type="text" class="rib-input" name="rib_1" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_2" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_3" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_4" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_5" maxlength="1">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-3 text-center">
                                                    <label for="codeagence" class="form-label">Code Agence</label><br>
                                                    <input type="text" class="rib-input" name="rib_6" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_7" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_8" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_9" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_10" maxlength="1">
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                <div class="col-lg-8 col-12 mb-3 text-center">
                                                    <label for="numcompte" class="form-label">N° de Compte</label><br>
                                                    <input type="text" class="rib-input" name="rib_11" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_12" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_13" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_14" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_15" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_16" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_17" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_18" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_19" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_20" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_21" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_22" maxlength="1">
                                                </div>
                                                <div class="col-lg-2 col-12 mb-3 w-lg-15 text-center">
                                                    <label for="clerib" class="form-label">Clé RIB</label><br>
                                                    <input type="text" class="rib-input" name="rib_23" maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_24" maxlength="1">
                                                </div>
                                            </div>
                                            <span class="text-center"><i id="ibanMsgError" class="text-danger"></i></span>
                                            <span class="text-center"><i id="ibanMsgSuccess" class="text-success"></i></span>
                                        </div>
                                        <input type="hidden" class="form-control" value="" name="IBAN" id="IBAN">
                                            
                                        <input type="hidden" name="TelOtp" value="" id="TelOtp">
                                    </div>
                                    <small class="text-center"><span class="form-label star"><i>Veuillez saisir le RIB de votre compte
                                                courant </i></span></small>
                                </div>
                                
                                <div class="row g-3 mb-3" id="TelephonePaiement">
                                    <div class="col-12 col-lg-6">
                                        
                                        <label for="TelPaiement" class="form-label">N° de téléphone sur lequel vous
                                            souhaitez recevoir le paiement <span class="star">*</span></label>
                                        <input type="number" class="form-control" name="TelPaiement"
                                            id="TelPaiement"
                                            placeholder="Veuillez saisir le N° de téléphone sur lequel vous souhaitez recevoir le paiement">
                                            <small><i id="telMsgError" class="text-danger"></i></small>
                                            <small><i id="telMsgSuccess" class="text-success"></i></small>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="ConfirmTelPaiement" class="form-label">Confirmer le N° de
                                            téléphone <span class="star">*</span></label>
                                        <input type="number" class="form-control" name="ConfirmTelPaiement"
                                            id="ConfirmTelPaiement"
                                            placeholder="Veuillez resaisir le N° de téléphone sur lequel vous souhaitez recevoir le paiement">
                                            <small><i id="telConfirmMsgError" class="text-danger"></i></small>
                                            <small><i id="telConfirmMsgSuccess" class="text-success"></i></small>
                                    </div>
                                    <small><span class="form-label star"><i>N° de Telephone sans l'indicatif (ex:
                                                <strong>0100128271</strong>) </i></span></small>
                                </div>
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start gap-3">
                                        <button class="btn btn-primary px-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne"><i
                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">
                                        <button class="btn btn-primary" type="button" id="btnIbanPaiementSuivant" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">Suivant <i
                                                class='bx bx-right-arrow-alt fs-4'></i></button>

                                        <button class="btn btn-primary" type="button" id="btnTelPaiementSuivant" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">Suivant <i
                                                class='bx bx-right-arrow-alt fs-4'></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button">
                                <h5>Informations suplementaires</h5>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{-- @include('prestations.components.stepsEdit.stepDoc') --}}

                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <label for="AutresInfos" class="form-label">Avez-vous d'autres informations
                                            suplementaires a fournir pour votre demande ? (<span class="star">max 400
                                                caractères </span>)</label>
                                        <textarea class="form-control" name="msgClient" id="AutresInfos" rows="5"
                                            placeholder="Veuillez saisir d'autres informations suplementaires a fournir pour pour votre demande">{{$prestation->msgClient}}</textarea>
                                        <div style="float: left;">
                                            <span id="totalChar" class="fs-6 text-muted"> 400 caractères autorisés
                                                :</span>
                                            <small><i id="counterror" class="text-danger"></i></small>
                                            <small><i id="countesucces" class="text-success"></i></small>
                                        </div>
                                        <div style="float: right;">
                                            <span id="totalMot" class="text-muted">0 mots saisis</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start gap-3">
                                        <button class="btn btn-primary px-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo"><i
                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">

                                        {{-- vers confirmation otp --}}
                                        <button class="btn btn-primary next-btn" type="button" id="next-stepper3"
                                            data-next="etapeEditPrest5">
                                            Suivant <i class='bx bx-right-arrow-alt fs-4'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="etapeEditPrest d-none" id="etapeEditPrest2">
                
            </div>
            <div class="etapeEditPrest d-none" id="etapeEditPrest3">
                
            </div>
            <div class="etapeEditPrest d-none" id="etapeEditPrest4">

                
            </div>

            <div class="etapeEditPrest d-none" id="etapeEditPrest5">
                <div class="row g-3 mb-3 text-center" id="OTP-edit">
                    <span class="form-label">Un code de confirmation a été envoyé pas SMS, veuillez le
                        rentrer ci-dessous</span>
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <div class="otp-container">
                            <input type="text" class="otp-input" name="otp_1" maxlength="1">
                            <input type="text" class="otp-input" name="otp_2" maxlength="1">
                            <input type="text" class="otp-input" name="otp_3" maxlength="1">
                            <input type="text" class="otp-input" name="otp_4" maxlength="1">
                            <input type="text" class="otp-input" name="otp_5" maxlength="1">
                            <input type="text" class="otp-input" name="otp_6" maxlength="1">
                        </div>
                    </div>


                    <div class="otp-timer-edit" id="otp-timer">
                        {{-- afficher le deconte ici  --}}
                    </div>
                    <a href="#" class="d-none resend-otp-link-edit">Renvoyer l'OTP</a>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end gap-3">
                        <div id="btn-otp">
                            {{-- <button class="btn2 border-btn2 prev-btn" type="button" data-prev="etapePrest4">
                                      <i class='bx bx-left-arrow-alt fs-4'></i>
                                  </button> --}}
                            <button class="btn btn-primary px-4 next-step-btnEdit2" type="button">étape 3<i
                                    class='bx bx-right-arrow-alt ms-2 fs-4'></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

