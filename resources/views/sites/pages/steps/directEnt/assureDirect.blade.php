<div class="row g-3 align-items-end mb-3">
    <div class="col-12 col-lg-6">
        <label class="form-label">Le souscripteur est-il l'assuré ? <span class="text-danger">*</span></label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="estAssure" id="estAssureOui" value="Oui">
            <label class="form-check-label" for="estAssureOui">Oui</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="estAssure" id="estAssureNon" value="Non" required>
            <label class="form-check-label" for="estAssureNon">Non</label>
        </div>
    </div>
    <div class="col-12 col-lg-6 text-end" id="modalAssurerOpen">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createAssurerModal">
            <i class="fadeIn animated bx bx-plus"></i> Ajouter un(e) autre assuré(e)
        </button>
    </div>
</div>
@include('sites.pages.add.addAssurerModal')


<div class="overflow-auto">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Assuré(e)</th>
                <th>Date de naissance</th>
                <th>Lieu de résidence</th>
                <th>n° de telephone</th>
                <th>n° de piece</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableAssuresBody">
            <!-- Contenu dynamique injecté ici par JavaScript -->
        </tbody>
    </table>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radioOui = document.getElementById('estAssureOui');
        const radioNon = document.getElementById('estAssureNon');
        const storeAssurerBtn = document.getElementById('storeAssurerBtn');
        const assurerForm = document.getElementById('assurerForm');
        const modalAssurerOpen = document.getElementById('modalAssurerOpen');

        // Fonction pour récupérer les données de la session
        function getSouscriptionData() {
            return JSON.parse(sessionStorage.getItem('souscriptionData')) || {};
        }

        // Fonction pour sauvegarder les données dans la session
        function saveSouscriptionData(data) {
            sessionStorage.setItem('souscriptionData', JSON.stringify(data));
        }

        // Fonction pour vérifier si le type de contrat est Individuel
        function isContratIndividuel() {
            const souscriptionData = getSouscriptionData();
            return souscriptionData.simulationData?.type === "Individuel";
        }

        // Fonction pour vérifier la date de naissance du premier assuré
        function verifierPremierAssure(dateNaissance) {
            console.log('🔎 Vérification de la date de naissance du premier assuré :', dateNaissance);
            const souscriptionData = getSouscriptionData();
            if (!souscriptionData.assureData || souscriptionData.assureData.length === 0) {
                // C'est le premier assuré, on vérifie la date
                // if (dateNaissance !== souscriptionData.simulationData?.birthDate) {
                if (1 === 9) {
                    swal.fire({
                        icon: 'warning',
                        title: 'Désolé',
                        text: 'L"assuré principale doit avoir la meme date de naissance que celle du simulateur.',
                        confirmButtonText: 'Fermer'
                    })
                    return false;
                }
            }
            return true;
        }

        function updateButtonState() {
            const souscriptionData = getSouscriptionData();
            if (souscriptionData.simulationData?.type === "Individuel") {
                if (souscriptionData.assureData.length >= 1) {
                    modalAssurerOpen.classList.add("disabled");
                    modalAssurerOpen.style.pointerEvents = "none";
                    modalAssurerOpen.style.opacity = "0.5";
                } else {
                    modalAssurerOpen.classList.remove("disabled");
                    modalAssurerOpen.style.pointerEvents = "auto";
                    modalAssurerOpen.style.opacity = "1";
                }
            }
        }


        // Fonction pour ajouter un assuré dans le tableau et la session
        function ajouterAssure(assure) {
            const souscriptionData = getSouscriptionData();
            souscriptionData.assureData = souscriptionData.assureData || [];

            console.log('✅ Ajout de l\'assuré :', souscriptionData);

            // Vérifier si le contrat est Individuel et qu'il y a déjà un assuré
            if (isContratIndividuel() && souscriptionData.assureData.length >= 2) {
                swal.fire({
                    icon: 'warning',
                    title: 'Désolé',
                    text: 'Seulment deux assurés sont autorisés pour un contrat individuel.',
                    confirmButtonText: 'Fermer'
                })
                return false;
            }

            // Vérifier si l'assuré existe déjà (par numéro de pièce)
            const existeDeja = souscriptionData.assureData.some(a => a.numeropiece === assure.numeropiece);
            if (existeDeja) {
                swal.fire({
                    icon: 'warning',
                    title: 'Désolé',
                    text: 'Cet assuré est déjà présent dans la liste.',
                    confirmButtonText: 'Fermer'
                })
                return false;
            }

            // Vérification pour le premier assuré
            if (!verifierPremierAssure(assure.datenaissance)) {
                return false;
            }

            // Ajouter l'assuré
            souscriptionData.assureData.push(assure);
            saveSouscriptionData(souscriptionData);

            updateButtonState();

            // Mettre à jour le tableau
            ajouterAssureDansTableau(assure);
            return true;
        }

        // Gestion du changement de l'état "souscripteur est assuré"
        radioOui.addEventListener('change', function() {
            if (this.checked) {
                const souscriptionData = getSouscriptionData();
                const adherentData = souscriptionData.adherentData;
                
                if (!adherentData) {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Veuillez d\'abord renseigner les informations du souscripteur.',
                    })
                    radioNon.checked = true;
                    return;
                }

                // Vérifier si on peut ajouter cet assuré
                if (!ajouterAssure(adherentData)) {
                    radioNon.checked = true;
                }
            }
        });

        radioNon.addEventListener('change', function() {
            if (this.checked) {
                const souscriptionData = getSouscriptionData();
                if (souscriptionData.adherentData) {
                    // Supprimer le souscripteur de la liste des assurés s'il y est
                    const numeropiece = souscriptionData.adherentData.numeropiece;
                    const index = (souscriptionData.assureData || []).findIndex(a => a.numeropiece === numeropiece);
                    
                    if (index !== -1) {
                        souscriptionData.assureData.splice(index, 1);
                        saveSouscriptionData(souscriptionData);
                        
                        // Supprimer visuellement du tableau
                        document.querySelector(`#tableAssuresBody tr[data-id="${numeropiece}"]`)?.remove();
                    }
                }

                updateButtonState();
            }
        });

        // Gestion de l'ajout d'un assuré via le modal
        storeAssurerBtn.addEventListener('click', function () {
            // Récupérer les données du formulaire
            const formData = {
                civilite: document.querySelector('input[name="assurerCivilite"]:checked')?.value || '',
                nom: document.getElementById('assurerNom').value,
                prenom: document.getElementById('assurerPrenom').value,
                datenaissance: document.getElementById('assurerDatenaissance').value,
                lieunaissance: document.getElementById('assurerLieunaissance').value,
                filiation: document.getElementById('assurerFiliation').value,
                sexe: document.getElementById('assurerSexe').value,
                naturepiece: document.getElementById('assurerNaturepiece').value,
                numeropiece: document.getElementById('assurerNumeropiece').value,
                lieuresidence: document.getElementById('assurerLieuresidence').value,
                profession: document.getElementById('assurerProfession').value,
                employeur: document.getElementById('assurerEmployeur').value,
                email: document.getElementById('assurerEmail').value,
                telephone: document.getElementById('assurerTelephone').value,
                telephone1: document.getElementById('assurerTelephone1').value,
                mobile: document.getElementById('assurerMobile').value,
                justifResidence: document.getElementById('justifResidence').files
            };

            // Vérifier si on peut ajouter cet assuré
            if (ajouterAssure(formData)) {
                // Fermer le modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('createAssurerModal'));
                modal.hide();

                // Réinitialiser le formulaire
                assurerForm.reset();
            }
        });

        // Fonction pour ajouter un assuré dans le tableau HTML
        function ajouterAssureDansTableau(assure) {
            const tbody = document.getElementById('tableAssuresBody');

            // Si type = Individuel → on vide avant d'ajouter
            if (isContratIndividuel()) {
                tbody.innerHTML = '';
            }

            const tr = document.createElement('tr');
            tr.setAttribute('data-id', assure.numeropiece);

            tr.innerHTML = `
                <td>${assure.civilite} ${assure.nom} ${assure.prenom}</td>
                <td>${assure.datenaissance}</td>
                <td>${assure.lieuresidence}</td>
                <td>${assure.mobile || assure.telephone}</td>
                <td>${assure.numeropiece}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="supprimerLigne(this)">Supprimer</button>
                </td>
            `;

            tbody.appendChild(tr);
        }

        // Initialisation: charger les assurés existants au chargement de la page
        function initialiserTableauAssures() {
            const souscriptionData = getSouscriptionData();
            const assures = souscriptionData.assureData || [];
            
            // Vider le tableau
            document.getElementById('tableAssuresBody').innerHTML = '';
            
            // Remplir avec les assurés existants
            assures.forEach(assure => {
                ajouterAssureDansTableau(assure);
            });
            
            // Cocher "Oui" si le souscripteur est dans la liste des assurés
            if (souscriptionData.adherentData && assures.some(a => a.numeropiece === souscriptionData.adherentData.numeropiece)) {
                radioOui.checked = true;
            } else {
                radioNon.checked = true;
            }
        }
    
        initialiserTableauAssures();
    });

    // Fonction globale pour supprimer une ligne
    function supprimerLigne(btn) {
        const row = btn.closest('tr');
        const id = row.getAttribute('data-id');
        row.remove();
        const modalAssurerOpen = document.getElementById('modalAssurerOpen');
        const radioNon = document.getElementById('estAssureNon');

        let souscriptionData = JSON.parse(sessionStorage.getItem('souscriptionData'));
        if (souscriptionData && souscriptionData.assureData) {
            souscriptionData.assureData = souscriptionData.assureData.filter(a => a.numeropiece !== id);
            sessionStorage.setItem('souscriptionData', JSON.stringify(souscriptionData));
        }
        
        if (souscriptionData.simulationData?.type === "Individuel") {
            if (souscriptionData.assureData.length >= 1) {
                modalAssurerOpen.classList.add("disabled");
                modalAssurerOpen.style.pointerEvents = "none";
                modalAssurerOpen.style.opacity = "0.5";
            } else {
                modalAssurerOpen.classList.remove("disabled");
                modalAssurerOpen.style.pointerEvents = "auto";
                modalAssurerOpen.style.opacity = "1";
            }

            radioNon.checked = true;
        }

        
        
    }
</script>

