<div class="card">
    <div class="card-header">
        <button class="btn btn-outline-info" id="addBenefBtn" data-bs-toggle="modal" data-bs-target="#addLoanBenefModal">
            Ajouter un bénéficiaire pour garantie yako
        </button>
    </div>
    <div class="card-body overflow-auto overflow-scroll">
        <table class="table mb-0 table-striped" id="loanYakobeneficiariesTable">
            <thead>
                <tr>
                    <th scope="col">Nom & Prénoms</th>
                    <th scope="col">Né(e) le</th>
                    <th scope="col">Lieu de naissance</th>
                    <th scope="col">Lieu de résidence</th>
                    <th scope="col">Capital</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les bénéficiaires seront ajoutés ici -->
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addLoanBenefModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un nouveau bénéficiaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBenefForm">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="nomBenef" class="form-label">Nom du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" id="nomBenef" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="prenomBenef" class="form-label">Prénoms du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" id="prenomBenef" name="prenomBenef" class="form-control" placeholder="Prénoms">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="datenaissanceBenef" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" id="datenaissanceBenef" name="datenaissanceBenef" class="form-control">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="lieunaissanceBenef" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
                            <select id="lieunaissanceBenef" class="form-select" name="lieunaissanceBenef">
                                <option value="">Sélectionner le lieu</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="form-label" for="lieuResidenceBenef">Lieu de residence <span class="text-danger">*</span></label>
                        <select id="lieuResidenceBenef" class="form-select" name="lieuResidenceBenef">
                            <option value="">Sélectionner le lieu</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="numPhoneBenef" class="form-label">Telephone <span class="text-danger">*</span></label>
                            <input type="text" id="numPhoneBenef" name="numPhoneBenef" class="form-control" placeholder="00225">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="emailBenef" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" id="emailBenef" class="form-control" placeholder="@gmail.com">
                        </div>
                    </div>

                    <input type="hidden" id="capitalBenef" name="capitalBenef" value="500000">
                    <input type="hidden" id="benefData" name="benefData" value="">

                    <div class="modal-footer">
                        <button type="button" class="btn border-btn" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" id="submitBenefBtn" class="btn btn-two">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('addBenefForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêche la soumission classique du formulaire

    const nom = document.getElementById('nomBenef').value;
    const prenom = document.getElementById('prenomBenef').value;
    const dateNaissance = document.getElementById('datenaissanceBenef').value;
    const lieuNaissance = document.getElementById('lieunaissanceBenef').value;
    const lieuResidence = document.getElementById('lieuResidenceBenef').value;
    const numPhone = document.getElementById('numPhoneBenef').value;
    const emailBenef = document.getElementById('emailBenef').value;
    const capital = document.getElementById('capitalBenef').value;

    // Vérifiez si un bénéficiaire existe déjà
    const table = document.getElementById('loanYakobeneficiariesTable').querySelector('tbody');
    if (table.rows.length > 0) {
        alert("Vous ne pouvez ajouter qu'un seul bénéficiaire.");
        return;
    }

    // Ajouter les données au tableau
    const row = table.insertRow();
    row.innerHTML = `
        <td>${nom} ${prenom}</td>
        <td>${dateNaissance}</td>
        <td>${lieuNaissance}</td>
        <td>${lieuResidence}</td>
        <td>${capital}</td>
        <td>${numPhone}</td>
        <td>${emailBenef}</td>
        <td>
            <button class="btn btn-danger btn-sm" onclick="removeBenef(this)">x</button>
        </td>
    `;

    

    // Sauvegarder dans la session via AJAX
    fetch('/save-beneficiary-session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ nom, prenom, dateNaissance, lieuNaissance, capital, lieuResidence, numPhone, emailBenef })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // alert("Bénéficiaire ajouté à la session.");
            
            // Fermer le modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addLoanBenefModal'));
            modal.hide();

            // Réinitialiser le formulaire
            document.getElementById('addBenefForm').reset();
            document.getElementById('addBenefBtn').disabled = true; // Désactiver le bouton
        }
    })
    .catch(error => console.error('Erreur:', error));
});

// Fonction pour supprimer un bénéficiaire
function removeBenef(button) {
    button.closest('tr').remove();
    document.getElementById('addBenefBtn').disabled = false; // Réactiver le bouton
}

</script>