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
                    <li class="breadcrumb-item active" aria-current="page">Equipes</li>
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
              <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addnewEquipe"><i class="bx bxs-plus-square"></i>Ajouter une equipe</a></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Libelle</th>
                            <th>Zone</th>
                            <th>Code Responsable</th>
                            <th>Responsable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $equipes as $item)
                        <tr>
                            <td>
                               {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->codeequipe ?? ""}}</td>
                            <td>{{ $item->libelleequipe ?? ""}}</td>
                            <td>{{ $item->zone->libellezone ?? ""}}</td>
                            <td>{{ $item->coderesponsable ?? ""}}</td>
                            <td>{{ $item->nomresponsable ?? ""}}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#EditEquipe{{ $item->id}}"><i class='bx bxs-edit'></i></a>
                                    <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('setting.destroy.equipe',$item->id)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->libelleequipe}} "
                                        data-id="{{$item->id}}" data-param="0"
                                        data-route="{{route('setting.destroy.equipe',$item->id)}}"><i
                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>
                                </div>
                            </td>
                        </tr>
                        @include('settings.equipes.editModal', ['item' => $item])
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('settings.equipes.addModal')
</div>
@endsection