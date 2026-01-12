<div class="modal fade" id="addnewPropect" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #1e4520">
                <h5 class="modal-title text-white" id="clientModalLabel">Nouveau Prospect</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="clientForm">
                    @csrf

                    <!-- Progress Bar -->
                    <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" id="formProgress" style="width: 0%; background-color: #1e4520"></div>
                    </div>

                    <!-- Steps Indicators -->
                    <ul class="nav nav-pills mb-4 justify-content-center" id="formSteps" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="step1-tab" data-bs-toggle="pill" data-bs-target="#step1" type="button" role="tab">
                                <span class="step-number">1</span> Informations Personnelles
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="step2-tab" data-bs-toggle="pill" data-bs-target="#step2" type="button" role="tab" disabled>
                                <span class="step-number">2</span> Professionnelles
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="step3-tab" data-bs-toggle="pill" data-bs-target="#step3" type="button" role="tab" disabled>
                                <span class="step-number">3</span> Assurance
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="step4-tab" data-bs-toggle="pill" data-bs-target="#step4" type="button" role="tab" disabled>
                                <span class="step-number">4</span> Finalisation
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="formStepsContent">
                        <!-- STEP 1 : INFORMATIONS PERSONNELLES -->
                        <div class="tab-pane fade show active" id="step1" role="tabpanel">
                            <fieldset class="border p-3 rounded mb-4">
                                <legend class="float-none w-auto px-3">Informations Personnelles</legend>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 rounded mb-4">
                                <legend class="float-none w-auto px-3">Fiche signalétique</legend>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="gender" class="form-label">Sexe</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">Sélectionner...</option>
                                            <option value="M">Masculin</option>
                                            <option value="F">Féminin</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="birth_date" class="form-label">Date de Naissance</label>
                                        <input type="date" class="form-control" id="birth_date" name="birth_date">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="marital_status" class="form-label">Situation Matrimoniale</label>
                                        <select class="form-select" id="marital_status" name="marital_status">
                                            <option value="">Sélectionner...</option>
                                            <option value="celibataire">Célibataire</option>
                                            <option value="marie">Marié(e)</option>
                                            <option value="divorce">Divorcé(e)</option>
                                            <option value="veuf">Veuf(ve)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">Ville de Résidence</label>
                                        <select name="city" id="city" class="form-select">
                                            <option value="" disabled selected>Sélectionner...</option>
                                            @foreach ($villes as $item)
                                                <option value="{{ $item->idville }}">{{ $item->libelleVillle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="adress" class="form-label">Adresse complète</label>
                                        <textarea class="form-control" id="adress" name="adress" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile" class="form-label">Téléphone Mobile</label>
                                        <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" pattern="[0-9]{10}">
                                    </div>
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary next-step" data-next="step2" style="background-color:#1e4520;border-color:#1e4520;">
                                    Suivant <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- STEP 2 : INFORMATIONS PROFESSIONNELLES -->
                        <div class="tab-pane fade" id="step2" role="tabpanel">
                            <fieldset class="border p-3 rounded mb-4">
                                <legend class="float-none w-auto px-3">Informations Professionnelles</legend>
                                <div class="mb-3">
                                    <label for="profession_uuid" class="form-label">Profession</label>
                                    <select class="form-select" id="profession_uuid" name="profession_uuid">
                                        <option value="">Sélectionner...</option>
                                        @foreach ($professions as $item)
                                            <option value="{{ $item->id }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="secteurActivity_uuid" class="form-label">Secteur d'Activité</label>
                                    <select class="form-select" id="secteurActivity_uuid" name="secteurActivity_uuid">
                                        <option value="">Sélectionner...</option>
                                        @foreach ($secteurActivites as $item)
                                            <option value="{{ $item->uuid }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-step" data-prev="step1"><i class="fas fa-arrow-left me-2"></i>Précédent</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step3" style="background-color:#1e4520;border-color:#1e4520;">Suivant <i class="fas fa-arrow-right ms-2"></i></button>
                            </div>
                        </div>

                        <!-- STEP 3 : INFORMATIONS ASSURANCE -->
                        <div class="tab-pane fade" id="step3" role="tabpanel">
                            <fieldset class="border p-3 rounded mb-4">
                                <legend class="float-none w-auto px-3">Informations Assurance</legend>

                                <div class="mb-3">
                                    <label for="products" class="form-label">Produits à souscrire</label>
                                    <select multiple class="form-select" id="products" name="products[]">
                                        @foreach ($product as $item)
                                            <option value="{{ $item->IdProduit }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs produits.</small>
                                </div>

                                <div id="selectedProducts" class="mt-3">
                                    <strong>Produits sélectionnés :</strong>
                                    <ul id="productList" class="list-group mt-2"></ul>
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-step" data-prev="step2"><i class="fas fa-arrow-left me-2"></i>Précédent</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step4" style="background-color:#1e4520;border-color:#1e4520;">Suivant <i class="fas fa-arrow-right ms-2"></i></button>
                            </div>
                        </div>

                        <!-- STEP 4 : FINALISATION -->
                        <div class="tab-pane fade" id="step4" role="tabpanel">
                            <fieldset class="border p-3 rounded mb-4">
                                <legend class="float-none w-auto px-3">Finalisation</legend>

                                <div class="mb-3">
                                    <label for="note" class="form-label">Notes / Observations</label>
                                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-step" data-prev="step3"><i class="fas fa-arrow-left me-2"></i>Précédent</button>
                                <button type="submit" class="btn btn-success" id="saveClientBtn" style="background-color:#1e4520;border-color:#1e4520;"><i class="fas fa-save me-2"></i>Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script dynamique pour affichage des produits sélectionnés -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const productSelect = document.getElementById("products");
    const productList = document.getElementById("productList");

    productSelect.addEventListener("change", function() {
        productList.innerHTML = "";
        Array.from(this.selectedOptions).forEach(opt => {
            const li = document.createElement("li");
            li.textContent = opt.textContent;
            li.classList.add("list-group-item");
            productList.appendChild(li);
        });
    });
});
</script>


