@extends('layouts.main')

@section('content')

<!--breadcrumb-->

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Productions</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Details de la proposition</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-end gap-4">
            @can('Valider une proposition')
            <form action="{{ route('prod.traitement.proposition.valider', $contrat->id)}}" method="post" class="submitForm">
                @csrf
                <button type="submit" class="btn btn-success py-1 px-2 border-1 text-center"><i class='bx bx-check fs-4'></i>Valider</button>
            </form>
            @endcan
            
            @can('Rejeter une proposition')
                <button type="button" class="btn btn-danger py-1 px-2 border-1 text-center" data-bs-toggle="modal" data-bs-target="#rejectModal"><i class='bx bx-x' ></i>Rejeter</button>
            @endcan

            @can('Modifier une proposition')
                <button type="button" class="border-0 btn btn-primary py-1 px-2 text-center">
                    <a href="{{ route('prod.proposition.edit', $contrat->id) }}" class="btn py-1 px-2 border-1 text-center"><i class='bx bx-edit' ></i>Modifier</a>
                </button>
            @endcan
            
        </div>
    </div>
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rejeter la proposition N° {{ $contrat->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('prod.traitement.proposition.rejet', $contrat->id)}}" method="post" class="submitForm">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12 form-group mt-3">
                            <label for="motifrejet" class="form-label">Observations(Motif de rejet)</label>

                            <select name="motifrejet" id="motifrejet" class="form-select">
                                <option value="">Selectionner un motif</option>
                                @foreach ($motifs as $motif)
                                    <option class="form-option" value="{{ $motif->libelle }}">{{ $motif->libelle }}</option>
                                @endforeach
                            </select>
                            {{-- <textarea name="motifrejet" class="form-control" id="motifrejet" rows="3" required></textarea> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Rejeter maintenant</button>
                    </div>
                </form>
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
                            <i class='bx bx-folder me-2'></i><span>Detail du contrat</span>
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
                <h5 class="mb-0 font-weight-bold">Documents joints</h5>
                <div class="mt-3"></div>
                
                @php
                    $documents = $contrat->getDocumentsBasedOnProduct();
                @endphp

                
                @if (count($documents) > 0)
                    @foreach ($documents as $doc)
                    <div class="d-flex align-items-center mt-3">
                        <div class="fm-file-box bg-light-success text-success">
                            <i class='bx bxs-file-doc'></i>
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
                    <h5>Détails du Contrat</h5>

                    <div class="card p-4">
                        <div class="row">
                            <!-- Colonne 1 -->
                            <div class="col-4">
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
                            <div class="col-4">
                                <dl class="mb-4">
                                    <dt>Périodicité</dt>
                                    <dd>
                                        @switch($contrat->periodicite)
                                            @case('M') Mois @break
                                            @case('T') Trimestre @break
                                            @case('S') Semestre @break
                                            @case('A') Année @break
                                            @case('U') Versement unique @break
                                            @default --
                                        @endswitch
                                    </dd>
                    
                                    <dt>Date d'effet</dt>
                                    <dd>{{ $contrat->dateeffet ?? '--' }}</dd>
                    
                                    <dt>Capital</dt>
                                    <dd>{{ number_format($contrat->capital ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    <dt>Duree</dt>
                                    <dd>{{ $contrat->duree ?? '--' }}</dd>

                                    <dt>Code Guichet</dt>
                                    <dd>{{ $contrat->codeguichet ?? '--' }}</dd>
                    
                                    <dt>Conseiller client</dt>
                                    <dd>{{ $contrat->nomagent ?? ""}}</dd>

                                    
                                </dl>
                            </div>
                    
                            <!-- Colonne 3 -->
                            <div class="col-4">
                                <dl class="mb-4">
                                    <dt>Surprime</dt>
                                    <dd>{{ number_format($contrat->surprime ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    <dt>Prime</dt>
                                    <dd>{{ number_format($contrat->prime ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    <dt>Prime Principale</dt>
                                    <dd>{{ number_format($contrat->primepricipale ?? 0, 0, ',', ' ') }} FCFA</dd>

                                    <dt>Frais d'adhésion</dt>
                                    <dd>{{ number_format($contrat->fraisadhesion ?? 0, 0, ',', ' ') }} FCFA</dd>
                    
                                    
                    
                                    <dt>Cle Rib</dt>
                                    <dd>{{ $contrat->rib ?? '--' }}</dd>
                                    <dt>Code Conseiller</dt>
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

                        <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoins</small></legend>

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
                                @if ($contrat->assures->count() > 0)
                                    @foreach ($contrat->assures as $assure)
                                        <tr>
                                            <td>{{ $assure->nom ?? '-' }} {{ $assure->prenom ?? '-' }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($productGarantie as $item)
                                                        <li>{{ $item->libelle }}</li>
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

                        @if ($contrat->codeproduit === "INV_2020")
                            <div class="row my-4">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label"><strong>Beneficiaire au terme du contrat</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $contrat->beneficiaireauterme ?? 'Non renseigné' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label class="form-label"><strong>Beneficiaire au Deces</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $contrat->beneficiaireaudeces ?? 'Non renseigné' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                                <span>{{ Carbon\Carbon::parse($contrat->created_at)->format('D-M-Y H:i') ?? 'Non renseigné' }}</span>
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
                                <strong>Modifier le </strong>
                                <span>{{ $contrat->modifierle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Modifier par</strong>
                                <span>{{ $contrat->modifierpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="div col">
                                <strong>Transmis le </strong>
                                <span>{{ $contrat->transmisle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Transmis par</strong>
                                <span>{{ $contrat->transmisPar->nom ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Accepter le </strong>
                                <span>{{ $contrat->accepterle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Accepter par</strong>
                                <span>{{ $contrat->accepterpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="div col">
                                <strong>Rejeter le </strong>
                                <span>{{ $contrat->annulerle ?? '--' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Rejeter par</strong>
                                <span>{{ $contrat->rejeterpar ?? 'Non renseigné' }}</span>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="div col">
                                <strong>Est migré </strong>
                                <span>{{ $contrat->estMigre ? 'Oui' : 'Non' }}</span>
                            </div>
                            <div class="div col">
                                <strong>Transmis par</strong>
                                <span>{{ $contrat->codeConseiller ?? 'Non renseigné' }}</span>
                            </div>
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