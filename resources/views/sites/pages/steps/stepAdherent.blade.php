<style>
    .readonly {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        cursor: not-allowed;
    }
</style>
<div class="row g-3 mb-3">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label class="form-label">Civilité <span class="text-danger">*</span></label> <br>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Madame" autocomplete="on"
                required data-invalid-message="Veuillez cocher la civilité">
            <label class="form-check-label" for="inlineRadio1">Madame</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Mademoiselle"
                autocomplete="on" required>
            <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio3" value="Monsieur"
                autocomplete="on" required>
            <label class="form-check-label" for="inlineRadio3">Monsieur</label>
        </div>
        @error('civilite')
            <span class="text-danger"> Veuillez cocher la civilité </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label class="form-label">Situation matrimoniale <span class="text-danger">*</span></label> <br>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="situation_matrimoniale" id="radioCelibataire"
                value="celibataire" required>
            <label class="form-check-label" for="radioCelibataire">Célibataire</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="situation_matrimoniale" id="radioMarie" value="marie">
            <label class="form-check-label" for="radioMarie">Marié(e)</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="situation_matrimoniale" id="radioVeuf" value="veuf">
            <label class="form-check-label" for="radioVeuf">Veuf / Veuve</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="situation_matrimoniale" id="radioDivorce"
                value="divorce">
            <label class="form-check-label" for="radioDivorce">Divorcé(e)</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="situation_matrimoniale" id="radioSepare"
                value="separe">
            <label class="form-check-label" for="radioSepare">Séparé(e)</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="situation_matrimoniale" id="radioUnionLibre"
                value="union_libre">
            <label class="form-check-label" for="radioUnionLibre">Union libre</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="situation_matrimoniale" id="radioPacs" value="pacs">
            <label class="form-check-label" for="radioPacs">PACS</label>
        </div>

        @error('situation_matrimoniale')
            <span class="text-danger">Veuillez sélectionner une situation matrimoniale</span>
        @enderror
    </div>

</div>
<!---end row-->
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6">
        <label for="FisrtName" class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" name="nom" class="form-control" id="FisrtName" placeholder="Nom" autocomplete="on"
            required>
        @error('nom')
            <span class="text-danger">Veuillez remplir le champ nom</span>
        @enderror
    </div>
    <div class="col-12 col-lg-6">
        <label for="LastName" class="form-label">Prénoms <span class="text-danger">*</span></label>
        <input type="text" name="prenom" class="form-control" id="LastName" placeholder="Prénoms"
            autocomplete="on" required>
        @error('prenom')
            <span class="text-danger">Veuillez remplir le champ prenom</span>
        @enderror
    </div>
</div>
<!---end row-->
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-4">
        <label for="Date_naissance" class="form-label ">Date de naissance <span class="text-danger">*</span></label>
        <input type="date" name="datenaissance" class="form-control" id="Date_naissance"
            placeholder="Date de naissance" autocomplete="on" required>

        <span class="text-danger date-error"></span>

        @error('datenaissance')
            <span class="text-danger"> Veuillez remplir la date de naissance </span>
        @enderror
    </div>

    <div class="col-12 col-lg-4">
        <label for="" class="form-label">Nature de la pièce <span class="text-danger">*</span></label>
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="naturepiece" id="CNI" value="CNI"
                autocomplete="on" required>
            <label class="form-check-label" for="CNI">CNI</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="naturepiece" id="Atestation" value="AT"
                autocomplete="on" required>
            <label class="form-check-label" for="Atestation">Attestation</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="naturepiece" id="Passport" value="Passport"
                autocomplete="on" required>
            <label class="form-check-label" for="Passport">Passport</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="naturepiece" id="carteSejour"
                value="Carte de sejour" autocomplete="on" required>
            <label class="form-check-label" for="carteSejour">Carte de séjour</label>
        </div>

        @error('naturepiece')
            <span class="text-danger"> Veuillez cocher la nature de la pièce </span>
        @enderror
    </div>
    <div class="col-12 col-lg-4">
        <label for="numeropiece" class="form-label">numéro de la pièce<span class="text-danger">*</span></label>
        <input type="text" name="numeropiece" class="form-control" id="numeropiece"
            placeholder="Nature de la pièce d'identité" autocomplete="on" required>

        @error('numeropiece')
            <span class="text-danger"> Veuillez remplir le numéro de la pièce </span>
        @enderror
    </div>


</div>

