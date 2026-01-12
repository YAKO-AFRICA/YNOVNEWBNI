@extends('layouts.main')
@section('content')

<div class="page-container">
    <div class="page-header py-4 px-3 mb-4 bg-light border-1 border border-dark d-flex justify-content-center align-items-center">
        <h1 class="page-title text-center align-middle">
            <i class="fas fa-plus-circle me-2"></i>Formulaire de souscription
        </h1>
    </div>
    
    <!-- Bloc produit principal -->
    <div class="product-block mx-3 mb-4">
        <div class="card mb-4">
            
            
            

            <section>
                <div class="section-title">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-box me-2"></i>1. Sélection du Produit
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Zone de sélection de produit (visible par défaut) -->
                    <div id="product-selection-zone" class="product-selection-zone">
                        <h6 class="text-primary mb-2">Sélectionnez un produit</h6>
                        <p class="text-muted small mb-4">
                            <i class="fas fa-info-circle me-1"></i>
                            Veuillez sélectionner un produit pour passer à l'étape suivante
                        </p>
                        
                        <div class="row g-3">
                            <!-- Produits qui intéressent le prospect -->
                            @foreach($products as $product)
                            <div class="col-md-4 col-lg-3">
                                <div class="card product-card h-100 border-2 border border-primary"
                                    data-product-uuid="{{ $product->product_uuid }}"
                                    data-product-code="{{ $product->itemProduct->CodeProduit }}">
                                    
                                    <div class="card-body text-center py-4">
                                        <div class="product-icon mb-3">
                                            <i class="fas fa-box fa-2x text-primary"></i>
                                        </div>
                                        <h6 class="product-title mb-2">
                                            {{ $product->itemProduct->MonLibelle }}
                                        </h6>
                                        <p class="product-code small text-muted mb-2">
                                            Code: {{ $product->itemProduct->CodeProduit }}
                                        </p>
                                        
                                        <div class="product-details small text-start mb-3" style="display: none;">
                                            <!-- Détails spécifiques au produit -->
                                            @if(isset($product->itemProduct->description))
                                            <p class="mb-1">
                                                <i class="fas fa-info-circle text-primary fa-xs me-1"></i>
                                                {{ Str::limit($product->itemProduct->description, 80) }}
                                            </p>
                                            @endif
                                            
                                            @if(isset($product->itemProduct->AgeMiniAdh))
                                            <p class="mb-0">
                                                <i class="fas fa-tag text-primary fa-xs me-1"></i>
                                                Catégorie: {{ $product->itemProduct->AgeMiniAdh }}
                                            </p>
                                            @endif
                                        </div>
                                        
                                        <button class="btn btn-outline-primary btn-sm toggle-details mt-2">
                                            <i class="fas fa-chevron-down me-1"></i>Détails
                                        </button>
                                    </div>
                                    
                                    <div class="card-footer bg-transparent border-top-0 pt-0">
                                        
                                        <button class="btn btn-outline-primary w-100 btn-select-product">
                                            <i class="fas fa-check me-1"></i>Sélectionner
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <!-- Option pour ajouter un produit non listé -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100 border-dashed d-flex align-items-center justify-content-center text-center p-4">
                                    <div class="card-body">
                                        <div class="add-product-icon mb-3">
                                            <i class="fas fa-plus-circle fa-2x text-muted"></i>
                                        </div>
                                        <h6 class="mb-2">Autre produit</h6>
                                        <p class="small text-muted mb-3">
                                            Sélectionnez un produit qui ne fait pas partie de la liste
                                        </p>
                                        <button class="" data-bs-toggle="modal" data-bs-target="#otherProductModal">
                                            <i class="fadeIn animated bx bx-plus fs-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Champ caché pour le produit sélectionné -->
                        <input type="hidden" name="produit_selected" id="selectedProduct" value="">
                    </div>
                </div>
            </section>

            <section>
                <div class="section-title">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-box me-2"></i>2. Simulateur de prime
                        </h5>
                    </div>
                </div>

                <!-- Zone simulateur (cachée par défaut) -->
                <div id="product-simulator-zone" class="product-simulator-zone" style="display: none;">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3">
                        <div>
                            <h6 class="mb-1">Produit sélectionné</h6>
                            <p class="mb-0 text-muted small" id="selected-product-name">
                                
                            </p>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="change-product">
                            <i class="fas fa-exchange-alt me-1"></i>Changer
                        </button>
                    </div>
                    
                    <!-- Contenu du simulateur -->
                    <div class="simulator-content border rounded p-3 bg-light">
                       

                        @include('productions.create.simulateur.partials.doihoInclude')
                    </div>
                </div>
            </section>
            
            <div class="card-body">

                <div class="" id="form-content" style="display: none;">

                    {{-- formulaire dynamique ici  --}}
                    <div id="dynamic-form">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <div class="row g-3 mb-3">
                                        <div class="col-6">
                                            <label class="form-label">Civilité <span class="star">*</span></label> <br>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Madame" autocomplete="on" required data-invalid-message="Veuillez cocher la civilité">
                                                <label class="form-check-label" for="inlineRadio1">Madame</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Mademoiselle" autocomplete="on" required>
                                                <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio3" value="Monsieur" autocomplete="on" required>
                                                <label class="form-check-label" for="inlineRadio3">Monsieur</label>
                                            </div>
                                            @error('civilite')
                                                <span class="text-danger"> Veuillez cocher la civilité </span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Situation matrimoniale <span class="star">*</span></label><br>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="celibataire" value="CELIB" required>
                                                <label class="form-check-label" for="celibataire">Célibataire</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="union_libre" value="union_libre" required>
                                                <label class="form-check-label" for="union_libre">En Concubinage</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="marie" value="MARIE" required>
                                                <label class="form-check-label" for="marie">Marié(e)</label>
                                            </div>
                                            

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="divorce" value="DIVOR" required>
                                                <label class="form-check-label" for="divorce">Divorcé(e)</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="situation_matrimoniale" id="veuf" value="VEUVE" required>
                                                <label class="form-check-label" for="veuf">Veuf(ve)</label>
                                            </div>

                                            @error('situation_matrimoniale')
                                                <span class="text-danger">Veuillez sélectionner une situation matrimoniale.</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="FisrtName" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" name="nom" class="form-control" id="FisrtName" placeholder="Nom" autocomplete="on" required>
                                            @error('nom')
                                                <span class="text-danger">Veuillez remplir le champ nom</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="LastName" class="form-label">Prénoms <span class="text-danger">*</span></label>
                                            <input type="text" name="prenom" class="form-control" id="LastName" placeholder="Prénoms" autocomplete="on" required>
                                            @error('prenom')
                                                <span class="text-danger">Veuillez remplir le champ prenom</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="Date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                            <input type="date" name="datenaissance" class="form-control" id="Date_naissance"
                                                placeholder="Date de naissance" autocomplete="on" required>

                                                <span class="text-danger date-error"></span>

                                            @error('datenaissance')
                                                <span class="text-danger"> Veuillez remplir la date de naissance </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-12 col-lg-6">
                                            <label for="lieunaissance" class="form-label">Lieu de naissance</label>
                                            <select class="form-select selection" name="lieunaissance" id="lieunaissance"
                                                 data-placeholder="Sélectionner le lieu" autocomplete="on">
                                                <option value="" disabled selected>Sélectionner le lieu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!---end row-->
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="" class="form-label">Nature de la pièce <span class="text-danger">*</span></label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="naturepiece" id="CNI" value="CNI" autocomplete="on" required>
                                                <label class="form-check-label" for="CNI">CNI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="naturepiece" id="Atestation" value="AT" autocomplete="on" required>
                                                <label class="form-check-label" for="Atestation">Attestation </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="naturepiece" id="Passport" value="Passport" autocomplete="on" required>
                                                <label class="form-check-label" for="Passport">Passeport</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="naturepiece" id="CarteConsulaire" value="CarteConsulaire" autocomplete="on" required>
                                                <label class="form-check-label" for="CarteConsulaire">Carte Consulaire</label>
                                            </div>

                                            @error('naturepiece')
                                                <span class="text-danger"> Veuillez cocher la nature de la pièce </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="numeropiece" class="form-label">Numéro de la pièce<span class="text-danger">*</span></label>
                                            <input type="text" name="numeropiece" class="form-control" id="numeropiece"
                                                placeholder="Nature de la pièce d'identité" autocomplete="on" required>

                                            @error('numeropiece')
                                                <span class="text-danger"> Veuillez remplir le numéro de la pièce </span>

                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="lieuresidence" class="form-label">Lieu de résidence <span class="text-danger">*</span></label>
                                            <select class="form-select selection" name="lieuresidence" id="lieuresidence" autocomplete="on" required>
                                                <option value="" disabled selected>Sélectionner le lieu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="profession" class="form-label">Profession</label>
                                            <select class="form-select selection" name="profession" id="profession" autocomplete="on">
                                                <option value="" disabled selected>Sélectionner la profession</option>

                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="employeur" class="form-label">Secteur d’activité</label>
                                            <select class="form-select selection" name="employeur" id="employeur" autocomplete="on">
                                                <option value="" disabled selected>Sélectionner le secteur d’activité</option>

                                                {{-- @foreach($secteurActivites as $secteurActivite)
                                                    <option value="{{ $secteurActivite->MonLibelle }}">{{ $secteurActivite->MonLibelle }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="on" required>

                                            @error('email')

                                                <span class="text-danger"> Veuillez remplir votre email </span>

                                            @enderror
                                        </div>
                                    </div>
                                    <fieldset class="border p-3">
                                        <legend class="float-none w-auto px-2"><small>Contact</small></legend>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <label for="cell1" class="form-label">Cell 1 <span class="text-danger">*</span></label>
                                                <input type="tel" name="cell1" class="form-control" id="cell1" placeholder="+225 00 00 00 00" autocomplete="on" required>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label for="cell2" class="form-label">Cell 2</label>
                                                <input type="tel" name="cell2" class="form-control" id="cell2" placeholder="+225 00 00 00 00" autocomplete="on">
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label for="cell3" class="form-label">Tél Fixe :</label>
                                                <input type="tel" name="cell3" class="form-control" id="cell3" placeholder="+225 00 00 00 00" autocomplete="on">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 mt-3">
                                                <label for="whatsapp" class="form-label">N ° Whathapp :</label>
                                                <input type="tel" name="whatsapp" class="form-control" id="whatsapp" placeholder="n°whatsapp" autocomplete="on">
                                            </div>
                                            <div class="col-sm-12 col-md-6 mt-3">
                                                <label for="refSocial" class="form-label">Référence réseaux sociaux :</label>
                                                <input type="tel" name="refSocial" class="form-control" id="refSocial" placeholder="reseau social" autocomplete="on">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <fieldset class="border p-3">
                                        <legend class="float-none w-auto px-2"><small>Garantie</small></legend>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <label for="prime" class="form-label">Prime/Périodicité <span class="text-danger">*</span></label>
                                                <input type="text" name="prime" class="form-control" id="prime" value="5000" autocomplete="on" required readonly>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label for="capital" class="form-label">Capital</label>
                                                <input type="text" name="capital" class="form-control" id="capital" value="1000000" autocomplete="on" required readonly>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label for="duree" class="form-label">Duree :</label>
                                                <input type="tel" name="duree" class="form-control" id="duree" value="8" autocomplete="on" required readonly>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="form-group row">
    <div class="col-sm-12 col-md-6">
        <label for="" class="form-label">Je souhaite payer mes primes par : <span class="text-danger">*</span></label>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="modepaiement" type="radio" value="VIR" id="Virement_bancaire" required>
                <label class="form-check-label" for="Virement_bancaire">
                    Virement bancaire
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="modepaiement" type="radio" value="ESP" id="Espece">
                <label class="form-check-label" for="Espece">
                    Espèce
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="modepaiement" type="radio" value="CHK" id="Cheque">
                <label class="form-check-label" for="Cheque">
                    Chèque
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="modepaiement" type="radio" value="Mobile_money" id="Mobile_money">
                <label class="form-check-label" for="Mobile_money">
                    Mobile money
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="modepaiement" type="radio" value="SOURCE" id="Prelevement_source">
                <label class="form-check-label" for="Prelevement_source">
                    Prélèvement à la source
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="modepaiement" type="radio" value="BANK" id="Prelevement_bank">
                <label class="form-check-label" for="Prelevement_bank">
                    Prélèvement bancaire
                </label>
            </div>
        </div>
    </div>
</div>

<!-- Zone d'informations selon le mode de paiement -->
<div class="form-group row" id="payment-details-container" style="display: none;">
    <div class="col-sm-12">
        <div id="payment-details">
            <!-- Mobile Money -->
            <div id="mobile-money-section" class="payment-section" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <label for="mobile-number" class="form-label">Numéro de téléphone Mobile Money <span class="text-danger">*</span></label>
                        <input type="text" id="mobile-number" class="form-control" placeholder="Ex: 0612345678" maxlength="10">
                        <small class="text-muted">Format: 10 chiffres (ex: 0612345678)</small>
                    </div>
                </div>
            </div>
            
            <!-- Informations bancaires (RIB) -->
            <div id="bank-info-section" class="payment-section" style="display: none;">
                <div class="rib-form-container">
                    <style>
                        .rib-form {
                            font-family: Arial, sans-serif;
                            padding: 20px;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            background-color: #f9f9f9;
                            margin-top: 10px;
                        }
                        
                        .rib-form .form-group {
                            margin-bottom: 15px;
                        }
                        
                        .rib-form .form-group label {
                            display: block;
                            margin-bottom: 5px;
                            font-weight: bold;
                            color: #333;
                        }
                        
                        .rib-form .form-group input {
                            width: 100%;
                            padding: 8px 12px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            font-size: 14px;
                        }
                        
                        .rib-form .form-group input:focus {
                            outline: none;
                            border-color: #4a90e2;
                            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
                        }
                        
                        .rib-preview {
                            margin-top: 20px;
                            padding: 15px;
                            background-color: white;
                            border: 1px dashed #ccc;
                            border-radius: 4px;
                            font-family: monospace;
                            font-size: 14px;
                            line-height: 1.5;
                        }
                        
                        .rib-preview .empty {
                            color: #999;
                            font-style: italic;
                        }
                        
                        .rib-preview .filled {
                            color: #2c3e50;
                            font-weight: 500;
                        }
                        
                        .preview-title {
                            font-weight: bold;
                            margin-bottom: 8px;
                            color: #555;
                        }
                        
                        .preview-line {
                            margin: 3px 0;
                        }
                        
                        .payment-section {
                            padding: 15px;
                            background-color: #f8f9fa;
                            border-radius: 6px;
                            border-left: 4px solid #4a90e2;
                        }
                    </style>

                    <div class="rib-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bank-code">Code banque (5 chiffres) <span class="text-danger">*</span></label>
                                    <input type="text" id="bank-code" maxlength="5" placeholder="12345" class="rib-input">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="branch-code">Code guichet (5 chiffres) <span class="text-danger">*</span></label>
                                    <input type="text" id="branch-code" maxlength="5" placeholder="67890" class="rib-input">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account-number">Numéro de compte (11 chiffres) <span class="text-danger">*</span></label>
                                    <input type="text" id="account-number" maxlength="11" placeholder="12345678901" class="rib-input">
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rib-key">Clé RIB (2 chiffres) <span class="text-danger">*</span></label>
                                    <input type="text" id="rib-key" maxlength="2" placeholder="23" class="rib-input">
                                </div>
                            </div>
                        </div>
                        
                        <div class="rib-preview">
                            <div class="preview-title">Aperçu du RIB :</div>
                            <div id="rib-preview-content">
                                <div class="preview-line">Banque : <span id="preview-bank" class="empty">non saisi</span></div>
                                <div class="preview-line">Guichet : <span id="preview-branch" class="empty">non saisi</span></div>
                                <div class="preview-line">Compte : <span id="preview-account" class="empty">non saisi</span></div>
                                <div class="preview-line">Clé RIB : <span id="preview-key" class="empty">non saisie</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Message pour les autres modes -->
            <div id="other-payment-section" class="payment-section" style="display: none;">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Aucune information supplémentaire requise pour ce mode de paiement.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Éléments DOM
    const paymentRadios = document.querySelectorAll('input[name="modepaiement"]');
    const detailsContainer = document.getElementById('payment-details-container');
    const mobileMoneySection = document.getElementById('mobile-money-section');
    const bankInfoSection = document.getElementById('bank-info-section');
    const otherPaymentSection = document.getElementById('other-payment-section');
    
    // Gestionnaires pour les sections bancaires
    const ribInputs = document.querySelectorAll('.rib-input');
    const previewBank = document.getElementById('preview-bank');
    const previewBranch = document.getElementById('preview-branch');
    const previewAccount = document.getElementById('preview-account');
    const previewKey = document.getElementById('preview-key');
    
    // Fonction pour mettre à jour l'aperçu RIB
    function updatePreview() {
        const bankCode = document.getElementById('bank-code').value;
        const branchCode = document.getElementById('branch-code').value;
        const accountNumber = document.getElementById('account-number').value;
        const ribKey = document.getElementById('rib-key').value;
        
        previewBank.textContent = bankCode || 'non saisi';
        previewBank.className = bankCode ? 'filled' : 'empty';
        
        previewBranch.textContent = branchCode || 'non saisi';
        previewBranch.className = branchCode ? 'filled' : 'empty';
        
        previewAccount.textContent = accountNumber || 'non saisi';
        previewAccount.className = accountNumber ? 'filled' : 'empty';
        
        previewKey.textContent = ribKey || 'non saisie';
        previewKey.className = ribKey ? 'filled' : 'empty';
    }
    
    // Validation numérique pour RIB
    ribInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            updatePreview();
        });
        
        input.addEventListener('keyup', updatePreview);
        input.addEventListener('change', updatePreview);
    });
    
    // Validation pour mobile money (uniquement chiffres)
    const mobileNumberInput = document.getElementById('mobile-number');
    if (mobileNumberInput) {
        mobileNumberInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
    
    // Gestion du changement de mode de paiement
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Afficher le conteneur des détails
            detailsContainer.style.display = 'block';
            
            // Masquer toutes les sections
            mobileMoneySection.style.display = 'none';
            bankInfoSection.style.display = 'none';
            otherPaymentSection.style.display = 'none';
            
            // Afficher la section appropriée
            switch(this.value) {
                case 'Mobile_money':
                    mobileMoneySection.style.display = 'block';
                    break;
                    
                case 'VIR':  // Virement bancaire
                case 'CHK':  // Chèque
                case 'BANK': // Prélèvement bancaire
                    bankInfoSection.style.display = 'block';
                    break;
                    
                case 'ESP':   // Espèce
                case 'SOURCE': // Prélèvement source
                    otherPaymentSection.style.display = 'block';
                    break;
            }
        });
    });
    
    // Initialiser l'aperçu RIB
    updatePreview();
    
    // Ajouter un peu de style pour les sections
    const style = document.createElement('style');
    style.textContent = `
        .payment-section {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert {
            margin-bottom: 0;
        }
        
        .bi {
            margin-right: 8px;
        }
    `;
    document.head.appendChild(style);
});
</script>

                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour la recherche d'autres produits -->
