@extends('layouts.main')

@section('content')

<!--breadcrumb-->

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">e-Souscription</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails de la proposition</li>
            </ol>
        </nav>
    </div>

</div>
<!--end breadcrumb-->
<div class="d-flex justify-content-end my-4">
    <div class="btn-group gap-1 gap-md-2 gap-lg-3">
        @can('Modifier une souscription')
            @if (!in_array($contrat->etape, [2, 3]))
                <a href="{{ route('prod.edit', $contrat->id) }}" class="btn btn-primary btn-sm text-decoration-none px-2 px-md-3">
                    <i class="bx bx-edit me-1" title="Modifier"></i>
                    <span class="d-none d-sm-inline">Modifier</span>
                </a>
            @endif
        @endcan

        @can('Transmettre une souscription')
            @if (!in_array($contrat->etape, [2, 3]))
                <form action="{{ route('prod.transmettreContrat', $contrat->id)}}" method="post" class="d-inline m-0 submitForm">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm px-2 px-md-3 ">
                        <i class="bx bx-send me-1"></i>
                        <span class="d-none d-sm-inline">Transmettre</span>
                    </button>
                </form>
            @endif
        @endcan
        
        <a href="{{ route('prod.generate.bulletin', $contrat->id) }}" target="_blank" class="btn btn-primary btn-sm text-decoration-none px-2 px-md-3">
            <i class="bx bx-download me-1" title="Bulletin"></i>
            <span class="d-none d-sm-inline">Bulletin</span>
        </a>

        <input type=button onclick='calltouchpay("{{ $contrat->id }}")' class="btn btn-primary btn-sm text-decoration-none px-2 px-md-3" value="Payer ma première prime" />
    </div>
