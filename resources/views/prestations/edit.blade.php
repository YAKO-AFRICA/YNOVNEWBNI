@extends('layouts.main')

@section('content')
    <style>
        input[readonly],
        textarea[readonly],
        select[readonly] {
            background-color: #f0f0f0;
            /* Couleur de fond gris pour les champs en readonly */
            border: 1px solid #ccc;
            /* Bordure gris clair */
            /* cursor: not-allowed;        Curseur indiquant que l'action est interdite */
            cursor: no-drop;
            /* pointer-events: none; */
            /* Empêche toute interaction avec ces éléments */
        }

        /* Remplacer le curseur par l'emoji 🚫 lors du survol des champs readonly */
        input[readonly]:hover,
        textarea[readonly]:hover,
        select[readonly]:hover {
            cursor: no-drop;
            /* cursor: wait; */
        }
    </style>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Prestations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editer la prestation</li>
                </ol>
            </nav>
        </div>
    </div>
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
                    </div>
                </center>

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
            <div class="card">
                <div class="card-body">
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
                                                @if ($prestation && $prestation->etape == 0 || $prestation->etape == 3)
                                                    <form
                                                        action="{{ route('prestation.transmettrePrest', $prestation->code) }}"
                                                        method="post" class="submitForm d-flex justify-content-end">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-primary p-1 px-3  text-center">
                                                            Transmettre</button>
                                                    </form>
                                                @endif
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('prestation.update', $prestation->code) }}" method="post"
                            class="submitForm">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>Prestation</h3>
                                            @if ($prestation)
                                                <div class="mt-4">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="" class="form-label">Type de
                                                                prestation</label>
                                                            <input type="text" name="typeprestation"
                                                                value="{{ $prestation->typeprestation ?? '' }}" readonly
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="" class="form-label">ID du contrat</label>
                                                            <input type="text" name="idcontrat"
                                                                value="{{ $prestation->idcontrat ?? '' }}" readonly
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="" class="form-label">Montant
                                                                souhaité</label>
                                                            <input type="text" name="montantSouhaite"
                                                                value="{{ $prestation->montantSouhaite ?? '' }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="" class="form-label"> Dode de
                                                                paiement</label>
                                                            <div class="mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" name="moyen"
                                                                        type="radio" disabled value="Virement_Bancaire"
                                                                        id="Virement_Bancaire"
                                                                        @if ($prestation->moyenPaiement === 'Virement_Bancaire') checked @endif>
                                                                    <label class="form-check-label"
                                                                        for="Virement_Bancaire">Virement Bancaire</label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" name="moyen"
                                                                        type="radio" disabled value="Mobile_Money"
                                                                        id="Mobile_Money"
                                                                        @if ($prestation->moyenPaiement === 'Mobile_Money') checked @endif>
                                                                    <label class="form-check-label"
                                                                        for="Mobile_Money">Mobile Money</label>
                                                                </div>
                                                                 {{-- Champ caché qui contient la valeur à soumettre --}}
                                                                <input type="hidden" name="moyenPaiement" value="{{ $prestation->moyenPaiement }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($prestation->moyenPaiement == 'Mobile_Money')
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label"> Moyen de
                                                                    paiement</label>
                                                                <div class="mb-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" name="Operateurs"
                                                                            type="radio" disabled value="Orange_money"
                                                                            id="Orange_money"
                                                                            @if ($prestation->Operateur === 'Orange_money') checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="Orange_money">Orange Money</label>
                                                                    </div>

                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" name="Operateurs"
                                                                            type="radio" disabled value="Moov_money"
                                                                            id="Moov_Money"
                                                                            @if ($prestation->Operateur === 'Moov_money') checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="Moov_Money">Moov Money</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" name="Operateurs"
                                                                            type="radio" disabled value="MTN_money"
                                                                            id="MTN_Money"
                                                                            @if ($prestation->Operateur === 'MTN_money') checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="MTN_Money">MTN Money</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">N° de
                                                                    paiement</label>
                                                                <input type="number" name="TelPaiement"
                                                                    value="{{ $prestation->telPaiement ?? '' }}" readonly
                                                                    class="form-control">

                                                                    {{-- Champ caché qui contient la valeur à soumettre --}}
                                                        <input type="hidden" name="Operateur" value="{{ $prestation->Operateur }}">
                                                                    
                                                            </div>
                                                        </div>
                                                    @elseif ($prestation->moyenPaiement == 'Virement_Bancaire')
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">RIB</label>
                                                                {{-- <input type="text" name="IBAN"
                                                                    value="{{ $prestation->IBAN ?? '' }}" readonly maxlength="24"
                                                                    minlength="24" class="form-control"> --}}
                                                                    @php
                                                                        $codeBanque = $prestation->codeBanque ?? ''; // Récupère la valeur depuis la base de données
                                                                        $codeGuichet = $prestation->codeGuichet ?? ''; // Récupère la valeur depuis la base de données
                                                                        $numCompte = $prestation->numCompte ?? ''; // Récupère la valeur depuis la base de données
                                                                        $cleRIB = $prestation->cleRIB ?? ''; // Récupère la valeur depuis la base de données
                                                                        // @dd($cleRIB);
                                                                    @endphp
                                                                    <div class="rib-container">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-12 mb-3 text-center">
                                                                                <label for="codebanque" class="form-label">Code Banque</label><br>
                                                                                <input type="text" class="rib-input" value="{{ $codeBanque[0] ?? '' }}" name="rib_1" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeBanque[1] ?? '' }}" name="rib_2" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeBanque[2] ?? '' }}" name="rib_3" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeBanque[3] ?? '' }}" name="rib_4" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeBanque[4] ?? '' }}" name="rib_5" required maxlength="1">
                                                                            </div>
                                                                            <div class="col-lg-6 col-12 mb-3 text-center">
                                                                                <label for="codeagence" class="form-label">Code Agence</label><br>
                                                                                <input type="text" class="rib-input" value="{{ $codeGuichet[0] }}" name="rib_6" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeGuichet[1] }}" name="rib_7" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeGuichet[2] }}" name="rib_8" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeGuichet[3] }}" name="rib_9" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $codeGuichet[4] }}" name="rib_10" required maxlength="1">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row"> 
                                                                            <div class="col-lg-7 col-12 mb-3 text-center">
                                                                                <label for="numcompte" class="form-label">N° de Compte</label><br>
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[0] ?? '' }}" name="rib_11" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[1] ?? '' }}" name="rib_12" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[2] ?? '' }}" name="rib_13" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[3] ?? '' }}" name="rib_14" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[4] ?? '' }}" name="rib_15" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[5] ?? '' }}" name="rib_16" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[6] ?? '' }}" name="rib_17" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[7] ?? '' }}" name="rib_18" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[8] ?? '' }}" name="rib_19" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[9] ?? '' }}" name="rib_20" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[10] ?? '' }}" name="rib_21" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $numCompte[11] ?? '' }}" name="rib_22" required maxlength="1">
                                                                            </div>
                                                                            <div class="col-lg-3 col-12 mb-3 w-lg-15 text-center">
                                                                                <label for="clerib" class="form-label">Clé RIB</label><br>
                                                                                <input type="text" class="rib-input" value="{{ $cleRIB[0] ?? '' }}" name="rib_23" required maxlength="1">
                                                                                <input type="text" class="rib-input" value="{{ $cleRIB[1] ?? '' }}" name="rib_24" required maxlength="1">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <textarea name="msgClient" class="form-control" id="" placeholder="Informations suplementaires" cols="30" rows="5">{{ $prestation->msgClient ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-secondary">Aucune prestation trouvée</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>Client</h3>
                                            <div class="mt-4">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Nom</label>
                                                        <input type="text" name="nom"
                                                            value="{{ $prestation->membreClient->nom ?? ($prestation->nom ?? '') }}"
                                                            readonly class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Prenom</label>
                                                        <input type="text" name="prenom"
                                                            value="{{ $prestation->membreClient->prenom ?? ($prestation->prenom ?? '') }}"
                                                            readonly class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Date de naissance</label>
                                                        <input type="datetime" name="datenaissance"
                                                            value="{{ $prestation->membreClient->datenaissance ?? ($prestation->datenaissance ?? '') }}"
                                                            readonly class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Genre</label>
                                                        <input type="text" name="sexe"
                                                            value="{{ $prestation->membreClient->sexe ?? ($prestation->sexe ?? '') }}"
                                                            readonly class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">N° de téléphone</label>
                                                        <input type="number" name="cel"
                                                            value="{{ $prestation->cel ?? '' }}"
                                                            class="form-control" @if ($prestation->moyenPaiement == 'Virement_Bancaire') readonly @endif>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Tel WhatsApp</label>
                                                        <input type="number" name="tel"
                                                            value="{{ $prestation->tel ?? '' }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">E-mail</label>
                                                        <input type="email" name="email"
                                                            value="{{ $prestation->email ?? '' }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Lieu de residence</label>
                                                        <input type="text" name="lieuresidence"
                                                            value="{{ $prestation->lieuresidence ?? '' }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @include('prestations.components.modals.addDocPrest')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les éléments nécessaires
            const typeFileSelect = document.getElementById('typeFile');
            const docNameInput = document.getElementById('DocName');
            const typedocName = document.getElementById('typeDocName');
            let typeDocFile = document.getElementById('typeDocFile');

            // Cacher l'élément au chargement
            typeDocFile.classList.add('d-none');

            // Fonction pour mettre à jour la valeur du champ caché et afficher l'input file
            function updateDocName() {
                const selectedValue = typeFileSelect.value;
                docNameInput.value = selectedValue; // Met à jour avec la valeur sélectionnée
                typedocName.textContent = selectedValue; // Met à jour l'affichage du type sélectionné

                if (selectedValue !== "") { // Vérifie si une option est bien sélectionnée
                    typeDocFile.classList.remove('d-none');
                } else {
                    typeDocFile.classList.add('d-none');
                }
            }

            // Ajouter un événement 'change' sur le select
            typeFileSelect.addEventListener('change', updateDocName);

            // Initialiser la valeur au chargement de la page
            updateDocName();
        });



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
@endsection
