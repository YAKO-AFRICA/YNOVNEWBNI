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
                        <li class="breadcrumb-item active" aria-current="page">Prospect</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('prospect.index') }}">Liste</a>
                        </li> |
                        <li class="breadcrumb-item active" aria-current="page">Detail sur la propection
                            <span>{{ $prospect->code ?? ' ' }}</span></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->


        <div class="container-fluid">
            <div class="row">
                <!-- Colonne principale -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center py-3"
                            style="background-color: #1e4520">
                            <h5 class="m-0 font-weight-bold text-white">Détails du Prospect</h5>
                            <div>
                                <span
                                    class="badge bg-{{ $prospect->status === 'nouveau' ? 'info' : ($prospect->status === 'en_cours' ? 'warning' : 'success') }}">
                                    {{ ucfirst($prospect->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-3">Informations Personnelles</h5>
                                    <p><strong>Code:</strong> {{ $prospect->code ?? '' }}</p>
                                    <p><strong>Nom complet:</strong> {{ $prospect->first_name ?? '' }}
                                        {{ $prospect->last_name ?? '' }}</p>
                                    <p><strong>Téléphone:</strong> {{ $prospect->mobile }}</p>
                                    <p><strong>Email:</strong> {{ $prospect->email ?? 'Non renseigné' }}</p>
                                    <p><strong>Ville:</strong> {{ $prospect->ville->libelleVillle ?? 'Non renseigné' }}</p>
                                    <p><strong>Adresse complete:</strong> {{ $prospect->adress ?? 'Non renseigné' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-3">Informations Professionnelles</h5>
                                    <p><strong>Profession:</strong>
                                        {{ $prospect->profession->MonLibelle ?? 'Non renseigné' }}</p>
                                    <p><strong>Secteur d'activité:</strong>
                                        {{ $prospect->secteurActivity->MonLibelle ?? 'Non renseigné' }}</p>
                                    <p><strong>Nature:</strong> {{ $prospect->natureProspect }}</p>
                                    <p>
                                    <p><strong>Produits intéressants:</strong>
                                        <button class="btn btn-sm p-1">
                                            <span data-bs-toggle="modal" data-bs-target="#productAddModal"> <i
                                                    class="fadeIn animated bx bx-plus-medical text-primary fs-6"></i>
                                                Ajouter</span>
                                        </button>
                                    </p>
                                    @if ($prospect->products->count() > 0)
                                        <div class="d-flex flex-wrap gap-2" id="products-container">
                                            @foreach ($prospect->products as $product)
                                                <span
                                                    class="badge bg-secondary text-white d-flex align-items-center product-badge"
                                                    id="product-{{ $product->IdProduit }}">
                                                    {{ $product->itemProduct->MonLibelle }}


                                                    <button class="btn btn-sm btn-link p-0 ms-2 text-white delete-product"
                                                        data-product-id="{{ $product->itemProduct->IdProduit }}"
                                                        data-prospect-id="{{ $prospect->id }}"
                                                        title="Supprimer ce produit">
                                                        <i class="bx bxs-trash fs-6 p-1 mx-auto"></i>
                                                    </button>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">Aucun produit sélectionné</p>
                                    @endif
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="col-sm-12 col-md-12">
                                <h5>Dernières Notes</h5>
                                <div class="bg-light p-3 rounded">
                                    {!! nl2br(e($prospect->note)) ?? 'Aucune note' !!}
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-12 col-md-4 ">
                                    <fieldset class="m-0 py-0 px-2 bg-light" style="min-height: 110px">
                                        <legend class="float-none w-auto ">
                                            <strong class="border-1">Propecté</strong>
                                        </legend>

                                        <p class="m-0 p-0">
                                            <strong>Par</strong>
                                            <span>{{ $prospect->userAdd->membre->nom ?? '' }}
                                                {{ $prospect->userAdd->membre->prenom ?? '' }}</span>
                                        </p>
                                        <p>
                                            <strong>Le </strong>
                                            <span>{{ $prospect->created_at->format('d-m-Y') ?? '' }}</span>
                                        </p>
                                    </fieldset>
                                </div>


                                <div class="col-sm-12 col-md-4 ">
                                    <fieldset class="m-0 py-0 px-2 bg-light" style="min-height: 110px">
                                        <legend class="float-none w-auto ">
                                            <strong class="border-1">Assignation</strong>
                                        </legend>

                                        @if (!empty($prospect->assign_to))
                                            <p class="m-0 p-0">
                                                <strong>Par</strong>
                                                <span>{{ $prospect->assigned->membre->nom ?? '' }}
                                                    {{ $prospect->assigned->membre->prenom ?? '' }}</span> |
                                                <small>{{ Carbon\Carbon::parse($prospect->assign_date)->format('d-m-Y') }}</small>
                                            </p>
                                            <p>
                                                <strong class="">Assigné à </strong>
                                                <span>{{ $prospect->assignTo->membre->nom ?? '' }}
                                                    {{ $prospect->assignTo->membre->prenom ?? '' }}</span>
                                            </p>
                                        @else
                                            <center>
                                                Aucun assignation
                                            </center>
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="col-sm-12 col-md-4 ">
                                    <fieldset class="m-0 py-0 px-2 bg-light" style="min-height: 110px">
                                        <legend class="float-none w-auto ">
                                            <strong class="border-1">Mise a jour</strong>
                                        </legend>

                                        @if (!empty($prospect->update_by))
                                            <p class="m-0 p-0">
                                                <strong>Par</strong>
                                                <span>{{ $prospect->updateBy->membre->nom ?? '' }}
                                                    {{ $prospect->updateBy->membre->prenom ?? '' }}</span>
                                            </p>
                                            <p>
                                                <strong>Le </strong>
                                                <span>{{ $prospect->updated_at->format('d-m-Y') ?? '' }}</span>
                                            </p>
                                        @else
                                            <center>
                                                Aucun mise a jour
                                            </center>
                                        @endif
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historique des suivis -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: #1e4520">
                            <h5 class="m-0 font-weight-bold text-white">Historique des Relances</h5>
                        </div>
                        <div class="card-body overflow-y-auto" style="max-height: 300px">
                            <div class="timeline">
                                @forelse($prospect->followups as $followup)
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div
                                                class="timeline-item-marker-indicator bg-{{ $followup->status === 'completed' ? 'success' : ($followup->status === 'canceled' ? 'danger' : 'warning') }}">
                                            </div>
                                        </div>

                                        <div class="timeline-item-content">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-1">
                                                    {{ $followup->user->name }} -
                                                    <span class="text-capitalize">{{ $followup->type }}</span>
                                                </h6>
                                                <small
                                                    class="text-muted">{{ $followup->followup_date->format('d/m/Y H:i') }}</small>
                                            </div>

                                            <div class="notes-container">
                                                <p class="mb-1 short-notes">{!! nl2br(e(Str::limit($followup->notes, 100))) !!}</p>
                                                @if (strlen($followup->notes) > 100)
                                                    <p class="mb-1 full-notes d-none">{!! nl2br(e($followup->notes)) !!}</p>
                                                    <button class="btn btn-sm btn-link toggle-notes p-1 float-end mt-0"
                                                        data-state="short">
                                                        Voir plus <i class="bx bx-chevron-down"></i>
                                                    </button>
                                                @endif
                                            </div>

                                            @if ($followup->next_followup_date)
                                                <small class="text-muted">
                                                    <i class="bx bx-calendar-alt text-danger"></i> Prochain suivi:
                                                    {{ $followup->next_followup_date->format('d/m/Y H:i') }}
                                                </small>
                                            @endif
                                        </div>

                                        <style>
                                            .notes-container {
                                                position: relative;
                                            }

                                            .toggle-notes {
                                                font-size: 0.8rem;
                                                text-decoration: none;
                                            }

                                            .toggle-notes i {
                                                transition: transform 0.3s ease;
                                            }

                                            .toggle-notes[data-state="full"] i {
                                                transform: rotate(180deg);
                                            }
                                        </style>


                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucun suivi enregistré pour ce prospect</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne secondaire - Formulaire de suivi -->
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: #1e4520">
                            <h5 class="m-0 font-weight-bold text-white">Nouvelle Relance</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('prospect.followup.store', $prospect->uuid) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Type de contact</label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="type" id="type_call"
                                            value="call" checked>
                                        <label class="btn btn-outline-primary" for="type_call"><i
                                                class="bx bx-phone fs-5"></i> Appel</label>

                                        <input type="radio" class="btn-check" name="type" id="type_email"
                                            value="email">
                                        <label class="btn btn-outline-primary" for="type_email"><i
                                                class="bx bx-envelope fs-5"></i> Email</label>

                                        <input type="radio" class="btn-check" name="type" id="type_meeting"
                                            value="meeting">
                                        <label class="btn btn-outline-primary" for="type_meeting"><i
                                                class="fadeIn animated bx bx-calendar fs-5"></i> RDV</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="notes" name="notes" rows="5" required
                                        placeholder="Détails de l'échange..."></textarea>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="followup_date" class="form-label">Date du contact <span
                                                class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" id="followup_date"
                                            name="followup_date" required value="{{ now()->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="next_followup_date" class="form-label">Prochain suivi</label>
                                        <input type="datetime-local" class="form-control" id="next_followup_date"
                                            name="next_followup_date">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Statut</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="completed">Terminé</option>
                                        <option value="pending">À suivre</option>
                                        <option value="canceled">Annulé</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i> Enregistrer le suivi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Actions rapides -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: #1e4520">
                            <h5 class="m-0 font-weight-bold text-white">Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">

                                <button class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Modifier le prospect <i class="fas fa-edit me-2"></i>
                                </button>

                                <button class="btn btn-outline-success">
                                    <i class="fas fa-user-check me-2"></i> <a class="text-decoration-none"
                                        href="{{ route('prod.stepProduct') }}">Convertir en client</a>
                                </button>

                                <button class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#assignToModal">
                                    <i class="fas fa-user-check me-2"></i> Assigné a un agent
                                </button>

                                <a href="tel:{{ $prospect->mobile }}" class="btn btn-outline-info">
                                    <i class="fas fa-phone me-2"></i> Appeler le prospect
                                </a>

                                {{-- <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#assignToModal">
                                <i class="fas fa-user-check me-2"></i> Envoyé un mail
                            </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('prospects.assignModal')
        @include('prospects.addProductModal')
        @include('prospects.editModal')


        <style>
            /* Style pour la timeline */
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
                padding: 0.5rem 1rem;
                background-color: #f8f9fa;
                border-radius: 0.375rem;
                margin-bottom: 1rem;
            }

            /* Style pour les boutons radio */
            .btn-group .btn {
                flex: 1;
            }

            .btn-check:checked+.btn {
                background-color: #1e4520;
                color: white;
                border-color: #1e4520;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gestion de la suppression des produits
                document.querySelectorAll('.delete-product').forEach(button => {
                    button.addEventListener('click', async function() {
                        const productId = this.getAttribute('data-product-id');

                        console.log("le code es", productId)

                        const prospectId = this.getAttribute('data-prospect-id');
                        const badgeElement = this.closest('.product-badge');

                        if (!confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
                            return;
                        }

                        // Afficher un indicateur de chargement
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="bx bx-loader-alt bx-spin fs-6"></i>';
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

                            // Supprimer le badge avec animation
                            badgeElement.style.transition = 'all 0.3s ease';
                            badgeElement.style.opacity = '0';
                            badgeElement.style.transform = 'scale(0.8)';

                            setTimeout(() => {
                                badgeElement.remove();

                                // Si plus de produits, afficher le message "Aucun produit"
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
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
    </div>
@endsection
