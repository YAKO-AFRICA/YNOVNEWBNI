
<div class="row g-3">
    <div class="col-12 col-lg-12">
        <label class="form-label">Au  décès</label>
        <div class="card p-3">
            <div class="card-body">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="Conjoint non divorcé, ni séparé de corps" id="conjointCheckbox">
                    <label class="form-check-label" for="conjointCheckbox">
                        Le conjoint non divorcé, ni séparé de corps
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Enfants nés et à naitre" id="enfantsCheckbox">
                    <label class="form-check-label" for="enfantsCheckbox">
                        Les enfants nés et à naître
                    </label>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addBenefModal">
                    <i class="fadeIn animated bx bx-plus"></i> Ajouter un autre bénéficiaire
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="card">
        <div class="card-body overflow-auto overflow-scroll">
            <table class="table mb-0 table-striped" id="beneficiariesTable">
                <thead>
                    <tr>
                        <th scope="col">Nom & Prénoms</th>
                        <th scope="col">Né(e) le</th>
                        <th scope="col">Lieu de naissance</th>
                        <th scope="col">Lieu de residence</th>
                        <th scope="col">Filiation</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Beneficiary rows will be appended here -->
                </tbody>
            </table>
        </div>
    </div>
    @include('sites.pages.add.addBenefModal')
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const conjointCheckbox = document.getElementById('conjointCheckbox');
    const enfantsCheckbox = document.getElementById('enfantsCheckbox');
    const beneficiariesTable = document.querySelector('#beneficiariesTable tbody');

    // Met à jour benefData dans sessionStorage
    function updateBenefDataInSouscription(beneficiaires) {
        let souscription = JSON.parse(sessionStorage.getItem('souscriptionData')) || {};
        souscription.benefData = beneficiaires;
        sessionStorage.setItem('souscriptionData', JSON.stringify(souscription));
    }

    // Ajoute une ligne dans le tableau
    function addBeneficiaireRow(nom, prenom, lien, id) {
        const existingRow = beneficiariesTable.querySelector(`tr[data-id="${id}"]`);
        if (existingRow) return;

        const newRow = `
            <tr data-id="${id}">
                <td>${nom} ${prenom}</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>${lien || '--'}</td>
                <td>-</td>
                <td>-</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="removeBeneficiaireAuto('${id}')">Supprimer</button>
                </td>
            </tr>
        `;
        beneficiariesTable.insertAdjacentHTML('beforeend', newRow);
    }

    // Supprime une ligne du tableau
    function removeBeneficiaireRow(id) {
        const row = beneficiariesTable.querySelector(`tr[data-id="${id}"]`);
        if (row) row.remove();
    }

    // Supprime un bénéficiaire automatiquement
    window.removeBeneficiaireAuto = function (id) {
        const souscription = JSON.parse(sessionStorage.getItem('souscriptionData')) || {};
        let data = souscription.benefData || [];

        data = data.filter(item => item.id !== id);
        updateBenefDataInSouscription(data);
        removeBeneficiaireRow(id);

        // Décocher la checkbox liée
        if (id === 'conjoint') conjointCheckbox.checked = false;
        if (id === 'enfants') enfantsCheckbox.checked = false;
    }

    // Gère l’ajout ou la suppression d’un bénéficiaire automatique
    function toggleBeneficiaire(checkbox, id) {
        checkbox.addEventListener('change', function () {
            let souscription = JSON.parse(sessionStorage.getItem('souscriptionData')) || {};
            let data = souscription.benefData || [];

            if (this.checked) {
                const exists = data.some(item => item.id === id);
                if (!exists) {
                    let benef = {
                        id: id,
                        nom: '',
                        prenom: '',
                        datenaissance: '',
                        lieunaissance: '',
                        lieuresidence: '',
                        lien: '',
                        mobile: '',
                        email: '',
                        part: '',
                        type: 'terme'
                    };

                    if (id === 'conjoint') {
                        benef.nom = 'Conjoint';
                        benef.prenom = 'Non divorcé, ni séparé de corps';
                        benef.lien = 'Conjoint';
                    }
                    if (id === 'enfants') {
                        benef.nom = 'Enfants';
                        benef.prenom = 'nés et à naître';
                        benef.lien = 'Enfant';
                    }

                    data.push(benef);
                    updateBenefDataInSouscription(data);
                    addBeneficiaireRow(benef.nom, benef.prenom, benef.lien, id);
                }
            } else {
                data = data.filter(item => item.id !== id);
                updateBenefDataInSouscription(data);
                removeBeneficiaireRow(id);
            }
        });
    }

    // Appliquer les gestionnaires sur les checkboxes
    toggleBeneficiaire(conjointCheckbox, 'conjoint');
    toggleBeneficiaire(enfantsCheckbox, 'enfants');

    // Recharge les bénéficiaires depuis la session
    function reloadBeneficiairesTable() {
        const souscription = JSON.parse(sessionStorage.getItem('souscriptionData')) || {};
        const benefs = souscription.benefData || [];

        beneficiariesTable.innerHTML = '';

        benefs.forEach(item => {
            const checkbox = document.getElementById(item.id + 'Checkbox');
            if (checkbox) checkbox.checked = true;
            addBeneficiaireRow(item.nom, item.prenom, item.lien, item.id);
        });
    }

    // Initialiser tableau à l’ouverture
    reloadBeneficiairesTable();

    // Ajouter bénéficiaire via modal
    window.addBeneficiary = function () {
        const nom = document.getElementById('nomBenef').value.trim();
        const prenom = document.getElementById('prenomBenef').value.trim();
        const datenaissance = document.getElementById('datenaissanceBenef').value;
        const lieunaissance = document.getElementById('lieunaissance').value;
        const lieuresidence = document.getElementById('lieuresidence').value;
        const lien = document.getElementById('lienParente').value;
        const mobile = document.getElementById('mobileBenef').value.trim();
        const email = document.getElementById('emailBenef').value.trim();
        // const part = document.getElementById('partBenef').value.trim();

        if (!nom || !prenom || !mobile) {
            alert('Veuillez renseigner au moins le nom, prénom et téléphone.');
            return;
        }

        const newBenef = {
            id: Date.now().toString(), // id unique
            nom,
            prenom,
            datenaissance,
            lieunaissance,
            lieuresidence,
            lien,
            mobile,
            email,
            type: 'deces'
        };

        // Récupérer la session et la mettre à jour
        let souscription = JSON.parse(sessionStorage.getItem('souscriptionData')) || {};
        let benefs = souscription.benefData || [];
        benefs.push(newBenef);
        souscription.benefData = benefs;
        sessionStorage.setItem('souscriptionData', JSON.stringify(souscription));

        // Mise à jour du tableau sans recharger tout
        const newRow = `
            <tr data-id="${newBenef.id}">
                <td>${newBenef.nom} ${newBenef.prenom}</td>
                <td>${newBenef.datenaissance || '-'}</td>
                <td>${newBenef.lieunaissance || '-'}</td>
                <td>${newBenef.lieuresidence || '-'}</td>
                <td>${newBenef.lien || '-'}</td>
                <td>${newBenef.mobile || '-'}</td>
                <td>${newBenef.email || '-'}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="removeBeneficiaireAuto('${newBenef.id}')">Supprimer</button>
                </td>
            </tr>
        `;
        document.querySelector('#beneficiariesTable tbody').insertAdjacentHTML('beforeend', newRow);

        // Réinitialise le formulaire
        document.getElementById('beneficiaryForm').reset();

        // Fermer le modal
        const modalElement = document.getElementById('addBenefModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        }
    };
});
</script>




