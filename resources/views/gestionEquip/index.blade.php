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
                    <li class="breadcrumb-item active" aria-current="page">Saisie de mon equipe</li>
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
  
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <form action="{{ route('prod.gestionEquip') }}" method="get">
                        <label for="agentFilter">Selectionner un agent</label>
                        <select id="agentFilter" name="codeMembre" class="form-select">
                            <option value="">Choisir un agent</option>
                            @foreach ($datas['userOnEquipe'] as $item)
                                <option value="{{$item->idmembre}}">{{$item->nom ?? "Inconnu"}} {{$item->prenom ?? "Inconnu"}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="ms-auto">
                </div>
            </div>

            <div class="table-responsive">
                <!-- Tableau -->
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Produit</th>
                            <th>Adherent</th>
                            <th>Date Naissance</th>
                            <th>Date Effet</th>
                            <th>Prime</th>
                            <th>Capital</th>
                            <th>Saisie par</th>
                            <th>Etape</th>
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
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('prod.show', $item->id)}}">
                                        <i class='bx bxs-show'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Aucun contrat trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                
            </div>
        </div>
    </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let statusSelect = document.getElementById('agentFilter');
                statusSelect.addEventListener('change', function () {
                    this.form.submit();
                });
            });
        </script>
        
</div>
@endsection