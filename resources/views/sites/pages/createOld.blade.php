@extends('sites.layouts.main')

@section('content')



<!--breadcrumb-->

<div class="card">
    <div class="page-breadcrumb d-non d-sm-flex align-items-center mb-3 border-bottom-0 card-header">
        <div class="ps-3" style="width: 85%;">
            <marquee direction="left" behavior="scroll">
                <strong>"Après avoir renseigné toutes les informations, veillez Cliquer sur le bouton <span class="text-danger">Terminer avec votre signature</span> pour signer le contrat puis cliquer sur le bouton <span class="text-danger">Transmettre</span> pour transmettre le contrat"</strong>
            </marquee>
        </div>
        
        <div class="ms-auto gx-3">
        </div>

    </div>
</div>

@include('productions.components.otpModal')
@include('productions.create.steps.signModal')

<!--end breadcrumb-->

<div class="row">

    <div class="col-12 col-lg-3">

        <div class="card">

            <center>
                <div class="card-header">
                    <p>
                        <strong>N° de contrat :</strong> <span>{{ $contrat->id ?? ''}}</span>
                    </p>
                    <p>
                        <strong>N° bullettin :</strong> <span>{{ $contrat->numBullettin ?? '' }}</span>
                    </p>
                    <p>
                        <center>Status : 
                            @if ($contrat->etape == 0)
                                <span class="text-white badge rounded-pill  bg-secondary">Saisie non Achevée</span>
                            @elseif ($contrat->etape == 1)
                                <span class="text-info badge rounded-pill  bg-light-info">Saisie Non Transmis</span>
                            @elseif ($contrat->etape == 2)
                                <span class="text-primary badge rounded-pill  bg-light-primary">Saisie Transmis</span>
                            @elseif ($contrat->etape == 3)
                                <span class="text-success badge rounded-pill text-success bg-light-success">Accepté et Migré</span>
                            @elseif ($contrat->etape == 4)
                                <span class="text-danger badge rounded-pill bg-light-danger">Rejeté</span>
                            @endif
                        </center>
                    </p>
                </div>
            </center>

            <div class="card-body">

                <h5 class="my-3 text-center text-uppercase">Acteurs du contrat</h5>
                <p class="text-center text-secondary">Compléter les informations requis de chaque acteur avant de transmettre le contrat pour acceptation<br>( <span class="text-danger">* champs Obligatoires</span>)</p>

                <div class="fm-menu">

                    <div class="list-group list-group-flush">

                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="info-contrat">

                            <i class='bx bx-folder me-2'></i><span>Detail du contrat</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-adherent">

                            <i class='bx bx-devices me-2'></i><span>Adherent</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-assurer">

                            <i class='bx bx-analyse me-2'></i><span>Assurés</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-1 btn" data-target="edit-beneficiaire">

                            <i class='bx bx-plug me-2'></i><span>Beneficiaire</span>

                        </a>

                    </div>

                </div>

            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-0 font-weight-bold">Documents joint <span data-bs-toggle="modal"
                    data-bs-target="#add-doc"
                        class="float-end text-secondary"> <i class="bx bx-add-to-queue"></i> </span></h5>
                </p>
                <div class="mt-3"></div>

                @if (count($contrat->documents) > 0)
                    @foreach ($contrat->documents as $doc)
                    <div class="d-flex align-items-center mt-3">
                        <div class="fm-file-box bg-light-success text-success"><i
                                class='bx bxs-file-doc'></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0" style="font-size: 10px">{{ $doc->libelle ?? ''}}</h6>
                            <p class="mb-0 text-secondary">
                                {{ $doc->saisiele ?? ''}}
                            </p>
                        </div>
                        <h6 class="text-primary mb-0">
                            <a class="btn btn-sm btn-outline-secondary" data-bs-target="#view-bulletin{{$doc->id}}" data-bs-toggle="modal" title="Preview"> 
                                <i class="bx bx-show"></i>
                            </a>
                            {{-- <a class="btn btn-sm btn-outline-secondary" href=""> <i class="bx bx-trash"></i></a> --}}
                        </h6>

                        

                        <div class="modal fade" id="view-bulletin{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLabel">Aperçu {{$doc->libelle ?? ''}}</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="x"></button>

                                    </div>

                                    <div class="modal-body" style="width: 100%; height: 80vh">

                                        <iframe style="width: 100%; height: 100%" src="{{ url('storage/documents/' . $doc->filename) }}" frameborder="0"></iframe>

                                    </div>

                                    <div class="modal-footer">

                                        <form action="{{ route('siteProposition.destroy.document', $doc->id)}}" method="post" class="submitForm">
                                            @csrf

                                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">
                                               Supprimer
                                            </button>
                                        </form>

                                        
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    @endforeach

                @else
                <p class="text-center text-secondary">Aucun document joint</p>

                    

                @endif

                

                

            </div>

        </div>

    </div>

    <div class="col-12 col-lg-9">

        <div class="card">

            <div class="card-body">

                <section id="info-contrat" class="section-content">

                    <h5>Détails du Contrat</h5>
                    <hr>
                    
                    @include('sites.pages.edit.editContrat')
                    
                </section>

                <section id="edit-adherent" class="section-content d-none">

                    <h5>Adhérent</h5>
                    <hr>

                    @include('sites.pages.edit.editAdherent')

                </section>

                <section id="edit-assurer" class="section-content d-none">
                    <h5>Assurés</h5>
                    <hr>
                    @include('sites.pages.edit.editAssure')

                </section>

                <section id="edit-beneficiaire" class="section-content d-none">
                    <h5>Bénéficiaire</h5>
                    <hr>
                    @include('sites.pages.show.info')

                </section>

                

            </div>

        </div>

    </div>



    @include('sites.pages.add.addDoc')



    <script>

        document.addEventListener('DOMContentLoaded', () => {

            const links = document.querySelectorAll('.list-group-item');

            const sections = document.querySelectorAll('.section-content');

    

            links.forEach(link => {

                link.addEventListener('click', () => {

                    const targetId = link.getAttribute('data-target');

    

                    // Masquer toutes les sections

                    sections.forEach(section => section.classList.add('d-none'));

    

                    // Afficher la section correspondante

                    const targetSection = document.getElementById(targetId);

                    if (targetSection) {

                        targetSection.classList.remove('d-none');

                    }

                });

            });

        });

    </script>

    

