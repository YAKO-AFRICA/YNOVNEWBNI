@extends('layouts.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    </li>
                    <li class="breadcrumb-item " aria-current="page">Settings</li>
                    <li class="breadcrumb-item " aria-current="page"><a href="{{ route('setting.user.index') }}">Utilisateurs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $codepartenaire }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            
        </div>
    </div>
    <!--end breadcrumb-->
  
    <div class="card p-2">
        <div class="card-hedear">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <div class="">
                    <a href="javascript:;" 
                    class="btn btn-primary radius-30 mt-2 mt-lg-0" 
                    data-bs-toggle="modal" 
                    data-bs-target="#addUsers">
                    <i class="bx bxs-plus-square"></i>Ajouter un utilisateur</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            

            
            <div class="table-responsive">
                @php
                    // Colonnes par défaut
                    $defaultColumns = ['#', 'Nom complet', 'Email', 'Code', 'Type'];

                    $additionalColumns = [
                        'Session ID' => 'id_session',
                        'Nom' => 'nom',
                        'Prénom' => 'prenom',
                        'Cellulaire' => 'cel',
                        'Téléphone' => 'tel',
                        'Pays' => 'pays',
                        'Ville' => 'ville',
                        'Email' => 'email',
                        'Login' => 'login',
                        'Mot de passe' => 'pass',
                        'Date' => 'date',
                        'Date de modification' => 'datemodif',
                        'Token' => 'token',
                        'En ligne' => 'enligne',
                        'Dernière visite' => 'lastvisite',
                        'Nombre de visites' => 'nbrevisite',
                        'Membre actif' => 'memberok',
                        'Droits' => 'droits',
                        'Navigation sécurisée' => 'navigation_securise',
                        'Photo' => 'photo',
                        'Code agent' => 'codeagent',
                        'Type de membre' => 'typ_membre',
                        'Activer' => 'activer',
                        'Branche' => 'branche',
                        'Partenaire' => 'partenaire',
                        'Code partenaire' => 'codepartenaire',
                        'Agence' => 'agence',
                        'Date de naissance' => 'datenaissance',
                        'Lieu de résidence' => 'lieuresidence',
                        'Lieu de naissance' => 'lieunaissance',
                        'Profession' => 'profession',
                        'Code réseau' => 'codereseau',
                        'Code zone' => 'codezone',
                        'Code équipe' => 'codeequipe',
                        'Rôle' => 'role',
                        'Code rôle' => 'coderole',
                        'Sexe' => 'sexe',
                        'Téléphone secondaire' => 'cel2',
                        'Nom de l\'agence' => 'nomagence',
                        'Mot de passe modifié' => 'passmodifier',
                        'Date de modification du mot de passe' => 'passmodifierle',
                        'Est à jour' => 'estajour',
                        'Date de validité' => 'datevalidite',
                        'Paiement valide' => 'paiementok',
                        'Dernier paiement' => 'lastpaiement',
                        'Devis' => 'devis',
                        'Est employé' => 'isemploye',
                        'Est maître de branche' => 'isbranmaster',
                        'Est maître partenaire' => 'ispartmaster',
                        'Est administrateur' => 'isadmin',
                        'Parent utilisateur' => 'user_parent',
                    ];

                    // Colonnes activées par l'utilisateur (issu d'une session ou requête)
                    $activeColumns = session('activeColumns', []);
                @endphp

                <!-- Tableau -->
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            @foreach ($defaultColumns as $defaultColumn)
                                <th>{{ $defaultColumn }}</th>
                            @endforeach

                            <!-- Affiche les colonnes dynamiques activées -->
                            @foreach ($activeColumns as $colKey)
                                <th>{{ array_search($colKey, $additionalColumns) }}</th>
                            @endforeach

                            <th>Actions</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($membresbypartenaire as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nom ?? "" }} {{ $item->prenom ?? "" }}</td>
                            <td>{{ $item->email ?? "" }}</td>
                            <td>{{ $item->codeagent ?? "" }}</td>
                            <td>{{ $item->typ_membre ?? "" }}</td>

                            <!-- Remplissage des colonnes dynamiques activées -->
                            @foreach ($activeColumns as $colKey)
                                <td>{{ $item->$colKey ?? '' }}</td>
                            @endforeach

                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#EditUsers{{ $item->idmembre }}">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('setting.destroy.user',$item->idmembre)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->codereseau}} "
                                        data-id="{{$item->idmembre}}" data-param="0"
                                        data-route="{{route('setting.destroy.user',$item->idmembre)}}"><i
                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#columnsModal" class="ms-3">
                                            <i class="bx bx-cog" style="cursor: pointer;" title="Personnaliser les colonnes"></i>
                                        </a>
                                </div>
                            </td>
                        </tr>
                        {{-- @include('settings.users.editModal') --}}
                        @empty
                        <tr>
                            <td colspan="{{ count($defaultColumns) + count($activeColumns) + 1 }}">Aucun utilisateur trouvé</td>
                        </tr>
                        @endforelse

                        @foreach ($membresbypartenaire as $item)
                            @include('settings.users.editModal', ['item' => $item])
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal de personnalisation des colonnes -->
                <div class="modal fade" id="columnsModal" tabindex="-1" aria-labelledby="columnsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('setting.updateColumns') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="columnsModalLabel">Personnaliser les colonnes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($additionalColumns as $label => $key)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $key }}"
                                                id="col-{{ $key }}" 
                                                {{ in_array($key, $activeColumns) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="col-{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                </div>
                            </form>
                        </div>
                        

                    </div>
                </div>
            
            </div>
        </div>
    </div>
    @include('settings.users.addModal')

    

</div>
@endsection