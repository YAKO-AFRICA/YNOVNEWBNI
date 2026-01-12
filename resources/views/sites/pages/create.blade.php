<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire de Souscription - ynov</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
        
	<!--favicon-->
	<link rel="icon" href="{{ asset('root/images/logo-icon.png')}}" type="image/png"/>
	<!--plugins-->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />

	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">





    
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .countryPrefix {
            widows: 30% !important;
            max-width: 30% !important;
        }

        .select2-container .select2-selection--single {

            height: 37px !important;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .progress-line {
            height: 4px;
            background: #dee2e6;
            position: relative;
            margin: 20px 0;
        }

        .progress-line-active {
            height: 4px;
            background: #edb440;
            transition: width 0.5s ease;
        }

        .step-indicator {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #dee2e6;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .step-indicator.active {
            background: #076633;
            color: white;
        }

        .step-indicator.completed {
            background: #edb440;
            color: #076633;
        }

        .step-label.active {
            font-weight: bold;
            color: #076633;
        }
    </style>
</head>

<body>

    <div class="container py-5 wrapper">
        <div class="card shadow">
            <div class="card-header text-center text-white"
                style="background: linear-gradient(135deg, #076633, #0a7d3d);">
                <h2 class="mb-1 text-light">Formulaire de Souscription</h2>
                <p class="mb-0">Complétez votre souscription en 5 étapes simples</p>
            </div>

            <!-- Progress -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="step-indicator active" data-step="1">1</div>
                    <div class="step-indicator" data-step="2">2</div>
                    <div class="step-indicator" data-step="3">3</div>
                    <div class="step-indicator" data-step="4">4</div>
                    <div class="step-indicator" data-step="5">5</div>
                </div>
                <div class="progress-line">
                    <div class="progress-line-active" id="progress-line"></div>
                </div>
                <div class="d-flex justify-content-between small text-muted">
                    <span class="step-label active">Souscripteur</span>
                    <span class="step-label">Assuré</span>
                    <span class="step-label">Bénéficiaire</span>
                    <span class="step-label">Paiement</span>
                    <span class="step-label">Résumé</span>
                </div>
            </div>

            <div class="card-body">
                <form id="contratFormFinal" class="mt-4 submitForm" >
                    @csrf

                    <!-- Step 1 -->
                    <div class="step active step-block" data-step="1">
                        <h4 class="text-success">Étape 1 : Informations du Souscripteur</h4>
                        <div>
                            @include('sites.pages.steps.stepAdherent')
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step step-block" data-step="2">
                        <h4 class="text-success">Étape 2 : Assuré</h4>
                        <div class="mb-3">
                            @if ($codePartner === "DIRECTENTREPRISE")
                                @include('sites.pages.steps.directEnt.assureDirect')
                            @else
                                @include('sites.pages.steps.stepAssurer')
                            @endif
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step step-block" data-step="3">
                        <h4 class="text-success">Étape 3 : Bénéficiaire</h4>
                        <div class="mb-3">
                            @include('sites.pages.steps.stepBenef')
                        </div>
                    </div>
                    <input type="hidden" id="inputStorageSession" class="inputStorageSession" name="inputStorageSession" >

                    <!-- Step 4 -->
                    <div class="step step-block" data-step="4">
                        <h4 class="text-success">Étape 4 : Paiement</h4>
                        <div class="mb-3">
                            @if ($codePartner === "DIRECTENTREPRISE")
                                
                                @include('sites.pages.steps.directEnt.stepPaiementDirect')
                            @else
                                @include('sites.pages.steps.stepPaiement')
                                
                            @endif
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="step step-block" data-step="5">
                        <h4 class="text-success">Étape 5 : Résumé</h4>
                        <div id="step5Alert" class="alert alert-warning d-none" role="alert">
                            Vérifiez attentivement les informations ci-dessous avant de soumettre la souscription.
                        </div>
                        <div class="border p-3 rounded bg-light">
                            @include('sites.pages.steps.stepResume')
                        </div>
                    </div>

                    
                    <input type="hidden" id="otpGenerate" name="otpGenerate" value="">

                    
                    <!-- Navigation -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" id="prevBtn" onclick="changeStep(-1)"
                            disabled>← Précédent</button>

                        <button type="button" class="btn btn-outline-info" id="nextBtn" onclick="changeStep(1)">Suivant
                            →</button>

                        <button type="button" class="btn btn-outline-warning  border-1 text-center rounded-1" 
                        data-bs-toggle="modal" data-bs-target="#otpModal" id="btn-signature">Signer</button>

                        <button type="button" class="btn btn-outline-success d-none" id="FinalFormSubmit">Valider</button>
                    </div>
                </form>
            </div>
        </div>

        @include('sites.components.otpModal')
        @include('sites.components.signModal')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = JSON.parse(sessionStorage.getItem('souscriptionData'));

            console.log('✅ ffffffffffffffffffffffffffffffffffffff :', data);
            console.log('✅ souscriptiooooooooooooooooooooo :', data.simulationData);
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/custom.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


        
        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	    <script src="{{ asset('assets/plugins/select2/js/select2-custom.js')}}"></script>

        

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <script>
        let currentStep = 1;
        const totalSteps = 5;

        function updateProgressBar() {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            document.getElementById('progress-line').style.width = progress + '%';

            document.querySelectorAll('.step-indicator').forEach((el, idx) => {
                const step = idx + 1;
                el.classList.remove('active', 'completed');
                if (step < currentStep) el.classList.add('completed');
                if (step === currentStep) el.classList.add('active');
            });

            document.querySelectorAll('.step-label').forEach((label, idx) => {
                label.classList.toggle('active', idx + 1 === currentStep);
            });
            document.querySelectorAll('.step-block').forEach((label, idx) => {
                label.classList.toggle('active', idx + 1 === currentStep);
            });
        }

        function showStep(step) {
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
            document.querySelector(`[data-step="${step}"]`).classList.add('active');

            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const FinalFormSubmit = document.getElementById('FinalFormSubmit');
            const btnSignature = document.getElementById('btn-signature');

            prevBtn.disabled = step === 1;
            nextBtn.classList.toggle('d-none', step === totalSteps);
            // FinalFormSubmit.classList.toggle('d-none', step !== totalSteps);
            btnSignature.classList.toggle('d-none', step !== totalSteps);

            updateProgressBar();
        }


        function changeStep(direction) {
            const souscriptionData = sessionStorage.getItem('souscriptionData');

            if (souscriptionData) {
                try {
                    const dataToSend = JSON.parse(souscriptionData);
                console.log('Données de l\'adherent ajoutées au tableau:', dataToSend);

                    axios.post("{{ route('site.storeSessionContratData') }}", dataToSend, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response) => {
                        if (response.data.type === 'success') {
                            console.log('Données session envoyées avec succès');
                        } else {
                            alert(response.data.message || 'Une erreur s\'est produite.');
                        }
                    })
                    .catch((error) => {
                        console.error("Erreur lors de l'envoi à la session PHP :", error);
                    });

                } catch (error) {
                    console.error("Erreur JSON parse :", error);
                }
            } else {
                console.warn("Aucune donnée trouvée dans sessionStorage pour 'souscriptionData'");
            }

            if (direction === 1) {
                const currentStepElement = document.querySelector(`.step[data-step="${currentStep}"]`);

                // Vérification des champs requis visibles
                const requiredFields = Array.from(currentStepElement.querySelectorAll("[required]"))
                    .filter(field => field.offsetParent !== null); 

                let allValid = true;

                requiredFields.forEach(field => {
                    if (field.type === "checkbox" || field.type === "radio") {
                        const groupChecked = currentStepElement.querySelectorAll(`[name="${field.name}"]:checked`).length > 0;
                        if (!groupChecked) {
                            allValid = false;
                            field.classList.add("is-invalid");
                        } else {
                            field.classList.remove("is-invalid");
                        }
                    } else if (!field.value.trim()) {
                        allValid = false;
                        field.classList.add("is-invalid");
                    } else {
                        field.classList.remove("is-invalid");
                    }
                });

                // ✅ Vérification spécifique pour les champs type="tel"
                const telFields = currentStepElement.querySelectorAll('input[type="tel"]');
                telFields.forEach(tel => {
                    const min = parseInt(tel.getAttribute('minlength') || 0, 10);
                    const max = parseInt(tel.getAttribute('maxlength') || Infinity, 10);
                    const length = tel.value.trim().length;

                    if (length > 0 && (length < min || length > max)) {
                        allValid = false;
                        tel.classList.add("is-invalid");
                    } else {
                        tel.classList.remove("is-invalid");
                    }
                });

                if (!allValid) {
                    swal.fire({
                        icon: 'warning',
                        title: 'Attention',
                        text: 'Veuillez remplir correctement tous les champs obligatoires avant de continuer.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
            }

            const newStep = currentStep + direction;
            if (newStep >= 1 && newStep <= totalSteps) {
                currentStep = newStep;
                showStep(currentStep);
            }
        }

        showStep(currentStep);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pour chaque champ type="tel"
            document.querySelectorAll('input[type="tel"]').forEach(function(input) {
                
                // Empêche la saisie de lettres ou symboles autres que chiffres et +
                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which);

                    // Autoriser uniquement chiffres et +
                    if (!/^[0-9+]$/.test(char)) {
                        e.preventDefault();
                    }
                });

                // Vérification à la sortie du champ
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+]/g, ''); // Supprime tout caractère invalide
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pour chaque champ type="tel"
            document.querySelectorAll('input[type="tel"]').forEach(function(input) {
                
                // Autoriser uniquement chiffres et +
                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which);
                    if (!/^[0-9+]$/.test(char)) {
                        e.preventDefault();
                    }
                });

                // Nettoyage automatique (supprime caractères invalides mais garde le champ valide)
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+]/g, '');
                });
            });
        });

        // --- GESTION MULTISTEP ---
        let currentStep = 1;
        let totalSteps = document.querySelectorAll(".step").length;

        function changeStep(direction) {
            if (direction === 1) {
                const currentStepElement = document.querySelector(`.step[data-step="${currentStep}"]`);
                const requiredFields = currentStepElement.querySelectorAll("[required]");
                let allValid = true;

                requiredFields.forEach(field => {
                    let isValid = true;

                    if (field.type === "checkbox" || field.type === "radio") {
                        const groupChecked = currentStepElement.querySelectorAll(`[name="${field.name}"]:checked`).length > 0;
                        if (!groupChecked) isValid = false;
                    } 
                    else if (!field.value.trim()) {
                        isValid = false;
                    } 
                    else if (field.type === "tel") {
                        // Vérif spécifique pour les téléphones (ex. min 8 chiffres)
                        const cleanValue = field.value.replace(/\D/g, "");
                        if (cleanValue.length < 8) {
                            isValid = false;
                        }
                    }

                    // Ajout / retrait de la classe invalid
                    if (!isValid) {
                        allValid = false;
                        field.classList.add("is-invalid");
                    } else {
                        field.classList.remove("is-invalid");
                    }
                });

                if (!allValid) {
                    alert("Veuillez remplir correctement tous les champs obligatoires avant de continuer.");
                    return;
                }
            }

            const newStep = currentStep + direction;
            if (newStep >= 1 && newStep <= totalSteps) {
                currentStep = newStep;
                showStep(currentStep);
            }
        }

        function showStep(step) {
            document.querySelectorAll(".step").forEach((el) => {
                el.classList.remove("active");
                if (parseInt(el.dataset.step) === step) {
                    el.classList.add("active");
                }
            });

            document.getElementById("prevBtn").disabled = (step === 1);
            document.getElementById("nextBtn").textContent = (step === totalSteps) ? "Valider" : "Suivant →";
        }
    </script>



    {{-- <script>
        let currentStep = 1;
        let totalSteps = document.querySelectorAll(".step").length;

        function changeStep(direction) {
            // Si on va en avant, vérifier les champs obligatoires
            if (direction === 1) {
                const currentStepElement = document.querySelector(`.step[data-step="${currentStep}"]`);
                const requiredFields = currentStepElement.querySelectorAll("[required]");

                let allValid = true;

                requiredFields.forEach(field => {
                    // Si le champ est vide ou non coché
                    if ((field.type === "checkbox" || field.type === "radio")) {
                        const groupChecked = currentStepElement.querySelectorAll(`[name="${field.name}"]:checked`).length > 0;
                        if (!groupChecked) {
                            allValid = false;
                            field.classList.add("is-invalid");
                        } else {
                            field.classList.remove("is-invalid");
                        }
                    } else if (!field.value.trim()) {
                        allValid = false;
                        field.classList.add("is-invalid");
                    } else {
                        field.classList.remove("is-invalid");
                    }
                });

                // Si au moins un champ est vide → bloquer
                if (!allValid) {
                    alert("Veuillez remplir tous les champs obligatoires avant de continuer.");
                    return;
                }
            }

            // Si tout est ok → changer d'étape
            const newStep = currentStep + direction;
            if (newStep >= 1 && newStep <= totalSteps) {
                currentStep = newStep;
                showStep(currentStep);
            }
        }

        function showStep(step) {
            document.querySelectorAll(".step").forEach((el) => {
                el.classList.remove("active");
                if (parseInt(el.dataset.step) === step) {
                    el.classList.add("active");
                }
            });

            // Gérer les boutons
            document.getElementById("prevBtn").disabled = (step === 1);
            document.getElementById("nextBtn").textContent = (step === totalSteps) ? "Valider" : "Suivant →";
        }
    </script> --}}

    <script>
        const FinalFormSubmit = document.getElementById('FinalFormSubmit');
        FinalFormSubmit.addEventListener('click', function (e) {
            e.preventDefault();
            const form = document.getElementById('contratFormFinal');

            // Assurez-vous que la valeur est mise AVANT de construire FormData
            const sessionData = sessionStorage.getItem('souscriptionData');
            document.getElementById('inputStorageSession').value = sessionData;

            console.log("Contenu de inputStorageSession:", sessionData);

            const formData = new FormData(form);

            axios.post("{{ route('site.store.contrat') }}", formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (response) {
                if (response.data.type === 'success') {

                    // Étape 1 : délai avant le SweetAlert
                    setTimeout(() => {
                        Swal.fire({
                            title: 'Souscription validée avec succès !',
                            icon: 'success',
                            position: 'top-end',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Étape 2 : ouvrir le bulletin après 2 sec (fin du SweetAlert)
                        setTimeout(() => {
                            window.open(response.data.url, '_blank');

                            // Étape 3 : redirection après ouverture du bulletin
                            window.location.href = response.data.urlback;
                        }, 2000);

                    }, 1000);

                } else {
                    alert('Erreur : ' + (response.data.message || 'Une erreur est survenue.'));
                }
            })
            .catch(function (error) {
                console.error(error);
                alert("Erreur lors de l'envoi du formulaire.");
            });

        });

    </script>

    <script>
        class DataFetcher {
            constructor(apiVilles, apiProfessions) {
                this.apiVilles = apiVilles;
                this.apiProfessions = apiProfessions;
            }

            init() {
                document.addEventListener('DOMContentLoaded', () => {
                    this.loadVilles();
                    this.loadProfessions();
                });
            }

            // Charger les villes et remplir les select correspondants
            loadVilles() {
                fetch(this.apiVilles)
                    .then(response => response.json())
                    .then(data => {
                        const villeSelect = document.querySelector('.lieuresidence');
                        const lieuSelect = document.querySelector('.lieunaissance');

                        data.forEach(ville => {
                            const optionVille = this.createOption(ville.MonLibelle);
                            const optionLieu = this.createOption(ville.MonLibelle);

                            villeSelect.appendChild(optionVille);
                            lieuSelect.appendChild(optionLieu);
                        });
                    })
                    .catch(error => console.error('Erreur chargement villes :', error));
            }

            // Charger les professions et remplir les select correspondants
            loadProfessions() {
                fetch(this.apiProfessions)
                    .then(response => response.json())
                    .then(data => {
                        const professionSelects = document.querySelectorAll('.profession');

                        professionSelects.forEach(select => {
                            data.forEach(profession => {
                                const option = this.createOption(profession.MonLibelle);
                                select.appendChild(option);
                            });
                        });
                    })
                    .catch(error => console.error('Erreur chargement professions :', error));
            }

            // Créer une balise <option>
            createOption(value) {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = value;
                return option;
            }
        }

        // Initialisation
        const dataFetcher = new DataFetcher(
            'https://api.yakoafricassur.com/enov/villes',
            'https://api.yakoafricassur.com/enov/professions'
        );
        dataFetcher.init();
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countries = @json($detailCountries);
            const phoneInput = document.getElementById('phoneInput');
            const countryPrefixSelect = document.getElementById('countryPrefix');
            const phoneInputGroup = document.getElementById('phoneInputGroup');

            // Création du message de statut
            const statusDiv = document.createElement('div');
            statusDiv.id = 'prefix-status';
            statusDiv.style.fontSize = '0.9em';
            statusDiv.style.marginTop = '4px';
            phoneInputGroup.insertAdjacentElement('afterend', statusDiv);

            function detectCountryFromPhone(value) {
                const cleanedValue = value.replace(/\s+/g, '').replace(/^00/, '+');
                if (!cleanedValue.startsWith('+') && countryPrefixSelect.value == '') {
                    statusDiv.innerHTML =
                        `ℹ Entrez un numéro commençant par l'indicatif précédé de <code>+</code> ou <code>00</code>`;
                    statusDiv.style.color = '#6c757d'; // gris
                    // countryPrefixSelect.value = '';
                    return;
                }

                const country = countries.find(c => cleanedValue.startsWith('+' + c.phone_international_prefix));

                if (country) {
                    const prefix = '+' + country.phone_international_prefix;
                    phoneInput.value = cleanedValue.replace(prefix, '');
                    countryPrefixSelect.value = country.phone_international_prefix;
                    statusDiv.innerHTML = `✅ <strong>${country.name}</strong> détecté (<code>${prefix}</code>)`;
                    statusDiv.style.color = '#198754'; // vert
                } else if (!country && countryPrefixSelect.value == '') {
                    statusDiv.innerHTML = `❌ Aucun pays trouvé pour cet indicatif`;
                    statusDiv.style.color = '#dc3545'; // rouge
                    countryPrefixSelect.value = '';
                }
            }

            phoneInput.addEventListener('input', function() {
                detectCountryFromPhone(phoneInput.value);
            });

            
        });
    </script>




    <script>
        const SIGN_API = "{{ config('services.sign_api') }}";
        const OTP_API = "{{ config('services.otp_api') }}";
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sendOTPForm = document.getElementById('sendOTPForm');
            // const otpModal = document.getElementById('otpModal');
            const OTPSendID = document.getElementById('OTPSendID');
            const OTPVerifyID = document.getElementById('OTPVerifyID');
            const verifyOTPForm = document.getElementById('verifyOTPForm');
            const sendOTPButton = document.getElementById('sendOTPButton');


            const otpInputs = document.querySelectorAll('.otp-input');

            // Envoi de l’OTP
            sendOTPButton.addEventListener('click', function(e) {
                e.preventDefault();

                const indicatif = document.getElementById('countryPrefix').value;
                const telephone = document.getElementById('phoneInput').value;
                const operation_type = document.getElementById('operation_type').value;
                const csrfToken = document.querySelector('input[name="_token"]').value;

                fetch(`${OTP_API}api/send-otp`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            telIndicatif: indicatif,
                            telephone: telephone,
                            operation_type: operation_type
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 200) {
                            // Masquer sendOTPForm, afficher verifyOTPForm
                            OTPSendID.classList.add('d-none');
                            OTPVerifyID.classList.remove('d-none');

                            // Stocker les valeurs pour la vérification
                            document.getElementById('hiddenTelephone').value = telephone;
                            document.getElementById('hiddenIndicatif').value = indicatif;

                            // Afficher un message
                            const lastTwo = telephone.slice(-4);
                            const firstTwo = telephone.slice(0, 2);
                            //utilise sweetalert
                            Swal.fire({
                                icon: 'success',
                                title: 'Un code de confirmation a été envoyé par SMS au numéro +' +
                                    indicatif + firstTwo + '**' + lastTwo,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            //alert('Un code de confirmation a été envoyé par SMS au numéro +' + indicatif + firstTwo + '**' + lastTwo);

                            startOtpTimer();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.message || 'Erreur lors de l’envoi de l’OTP.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            //alert(data.message || 'Erreur lors de l’envoi de l’OTP.');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur réseau ou serveur.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                        //alert('Erreur réseau ou serveur.');
                    });
            });


            // Autofocus entre les champs OTP
            otpInputs.forEach((input, index) => {
                input.addEventListener("input", function() {
                    if (this.value.length === this.maxLength) {
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    } else if (this.value.length === 0 && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });

                input.addEventListener("keydown", function(e) {
                    if (e.key === "Backspace" && input.value === "" && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });

            const verifyOtpButton = document.getElementById('verifyOtpButton');
            const changePhoneButton = document.getElementById('changePhoneButton');
            const otpContainer = document.getElementById('OTP');
            const btnSignature = document.getElementById('btn-signature');
            const btnTransmettre = document.getElementById('btn-transmettre');
            const resendOtpButton = document.querySelector(".resend-otp-btn");
            const otpTimer = document.createElement("div"); // Timer pour afficher le compte à rebours
            // initialisation pour le hide modal bootstrap
            const qrCodeModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
            const myModal = new bootstrap.Modal(document.getElementById('otpModal'));
            verifyOtpButton.addEventListener('click', function() {
                const telephone = document.getElementById('hiddenTelephone').value;
                const indicatif = document.getElementById('hiddenIndicatif').value;
                const phoneNumber = indicatif + telephone;
                const csrfToken = document.querySelector('input[name="_token"]').value;

                let otp = '';
                otpInputs.forEach(input => {
                    otp += input.value;
                });

                if (otp.length !== 6) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Veuillez saisir les 6 chiffres du code.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        position: 'center',
                        timerProgressBar: true,
                        timer: 5000
                    });
                    otpInputs.forEach(input => {
                        input.classList.remove("is-valid");
                        input.classList.add("is-invalid");
                    });
                    return;
                }

                // fetch('http://192.168.11.8:8001/api/verify-otp', {
                fetch(`${OTP_API}api/verify-otp`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            telephone: phoneNumber,
                            otp: otp
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Votre numéro de téléphone a été vérifié avec succès.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 2000
                            });
                            otpInputs.forEach(input => {
                                input.classList.remove("is-invalid");
                                input.classList.add("is-valid");
                            });
                            
                            // Masquer btnSignature, afficher btnTransmettre et ouvrir la modale qrCodeModal avec un delay de 5 secondes
                            setTimeout(() => {
                                btnSignature.classList.add('d-none');
                                // btnTransmettre.classList.remove('d-none');
                                myModal.hide();
                                qrCodeModal.show()
                            }, 3000);

                            ;
                        } else if (data.status == 400) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Le code de confirmation saisi est incorrect.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            otpInputs.forEach(input => {
                                input.classList.remove("is-valid");
                                input.classList.add("is-invalid");
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Le code de confirmation a expiré.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            otpInputs.forEach(input => {
                                input.classList.remove("is-valid");
                                input.classList.add("is-invalid");
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Une erreur s’est produite lors de la vérification.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                    });
            });

            // Fonction pour démarrer le compte à rebours pour l'expiration de l'OTP
            let otpExpirationTime = 3 * 60; // 3 minutes en secondes
            let otpInterval;

            function startOtpTimer() {
                otpTimer.classList.add("otp-expi-timer");
                otpContainer.appendChild(otpTimer); // Ajouter le timer à l'interface
                updateOtpTimer();

                otpInterval = setInterval(() => {
                    otpExpirationTime--;
                    updateOtpTimer();

                    if (otpExpirationTime <= 0) {
                        clearInterval(otpInterval);
                        otpTimer.textContent = "Le code de confirmation a expiré.";
                        resendOtpButton.classList.remove("d-none"); // Afficher le lien pour renvoyer l'OTP
                        changePhoneButton.disabled = false; // Afficher le lien pour renvoyer l'OTP
                    }
                }, 1000); // Met à jour chaque seconde
            }

            function updateOtpTimer() {
                const minutes = Math.floor(otpExpirationTime / 60);
                const seconds = otpExpirationTime % 60;
                otpTimer.textContent = `Temps restant: ${minutes}:${
                seconds < 10 ? "0" : ""
            }${seconds}`;
            }

            // Fonction pour renvoyer l'OTP
            resendOtpButton.addEventListener("click", async function() {
                otpExpirationTime = 3 * 60; // Réinitialiser le temps d'expiration
                clearInterval(otpInterval); // Arrêter l'ancien intervalle
                resendOtpButton.classList.add("d-none"); // Cacher le lien pendant l'envoi de l'OTP
                const telephone = document.getElementById('hiddenTelephone').value;
                const indicatif = document.getElementById('hiddenIndicatif').value;
                const phoneNumber = indicatif + telephone;
                const csrfToken = document.querySelector('input[name="_token"]').value;


                try {
                    // const response = await fetch("http://192.168.11.8:8001/api/send-otp", {
                    const response = await fetch(`${OTP_API}api/send-otp`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify({
                            telephone: phoneNumber,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    if (data.status === 200) {
                        // Afficher un message
                        const lastTwo = telephone.slice(-4);
                        const firstTwo = telephone.slice(0, 2);
                        Swal.fire({
                            icon: 'success',
                            title: 'Le code de confirmation a été réenvoyé par SMS au numéro +' + indicatif +
                                firstTwo + '**' + lastTwo,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                        startOtpTimer();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Une erreur s’est produite lors de l’envoi de l’OTP.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                    }
                } catch (err) {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Une erreur s’est produite lors de l’envoi de l’OTP.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        position: 'center',
                        timerProgressBar: true,
                        timer: 5000
                    });
                }
            });

            changePhoneButton.addEventListener('click', function() {
                // Masquer OTPVerifyID, afficher OTPSendID
                OTPSendID.classList.remove('d-none');
                OTPVerifyID.classList.add('d-none');
            })
        });
    </script>


    <script>
        let pollingInterval;

        const qrCodeModal = document.getElementById('qrCodeModal');

        qrCodeModal.addEventListener('shown.bs.modal', function () {

            const keyUuid = "{{ $keyUuid }}";
            const operationType = "{{ $operationType }}";
            const FinalFormSubmit = document.getElementById('FinalFormSubmit');

            // Polling toutes les 3 secondes pour vérifier l'état de la signature
            pollingInterval = setInterval(() => {
                fetch(`${SIGN_API}api/check-signature-status/${keyUuid}/${operationType}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 'completed') {
                            clearInterval(pollingInterval);

                            FinalFormSubmit.classList.remove('d-none');

                            // Masquer la modale si la signature est terminée
                            const modal = bootstrap.Modal.getInstance(qrCodeModal);
                            modal.hide();

                            // Afficher un message indiquant que la signature est terminée utilise sweetalert
                            Swal.fire({
                                icon: 'success',
                                title: 'Signature terminée avec succès !',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Erreur de polling :", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Une erreur s’est produite lors de la vérification.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                    });
            }, 3000); // toutes les 3 secondes
        });

        // Si la modale est fermée, on arrête le polling
        qrCodeModal.addEventListener('hidden.bs.modal', function () {
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.selection').select2({
                placeholder: "Choisir",
                allowClear: true,
                width: '100%',
            });
        });
    </script>

<script>
    async function loadCountries() {
        const baseUrl = "https://apiotp.yakoafricassur.com/api/getAllCountries";
        const response = await fetch(baseUrl);
        const json = await response.json();
        const countries = json.countries;

        // Récupération de la session
        const sessionData = sessionStorage.getItem('souscriptionData');
        const souscription = sessionData ? JSON.parse(sessionData) : {};

        let listToShow;

        if (souscription?.utilisateur?.codepartenaire === "DIASPORA") {
            // On filtre uniquement les pays de la liste fixe
            const diasporaList = ["France", "Italy", "Netherlands", "Belgium", "Côte d'Ivoire"];
            listToShow = countries.filter(c => diasporaList.includes(c.name));
        } else {
            // Tous les pays triés alphabétiquement
            listToShow = countries.sort((a, b) => a.name.localeCompare(b.name, 'fr', { sensitivity: 'base' }));
        }

        const $select = $(".apiCountry");

        // On injecte les pays
        listToShow.forEach(c => {
            let option = new Option(c.name, c.country_code, false, false);
            option.dataset.flag = c.flag;
            option.dataset.prefix = c.phone_international_prefix ? "+" + c.phone_international_prefix : "";
            $select.append(option);
        });

        // Initialisation Select2 avec drapeau + indicatif
        $select.select2({
            templateResult: formatCountry,
            templateSelection: formatCountry,
            placeholder: "Sélectionner un pays",
            allowClear: true
        });
    }

    // Template d’affichage : flag + nom + indicatif
    function formatCountry(option) {
        if (!option.id) return option.text;
        let flag = $(option.element).data("flag") || "";
        let prefix = $(option.element).data("prefix") || "";
        return $(
            `<span style="display:flex;align-items:center;gap:8px;">
                <span>${flag}</span>
                <span>${option.text} ${prefix ? "(" + prefix + ")" : ""}</span>
            </span>`
        );
    }

    document.addEventListener("DOMContentLoaded", loadCountries);
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countries = @json($detailCountries);

            // Fonction pour créer le select pays
            function createCountrySelect() {
                const select = document.createElement('select');
                select.className = "form-select form-select-sm country-select countryPrefix";
                // select.required = true;

                // Première option
                const defaultOpt = document.createElement('option');
                defaultOpt.value = "";
                defaultOpt.selected = true;
                defaultOpt.textContent = "🌍 Pays";
                select.appendChild(defaultOpt);

                // Ajouter les pays
                countries.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c.phone_international_prefix;
                    opt.textContent = `+${c.phone_international_prefix} ${c.flag}`;
                    if (c.phone_international_prefix === "225") opt.selected = true; // Côte d'Ivoire par défaut
                    select.appendChild(opt);
                });

                return select;
            }

            // Fonction de formatage
            function formatNumber(number) {
                const digits = number.replace(/\D/g, '');
                return digits.replace(/(\d{2})(?=\d)/g, '$1 ').trim();
            }

            // Fonction de détection
            function detectCountryFromPhone(input, value) {
                const select = input.parentElement.querySelector('.countryPrefix');
                const statusDiv = input.parentElement.querySelector('.prefix-status');
                const cleanedValue = value.replace(/\s+/g, '').replace(/^00/, '+');

                if (cleanedValue.startsWith('+')) {
                    const country = countries.find(c => cleanedValue.startsWith('+' + c.phone_international_prefix));
                    if (country) {
                        const prefix = '+' + country.phone_international_prefix;
                        const rawNumber = cleanedValue.replace(prefix, '');
                        input.dataset.raw = rawNumber;
                        input.value = formatNumber(rawNumber);
                        if (select) select.value = country.phone_international_prefix;
                        statusDiv.innerHTML = `✅ <strong>${country.name}</strong> détecté (<code>${prefix}</code>)`;
                        statusDiv.style.color = '#198754';
                        return;
                    } else {
                        statusDiv.innerHTML = `❌ Aucun pays trouvé pour cet indicatif`;
                        statusDiv.style.color = '#dc3545';
                        if (select) select.value = '';
                        return;
                    }
                }

                // Pas d’indicatif → utiliser le select actuel
                input.dataset.raw = cleanedValue.replace(/\D/g, '');
                input.value = formatNumber(input.dataset.raw);
                statusDiv.innerHTML = `ℹ Entrez un numéro commençant par l'indicatif si vous voulez une détection automatique`;
                statusDiv.style.color = '#6c757d';
            }

            // Appliquer à tous les <input type="tel">
            document.querySelectorAll('input[type="tel"]').forEach(phoneInput => {
                // Créer l’input-group si pas déjà présent
                if (!phoneInput.closest('.input-group')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = "input-group";
                    phoneInput.parentNode.insertBefore(wrapper, phoneInput);
                    wrapper.appendChild(createCountrySelect());
                    wrapper.appendChild(phoneInput);
                } else {
                    // Ajouter le select si absent
                    if (!phoneInput.parentElement.querySelector('.countryPrefix')) {
                        phoneInput.parentElement.insertBefore(createCountrySelect(), phoneInput);
                    }
                }

                // Ajouter le div status
                let statusDiv = document.createElement('div');
                statusDiv.className = 'prefix-status';
                statusDiv.style.fontSize = '0.9em';
                statusDiv.style.marginTop = '4px';
                phoneInput.closest('.col-12, .col').appendChild(statusDiv);

                // Event input
                phoneInput.addEventListener('input', function() {
                    detectCountryFromPhone(phoneInput, phoneInput.value);
                });

                // Nettoyer à la soumission
                if (phoneInput.form) {
                    phoneInput.form.addEventListener('submit', function() {
                        if (phoneInput.dataset.raw) {
                            phoneInput.value = phoneInput.dataset.raw;
                        }
                    });
                }
            });
        });
    </script>








</body>

</html>
