@extends('layouts.main')

@section('content')
<div class="page-content py-4">
     <!--breadcrumb-->
     <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Support</li>
                    <li class="breadcrumb-item active" aria-current="page">Mes Tickets</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">
                    <i class="bx bx-plus me-2"></i>Nouveau ticket
                </button>
            </div>
        </div>
    </div>
    
    @if($tickets->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="far fa-ticket-alt fa-4x text-muted mb-3"></i>
                <h3 class="h5">Aucun ticket pour le moment</h3>
                <p class="text-muted">Créez votre premier ticket pour obtenir de l'aide</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">
                    Créer un ticket
                </button>
            </div>
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover mb-0" id="example2">
                        <thead class="table-light">
                            <tr>
                                <th width="30%">Sujet</th>
                                <th width="40%">Description</th>
                                <th>Statut</th>
                                <th>Priorité</th>
                                <th>Créé le</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>
                                        <a href="" class="text-decoration-none">
                                            <strong>{{ $ticket->subject }}</strong>
                                        </a>
                                        @if($ticket->attachments_count > 0)
                                            <span class="badge bg-light text-dark ms-2" title="Pièces jointes">
                                                <i class="fas fa-paperclip"></i> {{ $ticket->attachments_count }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ Str::limit($ticket->description, 70) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $ticket->status === 'open' ? 'warning' : ($ticket->status === 'answered' ? 'success' : 'secondary') }}">
                                            {{ __($ticket->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $ticket->priority === 'high' ? 'danger' : ($ticket->priority === 'medium' ? 'warning' : 'success') }}">
                                            {{ __($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('ticket.ticket.show', $ticket) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bx bx-show"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

@include('tickets.components.modals.create')
@endsection

