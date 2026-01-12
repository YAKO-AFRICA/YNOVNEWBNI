@extends('layouts.main')

@section('content')
<style>
    .disabled-link {
        pointer-events: none;
        opacity: 0.6; /* Rendre visuellement inactif */
        cursor: not-allowed;
    }
</style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Prestations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('shared.home') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mes prestations demandes</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">

        <div class="card-body container-fluid">
            <ul class="nav nav-tabs nav-success" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#successhome" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="fadeIn animated bx bx-book-alt font-18 me-2"></i>
                            </div>
                            <div class="tab-title">Prestations</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#successcontact" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="fadeIn animated bx bx-book-add font-18 me-2"></i>
                            </div>
                            <div class="tab-title">Autres</div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content py-3">
                <div class="tab-pane fade show active" id="successhome" role="tabpanel">
                    <div class="table-responsive">
                        <table id="example2" class="table mes-prestations table-stripe table-bordere">
                            <thead class="table-light">
                                <tr>
                                    <th>Code de la demande</th>
                                    <th>#ID du contrat</th>
                                    <th>Type de prestation</th>
                                    <th>Telephone associé</th>
                                    <th>Email associé</th>
                                    <th>Montant souhaité</th>
                                    <th>Statut</th>
                                    <th>Motif rejet</th>
                                    <th>Date de demande</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestations as $prestation)
                                    <tr>
                                        <td>{{ $prestation->code }}</td>
                                        <td>{{ $prestation->idcontrat }}</td>
                                        <td>{{ $prestation->typeprestation }}</td>
                                        <td>{{ $prestation->cel }}</td>
                                        <td>{{ $prestation->email }}</td>
                                        <td>{{ $prestation->montantSouhaite }}</td>
                                        <td>
                                            @if ($prestation->etape == 0)
                                                <div
                                                    class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                                    <i class="bx bxs-circle me-1"></i>En attente de transmission
                                                </div>
                                            @elseif($prestation->etape == 1)
                                                <div
                                                    class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">
                                                    <i class="bx bxs-circle me-1"></i> Demande transmise
                                                </div>
                                            @elseif($prestation->etape == 2)
                                                <div
                                                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                    <i class="bx bxs-circle me-1"></i> Demande acceptée
                                                </div>
                                            @elseif($prestation->etape == 3)
                                                <div
                                                    class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                                    <i class="bx bxs-circle me-1"></i>Demande rejétée
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($prestation->etape == 3)
                                                <div class="d-flex align-items-center">
                                                    <div>{{ $prestation->motifrejet->count() }} motif(s)</div>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0 font-18 text-success p-1 border rounded bg-light" data-bs-toggle="modal"
                                                            data-bs-target="#showMotifRejetModal{{ $prestation->code }}"
                                                            style="cursor: pointer">
                                                            <i class="bx bx-show"></i>
                                                        </h5>
                                                    </div>
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $prestation->created_at->format('d/m/Y à H:i') }}</td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('prestation.show', $prestation->code) }}"
                                                    class="ms-2 border"><i class='bx bxs-show'></i></a>
                                                    
                                                    @php
                                                        $isEditable = $prestation->etape == 0 || $prestation->etape == 3;
                                                        $editRoute = $prestation->etape == 3 
                                                            ? route('prestation.editAfterRejet', $prestation->code) 
                                                            : route('prestation.edit', $prestation->code);
                                                        $tooltipText = $isEditable ? 'Modifier la demande' : 'Impossible de modifier la demande une fois transmise';
                                                    @endphp

                                                    <a href="{{ $editRoute }}" 
                                                    class="ms-3 border {{ !$isEditable ? 'disabled-link' : '' }}" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="{{ $tooltipText }}">
                                                    <i class='bx bxs-edit'></i>
                                                    </a>
                                                     {{-- <a href="{{ route('prestation.edit', $prestation->code) }}" class="ms-3 border {{ $prestation->etape != 0 && $prestation->etape != 3 ? 'disabled-link' : '' }}" 
                                                        data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="{{ $prestation->etape != 0 && $prestation->etape != 3 ? 'Impossible de modifier la demande une fois transmise' : '' }}">
                                                         <i class='bx bxs-edit'></i>
                                                     </a> --}}
                                                    <a href="javascript:;" class="deleteConfirmation border ms-3 {{$prestation->etape != 0 && $prestation->etape != 3 ? 'disabled-link' : ''}}" data-uuid="{{$prestation->code}}"
                                                        data-type="confirmation_redirect" data-placement="top"
                                                        data-token="{{ csrf_token() }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="{{ $prestation->etape != 0 && $prestation->etape != 3 ? 'Impossible de supprimer la demande une fois transmise' : '' }}"
                                                        data-url="{{route('prestation.destroy',$prestation->code)}}"
                                                        data-title="Vous êtes sur le point de supprimer {{$prestation->code}} "
                                                        data-id="{{$prestation->code}}" data-param="0"
                                                        data-route="{{route('prestation.destroy',$prestation->code)}}" ><i
                                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                                    </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('prestations.components.modals.showMotifModal' , ['code' => $prestation->code])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="successcontact" role="tabpanel">
                    <div class="table-responsive">
                        <table id="example3" class="table mes-prestations">
                            <thead class="table-light">
                                <tr>
                                    <th>Code de la demande</th>
                                    <th>#ID du contrat</th>
                                    <th>Type de prestation</th>
                                    <th>Telephone associé</th>
                                    <th>Email associé</th>
                                    <th>Statut</th>
                                    <th>Motif de rejet</th>
                                    <th>Date de demande</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AutrePrestations as $prestation)
                                    <tr>
                                        <td>{{ $prestation->code }}</td>
                                        <td>{{ $prestation->idcontrat }}</td>
                                        <td>{{ $prestation->typeprestation }}</td>
                                        <td>{{ $prestation->cel }}</td>
                                        <td>{{ $prestation->email }}</td>
                                        <td>
                                            @if ($prestation->etape == 1)
                                                <div
                                                    class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">
                                                    <i class="bx bxs-circle me-1"></i>Transmis pour traitement
                                                </div>
                                            @elseif($prestation->etape == 2)
                                                <div
                                                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                    <i class="bx bxs-circle me-1"></i>Demande acceptée
                                                </div>
                                            @elseif($prestation->etape == 3)
                                                <div
                                                    class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                                    <i class="bx bxs-circle me-1"></i>Demande rejétée
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($prestation->etape == 3)
                                                <div class="d-flex align-items-center">
                                                    <div>{{ $prestation->motifrejet->count() }} motif(s)</div>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0 font-18 text-success p-1 border rounded bg-light" data-bs-toggle="modal"
                                                            data-bs-target="#showMotifRejetModal{{ $prestation->code }}"
                                                            style="cursor: pointer">
                                                            <i class="bx bx-show"></i>
                                                        </h5>
                                                    </div>
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $prestation->created_at->format('d/m/Y à H:i') }}</td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                {{-- <a href="{{ route('prestation.show', $prestation->code) }}" class="ms-2 border"><i class='bx bxs-show'></i></a> --}}
                                                <a href="{{ route('prestation.show', $prestation->code) }}"
                                                    class="ms-2 border"><i class='bx bxs-show'></i></a>

                                                    <a href="{{ route('prestation.edit', $prestation->code) }}" class="ms-3 border disabled-link" 
                                                        data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="Impossible de modifier la demande une fois transmise">
                                                         <i class='bx bxs-edit'></i>
                                                     </a>
                                                    <a href="javascript:;" class="deleteConfirmation border ms-3 {{$prestation->etape == 0 || $prestation->etape == 3 ? '' : 'disabled-link'}}" data-uuid="{{$prestation->code}}"
                                                        data-type="confirmation_redirect" data-placement="top"
                                                        data-token="{{ csrf_token() }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                                        title="{{ $prestation->etape == 0 || $prestation->etape == 3 ? 'Impossible de supprimer la demande' : '' }}"
                                                        data-url="{{route('prestation.destroy',$prestation->code)}}"
                                                        data-title="Vous êtes sur le point de supprimer la prestation {{$prestation->code}} "
                                                        data-id="{{$prestation->code}}" data-param="0"
                                                        data-route="{{route('prestation.destroy', $prestation->code)}}" ><i
                                                            class='bx bxs-trash' style="cursor: pointer"></i>
                                                    </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{ $prestation->code }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel{{ $prestation->code }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{ $prestation->code }}">
                                                        Détails de la prestation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card radius-10">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0">{{ $prestation->typeprestation }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="card-body bg-light-success rounded">
                                                            <div class="align-items-center">
                                                                <div class="flex-grow-1 ms-3 my-4"
                                                                    style="text-align: justify">
                                                                    {{ $prestation->msgClient ?? 'Aucune information disponible.' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('prestations.components.modals.showMotifModal' , ['code' => $prestation->code])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
        });
    </script>
@endsection
