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
                    <li class="breadcrumb-item active" aria-current="page">Reseau</li>
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
              <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addnewReseau"><i class="bx bxs-plus-square"></i>Ajouter un reseau</a></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>Order#</th>
                            <th>Code Reseau</th>
                            <th>Libelle</th>
                            <th>Responsable</th>
                            <th>Branche</th>
                            <th>Partenaire</th>
                            <th>Produits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reseaux as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->codereseau ?? ""}}</td>
                            <td>{{ $item->libelle ?? ""}}</td>
                            <td>{{ $item->coderesponsable ?? ""}}</td>
                            <td>{{ $item->codebranche ?? ""}}</td>
                            <td>{{ $item->codepartenaire ?? ""}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        {{ $item->products->count() }}
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-18 text-success" data-bs-toggle="modal" data-bs-target="#productModal{{ $item->id }}"><i class="bx bx-show"></i></h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex order-actions">

                                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#EditReseau{{ $item->id}}"><i class='bx bxs-edit'></i></a>
                                    {{-- <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a> --}}

                                    <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('setting.destroy.reseau',$item->id)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->codereseau}} "
                                        data-id="{{$item->id}}" data-param="0"
                                        data-route="{{route('setting.destroy.reseau',$item->id)}}">
                                        <i class='bx bxs-trash' style="cursor: pointer"></i>
                                    </a>

                                    <a href="javascript:;" class="ms-3" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addProductReseau{{$item->id}}">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @include('settings.productByReseau.addModal', ['item' => $item])
                        @include('settings.productByReseau.showProductModal', ['item' => $item])
                        @include('settings.reseaux.editModal', ['item' => $item])
                        @empty
                            <div class="collapse col-8">Aucun reseau</div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('settings.reseaux.addModal')
    

</div>
@endsection