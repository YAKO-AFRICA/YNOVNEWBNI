<div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
    {{-- @include('productions.components.otpModal') --}}
    <h5 class="mb-1">Informations sur votre état de santé</h5>

    <p class="mb-4">Veuillez cocher les informations relatives à votre état de santé en tenant compte des champs
        obligatoires.</p>


    <div class="g-3">

        @if ($product->CodeProduit == 'PFA_IND')
            <div class="col-12">
                <div class="card" style="width: 100%">
                    <div class="card-header">
                        <h5 class="mb-0">Êtes-vous sous traitement médicale pour l'une de ces maladies ou
                            souffrez-vous de l'une de ces maladies ?</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Quelle est votre taille ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="taille"
                                                    placeholder="170" name="taille">
                                                <span class="input-group-text">CM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Quel est votre poids ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="poids"
                                                    placeholder="70" name="poids">
                                                <span class="input-group-text">KG</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Fumez-vous ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="smoking" type="radio"
                                                    value="Oui" id="fumeOui">
                                                <label class="form-check-label" for="fumeOui">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="smoking" type="radio"
                                                    value="Non" id="fumeNon">
                                                <label class="form-check-label" for="fumeNon">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Buvez vous de l'alcool ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="alcohol" type="radio"
                                                    value="Non" id="alcoolPas">
                                                <label class="form-check-label" for="alcoolPas">
                                                    Pas du tout
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="alcohol" type="radio"
                                                    value="Partiel" id="alcoolOccasion">
                                                <label class="form-check-label" for="alcoolOccasion">
                                                    A l'ocassion
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="alcohol" type="radio"
                                                    value="Oui" id="alcoolRegulier">
                                                <label class="form-check-label" for="alcoolRegulier">
                                                    Régulièrement (au moins une fois par semaine)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Etes-vous atteint d'une infirmité
                                                ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Oui" id="infirmeOui">
                                                <label class="form-check-label" for="infirmeOui">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Non" id="infirmeNon">
                                                <label class="form-check-label" for="infirmeNon">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Êtes-vous en arrêt de travail
                                                ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="ArretTravail" type="radio"
                                                    value="Oui" id="ArretTravailOui">

                                                <label class="form-check-label" for="ArretTravailOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="ArretTravail" type="radio"
                                                    value="Non" id="ArretTravailNon">

                                                <label class="form-check-label" for="ArretTravailNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Avez-vous déjà été victime d'un
                                                accident ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Oui" id="AccidentOui">

                                                <label class="form-check-label" for="AccidentOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Non" id="AccidentNon">

                                                <label class="form-check-label" for="AccidentNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Quelles sont vos distractions
                                                (separer par une virgule) ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <input type="text" class="form-control" id="distractions"
                                                placeholder="separer par une virgule" name="distractions">
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Suivez-vous ou avez-vous suivi un
                                                traitement médical ces 6(six) derniers mois ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="treatment" type="radio"
                                                    value="Oui" id="SuiviTraitementOui">

                                                <label class="form-check-label" for="SuiviTraitementOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="treatment" type="radio"
                                                    value="Non" id="SuiviTraitementNon">

                                                <label class="form-check-label" for="SuiviTraitementNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Avez-vous déjà subi une
                                                transfusion de sang ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="transSang" type="radio"
                                                    value="Oui" id="transfusionSangOui">

                                                <label class="form-check-label" for="transfusionSangOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="transSang" type="radio"
                                                    value="Non" id="transfusionSangNon">

                                                <label class="form-check-label" for="transfusionSangNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Avez-vous déjà subi des
                                                interventions chirurgicales ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="interChirugiale" type="radio"
                                                    value="Oui" id="interventionsChirurgicalesOui">

                                                <label class="form-check-label" for="interventionsChirurgicalesOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="interChirugiale" type="radio"
                                                    value="Non" id="interventionsChirurgicalesNon">

                                                <label class="form-check-label" for="interventionsChirurgicalesNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Devez-vous subir une intervention
                                                chirurgicale ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="prochaineInterChirugiale"
                                                    type="radio" value="Oui" id="subirChirurgOui">

                                                <label class="form-check-label" for="subirChirurgOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="prochaineInterChirugiale"
                                                    type="radio" value="Non" id="subirChirurgNon">

                                                <label class="form-check-label" for="subirChirurgNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>

                </div>

            </div>

            <div class="col-12">
                <div class="card" style="width: 100%">

                    <div class="card-header">

                        <h5 class="mb-0">Êtes-vous sous traitement médicale pour l'une de ces maladies ou
                            souffrez-vous
                            de l'une de ces maladies ?</h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Diabète</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="diabetes" type="radio"
                                                    value="Oui" id="DiabeteOui">

                                                <label class="form-check-label" for="DiabeteOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="diabetes" type="radio"
                                                    value="Non" id="DiabeteNon">

                                                <label class="form-check-label" for="DiabeteNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Hypertension artérielle</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="hypertension" type="radio"
                                                    value="Oui" id="HypertensionOui">

                                                <label class="form-check-label" for="HypertensionOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="hypertension" type="radio"
                                                    value="Non" id="HypertensionNon">

                                                <label class="form-check-label" for="HypertensionNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Drépanocytose</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="sickleCell" type="radio"
                                                    value="Oui" id="DrepanocytoseOui">

                                                <label class="form-check-label" for="DrepanocytoseOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="sickleCell" type="radio"
                                                    value="Non" id="DrepanocytoseNon">

                                                <label class="form-check-label" for="DrepanocytoseNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Cirrhose de foie</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="liverCirrhosis" type="radio"
                                                    value="Oui" id="CirrhoseOui">

                                                <label class="form-check-label" for="CirrhoseOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="liverCirrhosis" type="radio"
                                                    value="Non" id="CirrhoseNon">

                                                <label class="form-check-label" for="CirrhoseNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Affections pulmonaires</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="lungDisease" type="radio"
                                                    value="Oui" id="AffectionsOui">

                                                <label class="form-check-label" for="AffectionsOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="lungDisease" type="radio"
                                                    value="Non" id="AffectionsNon">

                                                <label class="form-check-label" for="AffectionsNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Cancer</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="cancer" type="radio"
                                                    value="Oui" id="CancerOui">

                                                <label class="form-check-label" for="CancerOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="cancer" type="radio"
                                                    value="Non" id="CancerNon">

                                                <label class="form-check-label" for="CancerNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Anémie</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="anemia" type="radio"
                                                    value="Oui" id="AnemieOui">

                                                <label class="form-check-label" for="AnemieOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="anemia" type="radio"
                                                    value="Non" id="AnemieNon">

                                                <label class="form-check-label" for="AnemieNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Insuffisance rénale</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="kidneyFailure" type="radio"
                                                    value="Oui" id="InsuffisanceOui">

                                                <label class="form-check-label" for="InsuffisanceOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="kidneyFailure" type="radio"
                                                    value="Non" id="InsuffisanceNon">

                                                <label class="form-check-label" for="InsuffisanceNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>



                            <div class="card" style="width: 100%">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-8 border-r">

                                            <label for="" class="form-label">Avez-vous déjà été victime d’un
                                                AVC
                                                ?</label>

                                        </div>

                                        <div class="col-12 col-lg-4 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="stroke" type="radio"
                                                    value="Oui" id="AVCOui">

                                                <label class="form-check-label" for="AVCOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="stroke" type="radio"
                                                    value="Non" id="AVCNon">

                                                <label class="form-check-label" for="AVCNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

            </div>
        {{-- @elseif ($product->CodeProduit == 'CADENCE') --}}
       
            

        @elseif($product->CodeProduit == 'YKE_2018')
            <div class="col-12">
                <div class="card" style="width: 100%">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-12 col-lg-9 border-r">

                                <label for="" class="form-label">L'assure a t'il été hospitalisé au cours des
                                    ces 3 (trois) derniers mois ?</label>

                            </div>

                            <div class="col-12 col-lg-3">

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" name="treatment" type="radio" value="Oui"
                                        id="treatmentOui">

                                    <label class="form-check-label" for="treatmentOui">

                                        Oui

                                    </label>

                                </div>

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" name="treatment" type="radio" value="Non"
                                        id="treatmentNon">

                                    <label class="form-check-label" for="treatmentNon">

                                        Non

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-12">
                <div class="card" style="width: 100%">

                    <div class="card-header">

                        <h5 class="mb-0">Êtes-vous sous traitement médicale pour l'une de ces maladies ou
                            souffrez-vous
                            de l'une de ces maladies</h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Diabète</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="diabetes" type="radio"
                                                    value="Oui" id="DiabeteOui">

                                                <label class="form-check-label" for="DiabeteOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="diabetes" type="radio"
                                                    value="Non" id="DiabeteNon">

                                                <label class="form-check-label" for="DiabeteNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Hypertension artérielle</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="hypertension" type="radio"
                                                    value="Oui" id="HypertensionOui">

                                                <label class="form-check-label" for="HypertensionOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="hypertension" type="radio"
                                                    value="Non" id="HypertensionNon">

                                                <label class="form-check-label" for="HypertensionNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Drépanocytose</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="sickleCell" type="radio"
                                                    value="Oui" id="DrepanocytoseOui">

                                                <label class="form-check-label" for="DrepanocytoseOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="sickleCell" type="radio"
                                                    value="Non" id="DrepanocytoseNon">

                                                <label class="form-check-label" for="DrepanocytoseNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Cirrhose de foie</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="liverCirrhosis" type="radio"
                                                    value="Oui" id="CirrhoseOui">

                                                <label class="form-check-label" for="CirrhoseOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="liverCirrhosis" type="radio"
                                                    value="Non" id="CirrhoseNon">

                                                <label class="form-check-label" for="CirrhoseNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Affections pulmonaires</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="lungDisease" type="radio"
                                                    value="Oui" id="AffectionsOui">

                                                <label class="form-check-label" for="AffectionsOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="lungDisease" type="radio"
                                                    value="Non" id="AffectionsNon">

                                                <label class="form-check-label" for="AffectionsNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Cancer</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="cancer" type="radio"
                                                    value="Oui" id="CancerOui">

                                                <label class="form-check-label" for="CancerOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="cancer" type="radio"
                                                    value="Non" id="CancerNon">

                                                <label class="form-check-label" for="CancerNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Anémie</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="anemia" type="radio"
                                                    value="Oui" id="AnemieOui">

                                                <label class="form-check-label" for="AnemieOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="anemia" type="radio"
                                                    value="Non" id="AnemieNon">

                                                <label class="form-check-label" for="AnemieNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Insuffisance rénale</label>
                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="kidneyFailure" type="radio"
                                                    value="Oui" id="InsuffisanceOui">

                                                <label class="form-check-label" for="InsuffisanceOui">
                                                    Oui
                                                </label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="kidneyFailure" type="radio"
                                                    value="Non" id="InsuffisanceNon">
                                                <label class="form-check-label" for="InsuffisanceNon">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card" style="width: 100%">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-8 border-r">

                                            <label for="" class="form-label">Avez-vous déjà été victime d’un
                                                AVC
                                                ?</label>

                                        </div>

                                        <div class="col-12 col-lg-4 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="stroke" type="radio"
                                                    value="Oui" id="AVCOui">

                                                <label class="form-check-label" for="AVCOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="stroke" type="radio"
                                                    value="Non" id="AVCNon">

                                                <label class="form-check-label" for="AVCNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div id="isSureteCheck" style="display: none;">

            <div class="col-12">
                <div class="card" style="width: 100%">
                    <div class="card-header">
                        <h5 class="mb-0">Êtes-vous sous traitement médicale pour l'une de ces maladies ou
                            souffrez-vous de l'une de ces maladies</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Quelle est votre taille ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="taille"
                                                    placeholder="170" name="taille">
                                                <span class="input-group-text">CM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Quel est votre poids ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="poids"
                                                    placeholder="70" name="poids">
                                                <span class="input-group-text">KG</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Fumez-vous ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="smoking" type="radio"
                                                    value="Oui" id="fumeOui">
                                                <label class="form-check-label" for="fumeOui">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="smoking" type="radio"
                                                    value="Non" id="fumeNon">
                                                <label class="form-check-label" for="fumeNon">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Buvez vous de l'alcool ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="alcohol" type="radio"
                                                    value="Non" id="alcoolPas">
                                                <label class="form-check-label" for="alcoolPas">
                                                    Pas du tout
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="alcohol" type="radio"
                                                    value="Partiel" id="alcoolOccasion">
                                                <label class="form-check-label" for="alcoolOccasion">
                                                    A l'ocassion
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="alcohol" type="radio"
                                                    value="Oui" id="alcoolRegulier">
                                                <label class="form-check-label" for="alcoolRegulier">
                                                    Régulièrement (au moins une fois par semaine)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">
                                            <label for="" class="form-label">Etes-vous atteint d'une infirmité
                                                ?</label>
                                        </div>
                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Oui" id="infirmeOui">
                                                <label class="form-check-label" for="infirmeOui">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Non" id="infirmeNon">
                                                <label class="form-check-label" for="infirmeNon">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Êtes-vous en arrêt de travail
                                                ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="ArretTravail" type="radio"
                                                    value="Oui" id="ArretTravailOui">

                                                <label class="form-check-label" for="ArretTravailOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="ArretTravail" type="radio"
                                                    value="Non" id="ArretTravailNon">

                                                <label class="form-check-label" for="ArretTravailNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Avez-vous déjà été victime d'un
                                                accident ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Oui" id="AccidentOui">

                                                <label class="form-check-label" for="AccidentOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="accident" type="radio"
                                                    value="Non" id="AccidentNon">

                                                <label class="form-check-label" for="AccidentNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Quelles sont vos distractions
                                                (separer par une virgule) ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">
                                            <input type="text" class="form-control" id="distractions"
                                                placeholder="separer par une virgule" name="distractions">
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Suivez-vous ou avez-vous suivi un
                                                traitement médical ces 6(six) derniers mois ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="treatment" type="radio"
                                                    value="Oui" id="SuiviTraitementOui">

                                                <label class="form-check-label" for="SuiviTraitementOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="treatment" type="radio"
                                                    value="Non" id="SuiviTraitementNon">

                                                <label class="form-check-label" for="SuiviTraitementNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Avez-vous déjà subi une
                                                transfusion de sang ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="transSang" type="radio"
                                                    value="Oui" id="transfusionSangOui">

                                                <label class="form-check-label" for="transfusionSangOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="transSang" type="radio"
                                                    value="Non" id="transfusionSangNon">

                                                <label class="form-check-label" for="transfusionSangNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Avez-vous déjà subi des
                                                interventions chirurgicales ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="interChirugiale" type="radio"
                                                    value="Oui" id="interventionsChirurgicalesOui">

                                                <label class="form-check-label" for="interventionsChirurgicalesOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="interChirugiale" type="radio"
                                                    value="Non" id="interventionsChirurgicalesNon">

                                                <label class="form-check-label" for="interventionsChirurgicalesNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Devez-vous subir une intervention
                                                chirurgicale ?</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="prochaineInterChirugiale"
                                                    type="radio" value="Oui" id="subirChirurgOui">

                                                <label class="form-check-label" for="subirChirurgOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="prochaineInterChirugiale"
                                                    type="radio" value="Non" id="subirChirurgNon">

                                                <label class="form-check-label" for="subirChirurgNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>

                </div>

            </div>

            <div class="col-12">
                <div class="card" style="width: 100%">

                    <div class="card-header">

                        <h5 class="mb-0">Êtes-vous sous traitement médicale pour l'une de ces maladies ou
                            souffrez-vous
                            de l'une de ces maladies</h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Diabète</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="diabetes" type="radio"
                                                    value="Oui" id="DiabeteOui">

                                                <label class="form-check-label" for="DiabeteOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="diabetes" type="radio"
                                                    value="Non" id="DiabeteNon">

                                                <label class="form-check-label" for="DiabeteNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Hypertension artérielle</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="hypertension" type="radio"
                                                    value="Oui" id="HypertensionOui">

                                                <label class="form-check-label" for="HypertensionOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="hypertension" type="radio"
                                                    value="Non" id="HypertensionNon">

                                                <label class="form-check-label" for="HypertensionNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Drépanocytose</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="sickleCell" type="radio"
                                                    value="Oui" id="DrepanocytoseOui">

                                                <label class="form-check-label" for="DrepanocytoseOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="sickleCell" type="radio"
                                                    value="Non" id="DrepanocytoseNon">

                                                <label class="form-check-label" for="DrepanocytoseNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Cirrhose de foie</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="liverCirrhosis" type="radio"
                                                    value="Oui" id="CirrhoseOui">

                                                <label class="form-check-label" for="CirrhoseOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="liverCirrhosis" type="radio"
                                                    value="Non" id="CirrhoseNon">

                                                <label class="form-check-label" for="CirrhoseNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Affections pulmonaires</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="lungDisease" type="radio"
                                                    value="Oui" id="AffectionsOui">

                                                <label class="form-check-label" for="AffectionsOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="lungDisease" type="radio"
                                                    value="Non" id="AffectionsNon">

                                                <label class="form-check-label" for="AffectionsNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Cancer</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="cancer" type="radio"
                                                    value="Oui" id="CancerOui">

                                                <label class="form-check-label" for="CancerOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="cancer" type="radio"
                                                    value="Non" id="CancerNon">

                                                <label class="form-check-label" for="CancerNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Anémie</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="anemia" type="radio"
                                                    value="Oui" id="AnemieOui">

                                                <label class="form-check-label" for="AnemieOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="anemia" type="radio"
                                                    value="Non" id="AnemieNon">

                                                <label class="form-check-label" for="AnemieNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card col-lg-6 col-md-6 col-sm-12">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r">

                                            <label for="" class="form-label">Insuffisance rénale</label>

                                        </div>

                                        <div class="col-12 col-lg-5 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="kidneyFailure" type="radio"
                                                    value="Oui" id="InsuffisanceOui">

                                                <label class="form-check-label" for="InsuffisanceOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="kidneyFailure" type="radio"
                                                    value="Non" id="InsuffisanceNon">

                                                <label class="form-check-label" for="InsuffisanceNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>



                            <div class="card" style="width: 100%">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 col-lg-8 border-r">

                                            <label for="" class="form-label">Avez-vous déjà été victime d’un
                                                AVC
                                                ?</label>

                                        </div>

                                        <div class="col-12 col-lg-4 col-md-6 col-sm-6">

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="stroke" type="radio"
                                                    value="Oui" id="AVCOui">

                                                <label class="form-check-label" for="AVCOui">

                                                    Oui

                                                </label>

                                            </div>

                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" name="stroke" type="radio"
                                                    value="Non" id="AVCNon">

                                                <label class="form-check-label" for="AVCNon">

                                                    Non

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-12">

            <div class="d-flex align-items-center justify-content-between gap-3">
                <button onclick="event.preventDefault(); stepper1.previous()"
                    class="btn border-btn btn-previous-form"><i class='bx bx-left-arrow-alt'></i>Précédent</button>

                <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two btn-next-form d-none" id="btn-next-sante">Suivant<i
                        class='bx bx-right-arrow-alt'></i></button>

                <button type="button" data-bs-toggle="modal" data-bs-target="#otpModal" id="btn-otp-modal" class="btn btn-two d-non">Code OTP<i
                    class='bx bx-right-arrow-alt'></i></button>
            </div>
        </div>
    </div>


    <script>
        const data = sessionStorage.getItem('simulationData');
        if (data) {
            const parsedData = JSON.parse(data);
            const isSurete = parsedData.valueSureteCheck;
            const codeProduit = parsedData.codeProduit;

            // Conversion explicite en booléen
            const sureteChecked = (isSurete === true && codeProduit === 'CADENCE');

            if (sureteChecked) {
                document.getElementById('isSureteCheck').style.display = 'block';
            }
        }
    </script>
    @include('productions.components.otpModal')



</div>
