@extends('layouts.main')

@section('content')
<div class="container-fluid">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Liste des cotations</h4>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
        <div class="card col-sm-12 col-md-4 col-lg-4">
            <div class="card-body">
                <h5 class="card-title">Nombre total de cotations</h5>
                <p class="card-text display-6">
                    {{ $cotations->count() }}
                </p>
            </div>
        </div>
        <div class="card col-sm-12 col-md-4 col-lg-4">
            <div class="card-body">
                <h5 class="card-title">Cotations en attente</h5>
                <p class="card-text display-6">
                    {{ $cotations->where('status', 'sending')->count() }}
                </p>
            </div>
        </div>
        <div class="card col-sm-12 col-md-4 col-lg-4">
            <div class="card-body">
                <h5 class="card-title">Cotations acceptées</h5>
                <p class="card-text display-6">
                    {{ $cotations->where('status', 'accepted')->count() }}
                </p>
            </div>
        </div>
    </div>


    {{-- Tableau --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover border-1" id="example2">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Souscripteur</th>
                        <th>Téléphone</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cotations as $key => $cotation)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $cotation->code }}</td>
                            <td>{{ $cotation->nomCompletSouscripteur }}</td>
                            <td>{{ $cotation->telephoneSouscripteur }}</td>

                            <td>
                                @if ($cotation->status == 'sending')
                                    <span class="badge bg-info text-dark">
                                        Demande envoyée
                                    </span>
                                @elseif ($cotation->status == 'accepted')
                                    <span class="badge bg-success text-dark">
                                        Traité
                                    </span>
                                @elseif ($cotation->status == 'rejeted')
                                    <span class="badge bg-danger text-dark">
                                        Rejeté
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        En Attente
                                    </span>
                                @endif
                                
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ ucfirst(Str::limit($cotation->note, 20, '...')) }}
                                </span>
                            </td>

                            <td>{{ $cotation->created_at->format('d/m/Y') }}</td>


                            @if ($cotation->status == 'sending')
                                <td class="text-center">

                                    <form action="{{ route('cotation.store', $cotation->uuid)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class='bx bx-check-double'></i> Traiter
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td class="text-center text-muted" disabled style="opacity: 0.5;">
                                    <i class='bx bx-lock'></i> Deja traité
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Aucune cotation enregistrée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
