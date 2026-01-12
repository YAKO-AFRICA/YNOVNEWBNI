

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
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="Mobile_money"
                                id="Mobile_money">
                            <label class="form-check-label" for="Mobile_money">
                                Mobile money
                            </label>
                        </div> --}}
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio"
                                value="CARTE" id="carte_bancaire">
                            <label class="form-check-label" for="carte_bancaire">
                                Carte bancaire
                            </label>
                        </div>
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio"
                                value="SOURCE" id="Prelevement_source">
                            <label class="form-check-label" for="Prelevement_source">
                                Prélèvement à la source
                            </label>
                        </div> --}}
                    </div>

                    <div id="carte_mode" class="my-4 p-4 border rounded shadow-sm bg-light text-content-center text-center align-items-center" style="display: none;">
                        <h4 class="mb-3 text-success">
                            <i class="fas fa-credit-card me-2"></i> Mode de paiement par carte bancaire
                        </h4>

                        <p class="text-danger mb-2">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Ce service n'est pas encore disponible pour le moment
                        </p>

                        <small class="text-muted">
                            <i class="fas fa-university me-2"></i>
                            En attendant, vous pouvez payer par <strong>virement bancaire</strong>
                        </small>
                    </div>


                    <div class="row mb-3" id="mode_bancaire" style="display: none;">
                      
                        <div class="col-12 mb-3 row w-100">
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <label class="form-label small">Code Banque</label>
                                <input type="text" class="form-control account-number-input" id="codebanque" 
                                    placeholder="30003" maxlength="5" pattern="[0-9]{5}" name="codebanque">
                            </div> 
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <label class="form-label small">Code Guichet</label>
                                <input type="text" class="form-control account-number-input" id="codeguichet" 
                                    placeholder="02005" maxlength="5" pattern="[0-9]{5}" name="codeguichet" required>
                            </div> 
                            <div class="col-sm-8 col-md-5 col-lg-5">
                                <label class="form-label small">Numéro de compte</label>
                                <input type="text" class="form-control account-number-input" id="numerocompte" 
                                    placeholder="00123456789" maxlength="12" pattern="[0-9]{12}" name="numerocompte" required>
                            </div> 
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <label class="form-label small">Clé RIB</label>
                                <input type="text" class="form-control account-number-input" id="rib" 
                                    placeholder="12" maxlength="2" pattern="[0-9]{2}" name="rib" required>
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
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="U"
                                id="Versement_unique" readonly disabled>
                            <label class="form-check-label" for="Versement_unique">
                                Versement unique
                            </label>
                        </div> --}}
                    </div>
                    
                    
                    <div class="row">
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de
                                    :</label>
                                <input type="number" class="form-control" id="primepricipale" name="primepricipale"
                                    min="0" required readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="fraisAdhesion" class="form-label">Frais d'adhesion :</label>
                                <input type="number" class="form-control" id="fraisAdhesion" name="fraisAdhesion"
                                    min="0" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit :</label>
                                <input type="text" class="form-control" id="capital" name="capital" required readonly>
                                
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de mes cotisations :</label>
                                <input type="number" class="form-control" id="duree" name="duree" min="0"> 
                            </div>
                            <input type="hidden" id="tokGenerate" name="tokGenerate" value="{{ $tok }}">

                    </div>
                </div>
            </div>
        </div>
    </div><!---end row-->


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

    <script>
function handleModePaiementChange() {
    const mode = document.querySelector('input[name="modepaiement"]:checked')?.value;

    const modeBancaire = document.getElementById('mode_bancaire');
    const modeMobile = document.getElementById('mode_mobile');
    const carteBancaire = document.getElementById('carte_mode');

    // Champs bancaires
    const champsBancaires = [
        document.getElementById('codebanque'),
        document.getElementById('codeguichet'),
        document.getElementById('numerocompte'),
        document.getElementById('rib')
    ];

    // Champ mobile
    const champMobile = document.getElementById('numMobile');

    if (mode === 'VIR' || mode === 'SOURCE') {
        modeBancaire.style.display = 'block';
        modeMobile.style.display = 'none';
        if (carteBancaire) carteBancaire.style.display = 'none';

        // Rendre les champs bancaires obligatoires
        champsBancaires.forEach(champ => champ?.setAttribute('required', true));
        if (champMobile) champMobile.removeAttribute('required');
    } 
    else if (mode === 'Mobile_money') {
        modeBancaire.style.display = 'none';
        modeMobile.style.display = 'block';
        if (carteBancaire) carteBancaire.style.display = 'none';

        // Rendre le champ mobile obligatoire, et non les champs bancaires
        champMobile?.setAttribute('required', true);
        champsBancaires.forEach(champ => champ?.removeAttribute('required'));
    } 
    else {
        // ESP, CHQ, etc. => rien de requis
        modeBancaire.style.display = 'none';
        modeMobile.style.display = 'none';
        if (carteBancaire) carteBancaire.style.display = 'none';

        // Retirer tous les required
        champsBancaires.forEach(champ => champ?.removeAttribute('required'));
        champMobile?.removeAttribute('required');
    }
}

