<div class="modal fade" id="addPartner" tabindex="-1" aria-labelledby="mreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <style>
            .steps-banner {
                position: relative;
                border-bottom: 1px solid #ddd;
                margin-bottom: 20px;
            }

            .step-indicators {
                display: flex;
                justify-content: space-between;
            }

            .step-indicator {
                text-align: center;
                flex-grow: 1;
                font-size: 0.9rem;
                padding: 10px;
                background: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin: 0 5px;
                color: #555;
                transition: background 0.3s, color 0.3s;
            }

            .step-indicator.active {
                background: #154b07;
                color: #fff;
                font-weight: bold;
            }

        </style>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un nouveau partenaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('setting.partner.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                
                        <div class="steps-banner mb-4">
                            <ul class="step-indicators d-flex justify-content-between list-unstyled p-0">
                                <li id="step-indicator-1" class="step-indicator active">1. Informations Générales</li>
                                <li id="step-indicator-2" class="step-indicator">2. Personnes Ressources</li>
                                <li id="step-indicator-3" class="step-indicator">3. Comptes/Produits</li>
                            </ul>
                        </div>
                
                        <!-- Étape 1 -->
                        <div id="step-1" class="step">
                            <fieldset class="border p-3">
                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 1 : Informations Générales</h5></small></legend>
                                
                                <div class="form-group mb-3">
                                    <label for="code" class="form-label">Code </label>
                                    <input type="text" name="code" id="code" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nom" class="form-label">Logo </label>
                                    <input type="file" name="logo" id="logo" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="designation" class="form-label">Raison sociale <span class="text-danger">*</span></label>
                                        <input type="text" name="designation" id="designation" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="activitesprincipales" class="form-label">Activité principale</label>
                                        <input type="text" name="activitesprincipales" id="activitesprincipales" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="capital" class="form-label">Capital</label>
                                        <input type="number" name="capital" id="capital" class="form-control">
                                    </div>.

                                    <div class="mb-3">
                                        <label for="nrc" class="form-label">N° RC</label>
                                        <input type="text" name="nrc" id="nrc" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="forme_juridique" class="form-label">Forme juridique</label>
                                        <input type="text" name="forme_juridique" id="forme_juridique" class="form-control">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="compte_contribuable" class="form-label">Compte contribuable</label>
                                        <input type="text" name="compte_contribuable" id="compte_contribuable" class="form-control">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                
                        <!-- Étape 2 -->
                        <div id="step-2" class="step d-none">
                            <fieldset class="border p-3">
                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 2 : Personnes Ressources</h5></small></legend>
                
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="mobile1" class="form-label">Mobile 1</label>
                                        <input type="tel" name="mobile1" id="mobile1" class="form-control" placeholder="00 00 00 00 00">
                                    </div>
                                    <div class="mb-3">
                                        <label for="mobile2" class="form-label">Mobile 2</label>
                                        <input type="tel" name="mobile2" id="mobile2" class="form-control" placeholder="00 00 00 00 00">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="adresseemail" id="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                        <input type="tel" name="telephone" id="telephone" class="form-control" placeholder="00 00 00 00 00" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="siteweb" class="form-label">Site web</label>
                                        <input type="text" name="siteweb" id="siteweb" class="form-control">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                
                        <!-- Étape 3 -->
                        <div id="step-3" class="step d-none">
                            <fieldset class="border p-3">
                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 3 : Comptes/Produits</h5></small></legend>
                
                                <label for="convention" class="form-label">Ajouter une convention au produit</label>
                                <input type="file" name="convention" id="convention" class="form-control">
                            </fieldset>
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary prev-step d-none">Précédent</button>
                        <button type="button" class="btn btn-primary next-step">Suivant</button>
                        <button type="submit" class="btn btn-success d-none finish-step">Terminer</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>


    <script>
        let currentStep = 1;
    
        const showStep = (step) => {
            // Show the correct step
            document.querySelectorAll('.step').forEach(el => el.classList.add('d-none'));
            document.querySelector(`#step-${step}`).classList.remove('d-none');
            
            // Update buttons
            document.querySelector('.prev-step').classList.toggle('d-none', step === 1);
            document.querySelector('.next-step').classList.toggle('d-none', step === 3);
            document.querySelector('.finish-step').classList.toggle('d-none', step !== 3);
    
            // Update the step indicator
            document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                indicator.classList.toggle('active', index + 1 === step);
            });
        };
    
        document.querySelector('.next-step').addEventListener('click', () => {
            if (currentStep < 4) {
                currentStep++;
                showStep(currentStep);
            }
        });
    
        document.querySelector('.prev-step').addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    
        // Initialize with the first step
        showStep(currentStep);
    </script>
</div>