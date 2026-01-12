<div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
    <h5 class="mb-1">Informations personnelles de l'adhérent</h5>
    <p class="mb-4">Veuillez entrer vos informations personnelles pour commencer l'adhésion en tenant compte des champs
        obligatoires (<span class="star">*</span>).</p>


    <div class="col-12 d-flex justify-content-center align-items-center">

        <div class="d-flex justify-content-between mb-3">
            <div>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#RechercherClientModal">
                    <i class="bx bx-search"></i> Rechercher un adhérent existant
                </button>
            </div>
        </div>
    </div>
    <hr>
        
    <div class="row g-3 mb-3">
        <div class="col-6">
            <label class="form-label">Civilité <span class="star">*</span></label> <br>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Madame" autocomplete="on" required data-invalid-message="Veuillez cocher la civilité">
                <label class="form-check-label" for="inlineRadio1">Madame</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Mademoiselle" autocomplete="on" required>
                <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio3" value="Monsieur" autocomplete="on" required>
                <label class="form-check-label" for="inlineRadio3">Monsieur</label>
            </div>
            @error('civilite')
                <span class="text-danger"> Veuillez cocher la civilité </span>
            @enderror
        </div>
        <div class="col-6">
            <label class="form-label">Situation matrimoniale <span class="star">*</span></label><br>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="celibataire" value="CELIB" required>
                <label class="form-check-label" for="celibataire">Célibataire</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="union_libre" value="union_libre" required>
                <label class="form-check-label" for="separe">En Concubinage</label>
            </div>

            {{-- <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="PACS" value="PACS" required>
                <label class="form-check-label" for="marie">Pacsé(e)</label>
            </div> --}}

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="marie" value="MARIE" required>
                <label class="form-check-label" for="marie">Marié(e)</label>
            </div>
            

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="divorce" value="DIVOR" required>
                <label class="form-check-label" for="divorce">Divorcé(e)</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="veuf" value="VEUVE" required>
                <label class="form-check-label" for="veuf">Veuf(ve)</label>
            </div>

            @error('situation_matrimoniale')
                <span class="text-danger">Veuillez sélectionner une situation matrimoniale.</span>
            @enderror
        </div>

    </div>
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="FisrtName" class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" class="form-control" id="FisrtName" placeholder="Nom" autocomplete="on" required>
            @error('nom')
                <span class="text-danger">Veuillez remplir le champ nom</span>
            @enderror
        </div>
        <div class="col-12 col-lg-6">
            <label for="LastName" class="form-label">Prénoms <span class="text-danger">*</span></label>
            <input type="text" name="prenom" class="form-control" id="LastName" placeholder="Prénoms" autocomplete="on" required>
            @error('prenom')
                <span class="text-danger">Veuillez remplir le champ prenom</span>
            @enderror
        </div>
    </div>
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="Date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
            <input type="date" name="datenaissance" class="form-control" id="Date_naissance"
                placeholder="Date de naissance" autocomplete="on" required>

                <span class="text-danger date-error"></span>

            @error('datenaissance')
                <span class="text-danger"> Veuillez remplir la date de naissance </span>
            @enderror
        </div>
        
        <div class="col-12 col-lg-6">
            <label for="lieunaissance" class="form-label">Lieu de naissance</label>
            <select class="form-select selection" name="lieunaissance" id="lieunaissance"
                data-codeproduit="{{ $product->CodeProduit }}" data-placeholder="Sélectionner le lieu" autocomplete="on">
                <option value="" disabled selected>Sélectionner le lieu</option>

              
            </select>
        </div>
        
    </div>

    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-4">
            <label for="" class="form-label">Nature de la pièce <span class="text-danger">*</span></label>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="naturepiece" id="CNI" value="CNI" autocomplete="on" required>
                <label class="form-check-label" for="CNI">CNI</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="naturepiece" id="Atestation" value="AT" autocomplete="on" required>
                <label class="form-check-label" for="Atestation">Attestation </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="naturepiece" id="Passport" value="Passport" autocomplete="on" required>
                <label class="form-check-label" for="Passport">Passeport</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="naturepiece" id="CarteConsulaire" value="CarteConsulaire" autocomplete="on" required>
                <label class="form-check-label" for="CarteConsulaire">Carte Consulaire</label>
            </div>

            @error('naturepiece')
                <span class="text-danger"> Veuillez cocher la nature de la pièce </span>
            @enderror
        </div>
        <div class="col-12 col-lg-4">
            <label for="numeropiece" class="form-label">Numéro de la pièce<span class="text-danger">*</span></label>
            <input type="text" name="numeropiece" class="form-control" id="numeropiece"
                placeholder="Nature de la pièce d'identité" autocomplete="on" required>

            @error('numeropiece')
                <span class="text-danger"> Veuillez remplir le numéro de la pièce </span>

            @enderror
        </div>
        <div class="col-12 col-lg-4">
            <label for="lieuresidence" class="form-label">Lieu de résidence <span class="text-danger">*</span></label>
            <select class="form-select selection" name="lieuresidence" id="lieuresidence" autocomplete="on" required>
                <option value="" disabled selected>Sélectionner le lieu</option>

                {{-- @foreach($villes as $ville)
                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                @endforeach --}}
            </select>
        </div>
    </div>
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="profession" class="form-label">Profession</label>
            <select class="form-select selection" name="profession" id="profession" autocomplete="on">
                <option value="" disabled selected>Sélectionner la profession</option>

                {{-- @foreach($professions as $profession)
                    <option value="{{ $profession->MonLibelle }}">{{ $profession->MonLibelle }}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="col-12 col-lg-6">
            <label for="employeur" class="form-label">Secteur d’activité</label>
            <select class="form-select selection" name="employeur" id="employeur" autocomplete="on">
                <option value="" disabled selected>Sélectionner le secteur d’activité</option>

                @foreach($secteurActivites as $secteurActivite)
                    <option value="{{ $secteurActivite->MonLibelle }}">{{ $secteurActivite->MonLibelle }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="row g-3 mb-3">
        <div class="col-12">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="on" required>

            @error('email')

                <span class="text-danger"> Veuillez remplir votre email </span>

            @enderror
        </div>
    </div>
    <fieldset class="border p-3">
        <legend class="float-none w-auto px-2"><small>Contact</small></legend>
        <!-- Bouton pour ajouter des contacts optionnels -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#contactModal">
            + Ajouter un contact
        </button>
        
        <!-- Aperçu des contacts -->
        <div id="contactsPreview" class="mt-3"></div>

        <!-- Champ caché pour soumettre au backend -->
        <input type="hidden" name="contacts" id="contactsInput">
    </fieldset>

    
    <fieldset class="border p-3">
        <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoin</small></legend>

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-8">
                <label for="contact_nom" class="form-label">Nom et Prénoms <span class="text-danger">*</span></label>
                <input type="text" name="personneressource" class="form-control" id="contact_nom" placeholder="Nom et Prénoms" required>
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label">Contact <span class="text-danger">*</span></label><br>
                <div class="input-group mb-3">
                    <input type="text" name="contactpersonneressource" class="form-control" aria-label="Text input with select" required minlength="10" maxlength="14">
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-8">
                <label for="contact_nom" class="form-label">Nom et Prénoms </label>
                <input type="text" name="personneressource2" class="form-control" id="contact_nom" placeholder="Nom et Prénoms" >
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label">Contact </label><br>
                <div class="input-group mb-3">
                    <input type="text" name="contactpersonneressource2" class="form-control" aria-label="Text input with select" maxlength="10">
                </div>
            </div>
        </div>
    </fieldset>


    <div class="d-flex justify-content-between">
        <div class="">
            <button onclick="event.preventDefault(); stepper1.previous()" class="btn border-btn btn-previous-form"><i
                class='bx bx-left-arrow-alt'></i>Précédent</button>
        </div>

        <div class="">
            <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two btn-next-form">Suivant<i class='bx bx-right-arrow-alt'></i></button>
           
             
        </div>
        
    </div>


    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('Date_naissance');
            const ageMin = {{ $product->AgeMiniAdh ?? '0' }};
            const ageMax = {{ $product->AgeMaxiAdh ?? '0' }};
            const today = new Date();

            dateInput.addEventListener('input', function () {
                const dateValue = new Date(dateInput.value);
                const userAge = today.getFullYear() - dateValue.getFullYear();
                const monthDifference = today.getMonth() - dateValue.getMonth();

                // Ajuster l'âge si l'anniversaire n'est pas encore passé cette année
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dateValue.getDate())) {
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
                    errorSpan.textContent = `Veuillez entrer une date de naissance valide. L'âge doit être compris entre ${ageMin} et ${ageMax} ans.`;
                    dateInput.parentNode.appendChild(errorSpan);
                    dateInput.classList.add('is-invalid');
                } else {
                    dateInput.classList.remove('is-invalid');
                }
            });
        });
    </script>


    <script>
       
        document.addEventListener('DOMContentLoaded', function () {
            const apiUrl = 'https://api.yakoafricassur.com/enov/villes';
            const apiProfessions = 'https://api.yakoafricassur.com/enov/professions';

            // Fonction utilitaire pour mettre en majuscule uniquement la première lettre
            function capitalizeFirstLetter(str) {
                if (!str) return '';
                return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
            }


            // Chargement des villes
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const villeSelect = document.getElementById('lieuresidence');
                    const lieuSelect = document.getElementById('lieunaissance');
                    
                    data.forEach(ville => {
                        const libelleFormate = capitalizeFirstLetter(ville.MonLibelle);

                        const optionVille = document.createElement('option');
                        optionVille.value = libelleFormate;
                        optionVille.textContent = libelleFormate;
                        villeSelect.appendChild(optionVille);

                        const optionLieu = document.createElement('option');
                        optionLieu.value = libelleFormate;
                        optionLieu.textContent = libelleFormate;
                        lieuSelect.appendChild(optionLieu);
                    });
                })
                .catch(error => console.error('Erreur chargement villes:', error));

            // Chargement des professions
            fetch(apiProfessions)
                .then(response => response.json())
                .then(data => {
                    const professionSelect = document.getElementById('profession');
                    
                    data.forEach(profession => {
                        const libelleFormate = capitalizeFirstLetter(profession.MonLibelle);

                        const optionProfession = document.createElement('option');
                        optionProfession.value = libelleFormate;
                        optionProfession.textContent = libelleFormate;
                        professionSelect.appendChild(optionProfession);
                    });
                })
                .catch(error => console.error('Erreur chargement professions:', error));
        });




    </script>


</div>
