<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

    


    <div class="container mt-4 wrapper">
        {{-- @php
            $token = auth()->user()->qr_code_token
        @endphp --}}
        <form method="post" action="{{ route('prospection.form', $token) }}" id="multiStepForm" class="submitForm">
            @csrf
            
            <!-- Progress Bar -->
            <div class="progress mb-4">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" id="formProgress" style="width: 0%; background-color: #1e4520" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <input type="hidden" name="{{$commercial->idmembre}}">
            
            <!-- Steps Indicators - Version améliorée pour mobile -->
            <ul class="nav nav-pills mb-4 justify-content-center flex-nowrap overflow-auto" id="formSteps" role="tablist" style="white-space: nowrap;">
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link active" id="step1-tab" data-bs-toggle="pill" data-bs-target="#step1" type="button" role="tab">
                        <span class="step-number">1</span> <span class="step-label">Infos Perso</span>
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link" id="step2-tab" data-bs-toggle="pill" data-bs-target="#step2" type="button" role="tab" disabled>
                        <span class="step-number">2</span> <span class="step-label">Profession</span>
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link" id="step3-tab" data-bs-toggle="pill" data-bs-target="#step3" type="button" role="tab" disabled>
                        <span class="step-number">3</span> <span class="step-label">Assurance</span>
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link" id="step4-tab" data-bs-toggle="pill" data-bs-target="#step4" type="button" role="tab" disabled>
                        <span class="step-number">4</span> <span class="step-label">Finalisation</span>
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="formStepsContent">
                <!-- Step 1: Personal Information -->
                <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Informations Personnelles</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">Prénom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                    <div class="invalid-feedback">Veuillez saisir le prénom</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                    <div class="invalid-feedback">Veuillez saisir le nom</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="invalid-feedback">Veuillez saisir un email valide</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="mobile" class="form-label">Téléphone Mobile</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" pattern="[0-9]{10}">
                                    <div class="invalid-feedback">Veuillez saisir un numéro valide (10 chiffres)</div>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label for="adress" class="form-label">Adresse</label>
                                    <textarea class="form-control" id="adress" name="adress" rows="2"></textarea>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">Ville</label>
                                    <select name="city" id="city" class="form-select modal-selecti">
                                        <option value="" disabled selected>Sélectionner...</option>
                                        @foreach ($villes as $item)
                                            <option value="{{ $item->idville }}">{{ $item->libelleVillle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary next-step" data-next="step2" style="background-color: #1e4520; border-color: #1e4520">
                            Suivant <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 2: Professional Information -->
                <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Informations Professionnelles</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="profession_uuid" class="form-label">Profession</label>
                                    <select class="form-select modal-selo" id="profession_uuid" name="profession_uuid">
                                        <option value="">Sélectionner...</option>
                                        @foreach ($professions as $item)
                                            <option class="form-optio" value="{{ $item->id }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="secteurActivity_uuid" class="form-label">Secteur d'Activité</label>
                                    <select class="form-select" id="secteurActivity_uuid" name="secteurActivity_uuid">
                                        <option value="">Sélectionner...</option>
                                        @foreach ($secteurActivites as $item)
                                            <option value="{{ $item->uuid }}">{{ $item->MonLibelle  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="natureProspect" class="form-label">Nature du Prospect <span class="text-danger">*</span></label>
                                    <select class="form-select" id="natureProspect" name="natureProspect" required>
                                        <option value="" disabled selected>Sélectionner...</option>
                                        <option value="Suspect">Suspect</option>
                                        <option value="Prospect">Prospect</option>
                                        <option value="Déjà client">Déjà client</option>
                                    </select>
                                    <div class="invalid-feedback">Veuillez sélectionner une nature</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary prev-step" data-prev="step1">
                            <i class="fas fa-arrow-left me-2"></i> Précédent
                        </button>
                        <button type="button" class="btn btn-primary next-step" data-next="step3" style="background-color: #1e4520; border-color: #1e4520">
                            Suivant <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 3: Insurance Information -->
                <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Informations Assurance</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="products" class="form-label">Produit</label>
                                    <select class="form-select" id="products" name="products[]" multiple>
                                        @foreach ($product as $item)
                                            <option value="{{ $item->IdProduit }}">
                                                {{ $item->MonLibelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="typeCompagnie" class="form-label">Type de Compagnie</label>
                                    <select class="form-select" id="typeCompagnie" name="typeCompagnie">
                                        <option value="">Sélectionner...</option>
                                        <option value="assurance">Assurance</option>
                                        <option value="banque">Banque</option>
                                        <option value="microfinance">Microfinance</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary prev-step" data-prev="step2">
                            <i class="fas fa-arrow-left me-2"></i> Précédent
                        </button>
                        <button type="button" class="btn btn-primary next-step" data-next="step4" style="background-color: #1e4520; border-color: #1e4520">
                            Suivant <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 4: Status and Finalization -->
                <div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="step4-tab">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Finalisation</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="lieuEvenement" class="form-label">Lieu de prospection</label>
                                    <input type="text" class="form-control" id="lieuEvenement" name="lieuEvenement">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" disabled selected>Sélectionner...</option>
                                        <option value="nouveau">Nouveau</option>
                                        <option value="en_cours">En cours</option>
                                        <option value="finalise">Finalisé</option>
                                        <option value="annule">Annulé</option>
                                    </select>
                                    <div class="invalid-feedback">Veuillez sélectionner un statut</div>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label for="note" class="form-label">Notes</label>
                                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary prev-step" data-prev="step3">
                            <i class="fas fa-arrow-left me-2"></i> Précédent
                        </button>
                        <button type="submit" class="btn btn-success" id="saveClientBtn" style="background-color: #1e4520; border-color: #1e4520">
                            <i class="fas fa-save me-2"></i> Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/custom.js')}}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des étapes
            const form = document.getElementById('multiStepForm');
            const steps = document.querySelectorAll('.tab-pane');
            const stepTabs = document.querySelectorAll('[role="tab"]');
            const progressBar = document.getElementById('formProgress');
            const totalSteps = steps.length;
            
            // Initialisation
            updateProgressBar(1);
            
            // Navigation entre les étapes
            document.querySelectorAll('.next-step').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const currentStep = this.closest('.tab-pane');
                    const nextStepId = this.getAttribute('data-next');
                    
                    // Validation avant de passer à l'étape suivante
                    if (validateStep(currentStep)) {
                        const nextStep = document.getElementById(nextStepId);
                        
                        // Activer l'étape suivante
                        currentStep.classList.remove('show', 'active');
                        nextStep.classList.add('show', 'active');
                        
                        // Mettre à jour les onglets
                        const currentTab = document.querySelector(`[data-bs-target="#${currentStep.id}"]`);
                        const nextTab = document.querySelector(`[data-bs-target="#${nextStepId}"]`);
                        
                        currentTab.classList.remove('active');
                        nextTab.classList.add('active');
                        nextTab.removeAttribute('disabled');
                        
                        // Mettre à jour la barre de progression
                        const stepNumber = parseInt(nextStepId.replace('step', ''));
                        updateProgressBar(stepNumber);
                        
                        // Faire défiler vers le haut
                        window.scrollTo({top: 0, behavior: 'smooth'});
                    }
                });
            });
            
            document.querySelectorAll('.prev-step').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const currentStep = this.closest('.tab-pane');
                    const prevStepId = this.getAttribute('data-prev');
                    const prevStep = document.getElementById(prevStepId);
                    
                    // Activer l'étape précédente
                    currentStep.classList.remove('show', 'active');
                    prevStep.classList.add('show', 'active');
                    
                    // Mettre à jour les onglets
                    const currentTab = document.querySelector(`[data-bs-target="#${currentStep.id}"]`);
                    const prevTab = document.querySelector(`[data-bs-target="#${prevStepId}"]`);
                    
                    currentTab.classList.remove('active');
                    prevTab.classList.add('active');
                    
                    // Mettre à jour la barre de progression
                    const stepNumber = parseInt(prevStepId.replace('step', ''));
                    updateProgressBar(stepNumber);
                    
                    // Faire défiler vers le haut
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });
            });
            
            // Fonction de validation d'étape
            function validateStep(step) {
                let isValid = true;
                const requiredFields = step.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                    
                    // Validation spécifique pour l'email
                    if (field.type === 'email' && field.value.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                    
                    // Validation spécifique pour le téléphone
                    if (field.id === 'mobile' && field.value.trim() && !/^[0-9]{10}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                });
                
                return isValid;
            }
            
            // Mise à jour de la barre de progression
            function updateProgressBar(currentStep) {
                const progress = (currentStep / totalSteps) * 100;
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
            }
            
            // Validation en temps réel
            form.querySelectorAll('[required]').forEach(field => {
                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
            
            // Gestion responsive des onglets
            function handleResponsiveTabs() {
                const stepLabels = document.querySelectorAll('.step-label');
                if (window.innerWidth < 768) {
                    stepLabels.forEach(label => label.style.display = 'none');
                } else {
                    stepLabels.forEach(label => label.style.display = 'inline');
                }
            }
            
            // Initialisation et écouteur de redimensionnement
            handleResponsiveTabs();
            window.addEventListener('resize', handleResponsiveTabs);
        });
    </script>
    
    <style>
        /* Style personnalisé pour les étapes */
        .nav-pills {
            overflow-x: auto;
            flex-wrap: nowrap;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .nav-pills::-webkit-scrollbar {
            display: none;
        }
        
        .nav-pills .nav-link {
            position: relative;
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            border-radius: 2rem;
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        @media (min-width: 768px) {
            .nav-pills .nav-link {
                padding: 0.75rem 1.5rem;
                margin: 0 0.5rem;
            }
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
        
        /* Améliorations responsive */
        @media (max-width: 767.98px) {
            .card-body .row > [class^="col-"] {
                margin-bottom: 1rem;
            }
            
            .step-label {
                display: none;
            }
            
            .nav-pills .nav-link {
                padding: 0.5rem 0.75rem;
            }
            
            .step-number {
                width: 20px;
                height: 20px;
                line-height: 20px;
                font-size: 0.75rem;
                margin-right: 4px;
            }
        }
        
        /* Animation pour le changement d'étape */
        .tab-pane.fade:not(.show) {
            display: none;
        }
        
        /* Style pour les selects multiples */
        select[multiple] {
            min-height: 120px;
        }
    </style>
</body>
</html>