<div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
    <h5 class="mb-1">Informations de l'assuré(e)</h5>
    <p class="mb-4">Veuillez entrer les informations relatives à l'assuré(e) en tenant compte des champs obligatoires.
    </p>
    @php
        $GarantiesOptionnelles = $productGarantie->where('estobligatoire', 0)->all();
        // dd($GarantiesOptionnelles);
    @endphp
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="" class="form-label">Le souscripteur est-il l'assuré ? <span
                    class="text-danger">*</span></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estAssure" id="Oui" value="Oui" required>
                <label class="form-check-label" for="Oui">Oui</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estAssure" id="Non" value="Non">
                <label class="form-check-label" for="Non">Non</label>
            </div>
        </div>


        {{-- @if ($CodeProduit != 'ASSCPTBNI' && Auth::user()->codepartenaire == 'DIFIN') --}}
        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createPropositionModal"><i
                    class="fadeIn animated bx bx-plus"></i>Ajouter un(e) autre
                assuré(e)</button>
            <!-- Modal -->
        </div>
        {{-- @endif --}}
    </div>
    <div class="overflow-auto">
        <table class="table mb-0 table-striped table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Assuré(e)</th>
                    <th scope="col">Garanties</th>
                    <th scope="col">Garanties complementaires</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
    
            <tbody>
                {{-- coàntenue dynamique --}}
            </tbody>
    
            <tfoot>
                <tr id="conditional-tr" style="display: none;">
                    <td id="display-nom-prenom"></td>
                    <td>
                        <ul>
                            @foreach ($productGarantie->where('estobligatoire', 1) as $item)
                                <li>{{ $item->libelle }}</li>
                            @endforeach
                        </ul>
                    </td>
                    @if (!empty($GarantiesOptionnelles))
                        <td>
                            <ul>
                                @foreach ($GarantiesOptionnelles as $item)
                                    <li>
                                        <label class="form-label">
                                            Souhaitez-vous souscrire à la garantie {{ $item->libelle }} ?
                                        </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input garantie-optionnelle" type="radio"
                                                name="GarantiesOptionnelles[{{ $item->id }}]"
                                                id="OuiGarantiesOptionnelles{{ $item->id }}" 
                                                data-gar-value="{{ $item->codeproduitgarantie }}"
                                                @if ($product->CodeProduit == 'CADENCE') checked readonly @endif 
                                                value="Oui">
                                            <label class="form-check-label"
                                                for="OuiGarantiesOptionnelles{{ $item->id }}">Oui</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input garantie-optionnelle" type="radio"
                                                name="GarantiesOptionnelles[{{ $item->id }}]"
                                                id="NonGarantiesOptionnelles{{ $item->id }}" 
                                                data-gar-value="{{ $item->codeproduitgarantie }}" 
                                                value="Non">
                                            <label class="form-check-label"
                                                for="NonGarantiesOptionnelles{{ $item->id }}">Non</label>
                                        </div>
                                    </li>
                                @endforeach

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const simulationData = JSON.parse(sessionStorage.getItem('simulationData'));
                                        console.log('Données de simulation:', simulationData);

                                        const hasSenior = simulationData?.garantieData?.some(item => item.codeGarantie === 'SENIOR');

                                        document.querySelectorAll('.garantie-optionnelle').forEach(radio => {
                                            const garValue = radio.getAttribute('data-gar-value');

                                            if (garValue === 'SENIOR') {
                                                if (hasSenior) {
                                                    // Si garantie SENIOR existe → coche "Oui"
                                                    if (radio.value === 'Oui') {
                                                        radio.checked = true;
                                                    } else {
                                                        radio.checked = false;
                                                    }
                                                } else {
                                                    // Sinon → coche "Non"
                                                    if (radio.value === 'Non') {
                                                        radio.checked = true;
                                                    } else {
                                                        radio.checked = false;
                                                    }
                                                }

                                                // Rendre les deux boutons non modifiables
                                                radio.disabled = true;
                                                radio.parentElement.style.opacity = '0.7';
                                            }

                                            const hasSurete = simulationData?.garantieData?.some(item => item.codeGarantie === 'SUR');
                                            if (garValue === 'SUR') {
                                                if (hasSurete) {
                                                    // Si garantie SENIOR existe → coche "Oui"
                                                    if (radio.value === 'Oui') {
                                                        radio.checked = true;
                                                    } else {
                                                        radio.checked = false;
                                                    }
                                                } else {
                                                    // Sinon → coche "Non"
                                                    if (radio.value === 'Non') {
                                                        radio.checked = true;
                                                    } else {
                                                        radio.checked = false;
                                                    }
                                                }

                                                // Rendre les deux boutons non modifiables
                                                radio.disabled = true;
                                                radio.parentElement.style.opacity = '0.7';
                                            }

                                            const hasDeces = simulationData?.garantieData?.some(item => item.codeGarantie === 'DECESACC');
                                            if (garValue === 'DECESACC') {
                                                if (hasDeces) {
                                                    // Si garantie hasDeces existe → coche "Oui"
                                                    if (radio.value === 'Oui') {
                                                        radio.checked = true;
                                                    } else {
                                                        radio.checked = false;
                                                    }
                                                } else {
                                                    // Sinon → coche "Non"
                                                    if (radio.value === 'Non') {
                                                        radio.checked = true;
                                                    } else {
                                                        radio.checked = false;
                                                    }
                                                }

                                                // Rendre les deux boutons non modifiables
                                                radio.disabled = true;
                                                radio.parentElement.style.opacity = '0.7';
                                            }
                                        });
                                    });
                                </script>
                            </ul>
                        </td>
                    @else
                        <td>Pas de garantie complementaire</td>
                    @endif
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>


    <div class="row g-3">
        {{-- <div class="col-12"> --}}
        <div class="d-flex align-items-center justify-content-between gap-3">
            <button onclick="event.preventDefault(); stepper1.previous()" class="btn border-btn btn-previous-form"><i
                    class='bx bx-left-arrow-alt'></i>Précédent</button>
            <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two btn-next-form">Suivant<i
                    class='bx bx-right-arrow-alt'></i></button>

                    
        </div>
        {{-- </div> --}}
    </div>
    <!---end row-->

