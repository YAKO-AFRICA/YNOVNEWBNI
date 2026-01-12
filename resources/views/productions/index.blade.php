@extends('layouts.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Productions</li>
                    <li class="breadcrumb-item active" aria-current="page">Mes Propositions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Reglages</button>

                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#columnsModalPart">Personnaliser les colonnes</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
  
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <form action="{{ route('prod.index') }}" method="get">
                        <select id="statusFilter" name="etape" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="0">Saisie non achevée</option>
                            <option value="1">Saisie non transmise</option>
                            <option value="2">Transmis</option>
                            <option value="3">Accepté</option>
                            <option value="4">Rejeté</option>
                        </select>
                    </form>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('prod.stepProduct') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i>Nouvelle proposition
                    </a>
                </div>
            </div>

            <div class="table-responsive">

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
                        @forelse ($datas['allPropositionsFiltered'] as $item)
                        <tr class="articleByCat" data-status="{{ strtolower($item->etape) }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->libelleproduit ?? "" }}</td>
                            <td>{{ $item->adherent->nom ?? "" }} {{ $item->adherent->prenom ?? "" }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->adherent->datenaissance)->locale('fr')->translatedFormat('d M Y') ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->dateeffet)->locale('fr')->translatedFormat('d M Y') ?? '' }}</td>
                            <td>{{ $item->prime ?? "" }}</td>
                            <td>{{ $item->capital ?? 0 }}</td>
                            <td>{{ $item->montantrente ?? 0 }}</td>
                            <td>{{ $item->user->membre->nom ?? "" }} {{ $item->user->membre->prenom ?? "" }}</td>
                            <td>
                                @if ($item->etape == '0')
									<div class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Saisie non achevée</div>
								@elseif ($item->etape == '1')
									<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Saisie Non Transmis</div>
								@elseif ($item->etape == '2')
									<div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Transmis</div>
								@elseif ($item->etape == '3')
									<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Accepté</div>
								@elseif ($item->etape == '4')
									<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Rejeté</div>
								@endif
                            </td>
                            
                            @foreach ($activeColumns as $colKey)
                                <td>{{ $item->$colKey ?? '' }}</td>
                            @endforeach
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('prod.show', $item->id)}}">
                                        <i class='bx bxs-show'></i>
                                    </a>
                                    @if (!in_array($item->etape, [2, 3]))

                                        @can('Modifier une souscription')
                                            <a href="{{ route('prod.edit', $item->id)}}" class="ms-3">
                                                <i class='bx bxs-edit'></i>
                                            </a>
                                        @endcan
                                    

                                        @can('Suprimer une souscription')
                                            <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                                data-type="confirmation_redirect" data-placement="top"
                                                data-token="{{ csrf_token() }}"
                                                data-url="{{route('prod.destroy',$item->id)}}"
                                                data-title="Vous êtes sur le point de supprimer la proposition N° {{$item->id}} "
                                                data-id="{{$item->id}}" data-param="0"
                                                data-route="{{route('prod.destroy',$item->id)}}"><i
                                                    class='bx bxs-trash' style="cursor: pointer"></i>
                                            </a>
                                        @endcan
                                    
                                    @else
                                    <a href="javascript:;" class="ms-3 text-muted" title="Vous ne pouvez pas modifier une proposition transmise ou migrer">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <a class="ms-3 text-muted" data-uuid="{{$item->id}}" title="Vous ne pouvez pas supprimer une proposition transmise ou migrer">
                                        
                                        <i class='bx bxs-trash' style="cursor: pointer"></i>
                                    </a>
                                    @endif
                                    
                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ count($defaultColumns) + count($activeColumns) + 1 }}">Aucun contrat trouvé</td>
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
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let statusSelect = document.getElementById('statusFilter');
                statusSelect.addEventListener('change', function () {
                    this.form.submit();
                });
            });
        </script>
        
</div>
@endsection