<style>
    /* Style personnalisé pour les étapes */
    .nav-pills .nav-link {
        position: relative;
        padding: 0.75rem 1.5rem;
        margin: 0 0.5rem;
        border-radius: 2rem;
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link:hover:not(.active) {
        background-color: #e9ecef;
    }
    
    .nav-pills .nav-link.active {
        background-color: #1e4520;
        color: white;
        border-color: #1e4520;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .nav-pills .nav-link.disabled {
        opacity: 0.5;
        pointer-events: none;
    }
    
    .step-number {
        display: inline-block;
        width: 24px;
        height: 24px;
        line-height: 24px;
        text-align: center;
        border-radius: 50%;
        background-color: #6c757d;
        color: white;
        margin-right: 8px;
        font-weight: bold;
    }
    
    .nav-pills .nav-link.active .step-number {
        background-color: white;
        color: #1e4520;
    }
    
    .progress {
        height: 10px;
        background-color: #e9ecef;
    }
    
    .progress-bar {
        transition: width 0.3s ease;
    }
    
    /* Style pour les champs invalides */
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    .invalid-feedback {
        display: none;
        color: #dc3545;
        font-size: 0.875em;
    }
    
    .is-invalid ~ .invalid-feedback {
        display: block;
    }
    
    /* Style pour les selects */
    .selection + .select2-container {
        width: 100% !important;
    }
    
    .selection + .select2-container .select2-selection {
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }
    
    .selection + .select2-container .select2-selection__arrow {
        height: 36px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des étapes du formulaire
    const progressBar = document.getElementById('formProgress');
    const totalSteps = 4;
    let currentStep = 1;
    
    // Initialisation correcte de Select2 dans un modal
    function initSelect2InModal() {
        $('.modal-selection').select2({
            width: '100%',
            dropdownParent: $('#addnewPropect'), // Assurez-vous que c'est le bon ID de modal
            placeholder: "Sélectionner...",
            allowClear: true,
            dropdownCssClass: 'select2-dropdown-modal' // Classe CSS supplémentaire si nécessaire
        });
    }

    // Appeler cette fonction après l'ouverture du modal
    $('#addnewPropect').on('shown.bs.modal', function() {
        initSelect2InModal();
        
        // Réinitialiser les sélections si nécessaire
        $('.modal-selection').val(null).trigger('change');
    });
    
    // Mettre à jour la barre de progression
    function updateProgress() {
        const progress = (currentStep / totalSteps) * 100;
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);
    }
    
    // Activer l'étape suivante
    function enableNextStep(nextStep) {
        const nextTab = document.getElementById(`step${nextStep}-tab`);
        if (nextTab) {
            nextTab.disabled = false;
        }
    }
    
    // Valider l'étape courante
    function validateCurrentStep(step) {
        let isValid = true;
        const stepElement = document.getElementById(`step${step}`);
        
        // Valider tous les champs required de l'étape
        const requiredFields = stepElement.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
                
                // Scroll vers le premier champ invalide
                if (isValid === false) {
                    field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Validation spécifique pour le téléphone
        if (step === 1) {
            const mobileField = document.getElementById('mobile');
            if (mobileField.value && !/^[0-9]{10}$/.test(mobileField.value)) {
                mobileField.classList.add('is-invalid');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    // Navigation entre les étapes
    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = this.getAttribute('data-next').replace('step', '');
            const currentTab = document.querySelector(`#step${nextStep}-tab`);
            
            // Valider l'étape courante avant de continuer
            if (!validateCurrentStep(currentStep)) {
                return;
            }
            
            // Passer à l'étape suivante
            if (currentTab) {
                const tab = new bootstrap.Tab(currentTab);
                tab.show();
                currentStep = parseInt(nextStep);
                updateProgress();
                enableNextStep(currentStep + 1);
                
                // Scroll vers le haut de l'étape
                document.getElementById(`step${nextStep}`).scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Retour à l'étape précédente
    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = this.getAttribute('data-prev').replace('step', '');
            const prevTab = document.querySelector(`#step${prevStep}-tab`);
            
            if (prevTab) {
                const tab = new bootstrap.Tab(prevTab);
                tab.show();
                currentStep = parseInt(prevStep);
                updateProgress();
                
                // Scroll vers le haut de l'étape
                document.getElementById(`step${prevStep}`).scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Gestion de la soumission du formulaire
    const prospectForm = document.getElementById('clientForm');
    const saveProspectBtn = document.getElementById('saveClientBtn');
    
    prospectForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Valider toutes les étapes avant soumission
        let allValid = true;
        for (let i = 1; i <= totalSteps; i++) {
            if (!validateCurrentStep(i)) {
                allValid = false;
                // Afficher l'étape avec erreur
                const tab = new bootstrap.Tab(document.querySelector(`#step${i}-tab`));
                tab.show();
                currentStep = i;
                updateProgress();
                break;
            }
        }
        
        if (!allValid) {
            return;
        }
        
        // Afficher un indicateur de chargement
        saveProspectBtn.disabled = true;
        saveProspectBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...';
        
        // Soumission du formulaire via AJAX
        const formData = new FormData(prospectForm);
        
        fetch('/prospect/store', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Afficher un toast de succès
                showToast('success', 'Prospect enregistré avec succès!');
                
                // Fermer le modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addnewPropect'));
                modal.hide();
                
                // Réinitialiser le formulaire
                prospectForm.reset();
                $('.form-select').val(null).trigger('change');
                currentStep = 1;
                updateProgress();
                
                // Désactiver toutes les étapes sauf la première
                document.querySelectorAll('#formSteps .nav-link:not(#step1-tab)').forEach(btn => {
                    btn.disabled = true;
                });
                
                // Rafraîchir la liste des prospects si nécessaire
                if (typeof window.refreshProspectsTable === 'function') {
                    window.refreshProspectsTable();
                } else {
                    window.location.reload();
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Afficher les erreurs de validation
            if (error.errors) {
                let errorMessages = 'Veuillez corriger les erreurs suivantes:<br><br>';
                for (const [key, messages] of Object.entries(error.errors)) {
                    errorMessages += `- ${messages.join('<br>')}<br>`;
                }
                showToast('error', errorMessages);
            } else {
                showToast('error', error.message || 'Une erreur est survenue lors de l\'enregistrement');
            }
        })
        .finally(() => {
            saveProspectBtn.disabled = false;
            saveProspectBtn.innerHTML = '<i class="fas fa-save me-2"></i> Enregistrer';
        });
    });
    
    // Fonction pour afficher les toasts
    function showToast(type, message) {
        const toastContainer = document.getElementById('toastContainer') || createToastContainer();
        const toastId = 'toast-' + Math.random().toString(36).substr(2, 9);
        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `toast show align-items-center text-white bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        
        // Fermeture automatique après 5 secondes
        setTimeout(() => {
            const toastElement = document.getElementById(toastId);
            if (toastElement) {
                toastElement.remove();
            }
        }, 5000);

        
    }
    
    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toastContainer';
        container.className = 'toast-container position-fixed top-0 end-0 p-3';
        container.style.zIndex = '1100';
        document.body.appendChild(container);
        return container;
    }
    
    // Validation en temps réel pour le téléphone
    document.getElementById('mobile')?.addEventListener('input', function() {
        if (this.value && !/^[0-9]{0,10}$/.test(this.value)) {
            this.value = this.value.slice(0, 10);
        }
    });
});
</script>

<script>
    $(document).ready(function() {
    $('#products').select2({
        multiple: true,
        placeholder: "Sélectionner un ou plusieurs produits",
        allowClear: true,
        dropdownParent: $('#addnewPropect')
    });
});
</script>