</div>



<script>
document.addEventListener('DOMContentLoaded', function() {

    // Récupère les données depuis la session
    const sessionData = sessionStorage.getItem('simulationData');
    if (!sessionData) return;

    const simulationData = JSON.parse(sessionData);
    const info = simulationData.infoSimulation || {};

    // --- 1️⃣ Mise à jour des champs nom & prénom ---
    const firstNameInput = document.getElementById('FisrtName');
    const lastNameInput = document.getElementById('LastName');
    const displayNomPrenom = document.getElementById('display-nom-prenom');

    // Fonction de mise à jour en temps réel
    function updateDisplay() {
        const nom = firstNameInput.value.trim();
        const prenom = lastNameInput.value.trim();
        displayNomPrenom.textContent = (nom || prenom) ? `${nom} ${prenom}` : '';
    }

    // Déclenchement à chaque frappe
    firstNameInput.addEventListener('input', updateDisplay);
    lastNameInput.addEventListener('input', updateDisplay);

    // Appel initial (au cas où les champs sont déjà remplis)
    updateDisplay();

    // --- 2️⃣ Gestion des boutons radio Oui / Non ---
    const radioOui = document.getElementById('Oui');
    const radioNon = document.getElementById('Non');
    const conditionalRow = document.getElementById('conditional-tr');

    if (radioOui && radioNon) {
        // Coche la bonne valeur à partir de la session
        if (info.isAssure === 'oui') {
            radioOui.checked = true;
            // Rendre les boutons non modifiables
            radioOui.disabled = true;
            radioNon.disabled = true;
        } else if (info.isAssure === 'non') {
            radioNon.checked = true;
            // Rendre les boutons non modifiables
            radioOui.disabled = true;
            radioNon.disabled = true;
        }

        // Met à jour l'affichage du tableau selon la valeur
        if (conditionalRow) {
            conditionalRow.style.display = (info.isAssure === 'oui') ? 'table-row' : 'none';
        }
    }

    radioOui.addEventListener('change', toggleRowDisplay);
    radioNon.addEventListener('change', toggleRowDisplay);


    function toggleRowDisplay() {
        const isAssureOui = document.getElementById('Oui').checked;
        const row = document.getElementById('conditional-tr');
        row.style.display = isAssureOui ? 'table-row' : 'none';
    }
});
</script>




