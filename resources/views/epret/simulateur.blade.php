@extends('layouts.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Epret</li>
                    <li class="breadcrumb-item active" aria-current="page">Simulateur</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
  
    <div class="container mt-5">
        <h3 class="text-center text-uppercase">Simulateur de Prêt</h3>
        <div class="row mt-5">
            <!-- Formulaire -->
            <div class="col-8">
                <div class="card container">
                    <div class="card-header text-center">
                        <h5 class="text-uppercase">INFORMATIONS SUR LE PRÊT </h5>
                    </div>
                    <div class="card-body">
                        <form id="loanSimulatorForm" class="row g-3 needs-validation" novalidate>
                            <!-- Genre -->
                            <div class="col-md-6">
                                <label for="genre" class="form-label">Genre <span class="text-danger">*</span></label>
                                <select id="genre" class="form-select" required>
                                    <option value="" disabled selected>Choisir...</option>
                                    <option value="femme">Femme</option>
                                    <option value="homme">Homme</option>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner votre genre.</div>
                            </div>
            
                            <!-- Date de naissance -->
                            <div class="col-md-6">
                                <label for="birthday" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birthday" required>
                                <div class="invalid-feedback">Veuillez saisir votre date de naissance.</div>
                            </div>
            
                            <!-- Montant du prêt -->
                            <div class="col-md-6">
                                <label for="loanMontant" class="form-label">Montant du prêt (en FCFA) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="loanMontant" placeholder="Entrez le montant" required>
                                <div class="invalid-feedback">Veuillez entrer un montant valide.</div>
                            </div>
            
                            <!-- Durée -->
                            <div class="col-md-6">
                                <label for="loanDuration" class="form-label">Durée (en mois) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="loanDuration" placeholder="Entrez la durée" required>
                                <div class="invalid-feedback">Veuillez entrer une durée valide.</div>
                            </div>
            
                            <!-- Poids et Taille -->
                            <div class="col-md-6">
                                <label for="poids" class="form-label">Poids (kg) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="poids" placeholder="Entrez votre poids" required>
                                <div class="invalid-feedback">Veuillez entrer votre poids.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="taille" class="form-label">Taille (cm) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="taille" placeholder="Entrez votre taille" required>
                                <div class="invalid-feedback">Veuillez entrer votre taille.</div>
                            </div>
            
                            <!-- Garantie Yako -->
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="checkbox" id="disableYako">
                                <label class="form-check-label" for="disableYako">Désactiver la garantie Yako</label>
                            </div>
            
                            <!-- Boutons -->
                            
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary text-uppercase">Évaluer la Prime</button>
                                @can('Initier un pret')
                                    <a href="{{ route('epret.create')}}" class="btn btn-outline-primary text-uppercase">Démarrer une Souscription</a>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Résultats -->
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="text-uppercase">Résultat du simulateur</h5>
                    </div>
                    <div class="card-body">
                        <div class="result-container">
                            <div class="card mb-3">
                                <div class="card-body" style="background-color: #fff1eb">
                                    <h6 class="card-title">Prime de risque emprunteur :</h6>
                                    <p class="card-text fs-4"><span id="primeEmprunteur" class="font-weight-bold">0</span> Fcfa</p>
                                </div>
                            </div>

                            <div class="card mb-3" id="primeObsequeCard">
                                <div class="card-body" style="background-color: #fff1eb">
                                    <h5 class="card-title">Prime Yako Obseque :</h5>
                                    <p class="card-text fs-4"><span id="primeObseque" class="font-weight-bold">0</span> Fcfa</p>
                                </div>
                            </div>
                            <div class="card mb-3" id="primeObsequeCard">
                                <div class="card-body" style="background-color: #fff1eb">
                                    <h5 class="card-title">Prime :</h5>
                                    <p class="card-text fs-4"><span id="prime" class="font-weight-bold">0</span> Fcfa</p>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body" style="background-color: #c8e6c9">
                                    <h5 class="card-title">Total des primes :</h5>
                                    <p class="card-text float-end fs-3"><span id="totalPremium" class="font-weight-bold">0</span> Fcfa</p>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>             
            </div>
        </div>
    </div>
</div>
@endsection
    

