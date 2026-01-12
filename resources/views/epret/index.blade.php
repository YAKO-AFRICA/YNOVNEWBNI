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
                    <li class="breadcrumb-item active" aria-current="page">Epret</li>
                    <li class="breadcrumb-item active" aria-current="page">Demande de prets</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                {{-- <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div> --}}
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
  
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                </div>
              <div class="ms-auto"><a href="{{ route('epret.simulateur')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addnewEquipe"><i class="bx bxs-plus-square"></i>Nouvelle demande</a></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>Adherent</th>
                            <th>N° Compte</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Durée</th>
                            <th>Etat</th>
                            <th>Prime</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $prets as $item)
                        <tr>
                            <td>
                               {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->id ?? ""}}</td>
                            <td>{{ $item->adherent->nom ?? ""}} {{ $item->adherent->prenom ?? ""}}</td>
                            <td>{{ $item->numerocompte ?? ""}}</td>
                            <td>{{ $item->saisiele ?? ""}}</td>
                            <td>{{ $item->montantpret ?? ""}}</td>
                            <td>{{ $item->duree ?? ""}}</td>
                            <td>{{ $item->etat ?? ""}}</td>
                            <td>{{ $item->prime ?? ""}}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('epret.show', $item->id) }}" class="">
                                        <i class='bx bxs-show'></i>
                                    </a>

                                    @can('Modifier le pret')
                                        <a href="{{ route('epret.edit', $item->id)}}" class=""><i class='bx bxs-edit'></i></a>
                                    @endcan

                                    @can('Supprimer le pret')
                                        <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                            data-type="confirmation_redirect" data-placement="top"
                                            data-token="{{ csrf_token() }}"
                                            data-url="{{route('epret.destroy',$item->id)}}"
                                            data-title="Vous êtes sur le point de supprimer le pret  {{$item->id}} "
                                            data-id="{{$item->id}}" data-param="0"
                                            data-route="{{route('epret.destroy',$item->id)}}">
                                            <i class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>
                                    @endcan
                                    

                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection