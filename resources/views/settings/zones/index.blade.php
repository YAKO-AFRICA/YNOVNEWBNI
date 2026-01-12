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
                    <li class="breadcrumb-item active" aria-current="page">Zones</li>
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
              <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addnewZone"><i class="bx bxs-plus-square"></i>Ajouter une zone</a></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>Order#</th>
                            <th>Code Zone</th>
                            <th>Libelle</th>
                            <th>Reseau</th>
                            <th>Code Responsable</th>
                            <th>Responsable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($zones as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->codezone ?? ""}}</td>
                            <td>{{ $item->libellezone ?? ""}}</td>
                            <td>{{ $item->reseau->libelle ?? ""}}</td>
                            <td>{{ $item->coderesponsable ?? ""}}</td>
                            <td>{{ $item->nomresponsable ?? ""}}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#EditZone{{ $item->id}}"><i class='bx bxs-edit'></i></a>
                                    {{-- <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a> --}}
                                    <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('setting.destroy.zone',$item->id)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->libellezone}} "
                                        data-id="{{$item->id}}" data-param="0"
                                        data-route="{{route('setting.destroy.zone',$item->id)}}"><i
                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>
                                </div>
                            </td>
                        </tr>
                        @include('settings.zones.editModal', ['item' => $item])
                        @empty
                            <div class="collapse col-8">Aucun reseau</div>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('settings.zones.addModal')

</div>
@endsection