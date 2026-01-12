<div class="modal fade" id="editUserGroup{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('setting.editUserGroup', $user->id) }}" class="submitForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le groupe de {{ $user->membre->nom ?? '' }} {{ $user->membre->prenom ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Sélectionner un groupe</label>
                        <select name="group_uuid" class="form-select">
                            <option value="">-- Aucun --</option>
                            @foreach($notifgroups as $group)
                                <option value="{{ $group->code_group }}" 
                                    {{ $user->group_uuid == $group->code_group ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>