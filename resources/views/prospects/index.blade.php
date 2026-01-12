@extends('layouts.main')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="/shared/home"><i class="bx bx-home-alt"></i></a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Prospect</li>
                        <li class="breadcrumb-item active" aria-current="page">Liste</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">

                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        @php
            $total = count($myProspects ?? []);
            $clients = count($myProspects->where('status', 'client') ?? []);
            $prospect = count($myProspects->where('status', 'prospect') ?? []);
            $tauxConversion = $total > 0 ? ($clients / $total) * 100 : 0;
        @endphp

        

        <div class="row">
            <!-- QR Code Section -->
            <div class="col-sm-12 col-md-4 mb-3">
                <div class="card">
                    <div class="card-header text-center bg-light">
                        <h6 class="mb-0">Mon QR Code de prospection</h6>
                    </div>
                    <div class="card-body text-center">
                        {!! QrCode::size(200)->generate(route('prospect.create', auth()->user()->idmembre)) !!}
                        <p class="mt-2 text-muted">Scanner ce code pour ajouter un prospect</p>
                        <a href="{{ route('prospect.download') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download"></i> Télécharger le QR Code
                        </a>
                    </div>
                </div>
                <div class="">
                    <div class="row g-3">
                        <!-- Card 1 -->
                        <div class="col-md-6">
                            <div class="card card-stat p-3 h-100">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-people-fill fs-2 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="small-muted">Total prospections</div>
                                        <div class="stat-value text-primary float-end mt-3" id="card-new-prospects">{{ $total ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-6">
                            <div class="card card-stat p-3 h-100">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-person-check-fill fs-2 text-success"></i>
                                    </div>
                                    <div>
                                        <div class="small-muted">Prospects convertis</div>
                                        <div class="stat-value text-success float-end mt-3" id="card-converted">{{ $clients ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-6">
                            <div class="card card-stat p-3 h-100">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-clock-history fs-2 text-warning"></i>
                                    </div>
                                    <div>
                                        <div class="small-muted">En attente de conversion</div>
                                        <div class="stat-value text-warning float-end mt-3" id="card-pending">{{ $prospect ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-6">
                            <div class="card card-stat p-3 h-100">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-bar-chart-fill fs-2 text-info"></i>
                                    </div>
                                    <div>
                                        <div class="small-muted">Taux de conversion</div>
                                        <div class="stat-value text-info float-end mt-3" id="card-rate">{{ number_format($tauxConversion, 2) }}%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prospects List Section -->
            <div class="col-sm-12 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white">Liste des Prospects</h5>
                        {{-- <a href="javascript(void(0))" data-bs-toggle="modal" data-bs-target="#addnewPropect" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle"></i> Nouveau Prospect
                        </a> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="prospectTable" class="table table-striped table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom & Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Date Naissance</th>
                                        <th>Créé le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($myProspects as $item)
                                        <tr>
                                            <td>{{ $item->code ?? 'N/A' }}</td>
                                            <td>{{ $item->civilite }} {{ $item->nom }} {{ $item->prenom }}</td>
                                            <td>
                                                @if ($item->email)
                                                    <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $contact = \App\Models\contactProspert::where(
                                                        'prospert_uuid',
                                                        $item->uuid,
                                                    )->first();
                                                @endphp
                                                @if ($contact && $contact->contact)
                                                    <a href="tel:{{ $contact->contact }}">{{ $contact->contact }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->date_naissance)
                                                    {{ \Carbon\Carbon::parse($item->date_naissance)->format('d/m/Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('prospect.show', $item->uuid) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Voir les détails">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('prospect.edit', $item->uuid) }}" 
                                               class="btn btn-sm btn-outline-secondary" 
                                               title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                                Aucun prospect trouvé
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($prospects->hasPages())
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Affichage de {{ $prospects->firstItem() }} à {{ $prospects->lastItem() }} sur
                                    {{ $prospects->total() }} résultats
                                </div>
                                <div>
                                    {{ $prospects->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialisation de DataTable
                new DataTable('#prospectTable', {
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/fr-FR.json'
                    },
                    pageLength: 10,
                    responsive: true,
                    order: [
                        [5, 'desc']
                    ], // Tri par date de création décroissante
                    columnDefs: [{
                        targets: [6], // Colonne Actions
                        orderable: false,
                        searchable: false
                    }]
                });

                // Confirmation de suppression si vous ajoutez cette fonctionnalité
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function(e) {
                        if (!confirm('Êtes-vous sûr de vouloir supprimer ce prospect ?')) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    @endpush

    <style>
        .btn-group .btn {
            margin-right: 2px;
        }

        .table th {
            border-top: none;
            font-weight: 600;
        }

        .card {
            border: 1px solid #e3e6f0;
        }
    </style>
@endsection
