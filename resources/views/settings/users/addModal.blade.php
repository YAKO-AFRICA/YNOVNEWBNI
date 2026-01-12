<div class="modal fade" id="addUsers" tabindex="-1" aria-labelledby="membreModalLabel" aria-hidden="true">
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
                background: #076633;
                color: #fff;
                font-weight: bold;
            }

        </style>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="membreModalLabel">Ajouter un nouveau Membre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('setting.user.store') }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">

                    <div class="steps-banner mb-4">
                        <ul class="step-indicators d-flex justify-content-between list-unstyled p-0">
                            <li id="step-indicator-1" class="step-indicator active">1. Réseau</li>
                            <li id="step-indicator-2" class="step-indicator">2. Informations</li>
                            <li id="step-indicator-3" class="step-indicator">3. Comptes</li>
                            <li id="step-indicator-4" class="step-indicator">4. Contacts</li>
                        </ul>
                    </div>

                    <div id="step-1" class="step">
                        <fieldset class="border p-3" style="width: 100%;">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 1 : Reseau</h5></small></legend>
                        
                            <div class="mb-3">
                                <label for="codeagent" class="form-label">Code Agent <span class="text-danger">*</span></label>
                                <input type="text" name="codeagent" id="codeagent" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="codereseau" class="form-label">Réseau de commercialisation</label>
                                    <select name="codereseau" id="codereseau" class="form-select">
                                        <option value="" disabled selected>-- Choisir une option --</option>
                                        @foreach ($reseaux as $item)
                                            <option class="form-control" value="{{ $item->id }}">{{ $item->libelle ?? "" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6">
                                    <label for="codezone" class="form-label">Zone/Departement</label>
                                    <select name="codezone" id="codezone" class="form-select" id="">
                                        <option value="" disabled selected>-- Choisir une zone --</option>
                                        @foreach ($zones as $zone)
                                            <option class="form-control" value="{{ $zone->id }}">{{ $zone->libellezone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="codeequipe" class="form-label">Equipe/Agence</label>
                                    <select name="codeequipe" id="codeequipe" class="form-select">
                                       
                                        <option value="" disabled selected>-- Choisir une équipe --</option>
                                        @foreach ($equipes as $equipe)
                                            <option class="form-control" value="{{ $equipe->codeequipe }}">
                                                {{ $equipe->libelleequipe ?? ''}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="codePart" class="form-label">Partenaire</label>
                                    <select name="codePart" id="codePart" class="form-select" id="">
                                        <option value="">-- Choisir une partenaire --</option>
                                        @foreach ($partners as $item)
                                            <option class="form-control" value="{{ $item->code }}">{{ $item->designation }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    <div id="step-2" class="step d-none">
                        <fieldset class="border p-3" style="width: 100%;">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 2 : Informations personnelles</h5></small></legend>
                            
                            <div class="mb-3">
                                <label class="form-label d-block">Sexe</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="sexeF" name="sexe" value="F" class="form-check-input">
                                    <label class="form-check-label" for="sexeF">Féminin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="sexeM" name="sexe" value="M" class="form-check-input">
                                    <label class="form-check-label" for="sexeM">Masculin</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" name="nom" id="nom" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Prenoms</label>
                                        <input type="text" name="prenom" id="prenom" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="datenaissance" class="form-label">Date de naissance</label>
                                        <input type="date" name="datenaissance" id="datenaissance" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profession" class="form-label">Profession</label>
                                        <input type="text" name="profession" id="profession" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    <div id="step-3" class="step d-none">
                        <fieldset class="border p-3" style="width: 100%;">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 3 : Comptes</h5></small></legend>
                            <div class="mb-3">
                                <label for="login" class="form-label">Nom d'utilisateur (Login) <span class="text-danger">*</span></label>
                                <input type="text" name="login" id="login" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="branche" class="form-label">Branche <span class="text-danger">*</span></label>
                                <select name="branche" class="form-select" id="">
                                    <option value="" disabled selected>-- Choisir une option --</option>
                                    <option value="BANKASS">BANKASS</option>
                                    <option value="COURTAGE">COURTAGE</option>
                                    <option value="COM">COM</option>

                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="profile" class="form-label">Profile <span class="text-danger">*</span></label>
                                        <select name="profile_id" id="profileSelect" class="form-control" required>
                                            <option value="" disabled selected>-- Choisir une option --</option>
                                            
                                            @foreach ($profiles as $profile)
                                                <option class="form-option" value="{{ $profile->id }}">{{ $profile->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                        <select name="role_id" id="" class="form-control" required>
                                            <option value="">-- Choisir une option --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name ?? "" }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pass" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                        <input type="password" name="pass" id="pass" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cpass" class="form-label">Confirmation Mot de passe</label>
                                        <input type="password" name="cpass" id="cpass" class="form-control">
                                    </div>
                                </div>
                            </div>
                            

                        </fieldset>
                    </div>
                    <div id="step-4" class="step d-none">
                        <fieldset class="border p-3" style="width: 100%;">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 4 : Contacts</h5></small></legend>
                            <div class="mb-3">
                                <label for="login" class="form-label">Email  <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cel" class="form-label">Mobile 1</label>
                                        <input type="text" name="cel" id="cel" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tel" class="form-label">Mobile 2</label>
                                        <input type="tel" name="tel" id="tel" class="form-control">
                                    </div>
                                </div>
                            </div>
                            

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
    const showStep = (stepAdd) => {
        // Show the correct step
        document.querySelectorAll('.step').forEach(el => el.classList.add('d-none'));
        document.querySelector(`#step-${stepAdd}`).classList.remove('d-none');
        
        // Update buttons
        document.querySelector('.prev-step').classList.toggle('d-none', stepAdd === 1);
        document.querySelector('.next-step').classList.toggle('d-none', stepAdd === 4);
        document.querySelector('.finish-step').classList.toggle('d-none', stepAdd !== 4);

        // Update the step indicator
        document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
            indicator.classList.toggle('active', index + 1 === stepAdd);
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