</div>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
          
                <div class="step" data-target="#test-l-1">
                    <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                        <div class="bs-stepper-circle">1</div>
                        <div class="">
                            <h5 class="mb-0 steper-title @if ($contrat->etape == 1)
                                text-primary @endif">En Saisie</h5>
                            <p class="mb-0 steper-sub-title">{{ $contrat->saisiele ?? ''}}</p>
                        </div>
                    </div>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-2">
                    <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                    <div class="bs-stepper-circle">2</div>
                    <div class="">
                        <h5 class="mb-0 steper-title @if ($contrat->etape == 2)
                                text-primary @endif">Transmise</h5>
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
                            <h5 class="mb-0 steper-title text-primary">Acceptée/Migrée</h5>
                            <p class="mb-0 steper-sub-title">{{ $contrat->acceptele ?? ''}}</p>
                        </div>
                        @elseif ($contrat->etape == 4)
                        <div class="">
                            <h5 class="mb-0 steper-title text-primary">Rejetée</h5>
                            <p class="mb-0 steper-sub-title">{{ $contrat->annulerle ?? ''}}</p>
                        </div>
                        @else
                        <div class="">
                            <h5 class="mb-0 steper-title">Non Traitée</h5>
                            <p class="mb-0 steper-sub-title">00-00-0000</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body">
                
                <div class="fm-menu">
                    <div class="list-group list-group-flush">
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="info-contrat">
                            <i class='bx bx-folder me-2'></i><span>Détails du contrat</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-adherent">
                            <i class='bx bx-devices me-2'></i><span>Adhérent</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-assurer">
                            <i class='bx bx-analyse me-2'></i><span>Assurés</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-beneficiaire">
                            <i class='bx bx-plug me-2'></i><span>Bénéficiaires</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-Info-complementaire">
                            <i class='bx bx-analyse me-2'></i><span>Informations</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-body">

                <h5 class="mb-0 font-weight-bold">Documents joints </h5>

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
                        </h6>
                        
                        <div class="modal fade" id="view-bulletin{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLabel">Preview {{$doc->libelle ?? ''}}</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body" style="width: 100%; height: 80vh">

                                        {{-- <iframe style="width: 100%; height: 100%" src="{{ asset('documents/files/'.$doc->filename) }}" frameborder="0"></iframe> --}}
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
                    <p class="text-secondary">Aucun document joint</p>
                @endif
            </div>

        </div>

    </div>

    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <section id="info-contrat" class="section-content">
                    <h5>Détails du Contrat</h5>
                    <div class="card p-4">
                        <div class="row">
                            <!-- Colonne 1 -->
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <dl class="mb-4">
                                    <dt>ID du contrat</dt>
                                    <dd>{{ $contrat->id ?? '--' }}</dd>
                    
                                    <dt>Mode de paiement</dt>
                                    <dd>
                                        @switch($contrat->modepaiement)
                                            @case('VIR') Virement bancaire @break
                                            @case('ESP') Espèce @break
                                            @case('CHK') Chèque @break
                                            @case('Mobile_money') Mobile money @break
                                            @case('SOURCE') Prélèvement à la source @break
                                            @default --
                                        @endswitch
                                    </dd>
                    
                                    @if ($contrat->modepaiement === 'VIR' || $contrat->modepaiement === 'SOURCE')
                                        <dt>Banque / Organisme</dt>
                                        <dd>{{ $contrat->organisme ?? '--' }}</dd>
                    
                                        <dt>Agence</dt>
                                        <dd>{{ $contrat->agence ?? '--' }}</dd>
                    
                                        <dt>N° de compte (Matricule)</dt>
                                        <dd>{{ $contrat->numerocompte ?? '--' }}</dd>
                                    @endif
                    
                                    @if ($contrat->modepaiement === 'Mobile_money')
                                        <dt>N° Mobile</dt>
                                        <dd>{{ $contrat->numerocompte ?? '--' }}</dd>
                                    @endif

                                    <dt>Code Banque</dt>
                                    <dd>{{ $contrat->codebanque ?? '--' }}</dd>
                                </dl>
                            </div>
                    
                            <!-- Colonne 2 -->
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <dl class="mb-4">
                                    <dt>Périodicité</dt>
                                    <dd>
                                        @switch($contrat->periodicite)
                                            @case('M') Mensuelle @break
                                            @case('T') Trimestrielle @break
                                            @case('S') Semestrielle @break
                                        @case('A') Annuelle @break
                                            @case('U') Versement unique @break
                                            @default --
                                        @endswitch
                                    </dd>
                    
                                    <dt>Date d'effet</dt>
                                    <dd>{{ $contrat->dateeffet ?? '--' }}</dd>
                    
                                    <dt>Capital</dt>
                                    <dd>{{ number_format($contrat->capital ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    <dt>Rente</dt>
                                    <dd>{{ number_format($contrat->montantrente ?? 0, 0, ',', ' ') }} Fcfa</dd>

                                    <dt>Code Guichet</dt>
                                    <dd>{{ $contrat->codeguichet ?? '--' }}</dd>
                    
                                    <dt>Conseiller client</dt>
                                    <dd>{{ $contrat->nomagent ?? ""}}</dd>

                                    
                                </dl>
                            </div>
                    
                            <!-- Colonne 3 -->
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <dl class="mb-4">
                                    <dt>Surprime</dt>
                                    <dd>{{ number_format($contrat->surprime ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    <dt>Prime</dt>
                                    <dd>{{ number_format($contrat->prime ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    <dt>Prime principale</dt>
                                    <dd>{{ number_format($contrat->primepricipale ?? 0, 0, ',', ' ') }} FCFA</dd>

                                    <dt>Frais d'adhésion</dt>
                                    <dd>{{ number_format($contrat->fraisadhesion ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    
                    
                                    <dt>Clé RIB</dt>
                                    <dd>{{ $contrat->rib ?? '--' }}</dd>
                                    <dt>Code conseiller</dt>
                                    <dd>{{ $contrat->codeConseiller ?? "--" }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="edit-adherent" class="section-content d-none">
                    <fieldset class="border p-3">

                        <legend class="float-none w-auto px-2"><small>Adhérent</small></legend>
                        <div class="my-3">
                            <strong class=""><label class="form-label">Civilité :</label></strong>
                            <span class="">{{ $contrat->adherent->civilite ?? 'Non renseigné' }}</span>      
                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-6">

                                <strong><label class="form-label">Nom :</label></strong>

                                <span>{{ $contrat->adherent->nom ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-6">

                                <strong><label class="form-label">Prénoms :</label></strong>

                                <span>{{ $contrat->adherent->prenom ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-6">

                                <strong>
                                    <label class="form-label">Date de naissance :</label>
                                </strong>

                                <span>{{ $contrat->adherent->datenaissance ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-6">

                                <strong><label class="form-label">Lieu de naissance :</label></strong>

                                <span>{{ $contrat->adherent->lieunaissance ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Nature de la pièce :</label>
                                </strong>

                                <span>{{ $contrat->adherent->naturepiece ?? 'Non renseigné' }}</span>

                            </div>        

                            <div class="col-12 col-lg-4">

                            <strong>
                                    <label class="form-label">Numéro de la pièce :</label>
                            </strong>

                                <span>{{ $contrat->adherent->numeropiece ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Lieu de résidence :</label>
                                </strong>

                                <span>{{ $contrat->adherent->lieuresidence ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Profession :</label>
                                </strong>

                                <span>{{ $contrat->adherent->profession ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Secteur d'activités :</label>
                                </strong>

                                <span>{{ $contrat->adherent->employeur ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Email :</label>
                                </strong>

                                <span>{{ $contrat->adherent->email ?? 'Non renseigné' }}</span>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Mobile :</label>
                                </strong>

                                <span>{{ $contrat->adherent->mobile ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Mobile 2 :</label>
                                </strong>

                                <span>{{ $contrat->adherent->mobile1 ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Téléphone :</label>
                                </strong>

                                <span>{{ $contrat->adherent->telephone ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->
                    </fieldset>

                    <fieldset class="border p-3">

                        <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoin</small></legend>

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-8">

                                <strong>
                                    <label class="form-label">Nom et Prénoms :</label>
                                </strong>

                                <p>{{ $contrat->personneressource ?? 'Non renseigné' }}</p>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Contact :</label>
                                </strong>

                                <p>{{ $contrat->contactpersonneressource ?? 'Non renseigné' }}</p>

                            </div>

                        </div>

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-8">

                                <strong>
                                    <label class="form-label">Nom et Prénoms :</label>
                                </strong>

                                <p>{{ $contrat->personneressource2 ?? 'Non renseigné' }}</p>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Contact :</label>
                                </strong>

                                <p>{{ $contrat->contactpersonneressource2 ?? 'Non renseigné' }}</p>

                            </div>

                        </div>

                    </fieldset>

                    

                </section>

                <section id="edit-assurer" class="section-content d-none">
                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Assurés</small></legend>

                        <div class="table-responsive">
                            <table class="table mb-0 table-striped d-none d-md-table">
                                <!-- Tableau (masqué sur mobile) -->
                                <thead>
                                    <tr>
                                        <th scope="col">Assuré(e)</th>
                                        <th scope="col">Garanties</th>
                                        <th scope="col">Garanties complémentaires</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($contrat->assures->count() > 0)
                                        @foreach ($contrat->assures as $assure)
                                            <tr>
                                                <td>{{ $assure->nom ?? '-' }} {{ $assure->prenom ?? '-' }}</td>
                                                <td>
                                                    <ul class="mb-0">
                                                        @foreach ($assure->garanties as $item)
                                                            <li>{{ $item->monlibelle ?? 'Aucune garantie'}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="mb-0">
                                                        <li>Pas de garanties complémentaires</li>
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    <a href="" data-bs-target="#showAssureModal{{ $assure->id }}" data-bs-toggle="modal">
                                                        <i class="bx bx-show fs-4 btn btn-sm btn-outline-primary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('productions.assurer.show')
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Aucun assuré trouvé</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Version mobile (cartes) -->
                        <div class="d-md-none">
                            @if ($contrat->assures->count() > 0)
                                @foreach ($contrat->assures as $assure)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $assure->nom ?? '-' }} {{ $assure->prenom ?? '-' }}</h5>
                                            
                                            <div class="mb-2">
                                                <h6 class="fw-bold mb-1">Garanties :</h6>
                                                <ul class="mb-0 ps-3">
                                                    @foreach ($assure->garanties as $item)
                                                        <li>{{ $item->monlibelle ?? 'Aucune garantie'}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <h6 class="fw-bold mb-1">Garanties complémentaires :</h6>
                                                <ul class="mb-0 ps-3">
                                                    <li>Pas de garanties complémentaires</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="text-end">
                                                <a href="" class="btn btn-sm btn-primary" data-bs-target="#showAssureModal{{ $assure->id }}" data-bs-toggle="modal">
                                                    <i class="bx bx-show me-1"></i> Voir détails
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @include('productions.assurer.show')
                                @endforeach
                            @else
                                <div class="alert alert-info text-center">Aucun assuré trouvé</div>
                            @endif
                        </div>
                    </fieldset>
                </section>

                <section id="edit-beneficiaire" class="section-content d-none">
                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Bénéficiaire</small></legend>

                        @if ($contrat->codeproduit === "INV_2020")
                            <div class="row my-4">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label"><strong>Bénéficiaire au terme du contrat</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $contrat->beneficiaireauterme ?? 'Non renseigné' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label class="form-label"><strong>Bénéficiaire au Deces</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $contrat->beneficiaireaudeces ?? 'Non renseigné' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive d-none d-md-block">
                            <!-- Version Desktop (masquée sur mobile) -->
                            <table class="table mb-0 table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom & Prénoms</th>
                                        <th scope="col">Né(e) le</th>
                                        <th scope="col">Lieu de naissance</th>
                                        <th scope="col">Lieu de résidence</th>
                                        <th scope="col">Filiation</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Taux (%)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($contrat->beneficiaires->count() > 0)
                                        @foreach ($contrat->beneficiaires as $beneficiaire)
                                            <tr>
                                                <td>{{ $beneficiaire->nom ?? '--' }} {{ $beneficiaire->prenom ?? '--' }}</td>
                                                <td>{{ $beneficiaire->datenaissance ?? '--' }}</td>
                                                <td>{{ $beneficiaire->lieunaissance ?? '--' }}</td>
                                                <td>{{ $beneficiaire->lieuresidence ?? '--' }}</td>
                                                <td>{{ $beneficiaire->filiation ?? '--' }}</td>
                                                <td>{{ $beneficiaire->mobile ?? '--' }}</td>
                                                <td>{{ $beneficiaire->email ?? '--' }}</td>
                                                <td>{{ $beneficiaire->part ?? '--' }}</td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-sm btn-outline-primary" data-bs-target="#showBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('productions.beneficiaires.show')
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">Aucun bénéficiaire trouvé</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Version Mobile (cartes) -->
                        <div class="d-md-none">
                            @if ($contrat->beneficiaires->count() > 0)
                                @foreach ($contrat->beneficiaires as $beneficiaire)
                                    <div class="card mb-3 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $beneficiaire->nom ?? '--' }} {{ $beneficiaire->prenom ?? '--' }}</h5>
                                            
                                            <div class="row g-2 mb-2">
                                                <div class="col-6">
                                                    <small class="text-muted">Né(e) le</small>
                                                    <div>{{ $beneficiaire->datenaissance ?? '--' }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Taux</small>
                                                    <div>{{ $beneficiaire->part ?? '--' }}%</div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-2">
                                                <small class="text-muted">Lieu de naissance</small>
                                                <div>{{ $beneficiaire->lieunaissance ?? '--' }}</div>
                                            </div>
                                            
                                            <div class="mb-2">
                                                <small class="text-muted">Lieu de résidence</small>
                                                <div>{{ $beneficiaire->lieuresidence ?? '--' }}</div>
                                            </div>
                                            
                                            <div class="mb-2">
                                                <small class="text-muted">Filiation</small>
                                                <div>{{ $beneficiaire->filiation ?? '--' }}</div>
                                            </div>
                                            
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <small class="text-muted">Téléphone</small>
                                                    <div>{{ $beneficiaire->mobile ?? '--' }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Email</small>
                                                    <div class="text-truncate">{{ $beneficiaire->email ?? '--' }}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="text-end mt-3">
                                                <a href="" class="btn btn-sm btn-primary" data-bs-target="#showBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal">
                                                    <i class="bx bx-show me-1"></i> Détails
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @include('productions.beneficiaires.show')
                                @endforeach
                            @else
                                <div class="alert alert-info text-center">Aucun bénéficiaire trouvé</div>
                            @endif
                        </div>
                    </fieldset>

                </section>

                <section id="edit-Info-complementaire" class="section-content d-none">

                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Informations complémentaires</small></legend>

                        <div class="row mb-3">
                            <div class="div col">
                                <strong>Organisme</strong>
                                <span>{{ $contrat->organisme ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Date de saisie</strong>
                                <span>{{ $contrat->saisiele ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="div col">
                                <strong>Saisie par </strong>
                                <span>{{ $contrat->nomagent ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Code Agent</strong>
                                <span>{{ $contrat->codeConseiller ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Modifié le </strong>
                                <span>{{ $contrat->modifierle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Modifié par</strong>
                                <span>{{ $contrat->modifierpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="div col">
                                <strong>Transmise le </strong>
                                <span>{{ $contrat->transmisle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Transmise par</strong>
                                <span>{{ $contrat->transmispar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Accepté le </strong>
                                <span>{{ $contrat->accepterle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Accepté par</strong>
                                <span>{{ $contrat->accepterpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="div col">
                                <strong>Rejeté le </strong>
                                <span>{{ $contrat->annulerle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Rejeté par</strong>
                                <span>{{ $contrat->rejeterpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Est migrée </strong>
                                <span>{{ $contrat->estMigre ? 'Oui' : 'Non' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Transmise par</strong>
                                <span>{{ $contrat->codeConseiller ?? 'Non renseigné' }}</span>
                            </div>
                        </div>

                        <div class="col-12 form-group mt-3">
                            <label for="" class="form-label">Observations(Motif du rejet)</label>
                            <textarea name="" class="form-control" id="" rows="3" readonly>
                                {{ $contrat->motifrejet ?? '' }}
                            </textarea>
                        </div>
                    </fieldset>
                </section>

            </div>

        </div>

    </div>


    

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


<!--end row-->


<script>
    const contratInfo = {!! json_encode($contrat) !!};
    console.log(contratInfo.adherent);
</script>

<script>
    function getDateCode() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            return `${year}${month}${day}${hours}${minutes}${seconds}`;
        }
</script>

<script type="text/javascript">
    function calltouchpay(contratId) {
        
        const code = Math.floor(Math.random() * 9999) + 1;

        // Construire le code paiement
        const dateCode = getDateCode();
        const codePaiement = `PAI-${dateCode}-${code}`;

        // alert(codePaiement);


        const order_number = codePaiement;
        const agency_code = "CILLV4645";
        const secure_code = "hLVznZ60EQgSUq^Q-#6lzpn^YIpXW4w_LL%B!To#?f@gPnFsT%";

        const domain_name = 'yakoafricassur.com';

        const url_redirection_success = window.location.href + '/payment/success';
        const url_redirection_failed = window.location.href + '/payment/failed';
        const amount = contratInfo.prime;
        const city = "";
        const email = contratInfo.adherent.email || "";
        const clientFirstname = contratInfo.adherent.prenom || "";
        const clientLastname = contratInfo.adherent.nom || "";
        const clientPhone = contratInfo.adherent.mobile || "";

        fetch('{{ config('app.url') }}/cretePaiement', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                order_number: order_number,
                idContrat: contratId,
                agency_code: agency_code,
                domain_name: domain_name,
                amount: amount,
                city: city,
                email: email,
                clientFirstname: clientFirstname,
                clientLastname: clientLastname,
                clientPhone: clientPhone,
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(data => {
            console.log("Paiement sauvegardé côté serveur :", data);

            // 👉 Appeler TouchPay seulement après avoir sauvegardé
            sendPaymentInfos(
                order_number,
                agency_code,
                secure_code,
                domain_name,
                url_redirection_success,
                url_redirection_failed,
                amount,
                city,
                email,
                clientFirstname,
                clientLastname,
                clientPhone
            );
        })
        .catch(error => console.error("Erreur lors de la sauvegarde :", error));


        // sendPaymentInfos(
        //     order_number,
        //     agency_code,
        //     secure_code,
        //     domain_name,
        //     url_redirection_success,
        //     url_redirection_failed,
        //     amount,
        //     city,
        //     email,
        //     clientFirstname,
        //     clientLastname,
        //     clientPhone
        // );


        // fetch('http://ynovyakoafrica.test/cretePaiement', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     },
        //     body: JSON.stringify({
        //         order_number: order_number,
        //         idContrat: contratId,
        //         agency_code: agency_code,
        //         domain_name: domain_name,
        //         amount: amount,
        //         city: city,
        //         email: email,
        //         clientFirstname: clientFirstname,
        //         clientLastname: clientLastname,
        //         clientPhone: clientPhone,
        //     }),
        // })
        // .then(response => {
        //     if (!response.ok) {
        //         throw new Error('Erreur réseau');
        //     }
        //     return response.json();
        // })
    }
</script>

@endsection