<div class="row g-3-mb-3">
        {{-- <div class="col-12 col-lg-6">
            <label for="paysDeNaissance" class="form-label ">Pays de naissance</label>
            <select   class="form-select apiCountry selection" name="paysDeNaissance" id="paysDeNaissance"
                data-codeproduit="{{ $product->CodeProduit }}" data-placeholder="Sélectionner un Pays" autocomplete="on">
                <option value="" disabled selected>Sélectionner un Pays</option>
            </select>
        </div> --}}
        <div class="col-12 col-lg-6">
            <label for="paysDeNaissance" class="form-label">Pays de naissance</label>
            <select class="form-select apiCountry selection" name="paysDeNaissance" id="paysDeNaissance"
                data-placeholder="Sélectionner un Pays">
                <option value="" disabled selected>Sélectionner un Pays</option>
            </select>
        </div>
        <div class="col-12 col-lg-6">
            <label for="lieunaissance" class="form-label">Lieu de naissance</label>
            <input type="text" name="lieunaissance" class="form-control" id="lieunaissance">
        </div>
    </div>

    <!---end row-->
    <div class="row g-3 my-3">
        <div class="col-12 col-lg-4">
            <label for="paysDeResidence" class="form-label ">Pays de residence</label>
            <select class="form-select apiCountry selection" name="paysDeResidence" id="paysDeResidence"
                data-codeproduit="{{ $product->CodeProduit }}" data-placeholder="Sélectionner un Pays" autocomplete="on">
                <option value="" disabled selected>Sélectionner un Pays</option>
            </select>
        </div>
        <div class="col-12 col-lg-4">
            <label for="lieuresidence" class="form-label">Lieu de résidence <span class="text-danger">*</span></label>
            <input type="text" name="lieuresidence" class="form-control" id="lieuresidence" required>
        </div>

        @if ($codePartner == "DIRECTENTREPRISE")
            <div class="col-12 col-lg-4">
                <label for="justifResidenceAdh" class="form-label">Justificatif de résidence </label>
                <input type="file" name="justifResidenceAdh" class="form-control" id="justifResidenceAdh" accept="application/pdf,image/jpeg,image/jpg,image/png">
            </div>
        @else
            <div class="col-12 col-lg-4">
                <label for="justifResidenceAdh" class="form-label">Justificatif de résidence <span class="text-danger">*</span></label>
                <input type="file" name="justifResidenceAdh" class="form-control" id="justifResidenceAdh" accept="application/pdf,image/jpeg,image/jpg,image/png"  required>
            </div>
        @endif
        
        
    </div>
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="profession" class="form-label">Profession</label>
            <select class="form-select selection" name="profession" id="profession" autocomplete="on">
                <option value="" disabled selected>Sélectionner la profession</option>

                {{-- @foreach ($professions as $profession)
                        <option value="{{ $profession->MonLibelle }}">{{ $profession->MonLibelle }}</option>
                    @endforeach --}}
            </select>
        </div>
        <div class="col-12 col-lg-6">
            <label for="employeur" class="form-label">Secteur d'activités</label>
            <select class="form-select selection" name="employeur" id="employeur" autocomplete="on">
                <option value="" disabled selected>Sélectionner le secteur d'activites</option>

                @foreach ($secteurActivites as $secteurActivite)
                    <option value="{{ $secteurActivite->MonLibelle }}">{{ $secteurActivite->MonLibelle }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="row g-3 mb-3">
        <div class="col-12">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                autocomplete="on" required>

            @error('email')
                <span class="text-danger"> Veuillez remplir votre email </span>
            @enderror
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-4">
            <label class="form-label">Mobile <span class="text-danger">*</span></label><br>
            <div class="input-group mb-3">
                <input type="tel" name="mobile" class="form-control" autocomplete="on" required minlength="10"
                    maxlength="15">
            </div>

            @error('mobile')
                <span class="text-danger"> Veuillez remplir votre numéro de mobile </span>
            @enderror


        </div>
        <div class="col-12 col-lg-4">
            <label class="form-label">Mobile 2</label><br>
            <div class="input-group mb-3">
                <input type="tel" id="mobile1" name="mobile1" class="form-control" autocomplete="on"
                    minlength="10" maxlength="15">
            </div>
        </div>
        <div class="col-12 col-lg-4">

            <label class="form-label">Téléphone</label><br>
            <div class="input-group mb-3">
                <input type="tel" id="telephone" name="telephone" class="form-control" autocomplete="on"
                    minlength="10" maxlength="15">
            </div>
        </div>
    </div>
    <!---end row-->
    <fieldset class="border p-3">
        <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoins</small></legend>

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-8">
                <label for="contact_nom" class="form-label">Nom et Prénoms <span class="text-danger">*</span></label>
                <input type="text" name="personneressource" class="form-control" id="contact_nom"
                    placeholder="Nom et Prénoms" required>
            </div>

            <div class="col-12 col-lg-4">
                <label class="form-label">Contact <span class="text-danger">*</span></label><br>
                <div class="input-group mb-3">
                    <input type="tel" name="contactpersonneressource" class="form-control"
                        aria-label="Text input with select" required minlength="10" maxlength="15">
                </div>
            </div>
            

        </div>

        

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-8">
                <label for="contact_nom" class="form-label">Nom et Prénoms </label>
                <input type="text" name="personneressource2" class="form-control" id="contact_nom"
                    placeholder="Nom et Prénoms">
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label">Contact </label><br>
                <div class="input-group mb-3">
                    <input type="tel" name="contactpersonneressource2" class="form-control"
                        aria-label="Text input with select" minlength="10" maxlength="15">
                </div>
            </div>
        </div>
    </fieldset>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('Date_naissance');
            const ageMin = {{ $product->AgeMiniAdh ?? '0' }};
            const ageMax = {{ $product->AgeMaxiAdh ?? '0' }};
            const today = new Date();

            dateInput.addEventListener('input', function() {
                const dateValue = new Date(dateInput.value);
                const userAge = today.getFullYear() - dateValue.getFullYear();
                const monthDifference = today.getMonth() - dateValue.getMonth();

                // Ajuster l'âge si l'anniversaire n'est pas encore passé cette année
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dateValue
                .getDate())) {
                    userAge--;
                }

                // Supprimer les messages d'erreur précédents
                const errorElement = document.querySelector('.date-error');
                if (errorElement) {
                    errorElement.remove();
                }

                // Vérifier si l'âge est hors des limites
                if (!dateInput.value || userAge < ageMin || userAge > ageMax) {
                    const errorSpan = document.createElement('span');
                    errorSpan.classList.add('text-danger', 'date-error');
                    errorSpan.textContent =
                        `Veuillez entrer une date de naissance valide. L'âge doit être compris entre ${ageMin} et ${ageMax} ans.`;
                    dateInput.parentNode.appendChild(errorSpan);
                    dateInput.classList.add('is-invalid');
                } else {
                    dateInput.classList.remove('is-invalid');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const apiUrl = 'https://api.yakoafricassur.com/enov/villes';
            const apiProfessions = 'https://api.yakoafricassur.com/enov/professions';

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const villeSelect = document.getElementById('lieuresidence');
                    const lieuSelect = document.getElementById('lieunaissance');

                    data.sort((a, b) => a.MonLibelle.localeCompare(b.MonLibelle, 'fr', { sensitivity: 'base' }));

                    data.forEach(ville => {
                        const optionVille = document.createElement('option');
                        optionVille.value = ville.MonLibelle;
                        optionVille.textContent = ville.MonLibelle;
                        villeSelect.appendChild(optionVille);

                        const optionLieu = document.createElement('option');
                        optionLieu.value = ville.MonLibelle;
                        optionLieu.textContent = ville.MonLibelle;
                        lieuSelect.appendChild(optionLieu);
                    });
                });



            fetch(apiProfessions)
                .then(response => response.json())
                .then(data => {
                    const professionSelect = document.getElementById('profession');

                    data.sort((a, b) => a.MonLibelle.localeCompare(b.MonLibelle, 'fr', { sensitivity: 'base' }));

                    data.forEach(profession => {
                        const optionProfession = document.createElement('option');
                        optionProfession.value = profession.MonLibelle;
                        optionProfession.textContent = profession.MonLibelle;
                        professionSelect.appendChild(optionProfession);
                    });
                });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getSessionData() {
                const raw = sessionStorage.getItem('souscriptionData');
                let data = {};
                try {
                    data = raw ? JSON.parse(raw) : {};
                } catch (e) {
                    console.error("Erreur de parsing JSON sessionStorage:", e);
                }
                if (!data.adherentData) {
                    data.adherentData = {};
                }
                return data;
            }

            function saveSessionData(data) {
                sessionStorage.setItem('souscriptionData', JSON.stringify(data));
                console.log("✅ Données enregistrées dans la session :", data);
            }

            function updateSessionField(name, value) {
                const data = getSessionData();
                data.adherentData[name] = value;
                saveSessionData(data);
            }

            const fieldSelectors = [
                'input[name="civilite"]',
                'input[name="situation_matrimoniale"]',
                'input[name="naturepiece"]',
                'input[name="nom"]',
                'input[name="prenom"]',
                'input[name="datenaissance"]',
                'input[name="numeropiece"]',
                'input[name="email"]',
                'input[name="mobile"]',
                'input[name="mobile1"]',
                'input[name="telephone"]',
                'input[name="personneressource"]',
                'input[name="contactpersonneressource"]',
                'input[name="personneressource2"]',
                'input[name="contactpersonneressource2"]',
                'input[name="lieunaissance"]',
                'input[name="lieuresidence"]',
                'select[name="paysDeNaissance"]',
                'select[name="profession"]',
                'select[name="employeur"]',
                'input[type="file"]',
            ];

            fieldSelectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(element => {
                    const type = element.type;

                    if (type === 'radio') {
                        element.addEventListener('change', function() {
                            if (this.checked) {
                                updateSessionField(this.name, this.value);
                            }
                        });
                    } 
                    else if (type === 'text' || type === 'email' || type === 'tel' || type === 'date') {
                        element.addEventListener('input', function() {
                            updateSessionField(this.name, this.value);
                        });
                    }
                    else if (element.tagName.toLowerCase() === 'select') {
                        element.addEventListener('change', function() {
                            updateSessionField(this.name, this.value);
                        });
                    }
                    else if (type === 'file') {
                        element.addEventListener('change', function() {
                            if (this.files.length > 0) {
                                updateSessionField(this.name, this.files[0].name);
                            }
                        });
                    }
                });
            });
        });

    </script>



