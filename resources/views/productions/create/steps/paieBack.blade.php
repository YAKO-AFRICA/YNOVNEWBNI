<div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
    <h5 class="mb-1">Informations relatives aux modes de paiement et la periodicité</h5>
    <p class="mb-4">Veuillez entrer les informations relatives aux modes de paiement et la periodicité en tenant compte
        des champs obligatoire.</p>

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
                    </div>

                    <div class="row mb-3" id="mode_bancaire" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="banque" class="form-label">Ma banque ou organisme de prélèvement</label>
                            <select class="form-select" id="banque" name="organisme">
                                <option selected value="">Selectionnez la banque</option>
                                @foreach ($societes as $item)
                                    <option value="{{ $item->MonLibelle }}">{{ $item->MonLibelle ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="Agence" class="form-label">Agence</label>
                            <select class="form-select" id="Agence" name="agence">
                                <option  selected value="">Selectionnez l'agence</option>
                                @foreach ($agences as $item)
                                    <option value="{{ $item->NOM_LONG }}">{{ $item->NOM_LONG ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="Matricule" class="form-label">Mon N° de compte (Matricule)</label>
                            <input type="text" class="form-control" id="Matricule" name="numerocompte">
                        </div>
                    </div>

                    <div class="mb-3" id="mode_mobile" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="numMobile" class="form-label">Mon N° Mobile</label>
                            <input type="text" class="form-control" id="numMobile" name="numMobile">
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
                            @if ($product->CodeProduit != 'PFA_IND' && $product->CodeProduit == 'CADENCE')
                            <div class="col-12 mb-4">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                    : <span class="text-danger">*</span></label>
                                <select name="primepricipale" id="primepricipale" class="form-select" required>
                                    <option value="" selected>Selectionnez une prime</option>
                                    <option value="15000">15 000</option>
                                    <option value="20000">20 000</option>
                                    <option value="25000">25 000</option>
                                    <option value="30000">30 000</option>
                                    <option value="40000">40 000</option>
                                    <option value="50000">50 000</option>
                                    <option value="75000">75 000</option>
                                    <option value="100000">100 000</option>
                                </select>
                            </div>
                            @elseif($product->CodeProduit == 'PFA_IND' && $product->CodeProduit != 'CADENCE')
                                <div class="col-12 mb-3">
                                    <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                        : <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="primepricipale" name="primepricipale"
                                        min="1000" required>
                                </div>
                            @endif
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations (en année, entre 6
                                    et 60) :
                                    :</label>
                                <input type="number" min="6" max="60" class="form-control"
                                    id="duree" name="duree" required>
                            </div>
                            @if ($product->CodeProduit == 'PFA_IND' && $product->CodeProduit != 'CADENCE')
                                <div class="col-12 mb-4">
                                    <label for="montantrente" class="form-label">Montant de la Rente (en FCFA) :
                                        : <span class="text-danger">*</span></label>
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
                            @endif
                        @elseif($product->CodeProduit == 'YKE_2008' || $product->CodeProduit == 'YKE_2018')
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffetYKE_2008" name="dateEffet" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                    :</label>
                                <input type="number" class="form-control" id="primepricipaleYKE_2008" name="primepricipale"
                                    min="0" required readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit :</label>
                                <input type="number" class="form-control" id="capitalYKE_2008" name="capital"
                                    min="0" readonly>
                                    
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations :</label>
                                <input type="number" class="form-control" id="dureeYKE_2008" name="duree" min="0"> 
                            </div>

                            <div class="col-12 mb-3">
                                <label for="fraisadhesion" class="form-label">Fraie d'adhesion :</label>
                                <input type="number" class="form-control" id="fraisadhesion" value="7500" name="fraisadhesion" readonly>
                            </div>
                        @elseif ($product->CodeProduit == 'CADENCE')
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                    :</label>
                                <input type="number" class="form-control primeCalcule" id="primepricipale" name="primepricipale"
                                    min="0" required>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations :</label>
                                <input type="number" class="form-control" id="duree" name="duree" min="0"> 
                            </div>

                        @else
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                    :</label>
                                <input type="number" class="form-control" id="primepricipale" name="primepricipale"
                                    min="0" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit :</label>
                                {{-- <input type="number" class="form-control" id="capital" name="capital"
                                    min="0"> --}}
                                    <select name="capital" id="capital" class="form-select" required>
                                        <option value="" selected>Selectionnez le capital souscrit</option>
                                        <option value="300000">300 000</option>
                                        <option value="500000">500 000</option>
                                        <option value="750000">750 000</option>
                                        <option value="1000000">1 000 000</option>
                                        <option value="1250000">1 250 000</option>
                                        <option value="1500000">1 500 000</option>
                                        <option value="2000000">2 000 000</option>
                                    </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations :</label>
                                <input type="number" class="form-control" id="duree" name="duree" min="0"> 
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
                    class="btn border-btn btn-previous-form"><i class='bx bx-left-arrow-alt'></i>Precedent</button>
                <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two btn-next-form">Suivant<i
                        class='bx bx-right-arrow-alt'></i></button>
            </div>
        </div>
    </div><!---end row-->

    {{-- <script>
        document.getElementById("primepricipale").addEventListener("input", function() {
            const primeInput = document.getElementById("primepricipale");
            const primeError = document.getElementById("primepricipale-error");
    
            // Vérifiez si la valeur est inférieure au minimum autorisé
            if (parseInt(primeInput.value) < parseInt(primeInput.min)) {
                primeError.style.display = "block";
            } else {
                primeError.style.display = "none";
            }
        });
    </script> --}}

    



</div>
