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
                    <li class="breadcrumb-item active" aria-current="page">Detail du ticket</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
           
        </div>
    </div>
    <!-- Ticket Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light ">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0">{{ $ticket->subject }}</h2>
                <div>
                    <span class="badge bg-{{ $ticket->priority === 'high' ? 'danger' : ($ticket->priority === 'medium' ? 'warning' : 'success') }} me-2">
                        {{ __('Priorité.'.$ticket->priority) }}
                    </span>
                    <span class="badge bg-{{ $ticket->status === 'open' ? 'warning' : ($ticket->status === 'answered' ? 'success' : 'secondary') }}">
                        {{ __('Status.'.$ticket->status) }}
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $ticket->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Créé par {{ $ticket->user->membre->nom }} le {{ $ticket->created_at->format('d/m/Y H:i') }}
                </small>
                @if($ticket->attachments->isNotEmpty())
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#ticketAttachments">
                        <i class="bx bx-paperclip me-1"></i> Pièces jointes ({{ $ticket->attachments->count() }})
                    </button>
                @endif
            </div>
            
           @include('tickets.components.modals.attachements')
        </div>
    </div>

    <!-- Messages Section -->
    <h3 class="mb-3"><i class="fas fa-comments me-2"></i>Conversation</h3>
    
    @foreach($ticket->messages as $message)
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $message->user->name }}</strong>
                    @if($message->user_id === $ticket->user_id)
                        <span class="badge bg-info ms-2">Auteur</span>
                    @endif
                </div>
                <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $message->content }}</p>
                
                <!-- Message Attachments -->
               @include('messages.components.modals.attachements')
            </div>
        </div>
    @endforeach

    @include('messages.components.modals.create')
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
    .file-icon {
        transition: transform 0.2s;
    }
    .file-icon:hover {
        transform: scale(1.1);
    }
    .attachments-section {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]", {
        // Options Fancybox
    });
</script>
@endpush