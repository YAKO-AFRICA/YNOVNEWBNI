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
                    <li class="breadcrumb-item active" aria-current="page">Motifs</li>
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
              <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addNewMotif"><i class="bx bxs-plus-square"></i>Ajouter un Motif</a></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0" id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Libelle</th>
                            <th>Date Création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($motifs as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->code ?? ""}}</td>
                            <td>{{ Str::words($item->libelle ?? "", 15) }}</td>
                            <td>{{ $item->created_at->format('d-m-Y à H:i:s') ?? ""}}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#EditMotif{{ $item->id}}"><i class='bx bxs-edit'></i></a>
                                    <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('setting.destroy.motifRejetPrestation',$item->id)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->libelle}} "
                                        data-id="{{$item->id}}" data-param="0"
                                        data-route="{{route('setting.destroy.motifRejetPrestation',$item->id)}}"><i
                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                        </a>
                                </div>
                            </td>
                        </tr>
                        @include('settings.motifs.prestation.editModal', ['item' => $item])
                        @empty
                            <div class="collapse col-8">Aucun motif</div>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('settings.motifs.prestation.addModal')

</div>
@endsection