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
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-12 col-md-4 mb-3">
                    <a href="{{ route('setting.motifRejetProposition.index') }}">
                        <div class="card partenaire-card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Motif rejet Proposition</h5>
                                <p class="card-text">Nombre total des motifs  : <strong> {{ $MotifRejet['Proposition']->count() }}</strong></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <a href="{{ route('setting.motifRejetPrestation.index') }}">
                        <div class="card partenaire-card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Motif rejet Prestation</h5>
                                <p class="card-text">Nombre total des motifs  : <strong>{{ $MotifRejet['Prestation']->count() }}</strong></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <style>
                .partenaire-card {
                    border-radius: 10px;
                    overflow: hidden;
                    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    background: linear-gradient(90deg, #f5bd08, #107722);
                    color: white;
                }

                .partenaire-card:hover {
                    transform: scale(1.05);
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }

            </style>
        </div>
    </div>

</div>
@endsection