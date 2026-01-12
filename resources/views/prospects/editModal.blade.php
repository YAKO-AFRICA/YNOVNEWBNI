<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1e4520">
                <h5 class="modal-title text-white">Mise à jour du prospect</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prospect.update', $prospect->uuid) }}" method="POST" id="multiStepForm">
                @csrf
                @method('PUT')
                
                <!-- Progress Bar -->
                <div class="progress mt-3 mx-3" style="height: 10px;">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" id="formProgress" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
                <!-- Steps Indicators -->
                <ul class="nav nav-pills nav-justified mb-4 mt-3 mx-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="step1-tab" data-bs-toggle="pill" data-bs-target="#step1" type="button" role="tab" aria-controls="step1" aria-selected="true">
                            <span class="d-none d-md-inline">Étape 1 :</span> Informations Personnelles
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="step2-tab" data-bs-toggle="pill" data-bs-target="#step2" type="button" role="tab" aria-controls="step2" aria-selected="false">
                            <span class="d-none d-md-inline">Étape 2 :</span> Professionnelles
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="step3-tab" data-bs-toggle="pill" data-bs-target="#step3" type="button" role="tab" aria-controls="step3" aria-selected="false">
                            <span class="d-none d-md-inline">Étape 3 :</span> Statut
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content" id="pills-tabContent">
                    <!-- Step 1: Personal Information -->
                    <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                        <div class="card mb-4 mx-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Informations Personnelles</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $prospect->first_name) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $prospect->last_name) }}" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $prospect->email) }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Téléphone Mobile</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" value="{{ old('mobile', $prospect->mobile) }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="adress" class="form-label">Adresse</label>
                                    <textarea class="form-control" id="adress" name="adress" rows="2">{{ old('adress', $prospect->adress) }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="city" class="form-label">Ville</label>
                                    <select class="form-control" name="city" id="city">
                                        @foreach ($villes as $item)
                                            <option value="{{ $item->idville}}" {{ old('city', $prospect->city) == $item->idville ? 'selected' : '' }}>
                                                {{ $item->libelleVillle ?? " "}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mx-3 mb-3">
                            <button type="button" class="btn btn-secondary" disabled>
                                <i class="fas fa-arrow-left me-2"></i> Précédent
                            </button>
                            <button type="button" class="btn btn-primary next-step" style="background-color: #1e4520; border-color: #1e4520">
                                Suivant <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Professional Information -->
                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                        <div class="card mb-4 mx-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Informations Professionnelles</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="profession_uuid" class="form-label">Profession</label>
                                    <select class="form-select" id="profession_uuid" name="profession_uuid">
                                        {{-- <option value="{{ $prospect->profession_uuid }}" selected>{{ $prospect->profession_uuid ?? ' ' }}</option> --}}

                                        @foreach($professions as $profession)
                                            <option value="{{ $profession->IdProfession }}" {{ old('profession_uuid', $prospect->profession_uuid) == $profession->IdProfession ? 'selected' : '' }}>
                                                {{ $profession->MonLibelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="secteurActivity_uuid" class="form-label">Secteur d'Activité</label>
                                    <select class="form-select" id="secteurActivity_uuid" name="secteurActivity_uuid">
                                        {{-- <option value="{{ $prospect->secteurActivity_uuid }}">{{ $prospect->secteurActivity->MonLibelle ?? ' ' }}</option> --}}
                                        @foreach($secteurActivites as $secteur)
                                            <option value="{{ $secteur->IdSecteurActiviteSocietes }}" {{ old('secteurActivity_uuid', $prospect->secteurActivity_uuid) == $secteur->IdSecteurActiviteSocietes ? 'selected' : '' }}>
                                                {{ $secteur->MonLibelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="natureProspect" class="form-label">Nature du Prospect <span class="text-danger">*</span></label>
                                    <select class="form-select" id="natureProspect" name="natureProspect" required>
                                        <option value="Suspect" {{ old('natureProspect', $prospect->natureProspect) == 'Suspect' ? 'selected' : '' }}>Suspect</option>
                                        <option value="Prospect" {{ old('natureProspect', $prospect->natureProspect) == 'Prospect' ? 'selected' : '' }}>Prospect</option>
                                        <option value="Déjà client" {{ old('natureProspect', $prospect->natureProspect) == 'Déjà client' ? 'selected' : '' }}>Déjà client</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mx-3 mb-3">
                            <button type="button" class="btn btn-secondary prev-step">
                                <i class="fas fa-arrow-left me-2"></i> Précédent
                            </button>
                            <button type="button" class="btn btn-primary next-step" style="background-color: #1e4520; border-color: #1e4520">
                                Suivant <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Status Information -->
                    <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                        <div class="card mb-4 mx-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Statut</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="lieuEvenement" class="form-label">Lieu de prospection</label>
                                    <input type="text" class="form-control" id="lieuEvenement" name="lieuEvenement" value="{{ old('lieuEvenement', $prospect->lieuEvenement) }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="nouveau" {{ old('status', $prospect->status) == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                                        <option value="en_cours" {{ old('status', $prospect->status) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="finalise" {{ old('status', $prospect->status) == 'finalise' ? 'selected' : '' }}>Finalisé</option>
                                        <option value="annule" {{ old('status', $prospect->status) == 'annule' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="note" class="form-label">Notes</label>
                                    <textarea class="form-control" id="note" name="note" rows="3">{{ old('note', $prospect->note) }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mx-3 mb-3">
                            <button type="button" class="btn btn-secondary prev-step">
                                <i class="fas fa-arrow-left me-2"></i> Précédent
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .nav-pills .nav-link.active {
        background-color: #1e4520;
        color: white;
    }
    .nav-pills .nav-link {
        color: #1e4520;
        border: 1px solid #1e4520;
        margin: 0 2px;
    }
    .progress-bar {
        transition: width 0.3s ease;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Navigation between steps
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    const progressBar = document.getElementById('formProgress');
    
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentTab = this.closest('.tab-pane');
            const nextTab = currentTab.nextElementSibling;
            
            if (nextTab) {
                const nextTabId = nextTab.getAttribute('id');
                const nextTabButton = document.querySelector(`[data-bs-target="#${nextTabId}"]`);
                
                // Update progress bar
                if (nextTabId === 'step2') {
                    progressBar.style.width = '66%';
                    progressBar.setAttribute('aria-valuenow', '66');
                } else if (nextTabId === 'step3') {
                    progressBar.style.width = '100%';
                    progressBar.setAttribute('aria-valuenow', '100');
                }
                
                // Bootstrap tab show
                const tab = new bootstrap.Tab(nextTabButton);
                tab.show();
            }
        });
    });
    
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentTab = this.closest('.tab-pane');
            const prevTab = currentTab.previousElementSibling;
            
            if (prevTab) {
                const prevTabId = prevTab.getAttribute('id');
                const prevTabButton = document.querySelector(`[data-bs-target="#${prevTabId}"]`);
                
                // Update progress bar
                if (prevTabId === 'step1') {
                    progressBar.style.width = '33%';
                    progressBar.setAttribute('aria-valuenow', '33');
                } else if (prevTabId === 'step2') {
                    progressBar.style.width = '66%';
                    progressBar.setAttribute('aria-valuenow', '66');
                }
                
                // Bootstrap tab show
                const tab = new bootstrap.Tab(prevTabButton);
                tab.show();
            }
        });
    });
    
    // Validate before moving to next step (optional)
    document.getElementById('multiStepForm').addEventListener('click', function(e) {
        if (e.target.classList.contains('next-step')) {
            const currentTab = e.target.closest('.tab-pane');
            const inputs = currentTab.querySelectorAll('[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>