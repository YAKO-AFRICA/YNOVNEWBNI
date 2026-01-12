<div class="modal fade" id="assignToModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1e4520">
                <h5 class="modal-title text-white">Assigner le prospect à un agent</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prospect.assign', $prospect->uuid)}}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">
                    <p>Sélectionnez un agent à qui assigner le prospect</p>
                    
                    <div class="mb-3">
                        <label for="agentSearch" class="form-label">Rechercher un commercial</label>
                        <input type="text" class="form-control" id="agentSearch" placeholder="Commencez à taper un nom ou un code..." onkeyup="filterAgents()">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Résultats</label>
                        <div class="list-group" id="agentResults" style="max-height: 300px; overflow-y: auto;">
                            @foreach($commerciaux as $commercial)
                            <label class="list-group-item d-flex align-items-center agent-item">
                                <input class="form-check-input me-3" type="radio" name="assignedTo" value="{{ $commercial->idmembre }}">
                                <div class="agent-info">
                                    <strong class="agent-code">{{ $commercial->codeagent }}</strong> - <span class="agent-name">{{ $commercial->nom }}</span>
                                    @if($commercial->agence)
                                    <small class="text-muted d-block agent-agence">{{ $commercial->agence }}</small>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="note" class="form-label">Note (facultatif)</label>
                        <textarea class="form-control bg-light" name="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Assigné <i class=""></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .list-group-item {
        transition: all 0.2s;
        cursor: pointer;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .form-check-input:checked {
        background-color: #1e4520;
        border-color: #1e4520;
    }
    #agentResults::-webkit-scrollbar {
        width: 8px;
    }
    #agentResults::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    #agentResults::-webkit-scrollbar-thumb {
        background: #1e4520;
        border-radius: 4px;
    }
    .d-none {
        display: none !important;
    }
</style>

<script>
function filterAgents() {
    const input = document.getElementById('agentSearch');
    const filter = input.value.toUpperCase();
    const items = document.querySelectorAll('.agent-item');
    
    items.forEach(item => {
        const code = item.querySelector('.agent-code').textContent.toUpperCase();
        const name = item.querySelector('.agent-name').textContent.toUpperCase();
        const agence = item.querySelector('.agent-agence') ? item.querySelector('.agent-agence').textContent.toUpperCase() : '';
        
        if (code.includes(filter) || name.includes(filter) || agence.includes(filter)) {
            item.classList.remove('d-none');
        } else {
            item.classList.add('d-none');
        }
    });
}
</script>