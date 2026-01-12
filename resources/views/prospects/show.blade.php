@extends('layouts.main')

@section('content')
    <style>
        .prospect-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .prospect-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1rem;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .prospect-name {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .prospect-code {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 0.8rem;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
        }

        .info-section {
            padding: 1.5rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eaeaea;
            color: var(--primary-color);
        }

        .info-item {
            display: flex;
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .info-item:hover {
            background-color: var(--light-bg);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .info-icon.primary {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .info-icon.success {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }

        .info-icon.warning {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--warning-color);
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 500;
            color: #333;
        }

        .empty-value {
            color: #adb5bd;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .btn-action {
            flex: 1;
            padding: 0.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        @media (max-width: 768px) {
            .prospect-header {
                text-align: center;
            }

            .status-badge {
                position: static;
                display: inline-block;
                margin-top: 0.5rem;
            }
        }
    </style>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('prospect.index') }}">Prospects</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $prospect->code }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="container-fluid">
            <!-- Header avec actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <a href="{{ route('prospect.index') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Retour
                        </a>
                        <div class="d-flex gap-2 flex-wrap">
                            {{-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="bx bx-edit me-1"></i> Modifier
                            </button>
                            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#assignToModal">
                                <i class="bx bx-user-check me-1"></i> Assigner
                            </button> --}}
                            <a href="{{ route('prospect.convert.form', $prospect->uuid) }}" class="btn btn-outline-success">
                                <i class="bx bx-transfer me-1"></i> Convertir en client
                            </a>
                            {{-- <a href="tel:{{ $prospect->mobile }}" class="btn btn-outline-info">
                                <i class="bx bx-phone me-1"></i> Appeler
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Colonne principale -->
                <div class="col-lg-8">
                    <!-- Carte principale - Informations du prospect -->
                    <div class="card border-0 shadow-sm prospect-card mb-4">
                        <div class="card-body p-4">
                            <div class="prospect-card">
                                <div class="prospect-header">
                                    <div class="profile-avatar">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <h2 class="prospect-name text-center text-white">{{ $prospect->prenom ?? '' }}
                                        {{ $prospect->nom ?? '' }}</h2>
                                    <div class="text-center">
                                        <span class="prospect-code">
                                            <i class="bi bi-hash"></i> {{ $prospect->code ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <span class="status-badge bg-light text-dark">
                                        {{ ucfirst($prospect->status ?? 'nouveau') }}
                                    </span>
                                </div>

                                <div class="info-section">
                                    <!-- Informations personnelles -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-person-vcard me-2"></i>Informations personnelles
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon primary">
                                                        <i class="bi bi-gender-ambiguous"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Genre</div>
                                                        <div class="info-value">
                                                            {{ $prospect->genre ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon success">
                                                        <i class="bi bi-balloon"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Date de naissance</div>
                                                        <div class="info-value">
                                                            {{ Carbon\Carbon::parse($prospect->date_naissance)->locale('fr_FR')->translatedFormat('l j F Y') ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon warning">
                                                        <i class="bi bi-geo-alt"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Lieu de naissance</div>
                                                        <div class="info-value">
                                                            {{ $villesMap[$prospect->lieu_naissance] ?? ($prospect->lieu_naissance ?? 'Non renseigné') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon primary">
                                                        <i class="bi bi-heart"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Situation matrimoniale</div>
                                                        <div class="info-value">
                                                            {{ $prospect->situation_matrimoniale ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pièce d'identité -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-card-text me-2"></i>Pièce d'identité
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon success">
                                                        <i class="bi bi-card-heading"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Type de pièce</div>
                                                        <div class="info-value">
                                                            {{ $prospect->type_piece_identite ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon warning">
                                                        <i class="bi bi-123"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Numéro de pièce</div>
                                                        <div class="info-value">
                                                            {{ $prospect->numero_piece_identite ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Coordonnées -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-geo me-2"></i>Coordonnées
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon primary">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Email</div>
                                                        <div class="info-value">
                                                            {{ $prospect->email ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="info-item">
                                                    <div class="info-icon success">
                                                        <i class="bi bi-house"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Adresse complète</div>
                                                        <div class="info-value">
                                                            {{ $prospect->adresse ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon warning">
                                                        <i class="bi bi-geo-alt"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Lieu de résidence</div>
                                                        <div class="info-value">
                                                            {{ $villesMap[$prospect->lieu_residence] ?? ($prospect->lieu_residence ?? 'Non renseigné') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon primary">
                                                        <i class="bi bi-globe"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Pays</div>
                                                        <div class="info-value">
                                                            {{ $prospect->pays ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <!-- Contacts -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-briefcase me-2"></i>Contacts
                                        </h4>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="info-item">
                                                    <div class="info-icon success">
                                                        <i class="bi bi-telephone"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Téléphone</div>
                                                        <div class="info-value">

                                                            @foreach ($prospect->contacts as $contact)
                                                                @php
                                                                    $type = $contact->contactType ?? 'Non renseigné';
                                                                    $badge =
                                                                        $badgeColors[$contact->contactType] ??
                                                                        'secondary';
                                                                @endphp

                                                                <p>
                                                                    <span class="badge bg-{{ $badge }}">
                                                                        {{ ucfirst($type) }}
                                                                    </span>
                                                                    : {{ $contact->contact ?? 'Non renseigné' }}
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Profession -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-briefcase me-2"></i>Profession
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="info-item">
                                                    <div class="info-icon warning">
                                                        <i class="bi bi-person-badge"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Profession</div>
                                                        <div class="info-value">
                                                            {{ $prospect->profession ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-item">
                                                    <div class="info-icon primary">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Employeur</div>
                                                        <div class="info-value">
                                                            {{ $prospect->employeur ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-item">
                                                    <div class="info-icon success">
                                                        <i class="bi bi-diagram-3"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Secteur d'activité</div>
                                                        <div class="info-value">
                                                            {{ $prospect->secteur_activite ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Assurés -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-briefcase me-2"></i>Assurés
                                        </h4>

                                        <div class="info-content">
                                            <div class="info-label fw-bold mb-3">Informations de l'assuré</div>

                                            @if (isset($prospect->PartnerProspert) && $prospect->PartnerProspert->count() > 0)
                                                @foreach ($prospect->PartnerProspert as $partner)
                                                    <div class="card mb-2 border shadow-sm">
                                                        <div
                                                            class="card-body py-2 d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="mb-1 text-primary">
                                                                    {{ $partner->civilite ?? '' }}
                                                                    {{ $partner->nom ?? '' }} {{ $partner->prenom ?? '' }}
                                                                </h6>
                                                                <p class="mb-0 text-muted small">
                                                                    <i class="bi bi-envelope"></i>
                                                                    {{ $partner->email ?? 'Non renseigné' }}<br>
                                                                    <i class="bi bi-telephone"></i>
                                                                    {{ $partner->mobile ?? 'Non renseigné' }}
                                                                </p>
                                                            </div>
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#bruceModal{{ $partner->id }}">
                                                                <i class="bi bi-eye"></i>
                                                            </button>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-muted mb-0">
                                                    <i class="bx bx-info-circle"></i> Aucune information d’assuré trouvée
                                                </p>
                                            @endif
                                        </div>
                                    </div>




                                    <!-- Personnes ressources -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-people me-2"></i>Personnes ressources
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon warning">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Personne ressource 1</div>
                                                        <div class="info-value">
                                                            {{ $prospect->personneRessource ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon primary">
                                                        <i class="bi bi-telephone"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Contact ressource 1</div>
                                                        <div class="info-value">
                                                            {{ $prospect->contactRessource ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon success">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Personne ressource 2</div>
                                                        <div class="info-value">
                                                            {{ $prospect->personneRessource2 ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <div class="info-icon warning">
                                                        <i class="bi bi-telephone"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Contact ressource 2</div>
                                                        <div class="info-value">
                                                            {{ $prospect->contactRessource2 ?? 'Non renseigné' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informations supplémentaires -->
                                    <div class="mb-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-info-circle me-2"></i>Informations supplémentaires
                                        </h4>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="info-item">
                                                    <div class="info-icon success">
                                                        <i class="bi bi-sticky"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <div class="info-label">Notes</div>
                                                        <div class="info-value">
                                                            {{ $prospect->notes ?? 'Aucune note' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Produits intéressants -->
                            <div class="mb-3">
                                <h5 class="mb-3 d-flex align-items-center justify-content-between">
                                    <span>
                                        <i class="bx bx-package text-success me-2"></i>
                                        Produits intéressants
                                    </span>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#productAddModal">
                                        <i class="bx bx-plus me-1"></i> Ajouter
                                    </button>
                                </h5>
                                @if (10 > 0)
                                    <div class="d-flex flex-wrap gap-2" id="products-container">
                                        @foreach ($prospect->products as $pProduct)
                                            <span class="badge bg-secondary text-white d-flex align-items-center product-badge" 
                                                id="product-{{ $pProduct->IdProduit }}">
                                                {{ $pProduct->itemProduct->MonLibelle }}
                                                <button class="btn btn-sm btn-link p-0 ms-2 text-white delete-product" 
                                                        data-product-id="{{ $pProduct->itemProduct->IdProduit }}"
                                                        data-prospect-id="{{ $prospect->id }}"
                                                        title="Supprimer ce produit">
                                                    <i class="bx bx-x fs-6"></i>
                                                </button>
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">Aucun produit sélectionné</p>
                                @endif
                            </div>

                            <hr class="my-4">
                            <!-- Notes -->
                            <div class="mb-3">
                                <h5 class="mb-3 d-flex align-items-center">
                                    <i class="bx bx-note text-warning me-2"></i>
                                    Dernières Notes
                                </h5>
                                <div class="bg-light p-3 rounded">
                                    {!! nl2br(e($prospect->note)) ?? 'Aucune note' !!}
                                </div>
                            </div>
                            <hr class="my-4">

                            <!-- Informations de traçabilité -->
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="trace-box">
                                        <h6 class="mb-2 text-success"><i class="bx bx-user-plus me-1"></i> Prospecté</h6>
                                        <p class="mb-1"><strong>Par:</strong>
                                            {{ $prospect->userAdd->membre->nom ?? '' }}
                                            {{ $prospect->userAdd->membre->prenom ?? '' }}</p>
                                        <p class="mb-0"><strong>Le:</strong>
                                            {{ $prospect->created_at->format('d/m/Y') ?? '' }}</p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="trace-box">
                                        <h6 class="mb-2 text-warning"><i class="bx bx-user-check me-1"></i> Assignation
                                        </h6>
                                        @if (!empty($prospect->assign_to))
                                            <p class="mb-1"><strong>Par:</strong>
                                                {{ $prospect->assigned->membre->nom ?? '' }}
                                                {{ $prospect->assigned->membre->prenom ?? '' }}</p>
                                            <p class="mb-1">
                                                <small>{{ Carbon\Carbon::parse($prospect->assign_date)->format('d/m/Y') }}</small>
                                            </p>
                                            <p class="mb-0"><strong>À:</strong>
                                                {{ $prospect->assignTo->membre->nom ?? '' }}
                                                {{ $prospect->assignTo->membre->prenom ?? '' }}</p>
                                        @else
                                            <p class="text-muted text-center mb-0">Aucune assignation</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="trace-box">
                                        <h6 class="mb-2 text-info"><i class="bx bx-refresh me-1"></i> Mise à jour</h6>
                                        @if (!empty($prospect->update_by))
                                            <p class="mb-1"><strong>Par:</strong>
                                                {{ $prospect->updateBy->membre->nom ?? '' }}
                                                {{ $prospect->updateBy->membre->prenom ?? '' }}</p>
                                            <p class="mb-0"><strong>Le:</strong>
                                                {{ $prospect->updated_at->format('d/m/Y') ?? '' }}</p>
                                        @else
                                            <p class="text-muted text-center mb-0">Aucune mise à jour</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historique des suivis -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-3">
                            <h5 class="mb-0 d-flex align-items-center">
                                <span class="icon-box bg-success-subtle text-success me-2">
                                    <i class="bx bx-history"></i>
                                </span>
                                Historique des Relances
                            </h5>
                        </div>
                        <div class="card-body overflow-y-auto" style="max-height: 400px">
                            <div class="timeline">
                                @forelse($prospect->followups as $followup)
                            <div class="timeline-item">
                                <div class="timeline-item-marker">
                                    <div class="timeline-item-marker-indicator bg-{{ $followup->status === 'completed' ? 'success' : ($followup->status === 'canceled' ? 'danger' : 'warning') }}"></div>
                                </div>
                                
                                <div class="timeline-item-content">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="mb-1">
                                            {{ $followup->user->name }} - 
                                            <span class="text-capitalize badge bg-light text-dark">{{ $followup->type }}</span>
                                        </h6>
                                        <small class="text-muted">{{ $followup->followup_date->format('d/m/Y H:i') }}</small>
                                    </div>
                                    
                                    <div class="notes-container">
                                        <p class="mb-1 short-notes">{!! nl2br(e(Str::limit($followup->notes, 100))) !!}</p>
                                        @if (strlen($followup->notes) > 100)
                                            <p class="mb-1 full-notes d-none">{!! nl2br(e($followup->notes)) !!}</p>
                                            <button class="btn btn-sm btn-link toggle-notes p-1 float-end mt-0" data-state="short">
                                                Voir plus <i class="bx bx-chevron-down"></i>
                                            </button>
                                        @endif
                                    </div>
                                    
                                    @if ($followup->next_followup_date)
                                    <small class="text-muted">
                                        <i class="bx bx-calendar-alt text-danger"></i> Prochain suivi: {{ $followup->next_followup_date->format('d/m/Y H:i') }}
                                    </small>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="bx bx-history fs-1 text-muted mb-3"></i>
                                <p class="text-muted">Aucun suivi enregistré pour ce prospect</p>
                            </div>
                            @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne secondaire -->
                <div class="col-lg-4">
                    <!-- Formulaire de suivi -->
                    <div class="card border-0 shadow-sm mb-4 hover-card">
                        <div class="card-header bg-transparent border-0 pt-4 pb-3">
                            <h5 class="mb-0 d-flex align-items-center">
                                <span class="icon-box bg-warning-subtle text-warning me-2">
                                    <i class="bx bx-message-square-add"></i>
                                </span>
                                Nouvelle Relance
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('prospect.followup.store', $prospect->uuid) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Type de contact</label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="type" id="type_call"
                                            value="call" checked>
                                        <label class="btn btn-outline-success" for="type_call">
                                            <i class="bx bx-phone"></i> Appel
                                        </label>

                                        <input type="radio" class="btn-check" name="type" id="type_email"
                                            value="email">
                                        <label class="btn btn-outline-success" for="type_email">
                                            <i class="bx bx-envelope"></i> Email
                                        </label>

                                        <input type="radio" class="btn-check" name="type" id="type_meeting"
                                            value="meeting">
                                        <label class="btn btn-outline-success" for="type_meeting">
                                            <i class="bx bx-calendar"></i> RDV
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="notes" name="notes" rows="5" required
                                        placeholder="Détails de l'échange..."></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="followup_date" class="form-label">Date du contact <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="followup_date"
                                        name="followup_date" required value="{{ now()->format('Y-m-d\TH:i') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="next_followup_date" class="form-label">Prochain suivi</label>
                                    <input type="datetime-local" class="form-control" id="next_followup_date"
                                        name="next_followup_date">
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Statut</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="completed">Terminé</option>
                                        <option value="pending">À suivre</option>
                                        <option value="canceled">Annulé</option>
                                    </select>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bx bx-save me-2"></i> Enregistrer le suivi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @include('prospects.assignModal') --}}
        @include('prospects.addProductModal')
        {{-- @include('prospects.editModal') --}}
    </div>

    @foreach ($prospect->PartnerProspert as $partner)
        @include('prospects.components.modals.showActor', ['partner' => $partner])
    @endforeach

    <style>
        /* Variables de couleurs */
        :root {
            --success-color: #28a745;
            --success-light: #d4edda;
            --warning-color: #fd7e14;
            --warning-light: #fff3cd;
        }

        /* Carte prospect principale */
        .prospect-card {
            border-left: 4px solid var(--success-color) !important;
            transition: all 0.3s ease;
        }

        .prospect-card:hover {
            transform: translateY(-2px);
        }

        .prospect-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--success-color), var(--warning-color));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            padding: 0.5rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .info-item:hover {
            background-color: #f8f9fa;
        }

        .info-item i {
            font-size: 1.5rem;
            margin-top: 0.25rem;
        }

        /* Cards avec hover effect */
        .hover-card {
            transition: all 0.3s ease;
            border-radius: 12px !important;
            overflow: hidden;
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
        }

        /* Icon box */
        .icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .bg-success-subtle {
            background-color: var(--success-light) !important;
        }

        .bg-warning-subtle {
            background-color: var(--warning-light) !important;
        }

        /* Trace boxes */
        .trace-box {
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            border-left: 3px solid var(--success-color);
            height: 100%;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 1rem;
            margin: 0 0 0 1rem;
            border-left: 2px solid #dee2e6;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item-marker {
            position: absolute;
            left: -1.5rem;
            width: 1rem;
            height: 1rem;
            margin-top: 0.25rem;
        }

        .timeline-item-marker-indicator {
            width: 12px;
            height: 12px;
            border-radius: 100%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #dee2e6;
        }

        .timeline-item-content {
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
        }

        .timeline-item-content:hover {
            background-color: #e9ecef;
            transform: translateX(4px);
        }

        /* Notes container */
        .notes-container {
            position: relative;
        }

        .toggle-notes {
            font-size: 0.85rem;
            text-decoration: none;
        }

        .toggle-notes i {
            transition: transform 0.3s ease;
        }

        .toggle-notes[data-state="full"] i {
            transform: rotate(180deg);
        }

        /* Buttons */
        .btn-group .btn {
            flex: 1;
        }

        .btn-check:checked+.btn-outline-success {
            background-color: var(--success-color);
            color: white;
            border-color: var(--success-color);
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-outline-success {
            color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-outline-success:hover {
            background-color: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }

        /* Product badges */
        .product-badge {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .product-badge:hover {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .prospect-avatar {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.4s ease-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion de la suppression des produits
            document.querySelectorAll('.delete-product').forEach(button => {
                button.addEventListener('click', async function() {
                    const productId = this.getAttribute('data-product-id');
                    const prospectId = this.getAttribute('data-prospect-id');
                    const badgeElement = this.closest('.product-badge');

                    if (!confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
                        return;
                    }

                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>';
                    this.disabled = true;

                    try {
                        const response = await fetch(
                            `/prospect/${prospectId}/products/${productId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });

                        const data = await response.json();

                        if (!response.ok) throw new Error(data.message ||
                            'Erreur lors de la suppression');

                        badgeElement.style.transition = 'all 0.3s ease';
                        badgeElement.style.opacity = '0';
                        badgeElement.style.transform = 'scale(0.8)';

                        setTimeout(() => {
                            badgeElement.remove();

                            const container = document.getElementById(
                                'products-container');
                            if (container && container.children.length === 0) {
                                container.insertAdjacentHTML('afterend',
                                    '<p class="text-muted">Aucun produit sélectionné</p>'
                                );
                            }
                        }, 300);

                    } catch (error) {
                        console.error('Error:', error);
                        alert(error.message || 'Une erreur est survenue');
                        this.innerHTML = originalHTML;
                        this.disabled = false;
                    }
                });
            });

            // Gestion du toggle des notes
            document.querySelectorAll('.toggle-notes').forEach(button => {
                button.addEventListener('click', function() {
                    const container = this.closest('.notes-container');
                    const shortNotes = container.querySelector('.short-notes');
                    const fullNotes = container.querySelector('.full-notes');

                    if (this.dataset.state === 'short') {
                        shortNotes.classList.add('d-none');
                        fullNotes.classList.remove('d-none');
                        this.innerHTML = 'Voir moins <i class="bx bx-chevron-down"></i>';
                        this.dataset.state = 'full';
                    } else {
                        shortNotes.classList.remove('d-none');
                        fullNotes.classList.add('d-none');
                        this.innerHTML = 'Voir plus <i class="bx bx-chevron-down"></i>';
                        this.dataset.state = 'short';
                    }
                });
            });
        });
    </script>
@endsection
