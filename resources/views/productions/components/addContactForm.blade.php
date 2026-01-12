<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="contactForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Ajouter un contact optionnel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label d-block">Type de contact :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="type[]" value="Whatsapp" id="WhatsappOpt">
                            <label class="form-check-label" for="WhatsappOpt">Whatsapp</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="type[]" value="MobileMoney" id="MobileMoneyOpt">
                            <label class="form-check-label" for="MobileMoneyOpt">Mobile Money</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="type[]" value="Wave" id="WaveOpt">
                            <label class="form-check-label" for="WaveOpt">Wave</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="type[]" value="Tel" id="TelOpt">
                            <label class="form-check-label" for="TelOpt">Tel</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Valeur du contact <span class="text-danger">*</span></label>
                        <input type="tel" id="valeur" name="valeur" class="form-control" minlength="10" maxlength="14"  placeholder="ex: 0701020304" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success btn-sm">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    let contacts = JSON.parse(sessionStorage.getItem('contacts') || '[]');

    // Fonction d'affichage
    function renderContacts() {
        const preview = document.getElementById('contactsPreview');
        preview.innerHTML = '';

        if (contacts.length === 0) {
            preview.innerHTML = `<div class="text-muted">Aucun contact ajouté pour le moment.</div>`;
            return;
        }

        let html = `
            <table class="table table-bordered table-sm align-middle mt-3">
                <thead class="table-light">
                    <tr>
                        <th>Type</th>
                        <th>Valeur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        `;

        contacts.forEach((c, index) => {
            html += `
                <tr>
                    <td>${c.type}</td>
                    <td>${c.valeur}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeContact(${index})">
                            Supprimer
                        </button>
                    </td>
                </tr>
            `;
        });

        html += `</tbody></table>`;
        preview.innerHTML = html;
    }


    function removeContact(index) {
        contacts.splice(index, 1);
        sessionStorage.setItem('contacts', JSON.stringify(contacts));
        document.getElementById('contactsInput').value = JSON.stringify(contacts);
        renderContacts();
    }

    // Ajout d’un contact optionnel
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const valeur = document.getElementById('valeur').value.trim();
        const typesChecked = Array.from(document.querySelectorAll('input[name="type[]"]:checked'))
                                .map(c => c.value);

        if (typesChecked.length === 0) {
            alert('Veuillez sélectionner au moins un type de contact.');
            return;
        }

        if (valeur === '') {
            alert('Veuillez renseigner la valeur du contact.');
            return;
        }

        const contact = {
            type: typesChecked.join(', '),
            valeur: valeur,
            principal: false
        };

        // Ajoute à la liste
        contacts.push(contact);
        sessionStorage.setItem('contacts', JSON.stringify(contacts));
        document.getElementById('contactsInput').value = JSON.stringify(contacts);

        // Ferme modal
        bootstrap.Modal.getInstance(document.getElementById('contactModal')).hide();

        // Reset
        document.getElementById('contactForm').reset();

        renderContacts();
    });



    // On affiche les contacts déjà enregistrés à chaque chargement
    document.addEventListener('DOMContentLoaded', renderContacts);

    // Lors de la soumission du grand formulaire principal
     // Sauvegarde au clic sur le bouton "Suivant"
    document.querySelector('.btn-next-form').addEventListener('click', function (event) {
        event.preventDefault();

        // Vérifie si AU MOINS un contact existe
        const currentContacts = JSON.parse(sessionStorage.getItem('contacts') || '[]');

        if (currentContacts.length === 0) {
            alert("Veuillez ajouter au moins un contact avant de continuer.");
            return;
        }

        // Sauvegarde dans input caché
        document.getElementById('contactsInput').value = JSON.stringify(currentContacts);

        console.log("Contacts enregistrés :", currentContacts);

        // Passage à l'étape suivante
        stepper1.next();
    });


</script>
