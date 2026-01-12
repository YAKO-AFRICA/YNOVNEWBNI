@extends('layouts.main')

@section('content')

<style>
    fieldset {
    border: 1px solid #ddd; /* Bordure grise */
    padding: 1rem; /* Espacement interne */
    margin-bottom: 1rem; /* Espacement externe */
    border-radius: 5px; /* Coins arrondis */
    }

    legend {
        font-size: 1rem;
        padding: 0 10px; /* Espacement autour du texte de la légende */
        color: #333; /* Couleur du texte */
    }

    .input-group-text select {
        width: 100px; /* Largeur ajustée pour le sélecteur */
    }
    .is-valid {
  border: 2px solid green;
  }

</style>
    @php
        $tok = Str::random(80);
        $token = [
            'token' => $tok,
            'operation_type' => "E-SOUSCRIPTION",
            'key_uuid' => $tok
        ];
        $keyUuid = $token['key_uuid'];
        $operationType = $token['operation_type'];
    @endphp

<div class="productions">
    <div id="stepper1{{ $product->CodeProduit }}" class="bs-stepper">
        <div class="card">
            <div class="card-header">
                <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                    <div class="step" data-target="#test-l-1">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger1" aria-controls="test-l-1"> 
                            <div class="bs-stepper-circle">1</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Adhérent</p>
                            </div> 
                        </div> 
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-2">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">2</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Assuré(e)s</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-3">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                            <div class="bs-stepper-circle">3</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Bénéficiaires</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-4">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                            <div class="bs-stepper-circle">4</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Paiement & Périodicité</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-5">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger5" aria-controls="test-l-5">
                            <div class="bs-stepper-circle">5</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Etat de santé</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-6">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger6" aria-controls="test-l-6">
                            <div class="bs-stepper-circle">6</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Résumé</p>
                            </div>
                        </div>
                    </div>

                    <div class="bs-stepper-line align-self-center"></div>
                    <div class="step" data-target="#test-l-7">
                        <div class="step-trigger etape" role="tab" id="stepper1trigger7" aria-controls="test-l-7">
                            <div class="bs-stepper-circle">7</div>
                            <div class="text-center">
                                <p class="mb-0 steper-sub-title">Documents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-body productions">
                <div class="bs-stepper-content card p-3">
                    
                    <form id="productionForm" enctype="multipart/form-data" class="submitFor form">
                        @csrf

                    
                        @include('productions.create.steps.stepAdherent', ['CodeProduit' => $product->CodeProduit])
                        

                    
                    
                        @include('productions.create.steps.stepAssurer', ['CodeProduit' => $product->CodeProduit])

                    
                        @include('productions.create.steps.stepBeneficiaire', ['CodeProduit' => $product->CodeProduit])
                    
                        <input type="hidden" id="assuresInput" name="assures">
                        <input type="hidden" id="beneficiariesInput" name="beneficiaires">
                        <input type="hidden" id="simulationDataInput" name="inputSessionData">
                        <input type="hidden" id="tokGenerate" name="tokGenerate" value="{{ $tok }}">
                        <input type="hidden" id="otpGenerate" name="otpGenerate" value="">

                        <input type="hidden" id="codeproduitvalue" name="codeproduit" value="{{ $product->CodeProduit }}">
                    
                        @include('productions.create.steps.stepPaiementPrime', ['CodeProduit' => $product->CodeProduit])

                        @include('productions.create.steps.stepSante', ['CodeProduit' => $product->CodeProduit])

                        @include('productions.create.steps.stepResume', ['CodeProduit' => $product->CodeProduit])
                    </form>
                   
                    @include('productions.create.steps.stepDocument', ['CodeProduit' => $product->CodeProduit])
                    @include('productions.components.addContactForm')
                </div>
            </div>
        </div>
    </div>

    
</div>
@include('productions.components.searchModal')
@include('productions.create.steps.signModal')

@include('productions.assurer.addModal', ['CodeProduit' => $product->CodeProduit])
@include('productions.beneficiaires.add')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    let garantiesProduct = @json($productGarantie);
</script>

<script>
    const SIGN_API = "{{ config('services.sign_api') }}";
</script>

<script>
    let pollingInterval;

    document.addEventListener("DOMContentLoaded", function () {
        const qrCodeModal = document.getElementById('qrCodeModal');

        if (!qrCodeModal) {
            console.error("Modal #qrCodeModal non trouvé !");
            return;
        }

        qrCodeModal.addEventListener('shown.bs.modal', function () {
            const keyUuid = "{{ $keyUuid }}";
            const operationType = "{{ $operationType }}";

            pollingInterval = setInterval(() => {
                // fetch(`https://apisigntest.yakoafricassur.com/api/check-signature-status/${keyUuid}/${operationType}`)
                fetch(`${SIGN_API}api/check-signature-status/${keyUuid}/${operationType}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Statut de la signature :", data);

                        if (data.status === 'completed') {
                            clearInterval(pollingInterval);

                            const modalInstance = bootstrap.Modal.getInstance(qrCodeModal);
                            if (modalInstance) {
                                modalInstance.hide();
                            }

                            swal.fire({
                                icon: 'success',
                                title: 'Signature terminée avec succès !',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            // alert("Signature terminée avec succès !");
                        }
                    })
                    .catch(error => {
                        console.error("Erreur de polling :", error);
                    });
            }, 3000); // toutes les 3 secondes
        });

        qrCodeModal.addEventListener('hidden.bs.modal', function () {
            console.log("Modal fermé : arrêt du polling.");
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
        });
    });
</script>




<script>
    document.getElementById('Date_naissance').addEventListener('blur', function () {
        const ageMin = parseInt('{{ $product->AgeMiniAdh }}', 10);
        const ageMax = parseInt('{{ $product->AgeMaxiAdh }}', 10);
        const errorBlock = document.querySelector('.date-error');

        const birthDate = new Date(this.value);
        const today = new Date();

        // Vérifie si une date valide est saisie
        if (isNaN(birthDate.getTime())) {
            return;
        }

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        if (age < ageMin || age > ageMax) {
            errorBlock.innerHTML = `L'âge doit être compris entre ${ageMin} et ${ageMax} ans.`;
            this.value = '';
        }else{
            errorBlock.innerHTML = '';
        }

    });
</script>


<script>
    // Récupérer les données depuis sessionStorage
    const simulationData = sessionStorage.getItem("simulationData");

    if (simulationData) {
        document.getElementById("simulationDataInput").value = simulationData;
    }
</script>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("productionForm");
        const btn = document.getElementById("btn-next");

        btn.addEventListener("click", function (event) {
            event.preventDefault();

            const formData = new FormData(form);

            axios.post('{{ route("prod.store") }}', formData)
            .then(function (response) {
                if (response.data.type === "success") {
                    
                    if (response.data.url) {
                        window.open(response.data.url, '_blank');
                    }

                    if (response.data.urlback) {
                        window.location.href = response.data.urlback;
                    }

                    sessionStorage.removeItem("simulationData");
                    sessionStorage.removeItem("simulationData");
                    sessionStorage.removeItem("contacts");
                    sessionStorage.removeItem("contacts");
                } else {
                    throw new Error(response.data.message || "Erreur lors de l'enregistrement.");
                }
            })
            .catch(function (error) {
                console.error(error);
                alert(error.response?.data?.message || "Une erreur est survenue.");
            });
        });
    });


</script>


    



@endsection
