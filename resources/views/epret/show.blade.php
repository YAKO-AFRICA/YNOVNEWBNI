@extends('layouts.main')

@section('content')

<!--breadcrumb-->

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">ePret</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Details du pret</li>
            </ol>
        </nav>
    </div>
    

    <div class="ms-auto gx-3">
        <div class="btn-group">
            @if (($pret->etat == 1))
            <form action="{{ route('epret.transmettrePret', $pret->id)}}" method="post" class="submitForm">
                @csrf
                <button type="submit" class="btn btn-primary p-1 border-1 text-center"> Transmettre</button>
            </form>
            @endif

            <button class="btn btn-primary mx-4 border-1 text-center" style="font-size: 12px">
                <a class="text-decoration-none" href="{{ route('epret.generateBu', $pret->id) }}" target="_blank">
                    <i class="bx bx-download" title="Telecharger le bulletin"></i>Telecharger le bulletin
                </a>
            </button>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-header">
            <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                
                <div class="step" data-target="#test-l-1">
                    <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                        <div class="bs-stepper-circle">1</div>
                        <div class="">
                            <h5 class="mb-0 steper-title @if ($pret->etat == 1)
                                text-primary @endif">En Saisie</h5>
                            {{-- <p class="mb-0 steper-sub-title">{{ $pret->saisiele ?? ''}}</p> --}}
                        </div>
                    </div>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-2">
                    <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                    <div class="bs-stepper-circle">2</div>
                    <div class="">
                        <h5 class="mb-0 steper-title @if ($pret->etat == 2)
                                text-primary @endif">Transmission</h5>
                        {{-- <p class="mb-0 steper-sub-title">{{ $pret->transmisle ?? ''}}</p> --}}
                    </div>
                    </div>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-3">
                    <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                        <div class="bs-stepper-circle">3</div>
                        @if ($pret->etat == 3)
                        <div class="">
                            <h5 class="mb-0 steper-title text-primary">Accepter/Migrer</h5>
                            {{-- <p class="mb-0 steper-sub-title">{{ $pret->acceptele ?? ''}}</p> --}}
                        </div>
                        @elseif ($pret->etat == 4)
                        <div class="">
                            <h5 class="mb-0 steper-title text-primary">Rejetter</h5>
                            {{-- <p class="mb-0 steper-sub-title">{{ $pret->annulerle ?? ''}}</p> --}}
                        </div>
                        @else
                        <div class="">
                            <h5 class="mb-0 steper-title">Non Traité</h5>
                            {{-- <p class="mb-0 steper-sub-title">00-00-0000</p> --}}
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
                            <i class='bx bx-folder me-2'></i><span>Detail du pret</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-adherent">
                            <i class='bx bx-devices me-2'></i><span>Adherent</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-assurer">
                            <i class='bx bx-analyse me-2'></i><span>Assurés</span>
                        </a>
                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="edit-beneficiaire">
                            <i class='bx bx-plug me-2'></i><span>Beneficiaire</span>
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

                <h5 class="mb-0 font-weight-bold">Documents joint </h5>

                <div class="mt-3"></div>

                @if (count($pret->documents) > 0)

                    @foreach ($pret->documents as $doc)

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
                   <div class="card-header p-2">
                        <h6>Détails du pret</h6>
                   </div>

                    <div class=" mt-4 mx-auto">

                        <div class="col-md-4 mb-3 float-right">
                            <dt class="text-sm font-semibold text-gray-500">ID du prêt :</dt>
                            <dd class="text-lg font-bold text-gray-800" id="pretType">{{ $pret->id }}</dd>
                        </div>
                    
                        <!-- Informations principales -->
                        <div class="bg-white rounded-lg p-6">
                            <dl class="row">
                                <!-- Type et Montant -->
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Type de Prêt</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="pretType">{{ $pret->typepret }}</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Montant</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="pretMontant">{{ number_format($pret->montantpret, 0, ',', ' ') }} F CFA</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Durée</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="pretDuree">{{ $pret->duree }} mois</dd>
                                </div>
                    
                                <!-- Dates -->
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Date de Début</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="dateDebut">{{ \Carbon\Carbon::parse($pret->dateecheancedebut)->format('d/m/Y') }}</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Date de Fin</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="dateFin">{{ \Carbon\Carbon::parse($pret->dateecheancefin)->format('d/m/Y') }}</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Effet de Garantie</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="effetGarantie">{{ \Carbon\Carbon::parse($pret->effetgarantie)->format('d/m/Y') }}</dd>
                                </div>
                    
                                <!-- Primes -->
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Prime Totale</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="primeTotale">{{ number_format($pret->prime, 0, ',', ' ') }} F CFA</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Prime Obsèques</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="primeObseque">{{ number_format($pret->primeobseque, 0, ',', ' ') }} F CFA</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Prime Risque</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="primeRisque">{{ number_format($pret->primerisque, 0, ',', ' ') }} F CFA</dd>
                                </div>
                    
                                <!-- Autres informations -->
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Taille</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="taille">{{ $pret->taille }} cm</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Poids</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="poids">{{ $pret->poids }} kg</dd>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <dt class="text-sm font-semibold text-gray-500">Nature du Prêt</dt>
                                    <dd class="text-lg font-bold text-gray-800" id="naturePret">{{ $pret->naturepret }}</dd>
                                </div>
                            </dl>
                    
                        </div>
                    
                    </div>
                </section>

                <section id="edit-adherent" class="section-content d-none">
                    <fieldset class="border p-3">

                        <legend class="float-none w-auto px-2"><small>Adhérent</small></legend>
                        <div class="my-3">
                            <strong class=""><label class="form-label">Civilité :</label></strong>
                            <span class="">{{ $pret->adherent->civilite ?? 'Non renseigné' }}</span>      
                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-6">

                                <strong><label class="form-label">Nom :</label></strong>

                                <span>{{ $pret->adherent->nom ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-6">

                                <strong><label class="form-label">Prénoms :</label></strong>

                                <span>{{ $pret->adherent->prenom ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-6">

                                <strong>
                                    <label class="form-label">Date de naissance :</label>
                                </strong>

                                <span>{{ $pret->adherent->datenaissance ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-6">

                                <strong><label class="form-label">Lieu de naissance :</label></strong>

                                <span>{{ $pret->adherent->lieunaissance ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Nature de la pièce :</label>
                                </strong>

                                <span>{{ $pret->adherent->naturepiece ?? 'Non renseigné' }}</span>

                            </div>        

                            <div class="col-12 col-lg-4">

                            <strong>
                                    <label class="form-label">Numéro de la pièce :</label>
                            </strong>

                                <span>{{ $pret->adherent->numeropiece ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Lieu de résidence :</label>
                                </strong>

                                <span>{{ $pret->adherent->lieuresidence ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Profession :</label>
                                </strong>

                                <span>{{ $pret->adherent->profession ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Secteur d'activités :</label>
                                </strong>

                                <span>{{ $pret->adherent->employeur ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Email :</label>
                                </strong>

                                <span>{{ $pret->adherent->email ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Mobile :</label>
                                </strong>

                                <span>{{ $pret->adherent->mobile ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Mobile 2 :</label>
                                </strong>

                                <span>{{ $pret->adherent->mobile1 ?? 'Non renseigné' }}</span>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Téléphone :</label>
                                </strong>

                                <span>{{ $pret->adherent->telephone ?? 'Non renseigné' }}</span>

                            </div>

                        </div>

                        <!---end row-->
                    </fieldset>

                    <fieldset class="border p-3">

                        <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoins</small></legend>

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-8">

                                <strong>
                                    <label class="form-label">Nom et Prénoms :</label>
                                </strong>

                                <p>{{ $pret->personneressource ?? 'Non renseigné' }}</p>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Contact :</label>
                                </strong>

                                <p>{{ $pret->contactpersonneressource ?? 'Non renseigné' }}</p>

                            </div>

                        </div>

                        <div class="row g-3 mb-3">

                            <div class="col-12 col-lg-8">

                                <strong>
                                    <label class="form-label">Nom et Prénoms :</label>
                                </strong>

                                <p>{{ $pret->personneressource2 ?? 'Non renseigné' }}</p>

                            </div>

                            <div class="col-12 col-lg-4">

                                <strong>
                                    <label class="form-label">Contact :</label>
                                </strong>

                                <p>{{ $pret->contactpersonneressource2 ?? 'Non renseigné' }}</p>

                            </div>

                        </div>

                    </fieldset>

                    

                </section>

                <section id="edit-assurer" class="section-content d-none">
                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Assurés</small></legend>
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Assuré(e)</th>
                                    <th scope="col">Garanties</th>
                                    <th scope="col">Garanties complémentaires</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pret->assures->count() > 0)
                                    @foreach ($pret->assures as $assure)
                                        <tr>
                                            <td>{{ $assure->nom ?? '-' }} {{ $assure->prenom ?? '-' }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($productGarantie as $item)
                                                        <li>{{ $item->MonLibelle }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Pas de garanties complémentaires</li>
                                                </ul>
                                            </td>
                                            <td><a href="" data-bs-target="#showAssureModal{{ $assure->id }}" data-bs-toggle="modal"><i class="fadeIn animated bx bx-show fs-4 btn"></i></a></td>
                                        </tr>
                                        @include('productions.assurer.show')
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">Aucun assuré trouvé</td>
                                    </tr>
                                @endif
    
                            </tbody>
    
                        </table>
                    </fieldset>
                </section>

                <section id="edit-beneficiaire" class="section-content d-none">
                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Bénéficiaire</small></legend>

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
                                @if ($pret->beneficiaires->count() > 0)
                                    @foreach ($pret->beneficiaires as $beneficiaire)
                                        <tr>
                                            <td>{{ $beneficiaire->nom ?? '--' }} {{ $beneficiaire->prenom ?? '--' }}</td>
                                            <td>{{ $beneficiaire->datenaissance ?? '--' }}</td>
                                            <td>{{ $beneficiaire->lieunaissance ?? '--' }}</td>
                                            <td>{{ $beneficiaire->lieuresidence ?? '--' }}</td>
                                            <td>{{ $beneficiaire->filiation ?? '--' }}</td>
                                            <td>{{ $beneficiaire->mobile ?? '--' }}</td>
                                            <td>{{ $beneficiaire->email ?? '--' }}</td>
                                            <td>{{ $beneficiaire->part ?? '--' }}</td>
                                            <td> <a href="" data-bs-target="#showBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal"><i class="fadeIn animated bx bx-show fs-4 btn"></i></a></td>
                                        </tr>

                                        @include('productions.beneficiaires.show')
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">Aucun bénéficiaire trouvé</td>
                                    </tr>
                                @endif

                            </tbody>

                        </table>
                    </fieldset>

                </section>

                <section id="edit-Info-complementaire" class="section-content d-none">

                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Informations complémentaires</small></legend>

                        <div class="row mb-3">
                         
                            <div class="div col">
                                <strong>Date de saisie</strong>
                                <span>{{ $pret->saisiele ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="div col">
                                <strong>Saisie par </strong>
                                <span>{{ $pret->nomagent ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Code Agent</strong>
                                <span>{{ $pret->codeagent ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Modifier le </strong>
                                <span>{{ $pret->modifiele ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Modifier par</strong>
                                <span>{{ $pret->modifierpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Accepter le </strong>
                                <span>{{ $pret->datemiseenplace ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Accepter par</strong>
                                <span>{{ $pret->misenplacepar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="div col">
                                <strong>Rejeter le </strong>
                                <span>{{ $pret->daterejet ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Rejeter par</strong>
                                <span>{{ $pret->rejeterpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Est migré </strong>
                                <span>{{ $pret->estmigre ? 'Oui' : 'Non' }}</span>
                            </div>
                        </div>

                        <div class="col-12 form-group mt-3">
                            <label for="" class="form-label">Observations(Motif de rejet)</label>
                            <textarea name="" class="form-control" id="" rows="3" readonly>
                                {{ $pret->moftifrejet ?? '' }}
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

@endsection