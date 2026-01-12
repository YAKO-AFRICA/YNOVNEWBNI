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
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    <li class="breadcrumb-item active" aria-current="page">Partenaires</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
  
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                </div>
              <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addPartner"><i class="bx bxs-plus-square"></i>Ajouter un partenaire</a></div>
            </div>
            <div class="table-responsive">

                @php
                    $defaultColumns = ['#', 'Logo', 'Code', 'Designation', 'Capital', 'Telephone', 'Adresse Mail'];

                    $additionalColumns = [
                        'Code' => 'code',
                        'Designation' => 'designation',
                        'Forme Juridique' => 'formejuridique',
                        'Activites Principales' => 'activitesprincipales',
                        'Capital' => 'capital',
                        'Compte Contribuable' => 'comptecontribuable',
                        'Registre de Commerce' => 'nrc',
                        'Telephone' => 'telephone',
                        'Mobile 1' => 'mobile1',
                        'Mobile 2' => 'mobile2',
                        'Adresse Email' => 'adresseemail',
                        'Site Web' => 'siteweb',
                        'logo' => 'logo',
                        'Actif' => 'actif',
                        'Parent' => 'parent',
                        'Code Client' => 'code_client',
                        'Code Fournisseur' => 'code_fournisseur',
                        'Actif' => 'actif',
                        'Actif' => 'actif',
                        'Actif' => 'actif',
                        'Dernière visite' => 'lastvisite',
                    ];
                    $activeColumns = session('activeColumns', []);
                @endphp

                <!-- Tableau -->
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            @foreach ($defaultColumns as $defaultColumn)
                                <th>{{ $defaultColumn }}</th>
                            @endforeach

                            @foreach ($activeColumns as $colKey)
                                <th>{{ array_search($colKey, $additionalColumns) }}</th>
                            @endforeach
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($partners as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-box">
                                        <img src="{{ asset('logos/' . $item->logo) }}" class="product-img img-fluid" alt="" style="width: 40px; height: 40px"/>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->code ?? "" }}</td>
                            <td>{{ $item->designation ?? "" }}</td>
                            <td>{{ $item->capital ?? "" }}</td>
                            <td>{{ $item->telephone ?? "" }}</td>
                            <td>{{ $item->adresseemail ?? "" }}</td>

                            @foreach ($activeColumns as $colKey)
                                <td>{{ $item->$colKey ?? '' }}</td>
                            @endforeach

                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#EditPartner{{ $item->id }}">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('setting.destroy.partner',$item->id)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->code}} "
                                        data-id="{{$item->id}}" data-param="0"
                                        data-route="{{route('setting.destroy.partner',$item->id)}}"><i
                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#columnsModalPart" class="ms-3">
                                            <i class="bx bx-cog" style="cursor: pointer;" title="Personnaliser les colonnes"></i>
                                        </a>
                                </div>
                            </td>
                        </tr>
                        @include('settings.partners.editModal')
                        @empty
                        <tr>
                            <td colspan="{{ count($defaultColumns) + count($activeColumns) + 1 }}">Aucun utilisateur trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Modal de personnalisation des colonnes -->
                <div class="modal fade" id="columnsModalPart" tabindex="-1" aria-labelledby="columnsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('setting.updateColumnsPart') }}" method="POST">
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
    @include('settings.partners.addModal')

</div>
@endsection