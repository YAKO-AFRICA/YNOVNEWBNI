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
                    <li class="breadcrumb-item active" aria-current="page">Demande de pret</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <style>
      
        .stepper {
            margin-bottom: 5px;
        }
        .step {
        }

        .step .circle {
            width: 30px;
            height: 30px;
            line-height: 30px;
            border: 2px solid #ccc;
            border-radius: 50%;
            background-color: #f5f5f5;
            color: #aaa;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .step.active .circle {
            border-color: #08641f;
            background-color: #08641f;
            color: white;
        }

        .step.active div {
            font-weight: bold;
            color: #08641f;
        }

    </style>


    <div class="container-fluid">
        <div class="card p-3">
           <div class="row">
            <div class="col-8" id="formContainerPret">

                <form id="multiStepForm" method="POST"  class="submitForm">
                    @csrf
                    
                    <div class="form-step active">
                        <h3>Informations sur l'adhérent</h3>
                        
                        @include('epret.components.steps.stepAdherent')
                    </div>

                    <div class="form-step">
                        <h3>Détails de la cotation</h3>

                        @include('epret.components.steps.stepCotation')

                    </div>

                    <div class="form-step">
                        <h3>Questionnaire sur l'état de santé</h3>
                        
                        @include('epret.components.steps.stepSante')
                    </div>

                    <div class="form-step">
                        <h3>Bénéficiaire garantie YAKO</h3>
                        
                        @include('epret.components.steps.stepBeneficiaire')
                    </div>

                    <div class="form-step">
                        <h3>Résumé/Choix d'un médecin</h3>

                        @include('epret.components.steps.stepResume')
                    </div>

                    

                    <div class="card-footer">
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" id="prevBtn" class="btn btn-secondary">Précédent</button>
                            <button type="button" id="nextBtn" class="btn btn-primary">Suivant</button>
                            <button type="submit" id="submit" class="btn btn-primary">Soumettre </button>
                        </div>
                    </div>
                </form>
                
                <div class="form-step">
                    <h3>Document</h3>

                    @include('epret.components.steps.stepDocument')
                </div>
                
            </div>
            <div class="col-4">
                <div class="sticky-container">
                    <div class="card ">
                        <div class="card-header text-center">
                            <h5 class="text-uppercase">Résultat du simulateur</h5>
                        </div>
                        <div class="card-body">


                            @if(session()->has('simulationData'))
                                @php
                                    $simulationData = session('simulationData');
                                @endphp
                            @endif


                            <div class="result-container alert bg-light-success">
                                <dl class="row">
                                    <dt class="col-sm-6 font-weight-bold">Nature du pret :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="naturePret">Consommation</dd>
                            
                                    <dt class="col-sm-6 font-weight-bold">Nom Complet:</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="FullName">-</dd>
                            
                                    <dt class="col-sm-6 font-weight-bold">Né(e) :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="bithdayEmprunteur">{{ $simulationData['dateNaissance'] ?? '-' }}</dd>
                            
                                    <dt class="col-sm-6 font-weight-bold">Age :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="ageEmprunteur">{{ $simulationData['age'] ?? '-' }} ans</dd>

                                    <dt class="col-sm-6 font-weight-bold">Montant du pret :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="MontantEmprunteur">{{ $simulationData['montant'] ?? '-' }} Fcfa</dd>

                                    <dt class="col-sm-6 font-weight-bold">Durée (mois) :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="delayEmprunteur">{{ $simulationData['duree'] ?? '-' }}</dd>

                                    <dt class="col-sm-6 font-weight-bold">Prime Déces emprunteur :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="primeEmprunteur">{{ number_format($simulationData['primeEmprunteur'] ?? '0', 2) }} Fcfa</dd>

                                    <dt class="col-sm-6 font-weight-bold">Prime :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="primeEmprunteur">{{ number_format($simulationData['prime'] ?? '0', 2) }} Fcfa</dd>

                                    <dt class="col-sm-6 font-weight-bold">Prime Yako obseque :</dt>
                                    <dd class="col-sm-6 font-weight-bold" id="primeObseque">{{ number_format($simulationData['primeObseque'] ?? '0', 2)  }} Fcfa</dd>

                                    <hr>

                                    <div class="">
                                        <div class="card shadow position-relative">
                                            <div class="ribbon position-absolute top-0 start-0 bg-danger text-white px-3  py-1">
                                                Total
                                            </div>
                                            <!-- Contenu principal -->
                                            <div class="card-body text-center mt-3">
                                                <p class="display-6 fw-bold" id="totalPremium" style="color: #076633">{{ number_format($simulationData['primeFinal'] ?? '0', 2) }} Fcfa</p>
                                            </div>
                                        </div>
                                    </div>

                                </dl>
                                
                            </div>
                        </div>
                    </div>
                
                    <div class="card mt-4">
                        <div class="stepper p-3">
                            <div class="step active" data-step="1">
                                <div class="circle">1</div>
                                <div>Informations sur l'adhérent</div>
                            </div>
                            <div class="step" data-step="2">
                                <div class="circle">2</div>
                                <div>Détails de la cotation</div>
                            </div>
                            <div class="step" data-step="3">
                                <div class="circle">3</div>
                                <div>Questionnaire sur l'état de santé</div>
                            </div>
                            <div class="step" data-step="4">
                                <div class="circle">4</div>
                                <div>Bénéficiaire garantie YAKO</div>
                            </div>
                            <div class="step" data-step="5">
                                <div class="circle">5</div>
                                <div>Résumé/Choix d'un médecin</div>
                            </div>
                            <div class="step" data-step="6">
                                <div class="circle">6</div>
                                <div>Documents</div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
           </div>
        </div>
    </div>





    

    <script>
        function updateFullName() {
            const firstNameValue = document.getElementById("FisrtName").value.trim();
            const lastNameValue = document.getElementById("LastName").value.trim();
            const fullName = firstNameValue && lastNameValue ? `${firstNameValue} ${lastNameValue}` : "-";
            document.getElementById("FullName").textContent = fullName;
        }

        // Ajout des événements sur les deux champs
        document.getElementById("FisrtName").addEventListener("input", updateFullName);
        document.getElementById("LastName").addEventListener("input", updateFullName);
    </script>




</div>


    {{-- <multi-step-form></multi-step-form> --}}

    {{-- <script>
        window.villes = @json($villes); // Encode les données en JSON
    </script> --}}
    
@endsection

    



    

