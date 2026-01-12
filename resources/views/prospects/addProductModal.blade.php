<div class="modal fade" id="productAddModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1e4520">
                <h5 class="modal-title text-white">Ajouter de nouveau produit</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prospect.addProduct')}}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">
                    <p>Sélectionnez un produit pour l'ajouter</p>

                    <input type="hidden" name="prospect_id" value="{{$prospect->uuid}}">
                    
                    <div class="mb-3">
                        <label for="productSearch" class="form-label">Rechercher un produit</label>
                        <input type="text" class="form-control" id="productSearch" placeholder="Commencez à taper un nom ou un code..." onkeyup="filterProduct()">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Résultats</label>
                        <div class="list-group" id="productResults" style="max-height: 300px; overflow-y: auto;">
                            @foreach($allProducts as $item)
                            <label class="list-group-item d-flex align-items-center product-item">
                                <input class="form-check-input me-3" type="checkbox" name="products[]" value="{{ $item->CodeProduit }}">
                                <div class="product-info">
                                    <strong class="product-code">{{ $item->CodeProduit }}</strong> - <span class="product-name">{{ $item->MonLibelle }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Ajouter <i class=""></i></button>
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
function filterProduct() {
    const input = document.getElementById('productSearch');
    const filter = input.value.toUpperCase();
    const items = document.querySelectorAll('.product-item');
    
    items.forEach(item => {
        const code = item.querySelector('.product-code').textContent.toUpperCase();
        const name = item.querySelector('.product-name').textContent.toUpperCase();
        
        if (code.includes(filter) || name.includes(filter)) {
            item.classList.remove('d-none');
        } else {
            item.classList.add('d-none');
        }
    });
}
</script>