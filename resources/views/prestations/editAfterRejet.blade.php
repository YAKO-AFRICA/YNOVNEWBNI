@extends('layouts.main')

@section('content')
    <style>
        @media (min-width: 992px) { /* lg breakpoint */
        .w-lg-20 {
            max-width: 20%;
        }
        .w-lg-15 {
            max-width: 25% !important;
        }
    }
    </style>
    <!--start stepper one-->
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Prestations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editer la prestation après rejet</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">

                <center>
                    <div class="card-header">
                        <p>
                            <strong>Code de la prestation :</strong> <br> <span>{{ $prestation->code ?? '' }}</span>
                        </p>

                        <p>
                            <center>Status :
                                @if ($prestation->etape == 0)
                                    <span class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>En attente de transmission
                                    </span>
                                @elseif ($prestation->etape == 1)
                                    <span class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>Demande transmise
                                    </span>
                                @elseif ($prestation->etape == 2)
                                    <span class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>Demande acceptée
                                    </span>
                                @elseif ($prestation->etape == 3)
                                    <span class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>Demande rejétée
                                    </span>
                                @elseif ($prestation->etape == 4)
                                    --
                                @endif
                            </center>
                        </p>
                        @if ($prestation->etape == 3)
                            <div class="d-flex align-items-center">
                                <div>Cliquez sur l'oeil pour voir le(s) motif(s) de rejet</div>
                                <div class="ms-2">
                                    <h5 class="mb-0 font-18 text-success p-1 border rounded bg-light" data-bs-toggle="modal"
                                        data-bs-target="#showMotifRejetModal{{ $prestation->code }}"
                                        style="cursor: pointer">
                                        <i class="bx bx-show"></i>
                                    </h5>
                                </div>
                            </div>
                        @endif
                    </div>
                </center>
                @if ($prestation->etape == 3)
                    @include('prestations.components.modals.showMotifModal' , ['code' => $prestation->code])
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-0 text-primary font-weight-bold">Documents joint <span data-bs-toggle="modal"
                            data-bs-target="#add-doc" class="float-end text-secondary"> <i class="bx bx-add-to-queue"></i>
                        </span></h5>
                    </p>
                    <div class="mt-3"></div>
                    @if (
                        $prestation &&
                            $prestation->docPrestation &&
                            $prestation->docPrestation->where('idPrestation', $prestation->id)->count() > 0)
                        @forelse ($prestation->docPrestation->where('idPrestation', $prestation->id) as $doc)
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box text-success"><i class='bx bxs-file-doc'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0" style="font-size: 10px">
                                        {{ $doc->type == 'Police'
                                            ? "Police du contrat d'assurance"
                                            : ($doc->type == 'bulletin'
                                                ? "Bulletin du contrat d'assurance"
                                                : ($doc->type == 'RIB'
                                                    ? 'RIB du compte courant'
                                                    : ($doc->type == 'CNI'
                                                        ? 'CNI'
                                                        : ($doc->type == 'FicheIDNum'
                                                            ? 'Fiche ID numéro'
                                                            : ($doc->type == 'AttestationPerteContrat'
                                                                ? 'Attestation de perte de contrat'
                                                                : ($doc->type == 'etatPrestation'
                                                                    ? 'Fiche de la prestation'
                                                                    : '')))))) }}
                                    </h6>
                                    <p class="mb-0 text-secondary" style="font-size: 0.6em">
                                        {{ $doc->created_at ?? '' }}
                                    </p>
                                </div>
                                <h6 class="text-primary mb-0 text-center">
                                    <a class="btn btn-primary px-2" data-bs-target="#view-bulletin{{ $doc->id }}"
                                        data-bs-toggle="modal" title="Preview">
                                        <i class="bx bx-show"></i>
                                    </a>
                                </h6>
                                <div class="modal fade" id="view-bulletin{{ $doc->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Preview
                                                    {{ $doc->type == 'Police'
                                                        ? "Police du contrat d'assurance"
                                                        : ($doc->type == 'bulletin'
                                                            ? "Bulletin du contrat d'assurance"
                                                            : ($doc->type == 'RIB'
                                                                ? 'RIB du compte courant'
                                                                : ($doc->type == 'CNI'
                                                                    ? 'CNI'
                                                                    : ($doc->type == 'FicheIDNum'
                                                                        ? 'Fiche ID numéro'
                                                                        : ($doc->type == 'AttestationPerteContrat'
                                                                            ? 'Attestation de perte de contrat'
                                                                            : ($doc->type == 'etatPrestation'
                                                                                ? 'Fiche de la prestation'
                                                                                : '')))))) }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="width: 100%; height: 80vh">
                                                @if ($doc->type == 'etatPrestation')
                                                    <iframe style="width: 100%; height: 100%" src="{{ asset($doc->path) }}"
                                                        frameborder="0"></iframe>
                                                @else
                                                    <iframe style="width: 100%; height: 100%" src="{{ asset($doc->path) }}"
                                                        frameborder="0"></iframe>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                @if ($doc->type == 'etatPrestation')
                                                    <a class="btn btn-primary text-white" href="{{ asset($doc->path) }}"
                                                        id="download-bulletin" title="Preview" download
                                                        >Telecharger
                                                        <i class="bx bx-download"></i>
                                                    </a>
                                                @else
                                                    {{-- <a class="btn btn-primary text-white" href="{{  }}"
                                                        id="download-bulleti" title="Supprimer"
                                                        >
                                                        <i class="bx bx-trash"></i>
                                                    </a> --}}
                                                    <a href="javascript:;"
                                                        class="deleteConfirmation border ms-3 btn btn-primary"
                                                        data-uuid="{{ $doc->id }}" data-type="confirmation_redirect"
                                                        data-placement="top" data-token="{{ csrf_token() }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Supprimer"
                                                        data-url="{{ route('prestation.destroyDoc', $doc->id) }}"
                                                        data-title="Vous êtes sur le point de supprimer le document {{ $doc->type }} "
                                                        data-id="{{ $prestation->code }}" data-param="0"
                                                        data-route="{{ route('prestation.destroyDoc', $doc->id) }}">Supprimer
                                                        <i class='bx bxs-trash' style="cursor: pointer"></i>
                                                    </a>
                                                @endif

                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-secondary">Aucun document joint</p>
                        @endforelse
                    @else
                        <p class="text-secondary">Aucun document joint</p>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div id="stepper1" class="bs-stepper">
                <div class="card">
                    <div class="card-header">
                        <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                            <div class="step" data-target="#test-l-1">
                                <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                    <div class="bs-stepper-circle">1</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title">Information personnelle</h5>
                                        <p class="mb-0 steper-sub-title">Entrez vos coordonnées</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-2">
                                <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                                    <div class="bs-stepper-circle">2</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title">Information sur prestation</h5>
                                        <p class="mb-0 steper-sub-title">Informations liées à la prestation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-3">
                                <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                    <div class="bs-stepper-circle">3</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title">Finalisation de la demande</h5>
                                        <p class="mb-0 steper-sub-title">Finaliser votre demande</p>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bs-stepper-content">
                            <section id="info-contrat" class="section-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <dl class="row col-md-4">
                                                        @if ($prestation && $prestation->membre != null && $prestation->membre->typ_membre !== 3)
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Saisie par :</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                                {{ $prestation->membre->prenom ?? '' }}
                                                                {{ $prestation->membre->nom ?? '' }} </dd>
                                                        @endif
                                                    </dl>
                                                    <dl class="row col-md-8">
                                                        @if ($prestation && $prestation->etape == 0)
                                                            <form
                                                                action="{{ route('prestation.transmettrePrest', $prestation->code) }}"
                                                                method="post" class="submitForm d-flex justify-content-end">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-primary p-1 px-3  text-center">
                                                                    Retransmettre</button>
                                                            </form>
                                                        @endif
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('prestation.update', $prestation->code) }}" id="EditPrestationForm" method="post"
                                    class="submitForm">
                                    @csrf

                                    <input type="hidden" id="OTP_API" name="OTP_API" value="{{ config('services.otp_api') }}">
                                    @include('prestations.components.stepsEdit.stepInfosPerso')
                        
                                    @include('prestations.components.stepsEdit.stepInfosPrest')

                                    @include('prestations.components.stepsEdit.resumer')
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('prestations.components.modals.addDocPrest')

    <script>
        function previewFilesPrest(event, previewAreaId) {
            const files = event.target.files;
            const previewArea = document.getElementById(previewAreaId);
            previewArea.innerHTML = ''; // Effacer les aperçus précédents

            for (const file of files) {
                const fileType = file.type;
                const reader = new FileReader();

                reader.onload = function(e) {
                    let previewElement;
                    if (fileType.startsWith('image/')) {
                        previewElement = document.createElement('img');
                        previewElement.src = e.target.result;
                        previewElement.style.width = '100px';
                        previewElement.style.margin = '5px';
                    } else if (fileType === 'application/pdf') {
                        previewElement = document.createElement('embed');
                        previewElement.src = e.target.result;
                        previewElement.type = 'application/pdf';
                        previewElement.style.width = '100px';
                        previewElement.style.height = '100px';
                        previewElement.style.margin = '5px';
                    } else {
                        previewElement = document.createElement('p');
                        previewElement.textContent = file.name;
                    }
                    previewArea.appendChild(previewElement);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
    
    <!--end stepper one-->
        
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les éléments nécessaires
            const typeFileSelect = document.getElementById('typeFile');
            const docNameInput = document.getElementById('DocName');

            // Fonction pour mettre à jour la valeur du champ caché
            function updateDocName() {
                docNameInput.value = typeFileSelect.value; // Met à jour avec la valeur sélectionnée
            }

            // Ajouter un événement 'change' sur le select
            typeFileSelect.addEventListener('change', updateDocName);

            // Initialiser la valeur au chargement de la page
            updateDocName();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const formulaire = document.querySelector('#EditPrestationForm');
            // alert(formulaire);

            if (!formulaire) {
                console.error("Le formulaire avec l'ID 'PrestationForm' est introuvable.");
                return;
            }

            formulaire.addEventListener('input', mettreAJourResume);
            formulaire.addEventListener('change', mettreAJourResume);

            function mettreAJourResume() {
                try {
                    // Récupération des valeurs des champs
                    const typePrestation = formulaire.querySelector('[name="typeprestation"]')?.value || '';
                    const idContrat = formulaire.querySelector('[name="idcontrat"]')?.value || '';
                    const montantSouhaite = formulaire.querySelector('[name="montantSouhaite"]')?.value || '';

                    // Récupération des boutons radio sélectionnés
                    const moyenPaiement = formulaire.querySelector('[name="moyenPaiement"]:checked')?.value || '';
                    const operateur = formulaire.querySelector('[name="Operateur"]:checked')?.value || '';
                    const sexe = formulaire.querySelector('[name="sexe"]')?.value || '';

                    const telPaiement = formulaire.querySelector('[name="TelPaiement"]')?.value || '';
                    const iban = formulaire.querySelector('[name="IBAN"]')?.value || '';

                    const nom = formulaire.querySelector('[name="nom"]')?.value || '';
                    const prenom = formulaire.querySelector('[name="prenom"]')?.value || '';
                    const dateNaissance = formulaire.querySelector('[name="datenaissance"]')?.value || '';
                    const cel = formulaire.querySelector('[name="cel"]')?.value || '';
                    const email = formulaire.querySelector('[name="email"]')?.value || '';
                    const lieuResidence = formulaire.querySelector('[name="lieuresidence"]')?.value || '';

                    // Mise à jour du résumé
                    document.getElementById('TelOtp').value = cel;
                    document.getElementById('Prestation').textContent = typePrestation;
                    document.getElementById('Contrat').textContent = idContrat;
                    document.getElementById('montant').textContent = montantSouhaite + ' FCFA';

                    const moyenPaiementText = moyenPaiement === 'Virement_Bancaire' ? 'Virement Bancaire' :
                        'Mobile Money';
                    document.getElementById('moyenPmt').textContent = moyenPaiementText;

                    // Mise à jour du résumé pour le moyen de paiement Mobile Money
                    const telPaiementSection = document.getElementById('TelephonePaiement');
                    const ibanPaiementSection = document.getElementById('IBANPaiement');

                    if (ibanPaiementSection.classList.contains('d-none') && moyenPaiement === 'Mobile_Money') {
                        const operateurText = operateur === 'Orange_money' ? 'Orange Money' :
                            operateur === 'MTN_money' ? 'MTN Money' :
                            operateur === 'Moov_money' ? 'Moov Money' : '';
                        document.getElementById('Opera').textContent = operateurText;
                        document.getElementById('TelPmt').textContent = telPaiement;
                        document.getElementById('NIBAN').textContent = '';
                    } else if (telPaiementSection.classList.contains('d-none') && moyenPaiement ===
                        'Virement_Bancaire') {
                        document.getElementById('NIBAN').textContent = iban;
                        document.getElementById('Opera').textContent = '';
                        document.getElementById('TelPmt').textContent = '';


                    }

                    document.getElementById('nomSous').textContent = nom;
                    document.getElementById('prenomSous').textContent = prenom;
                    document.getElementById('datenaissanceSous').textContent = dateNaissance;
                    document.getElementById('sexeSous').textContent = sexe;
                    document.getElementById('celSous').textContent = cel;
                    document.getElementById('emailSous').textContent = email;
                    document.getElementById('lieuresidenceSous').textContent = lieuResidence;
                } catch (error) {
                    console.error("Erreur lors de la mise à jour du résumé :", error);
                }
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            const otpInputs = document.querySelectorAll('.otp-input');
            const ribInputs = document.querySelectorAll('.rib-input');
            function handleInput(inputArray, event, index) {
                const input = event.target;
                const nextInput = inputArray[index + 1];
                const prevInput = inputArray[index - 1];

                // Empêcher les entrées multiples (ex: copier-coller)
                if (input.value.length > 1) {
                    input.value = input.value.charAt(0);
                }

                // Passage automatique au champ suivant
                if (input.value.length === 1 && nextInput) {
                    nextInput.focus();
                }
            }

            function handleKeyDown(inputArray, event, index) {
                const input = event.target;
                const prevInput = inputArray[index - 1];
                const nextInput = inputArray[index + 1];

                // Gestion du retour arrière (Backspace)
                if (event.key === 'Backspace' && input.value === '' && prevInput) {
                    prevInput.focus();
                }

                // Permettre la navigation avec les flèches gauche et droite
                if (event.key === 'ArrowLeft' && prevInput) {
                    prevInput.focus();
                } else if (event.key === 'ArrowRight' && nextInput) {
                    nextInput.focus();
                }
            }

            function handlePaste(event) {
                event.preventDefault(); // Empêcher le collage multiple
            }

            // Gestion des OTP inputs
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', (event) => handleInput(otpInputs, event, index));
                input.addEventListener('keydown', (event) => handleKeyDown(otpInputs, event, index));
                input.addEventListener('paste', handlePaste);
            });

            // Gestion des RIB inputs (avec validation)
            ribInputs.forEach((input, index) => {
                input.addEventListener('input', function (event) {
                    this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); // Autoriser uniquement lettres et chiffres
                    handleInput(ribInputs, event, index);
                });

                input.addEventListener('keydown', (event) => handleKeyDown(ribInputs, event, index));
                input.addEventListener('paste', handlePaste);
            });
        });
    </script>
    



@include('prestations.components.modals.detailContratModal')
@endsection
