 <!-- Ticket Attachments -->
 @if($ticket->attachments->isNotEmpty())
 <div class="collapse mt-3" id="ticketAttachments">
     <div class="card card-body bg-light">
         <h5 class="h6 mb-3">Pièces jointes du ticket</h5>
         <div class="row g-2">
             @foreach($ticket->attachments as $attachment)
                 <div class="col-md-3 col-6">
                     <div class="border rounded p-2 h-100">
                         <div class="d-flex flex-column align-items-center text-center">
                             @if($attachment->isImage())
                                 <a href="{{ $attachment->url }}" data-fancybox="gallery" data-caption="{{ $attachment->original_name }}">
                                     <img src="{{ $attachment->url }}" alt="{{ $attachment->original_name }}" class="img-thumbnail mb-2" style="max-height: 80px;">
                                 </a>
                             @else
                                 <a href="" class="text-decoration-none">
                                     <div class="file-icon mb-2">
                                         <i class="far fa-file-{{ getFileIcon($attachment->mime_type) }} fa-3x text-{{ getFileColor($attachment->mime_type) }}"></i>
                                     </div>
                                 </a>
                             @endif
                             <small class="d-block text-truncate" style="max-width: 100%;" title="{{ $attachment->original_name }}">
                                 {{ Str::limit($attachment->original_name, 20) }}
                             </small>
                             <small class="text-muted">{{ formatFileSize($attachment->size) }}</small>
                         </div>
                         <div class="d-flex justify-content-center mt-2">
                             <a href="" class="btn btn-sm btn-outline-primary me-1" title="Télécharger">
                                 <i class="fas fa-download"></i>
                             </a>
                             @can('delete', $attachment)
                                 <form action="" method="POST">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                         <i class="fas fa-trash-alt"></i>
                                     </button>
                                 </form>
                             @endcan
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </div>
@endif