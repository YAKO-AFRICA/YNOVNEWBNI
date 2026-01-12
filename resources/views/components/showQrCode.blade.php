<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('root/images/logo-icon.png')}}" type="image/png"/>
    
    <!-- CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.css')}}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
    <title>Détails de souscription</title>
    <style>
        .detail-card {
            border-left: 4px solid #5a8dee;
            transition: all 0.3s;
        }
        .detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .section-title {
            position: relative;
            padding-left: 15px;
        }
        .section-title:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 70%;
            width: 4px;
            background-color: #5a8dee;
            border-radius: 2px;
        }
        .nav-menu-item {
            transition: all 0.2s;
            border-radius: 5px;
        }
        .nav-menu-item:hover, .nav-menu-item.active {
            background-color: rgba(90, 141, 238, 0.1);
        }
        .info-label {
            font-weight: 500;
            color: #6c757d;
        }
        .info-value {
            font-weight: 400;
            color: #495057;
        }
        @media (max-width: 768px) {
            .stepper-mobile {
                flex-direction: column;
                align-items: flex-start;
            }
            .stepper-mobile .step {
                width: 100%;
                margin-bottom: 10px;
            }
            .stepper-mobile .bs-stepper-line {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('root/images/logo-icon.png')}}" width="90px" height="90px" alt="Preloader"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="page-wrapper container">
        <div class="page-content w-100" id="app">
            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">YAKOAFRICA</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails de votre souscription</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end my-4">
                <div class="btn-group gap-2">
                    @can('Modifier une souscription')
                        @if (!in_array($contrat->etape, [2, 3]))
                            <a href="{{ route('prod.edit', $contrat->id) }}" class="btn btn-primary btn-sm">
                                <i class="bx bx-edit me-1"></i>
                                <span class="d-none d-sm-inline">Modifier</span>
                            </a>
                        @endif
                    @endcan

                    @can('Transmettre une souscription')
                        @if (!in_array($contrat->etape, [2, 3]))
                            <form action="{{ route('prod.transmettreContrat', $contrat->id)}}" method="post" class="d-inline m-0 submitForm">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bx bx-send me-1"></i>
                                    <span class="d-none d-sm-inline">Transmettre</span>
                                </button>
                            </form>
                        @endif
                    @endcan
                    
                    <a href="{{ route('prod.generate.bulletin', $contrat->id) }}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="bx bx-download me-1"></i>
                        <span class="d-none d-sm-inline">Bulletin</span>
                    </a>
                </div>
            </div>

            <!-- Stepper -->
            <div id="stepper1" class="bs-stepper">
                <div class="card">
                    <div class="card-header">
                        <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between stepper-mobile" role="tablist">
                            <div class="step" data-target="#test-l-1">
                                <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                    <div class="bs-stepper-circle">1</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title @if ($contrat->etape == 1) text-primary @endif">
                                            <i class="bx bx-play-circle me-1"></i> Démarrée
                                        </h5>
                                        <p class="mb-0 steper-sub-title">{{ $contrat->saisiele ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-2">
                                <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                                    <div class="bs-stepper-circle">2</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title @if ($contrat->etape == 2) text-primary @endif">
                                            <i class="bx bx-send me-1"></i> Transmise
                                        </h5>
                                        <p class="mb-0 steper-sub-title">{{ $contrat->transmisle ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-3">
                                <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                    <div class="bs-stepper-circle">3</div>
                                    @if ($contrat->etape == 3)
                                    <div class="">
                                        <h5 class="mb-0 steper-title text-success">
                                            <i class="bx bx-check-circle me-1"></i> Acceptée
                                        </h5>
                                        <p class="mb-0 steper-sub-title">{{ $contrat->acceptele ?? ''}}</p>
                                    </div>
                                    @elseif ($contrat->etape == 4)
                                    <div class="">
                                        <h5 class="mb-0 steper-title text-danger">
                                            <i class="bx bx-x-circle me-1"></i> Rejetée
                                        </h5>
                                        <p class="mb-0 steper-sub-title">{{ $contrat->annulerle ?? ''}}</p>
                                    </div>
                                    @else
                                    <div class="">
                                        <h5 class="mb-0 steper-title text-warning">
                                            <i class="bx bx-time-five me-1"></i> En attente
                                        </h5>
                                        <p class="mb-0 steper-sub-title">--/--/----</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-12 col-lg-3">
                    <!-- Navigation Menu -->
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="fm-menu">
                                <div class="list-group list-group-flush">
                                    <a href="javascript:;" class="list-group-item py-2 nav-menu-item active" data-target="info-contrat">
                                        <i class='bx bx-file me-2'></i> Détails du contrat
                                    </a>
                                    <a href="javascript:;" class="list-group-item py-2 nav-menu-item" data-target="edit-adherent">
                                        <i class='bx bx-user me-2'></i> Adhérent
                                    </a>
                                    <a href="javascript:;" class="list-group-item py-2 nav-menu-item" data-target="edit-assurer">
                                        <i class='bx bx-group me-2'></i> Assurés
                                    </a>
                                    <a href="javascript:;" class="list-group-item py-2 nav-menu-item" data-target="edit-beneficiaire">
                                        <i class='bx bx-gift me-2'></i> Bénéficiaires
                                    </a>
                                    <a href="javascript:;" class="list-group-item py-2 nav-menu-item" data-target="edit-Info-complementaire">
                                        <i class='bx bx-info-circle me-2'></i> Informations
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="card">
                        <div class="card-body p-3">
                            <h5 class="mb-3 font-weight-bold d-flex align-items-center">
                                <i class='bx bx-paperclip me-2'></i> Documents joints
                            </h5>

                            @if (count($contrat->documents) > 0)
                                @foreach ($contrat->documents as $doc)
                                <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                                    <div class="fm-file-box bg-light-primary text-primary">
                                        <i class='bx bxs-file-pdf'></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ $doc->libelle ?? ''}}</h6>
                                        <small class="text-muted">{{ $doc->saisiele ?? ''}}</small>
                                    </div>
                                    <a class="btn btn-sm btn-outline-primary" data-bs-target="#view-bulletin{{$doc->id}}" data-bs-toggle="modal"> 
                                        <i class="bx bx-show"></i>
                                    </a>
                                    
                                    <!-- Document Preview Modal -->
                                    <div class="modal fade" id="view-bulletin{{$doc->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{$doc->libelle ?? ''}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="height: 70vh">
                                                    <iframe style="width: 100%; height: 100%" src="{{ url('storage/documents/' . $doc->filename) }}" frameborder="0"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="alert alert-info py-2">
                                    <i class='bx bx-info-circle me-2'></i> Aucun document joint
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="col-12 col-lg-9">
                    <!-- Contract Details Section -->
                    <section id="info-contrat" class="section-content mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="section-title mb-4">
                                    <i class='bx bx-detail me-2'></i> Détails du contrat
                                </h5>
                                
                                <div class="row g-4">
                                    <!-- Column 1 -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="detail-card p-3 h-100">
                                            <div class="mb-3">
                                                <span class="info-label d-block">ID du contrat</span>
                                                <span class="info-value">{{ $contrat->id ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Mode de paiement</span>
                                                <span class="info-value">
                                                    @switch($contrat->modepaiement)
                                                        @case('VIR') <i class='bx bx-transfer me-1'></i> Virement @break
                                                        @case('ESP') <i class='bx bx-money me-1'></i> Espèce @break
                                                        @case('CHK') <i class='bx bx-credit-card me-1'></i> Chèque @break
                                                        @case('Mobile_money') <i class='bx bx-mobile-alt me-1'></i> Mobile money @break
                                                        @case('SOURCE') <i class='bx bx-credit-card-front me-1'></i> Prélèvement @break
                                                        @default --
                                                    @endswitch
                                                </span>
                                            </div>
                                            
                                            @if ($contrat->modepaiement === 'VIR' || $contrat->modepaiement === 'SOURCE')
                                                <div class="mb-3">
                                                    <span class="info-label d-block">Banque/Organisme</span>
                                                    <span class="info-value">{{ $contrat->organisme ?? '--' }}</span>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <span class="info-label d-block">Agence</span>
                                                    <span class="info-value">{{ $contrat->agence ?? '--' }}</span>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <span class="info-label d-block">N° de compte</span>
                                                    <span class="info-value">{{ $contrat->numerocompte ?? '--' }}</span>
                                                </div>
                                            @endif
                                            
                                            @if ($contrat->modepaiement === 'Mobile_money')
                                                <div class="mb-3">
                                                    <span class="info-label d-block">N° Mobile</span>
                                                    <span class="info-value">{{ $contrat->numerocompte ?? '--' }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Column 2 -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="detail-card p-3 h-100">
                                            <div class="mb-3">
                                                <span class="info-label d-block">Périodicité</span>
                                                <span class="info-value">
                                                    @switch($contrat->periodicite)
                                                        @case('M') <i class='bx bx-calendar me-1'></i> Mensuelle @break
                                                        @case('T') <i class='bx bx-calendar me-1'></i> Trimestrielle @break
                                                        @case('S') <i class='bx bx-calendar me-1'></i> Semestrielle @break
                                                        @case('A') <i class='bx bx-calendar me-1'></i> Annuelle @break
                                                        @case('U') <i class='bx bx-calendar me-1'></i> Unique @break
                                                        @default --
                                                    @endswitch
                                                </span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Date d'effet</span>
                                                <span class="info-value">{{ $contrat->dateeffet ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Capital</span>
                                                <span class="info-value">{{ number_format($contrat->capital ?? 0, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Rente</span>
                                                <span class="info-value">{{ number_format($contrat->montantrente ?? 0, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Conseiller</span>
                                                <span class="info-value">{{ $contrat->nomagent ?? "--" }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Column 3 -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="detail-card p-3 h-100">
                                            <div class="mb-3">
                                                <span class="info-label d-block">Surprime</span>
                                                <span class="info-value">{{ number_format($contrat->surprime ?? 0, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Prime</span>
                                                <span class="info-value">{{ number_format($contrat->prime ?? 0, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Prime Principale</span>
                                                <span class="info-value">{{ number_format($contrat->primepricipale ?? 0, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Frais d'adhésion</span>
                                                <span class="info-value">{{ number_format($contrat->fraisadhesion ?? 0, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Code Conseiller</span>
                                                <span class="info-value">{{ $contrat->codeConseiller ?? "--" }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Adherent Section -->
                    <section id="edit-adherent" class="section-content d-none mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="section-title mb-4">
                                    <i class='bx bx-user me-2'></i> Informations de l'adhérent
                                </h5>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="detail-card p-3 h-100">
                                            <div class="mb-3">
                                                <span class="info-label d-block">Civilité</span>
                                                <span class="info-value">{{ $contrat->adherent->civilite ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Nom</span>
                                                <span class="info-value">{{ $contrat->adherent->nom ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Prénoms</span>
                                                <span class="info-value">{{ $contrat->adherent->prenom ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Date de naissance</span>
                                                <span class="info-value">{{ $contrat->adherent->datenaissance ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Lieu de naissance</span>
                                                <span class="info-value">{{ $contrat->adherent->lieunaissance ?? 'Non renseigné' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="detail-card p-3 h-100">
                                            <div class="mb-3">
                                                <span class="info-label d-block">Nature de la pièce</span>
                                                <span class="info-value">{{ $contrat->adherent->naturepiece ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Numéro de la pièce</span>
                                                <span class="info-value">{{ $contrat->adherent->numeropiece ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Lieu de résidence</span>
                                                <span class="info-value">{{ $contrat->adherent->lieuresidence ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Profession</span>
                                                <span class="info-value">{{ $contrat->adherent->profession ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Employeur</span>
                                                <span class="info-value">{{ $contrat->adherent->employeur ?? 'Non renseigné' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="detail-card p-3 h-100">
                                            <div class="mb-3">
                                                <span class="info-label d-block">Email</span>
                                                <span class="info-value">{{ $contrat->adherent->email ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Mobile</span>
                                                <span class="info-value">{{ $contrat->adherent->mobile ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Mobile 2</span>
                                                <span class="info-value">{{ $contrat->adherent->mobile1 ?? 'Non renseigné' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Téléphone</span>
                                                <span class="info-value">{{ $contrat->adherent->telephone ?? 'Non renseigné' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="detail-card p-3 h-100">
                                            <h6 class="mb-3 d-flex align-items-center">
                                                <i class='bx bx-group me-2'></i> Personnes à contacter
                                            </h6>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Contact 1</span>
                                                <span class="info-value">{{ $contrat->personneressource ?? 'Non renseigné' }}</span>
                                                <small class="text-muted">{{ $contrat->contactpersonneressource ?? '' }}</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Contact 2</span>
                                                <span class="info-value">{{ $contrat->personneressource2 ?? 'Non renseigné' }}</span>
                                                <small class="text-muted">{{ $contrat->contactpersonneressource2 ?? '' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Assurés Section -->
                    <section id="edit-assurer" class="section-content d-none mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="section-title mb-4">
                                    <i class='bx bx-group me-2'></i> Liste des assurés
                                </h5>
                                
                                @if ($contrat->assures->count() > 0)
                                    <div class="table-responsive d-none d-md-block">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Assuré(e)</th>
                                                    <th>Garanties</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($contrat->assures as $assure)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar me-2">
                                                                    <span class="avatar-initial rounded-circle bg-primary">{{ substr($assure->prenom, 0, 1) }}</span>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0">{{ $assure->nom }} {{ $assure->prenom }}</h6>
                                                                    <small class="text-muted">{{ $assure->datenaissance }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($assure->garanties->count() > 0)
                                                                <div class="d-flex flex-wrap gap-1">
                                                                    @foreach ($assure->garanties as $garantie)
                                                                        <span class="badge bg-light-primary text-primary">{{ $garantie->monlibelle }}</span>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span class="text-muted">Aucune garantie</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" class="btn btn-sm btn-outline-primary" data-bs-target="#showAssureModal{{ $assure->id }}" data-bs-toggle="modal">
                                                                <i class="bx bx-show"></i> Détails
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @include('productions.assurer.show')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <!-- Mobile Version -->
                                    <div class="d-md-none">
                                        @foreach ($contrat->assures as $assure)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <h6 class="mb-0">{{ $assure->nom }} {{ $assure->prenom }}</h6>
                                                        <small class="text-muted">{{ $assure->datenaissance }}</small>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <small class="text-muted d-block">Garanties :</small>
                                                        @if($assure->garanties->count() > 0)
                                                            <div class="d-flex flex-wrap gap-1 mt-1">
                                                                @foreach ($assure->garanties as $garantie)
                                                                    <span class="badge bg-light-primary text-primary">{{ $garantie->monlibelle }}</span>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span class="text-muted">Aucune garantie</span>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="text-end">
                                                        <a href="" class="btn btn-sm btn-primary" data-bs-target="#showAssureModal{{ $assure->id }}" data-bs-toggle="modal">
                                                            <i class="bx bx-show me-1"></i> Voir
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @include('productions.assurer.show')
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class='bx bx-info-circle me-2'></i> Aucun assuré trouvé
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>

                    <!-- Beneficiaires Section -->
                    <section id="edit-beneficiaire" class="section-content d-none mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="section-title mb-4">
                                    <i class='bx bx-gift me-2'></i> Bénéficiaires
                                </h5>
                                
                                @if ($contrat->codeproduit === "INV_2020")
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="detail-card p-3 h-100">
                                                <span class="info-label d-block">Bénéficiaire au terme</span>
                                                <span class="info-value">{{ $contrat->beneficiaireauterme ?? 'Non renseigné' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-card p-3 h-100">
                                                <span class="info-label d-block">Bénéficiaire au décès</span>
                                                <span class="info-value">{{ $contrat->beneficiaireaudeces ?? 'Non renseigné' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                @if ($contrat->beneficiaires->count() > 0)
                                    <div class="table-responsive d-none d-md-block">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nom & Prénoms</th>
                                                    <th>Date naissance</th>
                                                    <th>Téléphone</th>
                                                    <th>Taux</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($contrat->beneficiaires as $beneficiaire)
                                                    <tr>
                                                        <td>{{ $beneficiaire->nom }} {{ $beneficiaire->prenom }}</td>
                                                        <td>{{ $beneficiaire->datenaissance }}</td>
                                                        <td>{{ $beneficiaire->mobile }}</td>
                                                        <td>{{ $beneficiaire->part }}%</td>
                                                        <td class="text-center">
                                                            <a href="" class="btn btn-sm btn-outline-primary" data-bs-target="#showBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal">
                                                                <i class="bx bx-show"></i> Détails
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @include('productions.beneficiaires.show')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <!-- Mobile Version -->
                                    <div class="d-md-none">
                                        @foreach ($contrat->beneficiaires as $beneficiaire)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h6 class="mb-1">{{ $beneficiaire->nom }} {{ $beneficiaire->prenom }}</h6>
                                                    <small class="text-muted d-block">Né(e) le {{ $beneficiaire->datenaissance }}</small>
                                                    
                                                    <div class="row mt-2">
                                                        <div class="col-6">
                                                            <small class="text-muted d-block">Téléphone</small>
                                                            <span>{{ $beneficiaire->mobile }}</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted d-block">Taux</small>
                                                            <span>{{ $beneficiaire->part }}%</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="text-end mt-2">
                                                        <a href="" class="btn btn-sm btn-primary" data-bs-target="#showBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal">
                                                            <i class="bx bx-show me-1"></i> Voir
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @include('productions.beneficiaires.show')
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class='bx bx-info-circle me-2'></i> Aucun bénéficiaire trouvé
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>

                    <!-- Additional Info Section -->
                    <section id="edit-Info-complementaire" class="section-content d-none mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="section-title mb-4">
                                    <i class='bx bx-info-circle me-2'></i> Informations complémentaires
                                </h5>
                                
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="detail-card p-3 h-100">
                                            <h6 class="mb-3 d-flex align-items-center">
                                                <i class='bx bx-calendar me-2'></i> Dates clés
                                            </h6>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Saisie le</span>
                                                <span class="info-value">{{ $contrat->saisiele ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Modifiée le</span>
                                                <span class="info-value">{{ $contrat->modifierle ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Transmise le</span>
                                                <span class="info-value">{{ $contrat->transmisle ?? '--' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-4">
                                        <div class="detail-card p-3 h-100">
                                            <h6 class="mb-3 d-flex align-items-center">
                                                <i class='bx bx-user me-2'></i> Par
                                            </h6>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Saisie par</span>
                                                <span class="info-value">{{ $contrat->nomagent ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Modifiée par</span>
                                                <span class="info-value">{{ $contrat->modifierpar ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Transmise par</span>
                                                <span class="info-value">{{ $contrat->transmispar ?? '--' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-4">
                                        <div class="detail-card p-3 h-100">
                                            <h6 class="mb-3 d-flex align-items-center">
                                                <i class='bx bx-check-circle me-2'></i> Statut
                                            </h6>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Acceptée le</span>
                                                <span class="info-value">{{ $contrat->accepterle ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Acceptée par</span>
                                                <span class="info-value">{{ $contrat->accepterpar ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Rejetée le</span>
                                                <span class="info-value">{{ $contrat->annulerle ?? '--' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="detail-card p-3">
                                            <div class="mb-3">
                                                <span class="info-label d-block">Est migré</span>
                                                <span class="info-value">{{ $contrat->estMigre ? 'Oui' : 'Non' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="info-label d-block">Code Conseiller</span>
                                                <span class="info-value">{{ $contrat->codeConseiller ?? '--' }}</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label info-label">Observations</label>
                                                <div class="p-3 bg-light rounded">
                                                    {{ $contrat->motifrejet ?? 'Aucune observation' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2-custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr')}}"></script>
    <script src="{{ asset('assets/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bs-stepper/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation between sections
            const links = document.querySelectorAll('.nav-menu-item');
            const sections = document.querySelectorAll('.section-content');

            links.forEach(link => {
                link.addEventListener('click', () => {
                    const targetId = link.getAttribute('data-target');

                    // Remove active class from all links
                    links.forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    link.classList.add('active');

                    // Hide all sections
                    sections.forEach(section => section.classList.add('d-none'));

                    // Show target section
                    document.getElementById(targetId).classList.remove('d-none');
                });
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>