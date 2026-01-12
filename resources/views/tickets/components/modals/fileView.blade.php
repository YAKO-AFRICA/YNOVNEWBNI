<div class="modal fade " tabindex="-1" id="viewFile" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="height: 80vh">
        <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">{{ $attachment->original_name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body w-100">
            <iframe style="width: 100%; height: 100%" 
            src="{{ asset('storage/' . $attachment->path) }}" 
            frameborder="0">
            </iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <a href="{{ asset('storage/' . $attachment->path) }}" download="{{ $attachment->original_name }}" class="btn btn-primary">Telecharger</a>
        </div>
      </div>
    </div>
</div>