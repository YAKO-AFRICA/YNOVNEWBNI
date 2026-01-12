@extends('layouts.main')

@section('content')

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Productions</li>
                    <li class="breadcrumb-item active" aria-current="page">Validation Popositions | {{ $datas['partners']->designation ?? 'BNI' }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Reglages</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#columnsModalPart">Personnaliser les colonnes</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-12 col-lg-3 col-md-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total en attente</p>
                            <h4 class="my-1">{{ count($datas['allPropositions']->where('etape', '2')) }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35"><i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-3 col-md-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total en attente/Jour</p>
                            <h4 class="my-1">{{ $datas['contratsEtape2Today'] }}</h4>
                        </div>
                        <div class="text-warning ms-auto font-35"><i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Accepter/Migrer</p>
                            <h4 class="my-1">{{ count($datas['acceptedPropositions']) }}</h4>
                        </div>
                        <div class="text-success ms-auto font-35"><i class='bx bxs-check-square'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Rejeter</p>
                            <h4 class="my-1">{{ count($datas['allPropositions']->where('etape', '4')) }}</h4>
                        </div>
                        <div class="text-danger ms-auto font-35"><i class='bx bxs-dislike' ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            

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
                        @forelse ($datas['allPropositions']->where('etape', '2') as $item)
                        <tr class="articleByCat">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->libelleproduit ?? "" }}</td>
                            <td>{{ $item->dateeffet ?? "" }}</td>
                            <td>{{ $item->prime ?? "" }}</td>
                            <td>{{ $item->capital ?? "" }}</td>
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
                                    <a href="{{ route('prod.validation.show', $item->id)}}">
                                        <i class='bx bxs-show'></i>
                                    </a>                                   
                                    
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


@endsection