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
                    <li class="breadcrumb-item active" aria-current="page">Détail du ticket</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
           
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light ">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0">{{ $ticket->subject }}</h2>
                <div>
                    <span class="badge bg-{{ $ticket->priority === 'high' ? 'danger' : ($ticket->priority === 'medium' ? 'warning' : 'success') }} me-2">
                        {{ $ticket->priority === 'high' ? 'Priorité Elevé' : ($ticket->priority === 'medium' ? 'Priorité Important' : 'Priorité Faible') }}
                    </span>
                    <span class="badge bg-{{ $ticket->status === 'open' ? 'warning' : ($ticket->status === 'answered' ? 'success' : 'secondary') }}">
                        {{ $ticket->status === 'open' ? 'Ouvert' : ($ticket->status === 'answered' ? 'Repondu' : 'Resolu') }}
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

    <div class="card shadow-sm h-100">
        <div class="card-body p-0 d-flex flex-column">
            <div class="chat-wrapper flex-grow-1 d-flex flex-column">
                <!-- Messages avec défilement -->
                <div class="messages-container p-4 flex-grow-1" style="overflow-y: auto;">
                    @foreach($ticket->messages as $message)

                        @if($message->user_id === $ticket->user_id) 
                            <div class="chat-content-rightside">
                                <div class="d-flex">
                                    
                                            {{-- <img src="{{ asset('assets/images/avatars/avatar-3.png') }}" width="45" height="45" class="rounded-circle" alt="" /> --}}
                                    <div class="flex-grow-1 ms-2 mb-2">
                                        <div class="chat-right-msg">
                                            <img src="{{ asset('root/images/login-images/default.png')}}"width="45" height="45" class="rounded-circle" alt="">
                                            <span class="mb-0 chat-time text-end">{{ $message->user->membre->nom }}, {{ $message->created_at->diffForHumans() }}</span>
                                            <p class="my-3">{!! nl2br(e($message->content)) !!}</p>

                                            @if($message->attachments->isNotEmpty())
                                                <div class="message-attachments mt-3">
                                                    @foreach($message->attachments as $attachment)
                                                        <a href="{{ asset('storage/' . $attachment->path) }}" 
                                                        class="attachment-item" download="{{ $attachment->original_name }}"
                                                        title="{{ $attachment->original_name }} ({{ round($attachment->size / 1024, 1) }} Ko)">
                                                            <i class="bx bx-file"></i>
                                                            <span class="attachment-name">{{ Str::limit($attachment->original_name, 20) }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="chat-content-leftside">
                                <div class="d-flex">
                                    <div class="flex-grow-1 me-2 mb-2">
                                        <div class="chat-left-msg">
                                            <img src="{{ asset('root/images/login-images/default.png')}}"width="45" height="45" class="rounded-circle" alt="">
                                            <span class="mb-0 chat-time text-end">{{ $message->user->membre->nom }}, {{ $message->created_at->diffForHumans() }}</span>
                                            <p class="my-3">{!! nl2br(e($message->content)) !!}</p>

                                            @if($message->attachments->isNotEmpty())
                                                <div class="message-attachments mt-3">
                                                    @foreach($message->attachments as $attachment)
                                                        <a href="{{ asset('storage/' . $attachment->path) }}" 
                                                        class="attachment-item" download="{{ $attachment->original_name }}"
                                                        title="{{ $attachment->original_name }} ({{ round($attachment->size / 1024, 1) }} Ko)">
                                                            <i class="bx bx-file"></i>
                                                            <span class="attachment-name">{{ Str::limit($attachment->original_name, 20) }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <!-- Zone de réponse (toujours en bas) -->
                <div class="reply-section border-top p-3 bg-light">
                    <form action="{{ route('ticket.messages.store', $ticket) }}" method="POST" enctype="multipart/form-data" class="position-relative" id="reply-form">
                        @csrf
                        <div id="attachments-preview" class="d-none mb-2">
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-2"><i class="bx bx-paperclip"></i> <span id="attachment-count">0</span> fichier(s)</small>
                            </div>
                            <div id="attachments-list" class="d-flex flex-wrap gap-2 mt-2"></div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <!-- Zone de texte -->
                            <div class="flex-grow-1 position-relative me-2">
                                <textarea name="content" class="form-control reply-textarea" 
                                    placeholder="Écrire votre réponse..." rows="1" 
                                    style="resize: none; border-radius: 20px; min-height: 45px; max-height: 120px;" required></textarea>
                            </div>
                            
                            <!-- Bouton d'upload -->
                            <div class="position-relative">
                                <input type="file" name="attachments[]" id="attachments-input" 
                                    class="d-none" multiple 
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">

                                <button type="button" class="btn btn-outline-secondary rounded-circle text-center" 
                                        style="width: 40px; height: 40px;" 
                                        onclick="document.getElementById('attachments-input').click()">
                                    <i class="bx bx-paperclip"></i>
                                </button>
                            </div> 
                            
                            <!-- Bouton d'envoi -->
                            <button type="submit" class="btn btn-icon btn-primary rounded-circle ms-2" 
                                    style="width: 40px; height: 40px;">
                                <i class="bx bx-send"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reply-form');
            const sendReplyButton = form.querySelector('button[type="submit"]');
            const messagesContainer = document.querySelector('.messages-container');
            const textarea = document.querySelector('.reply-textarea');
            const attachmentsInput = document.getElementById('attachments-input');
            const attachmentsPreview = document.getElementById('attachments-preview');
            const attachmentsList = document.getElementById('attachments-list');
            const attachmentCount = document.getElementById('attachment-count');
            
            // Auto-resize textarea
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            
            // Gestion des pièces jointes
            attachmentsInput.addEventListener('change', function() {
                attachmentsList.innerHTML = '';
                
                if (this.files.length > 0) {
                    attachmentsPreview.classList.remove('d-none');
                    attachmentCount.textContent = this.files.length;
                    
                    Array.from(this.files).forEach((file, index) => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'attachment-item';
                        fileItem.innerHTML = `
                            <i class="bx bx-file"></i>
                            <span class="attachment-name">${file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name}</span>
                            <button type="button" class="btn-remove-attachment" data-index="${index}">
                                <i class="bx bx-x"></i>
                            </button>
                        `;
                        attachmentsList.appendChild(fileItem);
                    });
                } else {
                    attachmentsPreview.classList.add('d-none');
                }
            });
            
            // Supprimer un fichier
            attachmentsList.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-remove-attachment') || 
                    e.target.parentElement.classList.contains('btn-remove-attachment')) {
                    const index = e.target.getAttribute('data-index') || 
                                e.target.parentElement.getAttribute('data-index');
                    removeFileFromInput(index);
                }
            });
            
            function removeFileFromInput(index) {
                const dt = new DataTransfer();
                const files = attachmentsInput.files;
                
                for (let i = 0; i < files.length; i++) {
                    if (i !== parseInt(index)) {
                        dt.items.add(files[i]);
                    }
                }
                
                attachmentsInput.files = dt.files;
                attachmentsInput.dispatchEvent(new Event('change'));
            }
            
            // Faire défiler vers le bas au chargement
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            
            // Envoi du formulaire
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                const formData = new FormData(form);
                
                // Désactiver le bouton pendant l'envoi
                sendReplyButton.disabled = true;
                sendReplyButton.innerHTML = '<i class="bx bx-loader bx-spin"></i>';
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Ajouter le nouveau message à l'interface
                        const message = data.message;
                        const userIsSender = message.user_id === {{ $ticket->user_id }};
                        //const userIsSender = message.user_id === {{ auth()->id() }}; /tickets/attachments/${attachment.id}/download
                        
                        let attachmentsHtml = '';
                        if (message.attachments && message.attachments.length > 0) {
                            attachmentsHtml = message.attachments.map(attachment => `
                                <a href="{{ asset('storage/') }}/${attachment.path}" 
                                class="attachment-item" 
                                title="${attachment.original_name} (${attachment.size / 1024} Ko)" download="${attachment.original_name}">
                                    <i class="bx bx-file"></i>
                                    <span class="attachment-name">${attachment.original_name.substring(0, 20)}${attachment.original_name.length > 20 ? '...' : ''}</span>
                                </a>
                            `).join('');
                        }
                        
                        const messageHtml = `

                            <div class="chat-content-${userIsSender ? 'rightside' : 'leftside'}">
                                <div class="d-flex ${userIsSender ? '' : 'align-items-star'}">
                                    <div class="${userIsSender ? 'flex-grow-1 me-2' : 'flex-grow-1 ms-2'} mb-2">
                                        <div class="chat-${userIsSender ? 'right' : 'left'}-msg">
                                            <img src="{{ asset('root/images/login-images/default.png') }}" width="48" height="48" class="rounded-circle me-2" alt="" />
                                            <span class="mb-0 chat-time ${userIsSender ? 'text-end' : ''}">
                                                ${message.user.membre.nom}, ${new Date(message.created_at).toLocaleString()}
                                            </span>
                                            <p class="my-3">${message.content.replace(/\n/g, '<br>')}</p>
                                            ${attachmentsHtml ? `
                                            <div class="message-attachments mt-3">
                                                ${attachmentsHtml}
                                            </div>
                                            ` : ''}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        
                        // Réinitialiser le formulaire
                        textarea.value = '';
                        textarea.style.height = '45px';
                        attachmentsInput.value = '';
                        attachmentsPreview.classList.add('d-none');
                        attachmentsList.innerHTML = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Une erreur est survenue lors de l\'envoi du message');
                })
                .finally(() => {
                    sendReplyButton.disabled = false;
                    sendReplyButton.innerHTML = '<i class="bx bx-send"></i>';
                });
            });
    
            const resizeObserver = new ResizeObserver(() => {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            });
            resizeObserver.observe(messagesContainer);
        });
    </script>
</div>
@endsection