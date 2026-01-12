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
                    <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            {{-- <div class="btn-group">
                <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addUsers"><i class="bx bxs-plus-square"></i>Ajouter un utilisateur</a></div>
            </div> --}}
        </div>
    </div>
    <!--end breadcrumb-->
  
    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach ($membres as $codepartenaire => $membresParPartenaire)
                    <div class="col-sm-12 col-md-4 mb-3">
                        <a href="{{ route('setting.user.indexByPartenaire', $codepartenaire) }}">
                            <div class="card partenaire-card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Partenaire : {{ $codepartenaire  }}</h5>
                                    <p class="card-text">Nombre de membres : <strong>{{ $membresParPartenaire->count() }}</strong></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
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
    {{-- @include('settings.users.addModal') --}}

</div>
@endsection