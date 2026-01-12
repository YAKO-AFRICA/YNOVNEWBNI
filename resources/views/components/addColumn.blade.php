<div class="modal fade" id="columnsModalPart" tabindex="-1" aria-labelledby="columnsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('setting.updateColumnsPart') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="columnsModalLabel">Personnaliser les colonnes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($additionalColumns as $label => $key)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $key }}"
                                id="col-{{ $key }}" 
                                {{ in_array($key, $activeColumns) ? 'checked' : '' }}>
                            <label class="form-check-label" for="col-{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
        
    </div>
</div>