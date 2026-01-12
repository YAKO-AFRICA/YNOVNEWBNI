@extends('prospects.layouts.main')
@section('content')
<style>
    #signatureLoader {
        padding: 15px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        max-width: 250px;
        margin: 15px auto;
    }

    #successModal {
        z-index: 9999 !important;
    }

    #successModal .modal-content {
        border-radius: 12px;
        text-align: center;
        padding: 20px 10px;
    }

    #successModal .modal-title {
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="header">
        <h1>🎉 Finalisation de la souscription !</h1>
        <p>Confirmez votre signature pour finaliser la souscription.</p>
    </div>

    <!-- SPINNER (masqué au début) -->
    <div id="signatureLoader" class="d-none text-center my-3">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Signature en cours...</p>
    </div>

    <!-- MODAL DE CONFIRMATION -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Souscription réussie</h5>
                </div>

                <div class="modal-body text-center">
                    <p class="mb-3">🎉 Votre souscription a bien été effectuée !</p>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnRedirect" class="btn btn-success w-100">OK</button>
                </div>
            </div>


            
        </div>
    </div>
    
    <div class="card shadow-sm rounded-3" >
        <div class="card-header">
            <strong>🧑‍💼 Informations du Prospect/Adhérent</strong>
        </div>
        <div class="card-body row">

            <div class="mb-2 col-sm-6">
                <strong>Nom :</strong> <span>{{ $prospect->nom ?? '' }}</span>
            </div>

            <div class="mb-2 col-sm-6">
                <strong>Prénom :</strong> <span>{{ $prospect->prenom ?? '' }}</span>
            </div>

            <div class="mb-2 col-sm-6">
                <strong>Nature pièce :</strong> <span>{{ $prospect->type_piece_identite ?? '' }}</span>
            </div>

            <div class="mb-2 col-sm-6">
                <strong>Numéro pièce :</strong> <span>{{ $prospect->numero_piece_identite ?? '' }}</span>
            </div>

            <div class="mb-2 col-sm-6">
                <strong>Secteur d'activité :</strong> <span>{{ $prospect->secteur_activite ?? '' }}</span>
            </div>

            <div class="mb-2 col-sm-6">
                <strong>Profession :</strong> <span>{{ $prospect->profession ?? '' }}</span>
            </div>

            <div class="mb-2 col-sm-6">
                <strong>Date de naissance :</strong> <span>{{ $prospect->date_naissance ?? '' }}</span>
            </div>

            <div class="mb-2 col-sm-6">
                <strong>Lieu de résidence :</strong> <span>{{ $prospect->lieu_residence ?? '' }}</span>
            </div>
        </div>
    </div>


    <hr>
    @include('prospects.components.steps.stepSign', ['prospect' => $prospect])
</div>
@endsection