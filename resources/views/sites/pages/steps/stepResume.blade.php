
<div class="row g-3">
    <div class="col-12">
        <div class="card" style="width: 100%">
            <div class="card-header">
                <h4>Adhérent</h4>
                <!-- Alerte Résumé -->
                

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6  col-xs-12 border-r">
                        <dl class="row">
                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Civilité:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayCivility">-- </dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Nom:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayNom">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Prénoms:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayPrenom">--</dd>

                            {{-- <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >Sexe:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displaySexe">Null</dd> --}}

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Date de naissance:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayBirthday">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Lieu de naissance:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayLieuNaissance">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Lieu de résidence:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayResidence">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">N° pièce</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayNumPiece">--</dd>
                        </dl>
                    </div>
                    <div class="col-6 col-xs-12">
                        <dl class="row">
                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Profession:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayProfession">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Secteur d'activité:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayEmployeur">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Email:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayEmail">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Téléphone:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayTelephone">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Mobile:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayMobile">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Mobile 2:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayMobile1">--</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card" style="width: 100%">
            <div class="card-header">
                <h4>Conditions de paiement de la prime & périodicité</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6  col-xs-12 border-r">
                        <dl class="row">
                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Produit:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $product->MonLibelle ?? 'null' }}
                            </dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Prime principale:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayPrimePrincipale">-</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Frais d'adhésion:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayFraisAdhesion">--</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Capital désiré:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayCapital">--</dd>
                        </dl>
                    </div>
                    <div class="col-6  col-xs-12">
                        <dl class="row">
                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Mode paiement:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayModePaiement">-</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Date Effet:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayDateEffet">-</dd>

                            <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">N° Compte:</dt>
                            <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayNumeroCompte">-</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card" style="width: 100%">
            <div class="card-header">
                <h4>Assuré(e)s</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 overflow-auto overflow-scroll">
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénoms</th>
                                    <th scope="col">Né(e) le</th>
                                    <th scope="col">Lieu de naissance</th>
                                    <th scope="col">Lieu de résidence</th>
                                    <th scope="col">Filiation</th>
                                    {{-- <th scope="col">Garanties</th> --}}
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">N° pièce</th>
                                </tr>
                            </thead>
                            <tbody id="resume-tbody-assure">

                            </tbody>
                            <tfoot>
                                <tr id="resume-row" style="display: none;">
                                    <td id="display-nom">-</td>
                                    <td id="display-prenom">-</td>
                                    <td id="display-date-naissance">-</td>
                                    <td id="display-lieu-naissance">-</td>
                                    <td id="display-lieu-residence">-</td>
                                    <td id="display-filiation">Moi-même</td>
                                    {{-- <td id="display-garanties">
                                        <ul>
                                            @foreach ($productGarantie->where('estobligatoire', 1) as $item)
                                                <li>{{ $item->libelle }}</li>
                                            @endforeach
                                        </ul>
                                    </td> --}}
                                    <td id="display-telephone">-</td>
                                    <td id="display-email">-</td>
                                    <td id="display-numeropiece">-</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card" style="width: 100%">
            <div class="card-header">
                <h4>Garanties</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 overflow-auto overflow-scroll">
                        <table class="table mb-0 table-striped table-responsive table-bordered">
                            <thead class="fw-bold">
                                <tr>
                                    <th scope="col">Garantie</th>
                                    <th scope="col">Prime principale</th>
                                    <th scope="col">Capital</th>
                                </tr>
                            </thead>
                            <tbody id="garantiesTableBody">
                                <tr>
                                    <td id="display-garanties">
                                        <span>Decès Rappatriement</span>
                                    </td>
                                    <td id="display-prime-principale">-</td>
                                    <td id="display-capital">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card" style="width: 100%">
            <div class="card-header">
                <h4>Bénéficiaire(s)</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 overflow-auto overflow-scroll">
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénoms</th>
                                    <th scope="col">Né(e) le</th>
                                    <th scope="col">Lieu de naissance</th>
                                    <th scope="col">Lieu de résidence</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">N° pièce</th>
                                </tr>
                            </thead>
                            <tbody id="resume-tbody-benef">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction principale de mise à jour de la vue Résumé
    function addValue(data) {
        const adherent = data.adherentData || {};
        const contrat = data.contratData || {};
        const assures = data.assureData || [];
        const benefs = data.benefData || [];

        console.log('Contrat benefs benefs:', benefs);

        const numCompte = document.getElementById('numero_complet').textContent;

        // Remplir les champs de l'adhérent (souscripteur)
        document.getElementById('displayCivility').textContent = adherent.civilite || '--';
        document.getElementById('displayNom').textContent = adherent.nom || '--';
        document.getElementById('displayPrenom').textContent = adherent.prenom || '--';
        document.getElementById('displayBirthday').textContent = adherent.datenaissance || '--';
        document.getElementById('displayLieuNaissance').textContent = adherent.lieunaissance || '--';
        document.getElementById('displayResidence').textContent = adherent.lieuresidence || '--';
        document.getElementById('displayNumPiece').textContent = adherent.numeropiece || '--';
        document.getElementById('displayProfession').textContent = adherent.profession || '--';
        document.getElementById('displayEmployeur').textContent = adherent.employeur || '--';
        document.getElementById('displayEmail').textContent = adherent.email || '--';
        document.getElementById('displayTelephone').textContent = adherent.telephone || '--';
        document.getElementById('displayMobile').textContent = adherent.mobile || '--';
        document.getElementById('displayMobile1').textContent = adherent.mobile1 || '--';

        // Contrat / Souscription
        document.getElementById('displayDateEffet').textContent = contrat.dateEffet || '--';
        document.getElementById('displayPrimePrincipale').textContent = contrat.primepricipale || '--';
        document.getElementById('displayFraisAdhesion').textContent = contrat.fraisAdhesion || '--';
        document.getElementById('displayCapital').textContent = contrat.capital || '--';
        document.getElementById('displayModePaiement').textContent = contrat.periodicite || '--';
        // document.getElementById('displayOrganisme').textContent = contrat.organisme || '--';
        // document.getElementById('displayAgence').textContent = contrat.agence || '--';
        document.getElementById('displayNumeroCompte').textContent = numCompte || '--';

        // Simulation (capital et prime) - table Garanties
        document.getElementById('display-capital').textContent = contrat.capital || '--';
        document.getElementById('display-prime-principale').textContent = contrat.primepricipale || '--';

        // Liste des assurés
        const tbodyAssure = document.getElementById('resume-tbody-assure');
        tbodyAssure.innerHTML = '';
        if (assures.length > 0) {
            assures.forEach(assure => {
                const row = `
                    <tr>
                        <td>${assure.nom || '--'}</td>
                        <td>${assure.prenom || '--'}</td>
                        <td>${assure.datenaissance || '--'}</td>
                        <td>${assure.lieunaissance || '--'}</td>
                        <td>${assure.lieuresidence || '--'}</td>
                        <td>${assure.filiation || '--'}</td>
                        <td>${assure.mobile || '--'}</td>
                        <td>${assure.email || '--'}</td>
                        <td>${assure.numeropiece || '--'}</td>
                    </tr>
                `;
                tbodyAssure.innerHTML += row;
            });
        } else {
            // Aucun assuré ajouté : le souscripteur est l’assuré
            const row = `
                <tr>
                    <td>${adherent.nom || '--'}</td>
                    <td>${adherent.prenom || '--'}</td>
                    <td>${adherent.datenaissance || '--'}</td>
                    <td>${adherent.lieunaissance || '--'}</td>
                    <td>${adherent.lieuresidence || '--'}</td>
                    <td>Moi-même</td>
                    <td>${adherent.mobile || '--'}</td>
                    <td>${adherent.email || '--'}</td>
                    <td>${adherent.numeropiece || '--'}</td>
                </tr>
            `;
            tbodyAssure.innerHTML = row;
        }


        const tbodyBenef = document.getElementById('resume-tbody-benef');

        tbodyBenef.innerHTML = '';

        if (benefs.length > 0) {
            
            benefs.forEach(benef => {
                const row = `
                    <tr>
                        <td>${benef.nom || '--'}</td>
                        <td>${benef.prenom || '--'}</td>
                        <td>${benef.datenaissance || '--'}</td>
                        <td>${benef.lieunaissance || '--'}</td>
                        <td>${benef.lieuresidence || '--'}</td>
                        <td>${benef.mobile || '--'}</td>
                        <td>${benef.email || '--'}</td>
                        <td>${benef.numeropiece || '--'}</td>
                    </tr>
                `;
                tbodyBenef.innerHTML += row;
            });
        }
        

    }

    // Vérifie si l'étape 5 est active pour déclencher l'affichage
    function checkStepAlert() {
        const step5 = document.querySelector('[data-step="5"]');

        if (step5 && step5.classList.contains('active')) {
            console.log('Etape 5 active');
            const data = JSON.parse(sessionStorage.getItem('souscriptionData') || '{}');
            if (Object.keys(data).length > 0) {
                addValue(data);
            }
        }
    }

    // Événement au chargement de la page
    document.addEventListener('DOMContentLoaded', checkStepAlert);

    // Observer les changements d'étape (ex: via boutons suivant/précédent)
    const observer = new MutationObserver(checkStepAlert);
    observer.observe(document.body, {
        attributes: true,
        subtree: true,
        attributeFilter: ['class']
    });
</script>




        {{-- // Bénéficiaires - Terme & Décès
        // const benefTerme = document.getElementById('display-beneficiaire-terme');
        // const benefDeces = document.getElementById('display-beneficiaire-deces');

        // const termeList = benefs.filter(b => b.type === 'terme');
        // const decesList = benefs.filter(b => b.type === 'deces');

        // benefTerme.innerHTML = termeList.length
        //     ? termeList.map(b => `<p><strong>${b.nom || ''} ${b.prenom || ''}</strong> - ${b.lien || '--'}</p>`).join('')
        //     : '<p>--</p>';

        // benefDeces.innerHTML = decesList.length
        //     ? decesList.map(b => `<p><strong>${b.nom || ''} ${b.prenom || ''}</strong> - ${b.lien || '--'}</p>`).join('')
        //     : '<p>--</p>'; --}}
