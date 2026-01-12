<!-- Ticket Attachments -->
@if($ticket->attachments->isNotEmpty())
<div class="collapse mt-3" id="ticketAttachments">
    <div class="card card-body bg-light">
        <h5 class="h6 mb-3">Pièces jointes du ticket</h5>
        <div class="row g-2">
            @foreach($ticket->attachments as $attachment)
                <div class="col-md-3 col-sm-6 col-lg-2" title="{{ $attachment->original_name }}" style="cursor: pointer">
                    <div class="border rounded p-2 h-100 row" data-bs-toggle="modal" data-bs-target="#viewFile">
                        <div class="col-4">
                            @php
                                $mime = $attachment->mime_type;
                                $extension = explode('/', $mime)[1];
                            @endphp

                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                <img src="{{ asset('assets/root/images/jpg.jpeg') }}" alt="" class="img-fluid" style="max-width: 40px">
                            @else
                                <img src="{{ asset('assets/root/images/pdf.jpg') }}" alt="" class="img-fluid" style="max-width: 40px">
                            @endif

                        </div>
                        <div class="col-8">
                            <small class="text-muted">{{ formatFileSize($attachment->size) }}</small> <br>
                            <small class="text-muted"> <i class="bx bx-time-five"></i> {{ $attachment->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>

                @include('tickets.components.modals.fileView')

            @endforeach
        </div>
    </div>
</div>
@endif