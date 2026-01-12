<div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
    <h5 class="mb-1">Informations relatives aux modes de paiement et à la périodicité</h5>
    <p class="mb-4">Veuillez entrer les informations relatives aux modes de paiement et à la périodicité en tenant compte
        des champs obligatoires.</p>

    <div class="row g-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <label for="" class="form-label">Je souhaite payer mes primes par : <span class="text-danger">*</span></label>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="VIR"
                                id="Virement_bancaire" required>
                            <label class="form-check-label" for="Virement_bancaire">
                                Virement bancaire
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="ESP"
                                id="Espece">
                            <label class="form-check-label" for="Espece">
                                Espèce
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="CHK"
                                id="Cheque">
                            <label class="form-check-label" for="Cheque">
                                Chèque
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="Mobile_money"
                                id="Mobile_money">
                            <label class="form-check-label" for="Mobile_money">
                                Mobile money
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio"
                                value="SOURCE" id="Prelevement_source">
                            <label class="form-check-label" for="Prelevement_source">
                                Prélèvement à la source
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio"
                            value="BANK" id="Prelevement_bank">
                            <label class="form-check-label" for="Prelevement_bank">
                                Prélèvement bancaire
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3" id="mode_bancaire" style="display: none;">

                        <div class="col-12 mb-3">
                            <label for="banque" class="form-label">Ma banque ou organisme de prélèvement</label>
                            <select class="form-select selection" id="banque" name="organisme" onchange="ChangeEtat()">
                                <option selected value="" disabled>Selectionnez la banque</option>
                                @foreach ($societes as $item)
                                    <option value="{{ $item->NOM_LONG }}" data-code-guichet="{{ $item->CodeGuichet }}" data-code-banque="{{ $item->CODEBANQUE }}" >
                                        {{ $item->NOM_LONG ?? '' }}
                                    </option>
                                @endforeach 
                            </select>
                        </div>
                        
                        <div class="col-12 mb-3 row w-100">
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <label class="form-label small">Code Banque</label>
                                <input type="text" class="form-control account-number-input" id="codebanque" 
                                    placeholder="30003" maxlength="5" pattern="[0-9]{5}" name="codebanque" >
                            </div> 
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <label class="form-label small">Code Guichet</label>
                                <input type="text" class="form-control account-number-input" id="codeguichet" 
                                    placeholder="02005" maxlength="5" pattern="[0-9]{5}" name="codeguichet" >
                            </div> 
                            <div class="col-sm-8 col-md-5 col-lg-5">
                                <label class="form-label small">Numéro de compte</label>
                                <input type="text" class="form-control account-number-input" id="numerocompte" 
                                    placeholder="00123456789" maxlength="12" pattern="[0-9]{12}" name="numerocompte" >
                            </div> 
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <label class="form-label small">Clé RIB</label>
                                <input type="text" class="form-control account-number-input" id="rib" 
                                    placeholder="12" maxlength="2" pattern="[0-9]{2}" name="rib" >
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">
                                <i class="bx bxs-show me-2"></i>Aperçu du numéro complet
                            </label>
                            <div class="form-control bg-secondary text-white" id="numero_complet" style=" text-align: center; font-size: 18px;">
                                _____ - _____ - ___________ - __
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="mode_mobile" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="numMobile" class="form-label">Mon N° Mobile</label>
                            <input type="text" class="form-control" id="numMobile" name="numMobile">
                        </div>
                    </div>
                    <div class="mb-3" id="mode_source" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="matricule" class="form-label">N° Mecano / N° Matricule</label>
                            <input type="text" class="form-control" id="matricule" name="matricule">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <label for="Conseiller" class="form-label">Votre conseiller client</label>
                            <input type="text" class="form-control" id="Conseiller" name="Conseiller" disabled
                                value="{{ Auth::user()->membre->nom ?? '' }} {{ Auth::user()->membre->prenom ?? '' }}">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="CodeConseiller" class="form-label">Code</label>
                            <input type="text" class="form-control" id="CodeConseiller" name="codeConseiller"
                                disabled value="{{ Auth::user()->membre->codeagent ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card mx-0">
                <div class="card-body">
                    <label for="" class="form-label">Je souhaite payer mes primes chaque : <span class="text-danger">*</span></label>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="M"
                                id="Mois" required>
                            <label class="form-check-label" for="Mois">
                                Mois
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="T"
                                id="Trimestre">
                            <label class="form-check-label" for="Trimestre">
                                Trimestre
                            </label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="S"
                                id="Semestre">
                            <label class="form-check-label" for="Semestre">
                                Semestre
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="A"
                                id="Annee">
                            <label class="form-check-label" for="Annee">
                                Année
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="U"
                                id="Versement_unique">
                            <label class="form-check-label" for="Versement_unique">
                                Versement unique
                            </label>
                        </div>
                    </div>
                    
                    <div class="row">
                        @if ($product->CodeProduit == 'PFA_IND')
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le : <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                    : <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="primepricipale" name="primepricipale"
                                    min="100" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations (en année, entre 6
                                    et 60) :
                                    </label>
                                <input type="number" min="6" max="60" class="form-control"
                                    id="duree" name="duree" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="montantrente" class="form-label">Montant de la rente (en FCFA) :
                                    <span class="text-danger">*</span></label>
                                <select name="montantrente" id="montantrente" class="form-select" required>
                                    <option value="" selected>Selectionnez le montant de la rente</option>
                                    <option value="50000">50 000</option>
                                    <option value="75000">75 000</option>
                                    <option value="100000">100 000</option>
                                    <option value="150000">150 000</option>
                                    <option value="200000">200 000</option>
                                    <option value="250000">250 000</option>
                                    <option value="500000">500 000</option>
                                    <option value="1000000">1000 000</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="" class="form-label">Périodicité de la rente:</label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="M" id="Moisrente">
                                        <label class="form-check-label" for="Moisrente">
                                            Mois
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="T" id="Trimestrerente">
                                        <label class="form-check-label" for="Trimestrerente">
                                            Trimestre
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="S" id="Semestrerente">
                                        <label class="form-check-label" for="Semestrerente">
                                            Semestre
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="periodiciterente" type="radio"
                                            value="A" id="Anneerente">
                                        <label class="form-check-label" for="Anneerente">
                                            Année
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="dureerente" class="form-label">Durée de service de la rente (en mois) :</label>
                                <select name="dureerente" id="dureerente" class="form-select">
                                    <option value="" selected>Selectionnez la durée de service de la rente</option>
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option> 
                                </select>
                            </div>

                        @else
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label input-group-label">Je souhaite payer une prime de :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="primepricipale" name="primepricipale" min="0" required>
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="fraisAdhesion" class="form-label">Frais d’adhésion :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="fraisAdhesion" name="fraisAdhesion"
                                        min="0"value="7500">
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit (en FCFA) :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="capital" name="capital" required>
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations :</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="duree" name="duree" min="0"> 
                                    <span class="input-group-text">mois</span>
                                </div>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="produitCode" name="produitCode" value="{{ $product->CodeProduit ?? '' }}">


        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <button onclick="event.preventDefault(); stepper1.previous()"
                    class="btn border-btn btn-previous-form"><i class='bx bx-left-arrow-alt'></i>Précédent</button>
                <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two btn-next-form">Suivant<i
                        class='bx bx-right-arrow-alt'></i></button>
            </div>
        </div>
    </div><!---end row-->

    <script>
        function ChangeEtat() {
            
            // Pour récupérer la valeur sélectionnée et le data-code-guichet
            const select = document.getElementById('banque');
            const selectedOption = select.options[select.selectedIndex];

            const codeGuichet = selectedOption.getAttribute('data-code-guichet');
            const codeBanque = selectedOption.getAttribute('data-code-banque');

            document.getElementById('codeguichet').value = codeGuichet || '00000';
            document.getElementById('codebanque').value = codeBanque || '00000';
        }
        </script>


    <script>


        // Fonction pour mettre à jour l'aperçu du numéro complet
        function updateAccountPreview() {
            const codeBanque = document.getElementById('codebanque').value || '_____';
            const codeGuichet = document.getElementById('codeguichet').value || '_____';
            const numeroCompte = document.getElementById('numerocompte').value || '___________';
            const cleRib = document.getElementById('rib').value || '__';
            
            const preview = `${codeBanque} - ${codeGuichet} - ${numeroCompte} - ${cleRib}`;
            document.getElementById('numero_complet').textContent = preview;
        }

        // Écouteurs d'événements pour la mise à jour en temps réel
        document.getElementById('codebanque').addEventListener('input', updateAccountPreview);
        document.getElementById('codeguichet').addEventListener('input', updateAccountPreview);
        document.getElementById('numerocompte').addEventListener('input', updateAccountPreview);
        document.getElementById('rib').addEventListener('input', updateAccountPreview);

        // Validation des champs numériques
        document.querySelectorAll('.account-number-input').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        });
    </script>
</div>