@include('prospects.components.modals.selectOtherProduct')

<style>
    .product-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .product-card.selected {
        border-color: #0d6efd !important;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .border-dashed {
        border: 2px dashed #dee2e6 !important;
    }

    .product-card .toggle-details {
        font-size: 0.8rem;
        padding: 0.2rem 0.8rem;
    }

    .simulator-content {
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des boutons de sélection

        document.querySelectorAll('.btn-select-product').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const card = this.closest('.product-card');
                const productUuid = card.getAttribute('data-product-uuid');
                const productCode = card.getAttribute('data-product-code');
                const productName = card.querySelector('.product-title').textContent.trim();
                
                // Mettre à jour le champ caché
                document.getElementById('selectedProduct').value = productCode;
                
                // Mettre à jour le nom du produit dans le simulateur
                document.getElementById('selected-product-name').textContent = productName;
                
                // Cacher la zone de sélection et afficher le simulateur
                document.getElementById('product-selection-zone').style.display = 'none';
                document.getElementById('product-simulator-zone').style.display = 'block';
                document.getElementById('form-content').style.display = 'none';
                
                // Ici, vous pourriez ajouter un appel AJAX pour charger le simulateur
                // loadSimulator(productUuid);
            });
        });
        
        // Bouton pour changer de produit
        document.getElementById('change-product').addEventListener('click', function() {
            document.getElementById('product-simulator-zone').style.display = 'none';
            document.getElementById('product-selection-zone').style.display = 'block';
            document.getElementById('form-content').style.display = 'none';
        });
        
        // Toggle des détails produit
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const details = this.closest('.product-card').querySelector('.product-details');
                const icon = this.querySelector('i');
                
                if (details.style.display === 'none' || !details.style.display) {
                    details.style.display = 'block';
                    icon.className = 'fas fa-chevron-up me-1';
                } else {
                    details.style.display = 'none';
                    icon.className = 'fas fa-chevron-down me-1';
                }
            });
        });
        
        // Sélection au clic sur la carte
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.toggle-details') && !e.target.closest('.btn-select-product')) {
                    const selectBtn = this.querySelector('.btn-select-product');
                    if (selectBtn && !selectBtn.disabled) {
                        selectBtn.click();
                    }
                }
            });
        });
    });
</script>

<script>
    // function de recuperation des donnée de simulation 
    function getSimulationData() {

        const blockForm = document.getElementById('form-content');
        const blockSimulator = document.getElementById('product-simulator-zone');
        
        const data = sessionStorage.getItem('simulationData');

        blockForm.style.display = 'block';
        blockSimulator.style.display = 'none';

        return data ? JSON.parse(data) : null;
    }
</script>


@endsection
