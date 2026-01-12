@extends('layouts.main')

@section('content')

 <!--breadcrumb-->
 <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page">Productions</li>
                <li class="breadcrumb-item active" aria-current="page">Sélection de produit</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
    </div>
</div>
<!--end breadcrumb-->

    <div class="row mb-2">
        <div class="col-4">
            <input type="text" id="searchProduct" class="form-control" placeholder="Rechercher un produit...">
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3" id="productList">
        @foreach($products as $product)
            <div class="col product-item">
                <div class="card">
                    <div class="card-header"> 
                        <h6 class="text-center text-capitalize">  {{ strtoupper($product->MonLibelle ?? 'N/A') }} </h6>
                    </div>
                    <div class="card-body py-1">
                        <p class="card-text">
                            <dl class="row">
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Code Produit</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $product->CodeProduit?? 'N/A' }}</dd>
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Age min</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $product->AgeMiniAdh?? 'N/A' }}</dd>
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Age max</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $product->AgeMaxiAdh?? 'N/A' }}</dd>
                            </dl>
                        </p>	
                    </div>
                    @if ($product->CodeProduit == 'YKE_2018')
                        @can('Demarrer une souscription')
                        <div class="card-footer text-center">
                            <a href="{{ route('prod.createYke', $product->CodeProduit) }}" class="btn-prime btn-prime-two d-block">Souscrire</a>
                        </div>
                        @else
                        <div class="card-footer text-center">
                            <a href="#" class="btn-prime btn-prime-two d-block text-danger">Vous n'etes pas autorisé</a>
                        </div>
                        @endcan
                    @elseif (in_array($product->CodeProduit, ['CADENCE']))
                        @can('Demarrer une souscription')
                        <div class="card-footer text-center">
                            <a href="{{ route('prod.createKds', $product->CodeProduit) }}" class="btn-prime btn-prime-two d-block">Souscrire</a>
                        </div>
                        @else
                        <div class="card-footer text-center">
                            <a href="#" class="btn-prime btn-prime-two d-block text-danger">Vous n'etes pas autorisé</a>
                        </div>
                        @endcan
                    @elseif (in_array($product->CodeProduit, ['CAD_EDUCPLUS']))
                        @can('Demarrer une souscription')
                        <div class="card-footer text-center">
                            <a href="{{ route('prod.createCAD', $product->CodeProduit) }}" class="btn-prime btn-prime-two d-block">Souscrire</a>
                        </div>
                        @else
                        <div class="card-footer text-center">
                            <a href="#" class="btn-prime btn-prime-two d-block text-danger">Vous n'etes pas autorisé</a>
                        </div>
                        @endcan
                    @elseif ($product->CodeProduit == 'DOIHOO')
                        @can('Demarrer une souscription')
                        <div class="card-footer text-center">
                            <a href="{{ route('prod.createdoihoo', $product->CodeProduit) }}" class="btn-prime btn-prime-two d-block">Souscrire</a>
                        </div>
                        @else
                        <div class="card-footer text-center">
                            <a href="#" class="btn-prime btn-prime-two d-block text-danger">Vous n'etes pas autorisé</a>
                        </div>
                        @endcan
                    @else
                        @can('Demarrer une souscription')
                        <div class="card-footer text-center">
                            <a href="{{ route('prod.create', $product->CodeProduit) }}" class="btn-prime btn-prime-two d-block">Souscrire</a>
                        </div>
                        @else
                        <div class="card-footer text-center">
                            <a href="#" class="btn-prime btn-prime-two d-block text-danger">Vous n'etes pas autorisé</a>
                        </div>
                        @endcan
                    @endif
                    
                    
                    
                </div>
            </div>
        @endforeach
    </div>
    
    {{-- <a href="{{ route('bullettin.test') }}" class="btn btn-primary" target="_blank"> bulletin</a> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            sessionStorage.removeItem('simulationData');
            sessionStorage.removeItem("contacts");
            var searchInput = document.getElementById('searchProduct');
            var productItems = document.querySelectorAll('.product-item');

            searchInput.addEventListener('keyup', function() {
                var filter = searchInput.value.toLowerCase();
                
                productItems.forEach(function(item) {
                    var productName = item.querySelector('h6').textContent.toLowerCase();

                    if (productName.includes(filter)) {
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    </script>

@endsection