<script>

    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM entièrement chargé");

        let assures = [];

        const boutonAjouter = document.getElementById('btn-ajouter');
        if (boutonAjouter) {
            boutonAjouter.addEventListener('click', ajouterAssureTemporaire);
        } else {
            console.error("Le bouton 'Ajouter' n'a pas été trouvé.");
        }


        function ajouterAssureTemporaire() {
            console.log("La fonction ajouterAssureTemporaire a été appelée.");

            const nomElement = document.getElementById('nomAssur');
            const prenomElement = document.getElementById('prenomAssur');
            const civiliteElementAll = [...document.querySelectorAll('.civiliteAssur')];
            const dateElement = document.getElementById('datenaissanceAssur');
            const lieuNaissanceElement = document.getElementById('lieunaissanceAssur');
            const numeropieceAssurElement = document.getElementById('numeropieceAssur');
            const naturepieceAssurElementAll = [...document.querySelectorAll('.naturepieceAssur')];
            const lieuresidenceAssurElement = document.getElementById('lieuresidenceAssur');
            const lienParenteElement = document.getElementById('lienParente');
            const mobileAssurElement = document.getElementById('mobileAssur');
            const emailAssurElement = document.getElementById('emailAssur');

            const nom = nomElement.value.trim();
            const prenom = prenomElement.value.trim();
            const civilite = getCiviliteSelectedValue(civiliteElementAll);
            const datenaissance = dateElement.value.trim();
            const lieuNaissance = lieuNaissanceElement ? lieuNaissanceElement.value.trim() : '';
            const numeropieceAssur = numeropieceAssurElement ? numeropieceAssurElement.value.trim() : '';
            const naturepieceAssur = getNaturePieceSelectedValue(naturepieceAssurElementAll);
            const lieuresidenceAssur = lieuresidenceAssurElement ? lieuresidenceAssurElement.value.trim() : '';
            const lienParente = lienParenteElement ? lienParenteElement.value.trim() : '';
            const mobileAssur = mobileAssurElement ? mobileAssurElement.value.trim() : '';
            const emailAssur = emailAssurElement ? emailAssurElement.value.trim() : '';

            // Validation des champs obligatoires
            if (!validateField(nomElement, nom) ||
                !validateField(prenomElement, prenom) ||
                !validateField(dateElement, datenaissance) ||
                !validateFieldRadio(civiliteElementAll, civilite)) {
                return; // Stop si un champ obligatoire est invalide
            }

            // Ajouter l'assuré temporaire
            assures.push({
                nom,
                prenom,
                civilite,
                datenaissance,
                lieuNaissance,
                numeropieceAssur,
                naturepieceAssur,
                lieuresidenceAssur,
                lienParente,
                mobileAssur,
                emailAssur
            });

            const assuresInput = document.getElementById('assuresInput').value = JSON.stringify(assures);
            console.log("Assurés input :", assuresInput);

            console.log("Assuré ajouté :", assures);

            // Réinitialiser le formulaire
            resetForm(nomElement, prenomElement, dateElement, lieuNaissanceElement, lieuresidenceAssurElement,
                lienParenteElement, mobileAssurElement, emailAssurElement, numeropieceAssurElement);
            resetRadio(civiliteElementAll);
            resetRadio(naturepieceAssurElementAll);

            afficherAssures();
            $('#createPropositionModal').modal('hide');
        }

        function validateField(element, value) {
            if (!value) {
                element.classList.add('is-invalid');
                element.classList.remove('is-valid');
                return false;
            } else {
                element.classList.remove('is-invalid');
                element.classList.add('is-valid');
                return true;
            }
        }

        // Validation spécifique pour les boutons radio
        function validateFieldRadio(elements, value) {
            if (!value) {
                elements.forEach(el => el.classList.add('is-invalid'));
                return false;
            } else {
                elements.forEach(el => el.classList.remove('is-invalid'));
                return true;
            }
        }

        // Récupération de la valeur sélectionnée pour Civilité
        function getCiviliteSelectedValue(elements) {
            for (let element of elements) {
                if (element.checked) {
                    return element.value;
                }
            }
            return ''; // Retourne une valeur vide si aucune option n'est sélectionnée
        }

        // Récupération de la valeur sélectionnée pour Nature de pièce
        function getNaturePieceSelectedValue(elements) {
            for (let element of elements) {
                if (element.checked) {
                    return element.value;
                }
            }
            return ''; // Retourne une valeur vide si aucune option n'est sélectionnée
        }

        // Réinitialisation des champs texte
        function resetForm(...elements) {
            elements.forEach(el => {
                if (el) {
                    el.value = '';
                    el.classList.remove('is-valid', 'is-invalid');
                }
            });
        }

        // Réinitialisation des boutons radio
        function resetRadio(elements) {
            elements.forEach(el => {
                el.checked = false;
                el.classList.remove('is-valid', 'is-invalid');
            });
        }

        function afficherAssures() {
            const tbody = document.querySelector('#test-l-2 tbody');
            const tbodyResume = document.querySelector('#resume-tbody-assure');

            if (!tbody) {
                console.error("Le tbody pour afficher les assurés n'a pas été trouvé.");
                return;
            }

            tbody.innerHTML = '';
            tbodyResume.innerHTML = '';

            assures.forEach((assure, index) => {
                const row = `
                <tr>
                    <td>${assure.nom} ${assure.prenom}</td>
                    <td>
                        <ul>
                            @foreach ($productGarantie->where('estobligatoire', 1) as $item)
                                <li>{{ $item->libelle }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Pas de garantie complementaire</td>
                    <td>
                        <a href="#" onclick="supprimerAssure(${index})" class="text-danger">
                            <i class="fadeIn animated bx bx-x fs-4"></i>
                        </a>
                    </td>
                </tr>`;
                tbody.innerHTML += row;
            });
            assures.forEach((assure, index) => {

                const Datarow = `
                <tr>
                    <td>${assure.nom || '-'}</td>
                    <td>${assure.prenom || '-'}</td>
                    <td>${assure.datenaissance || '-'}</td>
                    <td>${assure.lieuNaissance || '-'}</td>
                    <td>${assure.lieuresidenceAssur}</td>
                    <td>${assure.lienParente || '-'}</td>
                    <td>
                        <ul>
                            @foreach ($productGarantie->where('estobligatoire', 1) as $item)
                                <li>{{ $item->libelle }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>${assure.mobileAssur || '-'}</td>
                    <td>${assure.emailAssur}</td>
                    <td>${assure.numeropieceAssur || '-'}</td>
                </tr>`;
                tbodyResume.innerHTML += Datarow;
            });
        }

        function supprimerAssure(index) {
            assures.splice(index, 1);
            const assuresInput = document.getElementById('assuresInput').value = JSON.stringify(assures);
            console.log("Assurés input :", assuresInput);
            afficherAssures();
        }

        window.ajouterAssureTemporaire = ajouterAssureTemporaire;
        window.supprimerAssure = supprimerAssure;

        // Affichez initialement les assurés
        afficherAssures();

    });
</script>
