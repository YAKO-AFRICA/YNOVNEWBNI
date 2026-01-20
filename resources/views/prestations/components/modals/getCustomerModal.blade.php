

<div class="modal fade" id="RechercherContratClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <style>
                .spinner {
                    display: inline-block;
                    width: 1rem;
                    height: 1rem;
                    border: 0.2em solid currentColor;
                    border-right-color: transparent;
                    border-radius: 50%;
                    animation: spin 0.75s linear infinite;
                }
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
                .client-card {
                    border-left: 4px solid #0d6efd;
                    transition: all 0.3s ease;
                }
                .client-card:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                }
            </style>

            <div class="modal-header">
                <h5 class="modal-title">Rechercher un contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="searchCustomerContratForm">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Rechercher par :</label>
                                <select class="form-select" id="methodeRecherche" required>
                                    <option value="">Sélectionnez une option</option>
                                    <option value="numerocompte">Numéro de compte du client</option>
                                    <option value="contrat">Id du contrat</option>
                                    <option value="nomdatedenaissance">Nom et date de naissance du client</option>
                                </select>
                                <input type="hidden" class="form-control" value="{{ auth()->user()->membre->codepartenaire ?? '' }}" name="partenaire" id="partenaire">
                            </div>
                            

                            <div class="row mb-3 d-none" id="numerocompteBlock">
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="codeguichet" id="codeguichet" placeholder="Code guichet">
                                        <label for="codeguichet">Code guichet</label>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="numerocompte" id="numerocompte" placeholder="Numéro de compte">
                                        <label for="numerocompte">Numéro de compte</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 d-none" id="contratBlock">
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="idcontrat" id="idcontrat" placeholder="Veuillez entrer l'ID du contrat">
                                        <label for="idcontrat">ID du contrat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 d-none" id="nameBlock">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du client">
                                        <label for="nom">Nom du client</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" name="datenaissance" id="datenaissance" placeholder="Date de naissance">
                                        <label for="datenaissance">Date de naissance</label>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-end">
                                <button type="button" id="searchBtn" class="btn btn-primary">
                                    <span id="searchText">Rechercher</span>
                                    <span id="searchSpinner" class="spinner d-none"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <div class="alert alert-danger d-none text-center" id="errorMessage"></div>
                <div id="searchResults" class="mt-3 d-none">
                    <table class="table table-striped table-hover table-bordered" id="example0">
                        <thead>
                            <tr>
                                <th>Contact</th>
                                <th>Adhérent</th>
                                <th>Cotisation</th>
                                <th>Compte</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="resultsTableBody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1100;
        max-width: 350px;
    }
    .toast {
        position: relative;
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        color: white;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .toast.show {
        opacity: 1;
        transform: translateX(0);
    }
    .toast-success { background-color: #28a745; }
    .toast-error { background-color: #dc3545; }
    .toast-warning { background-color: #ffc107; color: #212529; }
    .toast-info { background-color: #17a2b8; }
    .toast-close {
        background: none;
        border: none;
        color: inherit;
        font-size: 1.5rem;
        cursor: pointer;
        margin-left: 1rem;
        line-height: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const methodSelect = document.getElementById('methodeRecherche');
        const blocks = {
            numerocompte: document.getElementById('numerocompteBlock'),
            contrat: document.getElementById('contratBlock'),
            nomdatedenaissance: document.getElementById('nameBlock')
        };
        const resultsTable = document.getElementById('example0'); // Table complète
        const searchBtn = document.getElementById('searchBtn');
        const partenaire = document.getElementById('partenaire')?.value;
        const resultsTableBody = document.getElementById('resultsTableBody');
        const errorMessage = document.getElementById('errorMessage');
        const searchResults = document.getElementById('searchResults');
        const searchSpinner = document.getElementById('searchSpinner');
        const searchText = document.getElementById('searchText');

        let dataTableInstance = null;

        const clearTable = () => {
            if (dataTableInstance) {
                dataTableInstance.destroy(); // Détruire DataTables
                dataTableInstance = null;
            }
            resultsTableBody.innerHTML = ''; // Nettoyer le contenu du tableau
        };

        /* ============================
        * 🎛️ Gestion affichage blocs
        * ============================ */
        function toggleBlocks(activeKey) {
            Object.entries(blocks).forEach(([key, block]) => {
                const isActive = key === activeKey;
                block.classList.toggle('d-none', !isActive);
                block.querySelectorAll('input').forEach(i => i.required = isActive);
            });
        }

        methodSelect.addEventListener('change', () => {
            toggleBlocks(methodSelect.value);
            clearErrors();
            
        });

        /* ============================
        * 🔍 Recherche
        * ============================ */
        searchBtn.addEventListener('click', async () => {

            const method = methodSelect.value;
            if (!method) {
                searchResults.classList.add('d-none');
                return showError('Veuillez sélectionner une méthode de recherche');
            }

            const query = collectInputs(blocks[method]);
            if (!query) return;

            toggleLoading(true);

            try {
                const contrats = await searchClient(method, query);
                //console.log('contrats', contrats);

                if (!contrats) {
                    searchResults.classList.add('d-none');
                    showError('Aucun client trouvé avec ce critère de recherche');
                    return;
                }else{
                    displayClientDetails(contrats);
                    searchResults.classList.remove('d-none');
                    errorMessage.classList.add('d-none');
                    errorMessage.textContent = '';
                    showToast('Client trouvé avec succès', 'success');
                }

            } catch (e) {
                searchResults.classList.add('d-none');
                showError(e.message || 'Erreur lors de la recherche');
            } finally {
                toggleLoading(false);
            }
        });

        /* ============================
        * 🧠 Utils
        * ============================ */
        function collectInputs(block) {
            const data = {};
            for (const input of block.querySelectorAll('input')) {
                if (!input.value.trim()) {
                    showError(`Veuillez renseigner le champ : ${input.previousElementSibling?.textContent || input.name}`);
                    searchResults.classList.add('d-none');
                    return null;
                }
                data[input.name] = input.value.trim();
            }            
            return data;
        }

        function toggleLoading(state) {
            searchText.classList.toggle('d-none', state);
            searchSpinner.classList.toggle('d-none', !state);
            searchBtn.disabled = state;
        }

        function clearErrors() {
            errorMessage.classList.add('d-none');
            errorMessage.textContent = '';
            searchResults.classList.add('d-none');
            resultsTableBody.innerHTML = '';
            clearTable();
        }

        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.classList.remove('d-none');
            searchResults.classList.add('d-none');
            clearTable();
        }
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer') || createToastContainer();
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.innerHTML = `<span>${message}</span><button class="toast-close" aria-label="Fermer">&times;</button>`;
            container.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 10);
            const autoClose = setTimeout(() => closeToast(toast), 5000);
            toast.querySelector('.toast-close').addEventListener('click', () => {
                clearTimeout(autoClose);
                closeToast(toast);
            });
            function closeToast(t) {
                t.classList.remove('show');
                setTimeout(() => t.remove(), 300);
            }
        }

        function createToastContainer() {
            const c = document.createElement('div');
            c.id = 'toastContainer';
            c.className = 'toast-container';
            document.body.appendChild(c);
            return c;
        }

        /* ============================
        * 🌐 API
        * ============================ */
        function formatMoney(value) {
            if (!value) return '0';
            return Number(value).toLocaleString('fr-FR');
        }
        async function searchClient(method, query) {

            const payload = {
                numerocompte: {
                    partenaire: partenaire,
                    codeguichet: query.codeguichet,
                    numerocompte: query.numerocompte
                },
                contrat: {
                    partenaire: partenaire,
                    idcontrat: query.idcontrat
                },
                nomdatedenaissance: {
                    partenaire: partenaire,
                    nom: query.nom,
                    datenaissance: query.datenaissance
                }
            }[method];

            //BNI UNIQUEMENT
            const response = await fetch('https://api.yakoafricassur.com/enov/search-contrat-agent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MjExODcyLCJlbWFpbCI6ImZvcm1hdGlvbi5ibmlAYm5pLmNvbSIsIm5vbSI6IkJOSSIsImNvZGVhZ2VudCI6IkIwNDAiLCJ0eXBlbWVicmUiOm51bGwsInByZW5vbSI6IkZvcm1hdGlvbiJ9.gwxwy43VeMDcfaTpgpFbuWkxjirIBqvuXq3UZOuw_nA'
                    },
                    body: JSON.stringify(payload)
                }
            );

            if (!response.ok) {
                showError('Aucun client trouvé avec ce critère de recherche');
                return null;
                //throw new Error(`Erreur API (${response.status})`);
            }

            const data = await response.json();
            //console.log('data', data);
            return data?.details ?? null;
        }

        /* ============================
        * 📊 Affichage résultat
        * ============================ */
        function displayClientDetails(contrats) {
            clearTable();
            resultsTableBody.innerHTML = '';

            contrats.forEach(contrat => {

                const row = `
                    <tr>
                        <!-- 📄 CONTRAT -->
                        <td>
                            <strong>#ID : ${contrat.id}</strong><br>
                            <span class="fw-semibold">${contrat.Produit}</span><br>
                            <small>Date d'effet : ${contrat.DateEffet}</small><br>
                            <small>Date d'échéance : ${contrat.DateEcheance}</small><br>
                            <small>
                                Prime : <strong>${formatMoney(contrat.Prime)}</strong>
                                &nbsp;&nbsp;
                                Capital : <strong>${formatMoney(contrat.Capital)}</strong>
                            </small><br>
                            <span class="badge bg-success mt-1">État : ${contrat.Etat}</span>
                        </td>

                        <!-- 👤 ADHÉRENT -->
                        <td>
                            <strong>${contrat.Adherent}</strong><br>
                            <small>Né(e) le : ${contrat.DateNaissance}</small>
                        </td>

                        <!-- 💰 COTISATION -->
                        <td>
                            <div>
                                Nb d'émission : <strong>${contrat.NombreEmission}</strong>
                                &nbsp;&nbsp;
                                Mt d'émission : <strong>${formatMoney(contrat.MontantEmission)}</strong>
                            </div>
                            <div>
                                Nb d'enc. : <strong>${contrat.NombreEncaissement}</strong>
                                &nbsp;&nbsp;
                                Mt d'enc. : <strong>${formatMoney(contrat.MontantEncaissement)}</strong>
                            </div>
                            <div>
                                Nb d'impayé : <strong>${contrat.NombreImpayes}</strong>
                                &nbsp;&nbsp;
                                Mt d'impayé : <strong>${formatMoney(contrat.MontantImpayes)}</strong>
                            </div>
                        </td>

                        <!-- 🏦 COMPTE -->
                        <td>
                            Code guichet : <strong>${contrat.CodeGuichet}</strong><br><br>
                            N° Compte : <strong>${contrat.NumCompte}</strong><br><br>
                            Rib : <strong>${contrat.Rib}</strong>
                        </td>

                        <!-- ⚙️ ACTIONS -->
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary"
                                data-bs-toggle="tooltip"
                                title="Demander une prestation"
                                onclick="demanderPrestation('${contrat.id}')">
                                <i class="bi bi-arrow-repeat"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-success"
                                data-bs-toggle="tooltip"
                                title="Voir l'état de cotisation"
                                onclick="voirEtatCotisation('${contrat.id}')">
                                <i class="bi bi-bar-chart-line"></i>
                            </button>

                            <div id="spinner-${contrat.id}" style="display: none; margin-top: 10px;">
                                <div class="spinner-border" style="color: #076633;" role="status">
                                    <span class="visually-hidden">Chargement...</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;

                resultsTableBody.insertAdjacentHTML('beforeend', row);
            });
            // Initialiser DataTables après l'ajout des lignes
            dataTableInstance = $(resultsTable).DataTable({
                order: [],
                lengthChange: true,
                language: {
                    search: "Recherche :",
                    lengthMenu: "Afficher _MENU_ lignes",
                    zeroRecords: "Aucun enregistrement trouvé",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                    infoEmpty: "Aucun enregistrement disponible",
                    infoFiltered: "(filtré à partir de _MAX_ enregistrements)",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent",
                    },
                },
            });

            // 🔁 Réinitialiser les tooltips Bootstrap
            const tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );
            tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
        }

    });

    window.voirEtatCotisation = function (idContrat) {
        const spinner = document.getElementById(`spinner-${idContrat}`);
        spinner.style.display = "block";

        if (!idContrat) return;

        $.ajax({
            url: "https://web.yakoafricassur.com/api/generate-etat-cotisation",
            method: "POST",
            data: { contrat: idContrat },
            dataType: "json",
            success: function (response) {
                spinner.style.display = "none";

                if (response.pdfUrl) {

                    // cliquer sur OK pour ouvrir le PDF
                    Swal.fire({
                        title: 'État de cotisation généré avec succès',
                        icon: 'success',
                        confirmButtonText: 'Ouvrir le PDF'
                    }).then(() => {
                        window.open(response.pdfUrl, '_blank');
                    });
                    
                } else {
                    Swal.fire({
                        title: 'Erreur lors de la génération du PDF',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function () {
                spinner.style.display = "none";
                Swal.fire({
                    title: 'Impossible de récupérer l\'état de cotisation.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    };

    window.demanderPrestation = function (idContrat) {
        const spinner = document.getElementById(`spinner-${idContrat}`);
        spinner.style.display = "block";

        if (!idContrat) return;

        $.ajax({
            url: "{{ route('prestation.fetchCustomerDetails') }}",
            method: "POST",
            data: { 
                idcontrat: idContrat,
                _token: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
             },
            dataType: "json",
            success: function (response) {
                spinner.style.display = "none";

                if (response.code == 200) {
                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        text: 'Vous allez être redirigé vers la page de sélection de prestation...',
                        timer: 5000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    }).then(() => {
                        // 1 seconde après
                        setTimeout(() => {
                            window.location.href = response.urlback;
                        }, 1000);
                    });
                } else {
                    Swal.fire({
                        title: response.message,
                        icon: 'warning',
                        confirmButtonText: 'Fermer'
                    });
                }

            },
            error: function () {
                spinner.style.display = "none";
                Swal.fire({
                    title: 'Impossible de récupérer les détails du contrat.',
                    icon: 'error',
                    confirmButtonText: 'Fermer'
                });
            }
        });
    };
</script>

{{-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        }
    });
</script> --}}