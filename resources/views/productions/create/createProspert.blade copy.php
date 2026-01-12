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
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-box me-2"></i>1. Sélection du Produit
                </h5>
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
                                    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#otherProductModal">
                                        <i class="fas fa-search me-1"></i>Rechercher
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Champ caché pour le produit sélectionné -->
                    <input type="hidden" name="produit_selected" id="selectedProduct" value="">
                </div>
                
                <!-- Zone simulateur (cachée par défaut) -->
                <div id="product-simulator-zone" class="product-simulator-zone" style="display: none;">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-1">Produit sélectionné</h6>
                            <p class="mb-0 text-muted small" id="selected-product-name">
                                Lorem ipsum dolor sit amet.
                                {{-- @if($prospect->produit_uuid)
                                    {{ $prospect->produit->itemProduct->MonLibelle }}
                                @endif --}}
                            </p>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="change-product">
                            <i class="fas fa-exchange-alt me-1"></i>Changer
                        </button>
                    </div>
                    
                    <!-- Contenu du simulateur -->
                    <div class="simulator-content border rounded p-3 bg-light">
                        <div class="text-center py-4">
                            <i class="fas fa-calculator fa-2x text-primary mb-3"></i>
                            <h6 class="mb-2">Simulateur</h6>
                            <p class="text-muted small mb-0">
                                Les options de simulation pour ce produit apparaîtront ici
                            </p>
                        </div>
                        <!-- Ici, vous pouvez ajouter le contenu spécifique au simulateur -->
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
            
            // Ici, vous pourriez ajouter un appel AJAX pour charger le simulateur
            // loadSimulator(productUuid);
        });
    });
    
    // Bouton pour changer de produit
    document.getElementById('change-product').addEventListener('click', function() {
        document.getElementById('product-simulator-zone').style.display = 'none';
        document.getElementById('product-selection-zone').style.display = 'block';
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

























<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user-edit me-2"></i>Modification du Prospect
                        </h4>
                        <span class="badge bg-light text-dark">Code: {{ $prospect->code }}</span>
                    </div>
                </div>
                
                <form action="" method="POST" id="prospectForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <!-- Section 1: Produit et informations générales -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-box me-2"></i>1. Informations Produit
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Produit sélectionné</label>
                                            <select class="form-select" name="produit">
                                                @foreach($products as $product)
                                                    <option value="{{ $product->itemProduct->CodeProduit }}" 
                                                        {{ $prospect->produit_uuid == $product->uuid ? 'selected' : '' }}>
                                                        {{ $product->itemProduct->MonLibelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Informations personnelles -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-user-circle me-2"></i>2. Informations Personnelles
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Civilité -->
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Civilité</label>
                                        <select class="form-select" name="civilite">
                                            <option value="M" {{ $prospect->civilite == 'M' ? 'selected' : '' }}>Monsieur</option>
                                            <option value="Mme" {{ $prospect->civilite == 'Mme' ? 'selected' : '' }}>Madame</option>
                                            <option value="Mlle" {{ $prospect->civilite == 'Mlle' ? 'selected' : '' }}>Mademoiselle</option>
                                        </select>
                                    </div>

                                    <!-- Nom -->
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label">Nom *</label>
                                        <input type="text" class="form-control" name="nom" 
                                               value="{{ $prospect->nom }}" required>
                                    </div>

                                    <!-- Prénom -->
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label">Prénom *</label>
                                        <input type="text" class="form-control" name="prenom" 
                                               value="{{ $prospect->prenom }}" required>
                                    </div>

                                    <!-- Genre -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Genre</label>
                                        <select class="form-select" name="genre">
                                            <option value="M" {{ $prospect->genre == 'M' ? 'selected' : '' }}>Masculin</option>
                                            <option value="F" {{ $prospect->genre == 'F' ? 'selected' : '' }}>Féminin</option>
                                        </select>
                                    </div>

                                    <!-- Date de naissance -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control" name="dateNaissance" 
                                               value="{{ $prospect->dateNaissance }}">
                                    </div>

                                    <!-- Lieu de naissance -->
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label">Lieu de naissance</label>
                                        <input type="text" class="form-control" name="lieuNaissance" 
                                               value="{{ $prospect->lieuNaissance }}">
                                    </div>

                                    <!-- Situation matrimoniale -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Situation matrimoniale</label>
                                        <select class="form-select" name="situationMatrimoniale">
                                            <option value="CELIBATAIRE" {{ $prospect->situationMatrimoniale == 'CELIBATAIRE' ? 'selected' : '' }}>Célibataire</option>
                                            <option value="MARIE" {{ $prospect->situationMatrimoniale == 'MARIE' ? 'selected' : '' }}>Marié(e)</option>
                                            <option value="DIVORCE" {{ $prospect->situationMatrimoniale == 'DIVORCE' ? 'selected' : '' }}>Divorcé(e)</option>
                                            <option value="VEUF" {{ $prospect->situationMatrimoniale == 'VEUF' ? 'selected' : '' }}>Veuf/Veuve</option>
                                        </select>
                                    </div>

                                    <!-- Profession et Employeur -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Profession</label>
                                        <input type="text" class="form-control" name="profession" 
                                               value="{{ $prospect->profession }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Employeur</label>
                                        <input type="text" class="form-control" name="employeur" 
                                               value="{{ $prospect->employeur }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Contacts -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-address-book me-2"></i>3. Coordonnées de Contact
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email" 
                                               value="{{ $prospect->email }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Téléphone mobile</label>
                                        <input type="text" class="form-control" name="mobile" 
                                               value="{{ $prospect->mobile }}">
                                    </div>

                                    <!-- Adresse -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Adresse complète</label>
                                        <textarea class="form-control" name="adresseComplete" rows="2">{{ $prospect->adresseComplete }}</textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Lieu de résidence</label>
                                        <input type="text" class="form-control" name="lieuResidence" 
                                               value="{{ $prospect->lieuResidence }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Pièce d'identité -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-id-card me-2"></i>4. Pièce d'Identité
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Type de pièce</label>
                                        <select class="form-select" name="naturepiece">
                                            <option value="Permis de conduire" {{ $prospect->naturepiece == 'Permis de conduire' ? 'selected' : '' }}>Permis de conduire</option>
                                            <option value="Carte d'identité" {{ $prospect->naturepiece == "Carte d'identité" ? 'selected' : '' }}>Carte d'identité</option>
                                            <option value="Passeport" {{ $prospect->naturepiece == 'Passeport' ? 'selected' : '' }}>Passeport</option>
                                            <option value="Carte de séjour" {{ $prospect->naturepiece == 'Carte de séjour' ? 'selected' : '' }}>Carte de séjour</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Numéro de pièce</label>
                                        <input type="text" class="form-control" name="numeropiece" 
                                               value="{{ $prospect->numeropiece }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Assurés avec modal -->
                        <div class="card mb-4">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-users me-2"></i>5. Assurés
                                    <span class="badge bg-primary ms-2">{{ count($assures) }}</span>
                                </h5>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editAssuresModal">
                                    <i class="fas fa-edit me-1"></i>Gérer les assurés
                                </button>
                            </div>
                            <div class="card-body">
                                @if(count($assures) > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Date naissance</th>
                                                <th>Genre</th>
                                                <th>Lien</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($assures as $assure)
                                            <tr>
                                                <td>{{ $assure->nom }}</td>
                                                <td>{{ $assure->prenom }}</td>
                                                <td>{{ $assure->dateNaissance ? \Carbon\Carbon::parse($assure->dateNaissance)->format('d/m/Y') : '-' }}</td>
                                                <td>
                                                    <span class="badge {{ $assure->genre == 'M' ? 'bg-info' : 'bg-warning' }}">
                                                        {{ $assure->genre == 'M' ? 'M' : 'F' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        @switch($assure->filliation_code)
                                                            @case('CONJOINT') Conjoint @break
                                                            @case('ENFANT') Enfant @break
                                                            @case('PARENT') Parent @break
                                                            @case('AUTRE') Autre @break
                                                        @endswitch
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <p>Aucun assuré enregistré</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Section 6: Bénéficiaires avec modal -->
                        <div class="card mb-4">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-hand-holding-heart me-2"></i>6. Bénéficiaires
                                    <span class="badge bg-success ms-2">{{ count($beneficiaries) }}</span>
                                </h5>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editBeneficiariesModal">
                                    <i class="fas fa-edit me-1"></i>Gérer les bénéficiaires
                                </button>
                            </div>
                            <div class="card-body">
                                @if(count($beneficiaries) > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Date naissance</th>
                                                <th>Genre</th>
                                                <th>Pourcentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($beneficiaries as $beneficiary)
                                            <tr>
                                                <td>{{ $beneficiary->nom }}</td>
                                                <td>{{ $beneficiary->prenom }}</td>
                                                <td>{{ $beneficiary->dateNaissance ? \Carbon\Carbon::parse($beneficiary->dateNaissance)->format('d/m/Y') : '-' }}</td>
                                                <td>
                                                    <span class="badge {{ $beneficiary->genre == 'M' ? 'bg-info' : 'bg-warning' }}">
                                                        {{ $beneficiary->genre == 'M' ? 'M' : 'F' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">{{ $beneficiary->percentage ?? 100 }}%</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-hand-holding-heart fa-2x mb-2"></i>
                                    <p>Aucun bénéficiaire enregistré</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Section 7: Contacts prospect avec modal -->
                        <div class="card mb-4">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-phone-alt me-2"></i>7. Contacts
                                    @php
                                        $contacts = json_decode($prospect->contacts ?? '[]', true) ?: [];
                                    @endphp
                                    <span class="badge bg-info ms-2">{{ count($contacts) }}</span>
                                </h5>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editContactsModal">
                                    <i class="fas fa-edit me-1"></i>Gérer les contacts
                                </button>
                            </div>
                            <div class="card-body">
                                @if(count($contacts) > 0)
                                <div class="row">
                                    @foreach($contacts as $index => $contact)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-info">
                                            <div class="card-body py-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">{{ $contact['contactType'] ?? 'Non spécifié' }}</h6>
                                                        <p class="mb-0 text-muted">{{ $contact['contact'] ?? '' }}</p>
                                                    </div>
                                                    <span class="badge {{ ($contact['etat'] ?? 'ACTIF') == 'ACTIF' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ($contact['etat'] ?? 'ACTIF') == 'ACTIF' ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-phone-alt fa-2x mb-2"></i>
                                    <p>Aucun contact enregistré</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Section 8: Paiement & Périodicité -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-credit-card me-2"></i>8. Paiement & Périodicité
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mode de paiement</label>
                                            <input type="text" class="form-control" 
                                                   value="{{ $prospect->assuranceInfo->modePaiement ?? 'Non spécifié' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Périodicité</label>
                                            <input type="text" class="form-control" 
                                                   value="{{ $prospect->assuranceInfo->periodicite ?? 'Non spécifié' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date d'effet</label>
                                            <input type="text" class="form-control" 
                                                   value="{{ isset($prospect->assuranceInfo->datteEffet) ? \Carbon\Carbon::parse($prospect->assuranceInfo->datteEffet)->format('d/m/Y') : 'Non spécifiée' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Déjà client</label>
                                            <input type="text" class="form-control" 
                                                   value="{{ $prospect->assuranceInfo->dejaClient ?? 'Non spécifié' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">RIB Complet</label>
                                            <input type="text" class="form-control font-monospace" 
                                                   value="{{ $prospect->assuranceInfo->rib ?? 'Non disponible' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 9: Documents -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-file-alt me-2"></i>9. Documents de Souscription
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($prospect->documents as $document)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border-secondary">
                                            <div class="card-body">
                                                <h6 class="card-title text-truncate">{{ $document->fileName }}</h6>
                                                <span class="badge bg-info mb-2">{{ $document->nature }}</span>
                                                <a href="{{ asset('storage/app/public/' . $document->filepath) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-primary w-100">
                                                    <i class="fas fa-eye me-1"></i>Voir le document
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-12 text-center py-4">
                                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucun document enregistré</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Section 10: Signature -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-signature me-2"></i>10. Signature
                                </h5>
                            </div>
                            <div class="card-body">
                                @if(isset($prospect->assuranceInfo->signature))
                                <div class="text-center">
                                    <div class="border rounded p-3 d-inline-block">
                                        <img src="{{ asset('storage/app/public/' . $prospect->assuranceInfo->signature) }}" 
                                             alt="Signature" 
                                             style="max-width: 300px; max-height: 150px;" 
                                             class="img-fluid">
                                    </div>
                                </div>
                                @else
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-signature fa-3x mb-3"></i>
                                    <p>Aucune signature disponible</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Section 11: Notes et Statut -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-sticky-note me-2"></i>11. Informations Complémentaires
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control" name="notes" rows="4">{{ old('notes', $prospect->notes) }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">État</label>
                                        <select class="form-select" name="etat">
                                            <option value="Actif" {{ $prospect->etat == 'Actif' ? 'selected' : '' }}>Actif</option>
                                            <option value="Inactif" {{ $prospect->etat == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                                            <option value="Suspendu" {{ $prospect->etat == 'Suspendu' ? 'selected' : '' }}>Suspendu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Statut</label>
                                        <select class="form-select" name="status">
                                            <option value="prospect" {{ $prospect->status == 'prospect' ? 'selected' : '' }}>Prospect</option>
                                            <option value="client" {{ $prospect->status == 'client' ? 'selected' : '' }}>Client</option>
                                            <option value="ancien_client" {{ $prospect->status == 'ancien_client' ? 'selected' : '' }}>Ancien client</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>Retour
                                    </a>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                            <i class="fas fa-undo me-1"></i>Annuler les modifications
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i>Mettre à jour
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour la gestion des assurés -->
<div class="modal fade" id="editAssuresModal" tabindex="-1" aria-labelledby="editAssuresModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editAssuresModalLabel">
                    <i class="fas fa-users me-2"></i>Gestion des Assurés
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="assuresModalContainer">
                    @foreach($assures as $index => $assure)
                    <div class="card mb-3 assure-item" data-index="{{ $index }}">
                        <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                            <span class="small fw-bold">Assuré #{{ $index + 1 }}</span>
                            <button type="button" class="btn btn-sm btn-danger remove-assure-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small">Nom</label>
                                    <input type="text" class="form-control modal-input" 
                                           name="modal_assures[{{ $index }}][nom]" 
                                           value="{{ $assure->nom }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small">Prénom</label>
                                    <input type="text" class="form-control modal-input" 
                                           name="modal_assures[{{ $index }}][prenom]" 
                                           value="{{ $assure->prenom }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Date naissance</label>
                                    <input type="date" class="form-control modal-input" 
                                           name="modal_assures[{{ $index }}][dateNaissance]" 
                                           value="{{ $assure->dateNaissance }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Genre</label>
                                    <select class="form-select modal-input" 
                                            name="modal_assures[{{ $index }}][genre]">
                                        <option value="M" {{ $assure->genre == 'M' ? 'selected' : '' }}>Masculin</option>
                                        <option value="F" {{ $assure->genre == 'F' ? 'selected' : '' }}>Féminin</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Lien</label>
                                    <select class="form-select modal-input" 
                                            name="modal_assures[{{ $index }}][filliation_code]">
                                        <option value="CONJOINT" {{ $assure->filliation_code == 'CONJOINT' ? 'selected' : '' }}>Conjoint</option>
                                        <option value="ENFANT" {{ $assure->filliation_code == 'ENFANT' ? 'selected' : '' }}>Enfant</option>
                                        <option value="PARENT" {{ $assure->filliation_code == 'PARENT' ? 'selected' : '' }}>Parent</option>
                                        <option value="AUTRE" {{ $assure->filliation_code == 'AUTRE' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                </div>
                                <input type="hidden" class="modal-input" 
                                       name="modal_assures[{{ $index }}][code_partner]" value="ASS">
                                <input type="hidden" class="modal-input" 
                                       name="modal_assures[{{ $index }}][id]" value="{{ $assure->id }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="addAssureInModal" class="btn btn-sm btn-outline-primary w-100">
                    <i class="fas fa-plus me-1"></i>Ajouter un nouvel assuré
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveAssures()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour la gestion des bénéficiaires -->
<div class="modal fade" id="editBeneficiariesModal" tabindex="-1" aria-labelledby="editBeneficiariesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="editBeneficiariesModalLabel">
                    <i class="fas fa-hand-holding-heart me-2"></i>Gestion des Bénéficiaires
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="beneficiariesModalContainer">
                    @foreach($beneficiaries as $index => $beneficiary)
                    <div class="card mb-3 beneficiary-item" data-index="{{ $index }}">
                        <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                            <span class="small fw-bold">Bénéficiaire #{{ $index + 1 }}</span>
                            <button type="button" class="btn btn-sm btn-danger remove-beneficiary-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Nom</label>
                                    <input type="text" class="form-control modal-input" 
                                           name="modal_beneficiaries[{{ $index }}][nom]" 
                                           value="{{ $beneficiary->nom }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Prénom</label>
                                    <input type="text" class="form-control modal-input" 
                                           name="modal_beneficiaries[{{ $index }}][prenom]" 
                                           value="{{ $beneficiary->prenom }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Date naissance</label>
                                    <input type="date" class="form-control modal-input" 
                                           name="modal_beneficiaries[{{ $index }}][dateNaissance]" 
                                           value="{{ $beneficiary->dateNaissance }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Genre</label>
                                    <select class="form-select modal-input" 
                                            name="modal_beneficiaries[{{ $index }}][genre]">
                                        <option value="M" {{ $beneficiary->genre == 'M' ? 'selected' : '' }}>Masculin</option>
                                        <option value="F" {{ $beneficiary->genre == 'F' ? 'selected' : '' }}>Féminin</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small">Pourcentage</label>
                                    <input type="number" class="form-control modal-input" 
                                           name="modal_beneficiaries[{{ $index }}][percentage]" 
                                           value="{{ $beneficiary->percentage ?? 100 }}" min="1" max="100">
                                </div>
                                <input type="hidden" class="modal-input" 
                                       name="modal_beneficiaries[{{ $index }}][code_partner]" value="BEN">
                                <input type="hidden" class="modal-input" 
                                       name="modal_beneficiaries[{{ $index }}][id]" value="{{ $beneficiary->id }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="addBeneficiaryInModal" class="btn btn-sm btn-outline-success w-100">
                    <i class="fas fa-plus me-1"></i>Ajouter un nouveau bénéficiaire
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" onclick="saveBeneficiaries()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour la gestion des contacts -->
<div class="modal fade" id="editContactsModal" tabindex="-1" aria-labelledby="editContactsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editContactsModalLabel">
                    <i class="fas fa-phone-alt me-2"></i>Gestion des Contacts
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="contactsModalContainer">
                    @foreach($contacts as $index => $contact)
                    <div class="card mb-3 contact-item" data-index="{{ $index }}">
                        <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                            <span class="small fw-bold">Contact #{{ $index + 1 }}</span>
                            <button type="button" class="btn btn-sm btn-danger remove-contact-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small">Type de contact</label>
                                    <select class="form-select modal-input" 
                                            name="modal_contacts[{{ $index }}][contactType]">
                                        <option value="">Sélectionnez un type</option>
                                        <option value="Téléphone" {{ ($contact['contactType'] ?? '') == 'Téléphone' ? 'selected' : '' }}>Téléphone</option>
                                        <option value="Mobile" {{ ($contact['contactType'] ?? '') == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                                        <option value="WhatsApp" {{ in_array(strtolower($contact['contactType'] ?? ''), ['whatsapp', 'whats app']) ? 'selected' : '' }}>WhatsApp</option>
                                        <option value="Wave" {{ ($contact['contactType'] ?? '') == 'Wave' ? 'selected' : '' }}>Wave</option>
                                        <option value="Email" {{ ($contact['contactType'] ?? '') == 'Email' ? 'selected' : '' }}>Email</option>
                                        <option value="Facebook" {{ ($contact['contactType'] ?? '') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                        <option value="Instagram" {{ ($contact['contactType'] ?? '') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                        <option value="Autre" {{ ($contact['contactType'] ?? '') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small">Coordonnées</label>
                                    <input type="text" class="form-control modal-input" 
                                           name="modal_contacts[{{ $index }}][contact]" 
                                           value="{{ $contact['contact'] ?? '' }}" 
                                           placeholder="Numéro, email, @...">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">Statut</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input modal-input" type="radio" 
                                                   name="modal_contacts[{{ $index }}][etat]" 
                                                   value="ACTIF" 
                                                   {{ ($contact['etat'] ?? 'ACTIF') == 'ACTIF' ? 'checked' : '' }}>
                                            <label class="form-check-label small">Actif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input modal-input" type="radio" 
                                                   name="modal_contacts[{{ $index }}][etat]" 
                                                   value="INACTIF" 
                                                   {{ ($contact['etat'] ?? '') == 'INACTIF' ? 'checked' : '' }}>
                                            <label class="form-check-label small">Inactif</label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="modal-input" 
                                       name="modal_contacts[{{ $index }}][uuid]" value="{{ $contact['uuid'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="addContactInModal" class="btn btn-sm btn-outline-info w-100">
                    <i class="fas fa-plus me-1"></i>Ajouter un nouveau contact
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-info" onclick="saveContacts()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .form-control[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }
    .assure-item, .beneficiary-item, .contact-item {
        transition: all 0.3s;
    }
    .assure-item:hover, .beneficiary-item:hover, .contact-item:hover {
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.1);
    }
    .modal-header {
        padding: 1rem 1.5rem;
    }
    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }
</style>
@endsection

@section('scripts')
<script>
    // Variables globales pour les index
    let assureModalIndex = {{ count($assures) }};
    let beneficiaryModalIndex = {{ count($beneficiaries) }};
    let contactModalIndex = {{ count($contacts) }};

    // Initialisation des modals
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des modals
        const editAssuresModal = document.getElementById('editAssuresModal');
        if (editAssuresModal) {
            editAssuresModal.addEventListener('show.bs.modal', function () {
                loadModalData('assures');
            });
        }

        const editBeneficiariesModal = document.getElementById('editBeneficiariesModal');
        if (editBeneficiariesModal) {
            editBeneficiariesModal.addEventListener('show.bs.modal', function () {
                loadModalData('beneficiaries');
            });
        }

        const editContactsModal = document.getElementById('editContactsModal');
        if (editContactsModal) {
            editContactsModal.addEventListener('show.bs.modal', function () {
                loadModalData('contacts');
            });
        }

        // Boutons d'ajout dans les modals
        document.getElementById('addAssureInModal').addEventListener('click', addAssureInModal);
        document.getElementById('addBeneficiaryInModal').addEventListener('click', addBeneficiaryInModal);
        document.getElementById('addContactInModal').addEventListener('click', addContactInModal);
    });

    // Fonction pour charger les données dans les modals
    function loadModalData(type) {
        // Cette fonction peut être utilisée pour précharger des données si nécessaire
        console.log(`Chargement des données pour ${type}`);
    }

    // Ajout d'un assuré dans le modal
    function addAssureInModal() {
        const container = document.getElementById('assuresModalContainer');
        const template = `
            <div class="card mb-3 assure-item" data-index="${assureModalIndex}">
                <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                    <span class="small fw-bold">Nouvel assuré</span>
                    <button type="button" class="btn btn-sm btn-danger remove-assure-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Nom</label>
                            <input type="text" class="form-control modal-input" 
                                   name="modal_assures[${assureModalIndex}][nom]">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Prénom</label>
                            <input type="text" class="form-control modal-input" 
                                   name="modal_assures[${assureModalIndex}][prenom]">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Date naissance</label>
                            <input type="date" class="form-control modal-input" 
                                   name="modal_assures[${assureModalIndex}][dateNaissance]">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Genre</label>
                            <select class="form-select modal-input" 
                                    name="modal_assures[${assureModalIndex}][genre]">
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Lien</label>
                            <select class="form-select modal-input" 
                                    name="modal_assures[${assureModalIndex}][filliation_code]">
                                <option value="CONJOINT">Conjoint</option>
                                <option value="ENFANT">Enfant</option>
                                <option value="PARENT">Parent</option>
                                <option value="AUTRE">Autre</option>
                            </select>
                        </div>
                        <input type="hidden" class="modal-input" 
                               name="modal_assures[${assureModalIndex}][code_partner]" value="ASS">
                        <input type="hidden" class="modal-input" 
                               name="modal_assures[${assureModalIndex}][id]" value="">
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
        assureModalIndex++;
    }

    // Ajout d'un bénéficiaire dans le modal
    function addBeneficiaryInModal() {
        const container = document.getElementById('beneficiariesModalContainer');
        const template = `
            <div class="card mb-3 beneficiary-item" data-index="${beneficiaryModalIndex}">
                <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                    <span class="small fw-bold">Nouveau bénéficiaire</span>
                    <button type="button" class="btn btn-sm btn-danger remove-beneficiary-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Nom</label>
                            <input type="text" class="form-control modal-input" 
                                   name="modal_beneficiaries[${beneficiaryModalIndex}][nom]">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Prénom</label>
                            <input type="text" class="form-control modal-input" 
                                   name="modal_beneficiaries[${beneficiaryModalIndex}][prenom]">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Date naissance</label>
                            <input type="date" class="form-control modal-input" 
                                   name="modal_beneficiaries[${beneficiaryModalIndex}][dateNaissance]">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Genre</label>
                            <select class="form-select modal-input" 
                                    name="modal_beneficiaries[${beneficiaryModalIndex}][genre]">
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small">Pourcentage</label>
                            <input type="number" class="form-control modal-input" 
                                   name="modal_beneficiaries[${beneficiaryModalIndex}][percentage]" 
                                   value="100" min="1" max="100">
                        </div>
                        <input type="hidden" class="modal-input" 
                               name="modal_beneficiaries[${beneficiaryModalIndex}][code_partner]" value="BEN">
                        <input type="hidden" class="modal-input" 
                               name="modal_beneficiaries[${beneficiaryModalIndex}][id]" value="">
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
        beneficiaryModalIndex++;
    }

    // Ajout d'un contact dans le modal
    function addContactInModal() {
        const container = document.getElementById('contactsModalContainer');
        const template = `
            <div class="card mb-3 contact-item" data-index="${contactModalIndex}">
                <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                    <span class="small fw-bold">Nouveau contact</span>
                    <button type="button" class="btn btn-sm btn-danger remove-contact-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Type de contact</label>
                            <select class="form-select modal-input" 
                                    name="modal_contacts[${contactModalIndex}][contactType]">
                                <option value="">Sélectionnez un type</option>
                                <option value="Téléphone">Téléphone</option>
                                <option value="Mobile">Mobile</option>
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Wave">Wave</option>
                                <option value="Email">Email</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Coordonnées</label>
                            <input type="text" class="form-control modal-input" 
                                   name="modal_contacts[${contactModalIndex}][contact]" 
                                   placeholder="Numéro, email, @...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Statut</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input modal-input" type="radio" 
                                           name="modal_contacts[${contactModalIndex}][etat]" 
                                           value="ACTIF" checked>
                                    <label class="form-check-label small">Actif</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input modal-input" type="radio" 
                                           name="modal_contacts[${contactModalIndex}][etat]" 
                                           value="INACTIF">
                                    <label class="form-check-label small">Inactif</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="modal-input" 
                               name="modal_contacts[${contactModalIndex}][uuid]" value="">
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
        contactModalIndex++;
    }

    // Suppression des éléments dans les modals
    document.addEventListener('click', function(e) {
        // Assurés
        if (e.target.closest('.remove-assure-btn')) {
            if (confirm('Voulez-vous supprimer cet assuré ?')) {
                e.target.closest('.assure-item').remove();
            }
        }
        // Bénéficiaires
        if (e.target.closest('.remove-beneficiary-btn')) {
            if (confirm('Voulez-vous supprimer ce bénéficiaire ?')) {
                e.target.closest('.beneficiary-item').remove();
            }
        }
        // Contacts
        if (e.target.closest('.remove-contact-btn')) {
            if (confirm('Voulez-vous supprimer ce contact ?')) {
                e.target.closest('.contact-item').remove();
            }
        }
    });

    // Sauvegarde des assurés
    function saveAssures() {
        const modal = document.getElementById('editAssuresModal');
        const inputs = modal.querySelectorAll('.modal-input');
        const assuresData = {};
        
        // Collecter les données du modal
        inputs.forEach(input => {
            const name = input.name;
            if (name && name.includes('modal_assures')) {
                const matches = name.match(/modal_assures\[(\d+)\]\[(\w+)\]/);
                if (matches) {
                    const index = matches[1];
                    const field = matches[2];
                    if (!assuresData[index]) assuresData[index] = {};
                    assuresData[index][field] = input.value;
                }
            }
        });
        
        // Mettre à jour le formulaire principal
        const form = document.getElementById('prospectForm');
        // Supprimer les anciens champs d'assurés
        const oldAssures = form.querySelectorAll('[name^="assures["]');
        oldAssures.forEach(input => {
            if (input.name.includes('assures[')) {
                input.closest('.assure-item')?.remove();
            }
        });
        
        // Ajouter les nouveaux champs
        const assuresContainer = document.getElementById('assures-container');
        if (assuresContainer) {
            assuresContainer.innerHTML = '';
            Object.entries(assuresData).forEach(([index, assure]) => {
                const assureHtml = `
                    <div class="card mb-3 assure-item border-primary">
                        <div class="card-header bg-light py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted">Assuré #${parseInt(index) + 1}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label small">Nom</label>
                                    <input type="text" class="form-control" name="assures[${index}][nom]" value="${assure.nom || ''}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label small">Prénom</label>
                                    <input type="text" class="form-control" name="assures[${index}][prenom]" value="${assure.prenom || ''}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label small">Date naissance</label>
                                    <input type="date" class="form-control" name="assures[${index}][dateNaissance]" value="${assure.dateNaissance || ''}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label small">Genre</label>
                                    <select class="form-select" name="assures[${index}][genre]">
                                        <option value="M" ${assure.genre === 'M' ? 'selected' : ''}>M</option>
                                        <option value="F" ${assure.genre === 'F' ? 'selected' : ''}>F</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label small">Lien</label>
                                    <select class="form-select" name="assures[${index}][filliation_code]">
                                        <option value="CONJOINT" ${assure.filliation_code === 'CONJOINT' ? 'selected' : ''}>Conjoint</option>
                                        <option value="ENFANT" ${assure.filliation_code === 'ENFANT' ? 'selected' : ''}>Enfant</option>
                                        <option value="PARENT" ${assure.filliation_code === 'PARENT' ? 'selected' : ''}>Parent</option>
                                        <option value="AUTRE" ${assure.filliation_code === 'AUTRE' ? 'selected' : ''}>Autre</option>
                                    </select>
                                </div>
                                <input type="hidden" name="assures[${index}][code_partner]" value="ASS">
                                <input type="hidden" name="assures[${index}][id]" value="${assure.id || ''}">
                            </div>
                        </div>
                    </div>
                `;
                assuresContainer.insertAdjacentHTML('beforeend', assureHtml);
            });
        }
        
        // Fermer le modal
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
        
        // Afficher un message de succès
        showToast('Assurés mis à jour avec succès', 'success');
    }

    // Sauvegarde des bénéficiaires
    function saveBeneficiaries() {
        // Implémentation similaire à saveAssures
        const modal = document.getElementById('editBeneficiariesModal');
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
        showToast('Bénéficiaires mis à jour avec succès', 'success');
    }

    // Sauvegarde des contacts
    function saveContacts() {
        // Implémentation similaire à saveAssures
        const modal = document.getElementById('editContactsModal');
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
        showToast('Contacts mis à jour avec succès', 'success');
    }

    // Fonction pour afficher des notifications
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            document.body.appendChild(container);
        }
        
        document.getElementById('toast-container').appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        // Supprimer le toast après sa disparition
        toast.addEventListener('hidden.bs.toast', function () {
            toast.remove();
        });
    }

    // Réinitialisation du formulaire
    function resetForm() {
        if (confirm('Voulez-vous vraiment réinitialiser le formulaire ?')) {
            document.getElementById('prospectForm').reset();
            showToast('Formulaire réinitialisé', 'warning');
        }
    }
</script>
@endsection