// Écouteurs sur tous les boutons radio de modepaiement
document.querySelectorAll('input[name="modepaiement"]').forEach(input => {
    input.addEventListener('change', handleModePaiementChange);
});

// Initialiser l'affichage correct au chargement
document.addEventListener('DOMContentLoaded', handleModePaiementChange);
</script>


    {{-- <script>
        function handleModePaiementChange() {
            const mode = document.querySelector('input[name="modepaiement"]:checked')?.value;

            const modeBancaire = document.getElementById('mode_bancaire');
            const modeMobile = document.getElementById('mode_mobile');
            const carteBancaire = document.getElementById('carte_mode');

            if (mode === 'VIR' || mode === 'SOURCE') {
                modeBancaire.style.display = 'block';
                modeMobile.style.display = 'none';
                carteBancaire.style.display = 'none';
            } else if (mode === 'Mobile_money') {
                modeBancaire.style.display = 'none';
                modeMobile.style.display = 'block';
                carteBancaire.style.display = 'none';
            } else if(mode === 'CARTE') {
                modeBancaire.style.display = 'none';
                modeMobile.style.display = 'none';
                carteBancaire.style.display = 'block';
            }else {
                // Pour ESP ou CHK, on masque tout
                modeBancaire.style.display = 'none';
                modeMobile.style.display = 'none';
                carteBancaire.style.display = 'none';
            }
        }

        // Écouteurs sur tous les boutons radio de modepaiement
        document.querySelectorAll('input[name="modepaiement"]').forEach(input => {
            input.addEventListener('change', handleModePaiementChange);
        });

        // Initialiser l'affichage correct au chargement (au cas où il y aurait une valeur déjà cochée)
        document.addEventListener('DOMContentLoaded', handleModePaiementChange);
    </script> --}}



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dataPay = JSON.parse(sessionStorage.getItem('souscriptionData') || '{}');
            const sim = dataPay.simulationData || {};

            // if (!sim.type) return;

            // Remplissage automatique
            const periodicite = document.querySelector('input[name="periodicite"]').value;
            document.getElementById('DateEffet').value = new Date().toISOString().split('T')[0];
            document.getElementById('primepricipale').value = sim.prime;
            document.getElementById('capital').value = sim.capital?.replace(/\s/g, '') || '';
            document.getElementById('duree').value = '1';

            // Frais d'adhésion (à adapter selon <t></t>on besoin)
            document.getElementById('fraisAdhesion').value = '0';


            const modePaiement = document.querySelectorAll('input[name="modepaiement"]').value;
            const codeBanque = document.getElementById('codebanque').value;
            const codeGuichet = document.getElementById('codeguichet').value;
            const numeroCompte = document.getElementById('numerocompte').value;
            const cleRib = document.getElementById('rib').value;
            const numMobile = document.getElementById('numMobile').value;

            // Sauvegarder automatiquement dans souscriptionData.contratData
            if (!dataPay.contratData) dataPay.contratData = {};
            Object.assign(dataPay.contratData, {
                periodicite: periodicite,
                dateEffet: document.getElementById('DateEffet').value,
                primepricipale: sim.prime,
                capital: sim.capital,
                fraisAdhesion: '0',
                duree: '1',
                modepaiement: modePaiement,
                codebanque: codeBanque,
                codeguichet: codeGuichet,
                numerocompte: numeroCompte,
                rib: cleRib,
                numMobile: numMobile,
                tokGenerate: document.getElementById('tokGenerate').value
            });
            sessionStorage.setItem('souscriptionData', JSON.stringify(dataPay));
        });

        // Sauvegarde dynamique à chaque changement
        document.addEventListener('input', (e) => {
            if (['periodicite', 'dateEffet', 'primepricipale', 'fraisAdhesion', 'capital', 'duree', 'modepaiement', 'codebanque', 'codeguichet', 'numerocompte', 'rib', 'numMobile'].includes(e.target.name)) {
                const data = JSON.parse(sessionStorage.getItem('souscriptionData') || '{}');
                
                if (!data.contratData) data.contratData = {};
                if (e.target.type === 'radio') {
                    data.contratData[e.target.name] = document.querySelector(`input[name="${e.target.name}"]:checked`)?.value;
                } else {
                    data.contratData[e.target.name] = e.target.value;
                }
                sessionStorage.setItem('souscriptionData', JSON.stringify(data));

                
            }
        });
        
    </script>

