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
    <div class="col-12 col-lg-6 text-end">
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

    radioOui.addEventListener('change', function () {
        if (this.checked) {
            // Appel à une fonction qui va insérer les données dans le tableau
            ajouterAssureDepuisAdherent();
        }
    });

});
</script>

<script>
    // On injecte les données PHP dans du JS
    

    function ajouterAssureDepuisAdherent() {

        const adherentData = sessionStorage.getItem('souscriptionData') ? JSON.parse(sessionStorage.getItem('souscriptionData')).adherentData : null;

        // console.log('Données de l\'adherent:', adherentData.civilite);
        if (!adherentData) return;

        // Créer une ligne de tableau
        const tbody = document.getElementById('tableAssuresBody');

        // Nettoyer d’abord la table (si on ne veut qu’un seul assuré)
        tbody.innerHTML = ''; // Supprimer cette ligne si vous voulez pouvoir ajouter plusieurs assurés

        const tr = document.createElement('tr');
        tr.setAttribute('data-id', adherentData.numeropiece);

        tr.innerHTML = `
            <td>${adherentData.civilite} ${adherentData.nom} ${adherentData.prenom}</td>
            <td>${adherentData.datenaissance}</td>
            <td>${adherentData.lieuresidence}</td>
            <td>${adherentData.mobile}</td>
            <td>${adherentData.numeropiece}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="supprimerLigne(this)">Supprimer</button>
            </td>
        `;

        

        tbody.appendChild(tr);

        // Mettre à jour le sessionStorage
        const souscriptionData = JSON.parse(sessionStorage.getItem('souscriptionData'));
        souscriptionData.assureData = [adherentData];
        sessionStorage.setItem('souscriptionData', JSON.stringify(souscriptionData));

        console.log('Données de l\'adherent ajoutées au tableau:', souscriptionData);
    }

    function supprimerLigne(btn) {
        const row = btn.closest('tr');
        const id = row.getAttribute('data-id'); // identifiant unique (n° de pièce)
        row.remove();

        // Mise à jour dans le sessionStorage
        let souscriptionData = JSON.parse(sessionStorage.getItem('souscriptionData'));

        if (souscriptionData && souscriptionData.assureData) {
            // Filtrer pour enlever celui qui correspond à l'identifiant
            souscriptionData.assureData = souscriptionData.assureData.filter(assure => assure.numeropiece !== id);
            sessionStorage.setItem('souscriptionData', JSON.stringify(souscriptionData));

            console.log(`Assuré avec la pièce ${id} supprimé de la session.`);
        }
    }


    
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const storeAssurerBtn = document.getElementById('storeAssurerBtn');
    const assurerForm = document.getElementById('assurerForm');

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
            mobile: document.getElementById('assurerMobile').value
        };

        // Ajouter dans le tableau
        ajouterAssureDansTableau(formData);

        // Ajouter dans la sessionStorage
        let souscriptionData = JSON.parse(sessionStorage.getItem('souscriptionData')) || {};
        souscriptionData.assureData = souscriptionData.assureData || [];

        // Vérifier si déjà existant (sur la base du numéro de pièce)
        const exist = souscriptionData.assureData.some(a => a.numeropiece === formData.numeropiece);
        if (!exist) {
            souscriptionData.assureData.push(formData);
        }

        sessionStorage.setItem('souscriptionData', JSON.stringify(souscriptionData));

        console.log('Données d ajoutées au tableau:', souscriptionData);

        // Fermer le modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('createAssurerModal'));
        modal.hide();

        // Réinitialiser le formulaire
        assurerForm.reset();
    });
});

function ajouterAssureDansTableau(assure) {
    const tbody = document.getElementById('tableAssuresBody');

    const tr = document.createElement('tr');
    tr.setAttribute('data-id', assure.numeropiece);

    tr.innerHTML = `
        <td>${assure.civilite} ${assure.nom} ${assure.prenom}</td>
        <td>${assure.datenaissance}</td>
        <td>${assure.lieuresidence}</td>
        <td>${assure.mobile}</td>
        <td>${assure.numeropiece}</td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="supprimerLigne(this)">Supprimer</button>
        </td>
    `;

    tbody.appendChild(tr);
}

function supprimerLigne(btn) {
    const row = btn.closest('tr');
    const id = row.getAttribute('data-id');
    row.remove();

    let souscriptionData = JSON.parse(sessionStorage.getItem('souscriptionData'));
    if (souscriptionData && souscriptionData.assureData) {
        souscriptionData.assureData = souscriptionData.assureData.filter(a => a.numeropiece !== id);
        sessionStorage.setItem('souscriptionData', JSON.stringify(souscriptionData));
    }
}
</script>

