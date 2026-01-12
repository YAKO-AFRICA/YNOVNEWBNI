<div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
    <div class="card">
        <div class="card-header text-center">
            <h5 class="mb-1">Resumé de vos saisies</h5>
            <p class="mb-4">Veuillez confirmer vos informations saisies et enregistrer votre demande</p>
        </div>
        <div class="card-body">
            <div class="card mb-3"> 
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card" style="width: 90%">
                                <div class="card-body">
                                    <h3>Informations sur la prestation</h3>
                                        <div class="mt-4">
                                            <dl class="row">
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Type de prestation:
                                                </dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="Prestation"></dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">ID du contrat :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="Contrat"></dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Montant souhaité :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="montant"></dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Moyen de paiement :
                                                </dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="moyenPmt">
                                                    {{-- si moyenPaiement = Virement_Bancaire met 'Virement Bancaire' si moyenPaiement = 'Mobile_Money' met Mobile Money --}}
                                                </dd>
                                            {{-- si moyenPaiement = Mobile_Money affiche --}}
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Opérateur :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="Opera">
                                                        {{-- si Operateur = Orange_money met Orange Money
                                                        si Operateur = MTN_Money met MTN Money
                                                        si Operateur = Moov_Money met Moov Money --}}
                                                    </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Numéro de paiement :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="TelPmt"></dd>

                                                {{-- sinon si moyenPaiement = Virement_Bancaire affiche --}}
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">IBAN du compte :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="NIBAN"></dd>
                                            </dl>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Informations personnelles</h3>
                                    <div class="mt-4">
                                        <dl class="row">
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Nom :</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="nomSous"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Prénom :</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="prenomSous"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date de naissance:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="datenaissanceSous"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Genre :</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="sexeSous"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Teléphone :</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="celSous"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Email :</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="emailSous"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Lieu de residence:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="lieuresidenceSous"></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-end gap-3">
                    {{-- <button class="btn btn-primary px-4" id="prev-btnPrest1" type="button" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2 fs-4'></i>étape prédédente</button> --}}
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</div>