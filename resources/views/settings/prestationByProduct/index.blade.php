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
                        <li class="breadcrumb-item active" aria-current="page">Produits & Prestations</li>
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
                

                <div class="table-responsive">
                    <table class="table mb-0" id="example2">
                        <thead class="table-light">
                            <tr>
                                <th>#ID</th>
                                <th>Code Produit</th>
                                <th>Libelle</th>
                                <th>Prestations possibles</th>
                                <th>Date création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->CodeProduit ?? '' }}</td>
                                    <td>{{ $item->MonLibelle ?? '' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>{{ $item->typePrestations->count() }}</div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-18 text-success" data-bs-toggle="modal"
                                                    data-bs-target="#showPrestationModal{{ $item->CodeProduit }}"
                                                    style="cursor: pointer">
                                                    <i class="bx bx-show"></i>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->DateProduit ?? '' }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('setting.prestation_product.form', $item->CodeProduit) }}" class="ms-3">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @include('settings.prestationByProduct.showPrestationModal', [
                                    'CodeProduit' => $item->CodeProduit,
                                ])
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucun produit</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    
@endsection