</div>

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const baseUrl = 'https://api.thecompaniesapi.com/v2/locations/cities';
        let currentPage = 1;

        const selectElements = document.querySelectorAll('select.list-ville');

        async function loadEuropeanCities() {
            try {
                while (true) {
                    const response = await fetch(`${baseUrl}?page=${currentPage}`);
                    const data = await response.json();

                    // Filtrer les villes européennes
                    const europeanCities = data.cities.filter(city => city.continent?.code === 'eu');

                    // Ajouter les options dans chaque select
                    europeanCities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;

                        selectElements.forEach(select => select.appendChild(option.cloneNode(true)));
                    });

                    if (data.meta.currentPage >= data.meta.lastPage) {
                        break;
                    }

                    currentPage++;

                    // Délai pour éviter surcharge
                    await new Promise(resolve => setTimeout(resolve, 200));
                }

                console.log("✅ Chargement des villes européennes terminé !");
            } catch (error) {
                console.error("❌ Erreur de chargement :", error);
            }
        }

        loadEuropeanCities();
    });
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
                            timer: 5000
                        });
                        otpInputs.forEach(input => {
                            input.classList.remove("is-invalid");
                            input.classList.add("is-valid");
                        });
                        
                        // Masquer btnSignature, afficher btnTransmettre et ouvrir la modale qrCodeModal avec un delay de 5 secondes
                        setTimeout(() => {
                            btnSignature.classList.add('d-none');
                            btnTransmettre.classList.remove('d-none');
                            myModal.hide();
                            qrCodeModal.show()
                        }, 5000);

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

        // Polling toutes les 3 secondes pour vérifier l'état de la signature
        pollingInterval = setInterval(() => {
            fetch(`${SIGN_API}api/check-signature-status/${keyUuid}/${operationType}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status == 'completed') {
                        clearInterval(pollingInterval);

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

<!--end row-->

    

@endsection