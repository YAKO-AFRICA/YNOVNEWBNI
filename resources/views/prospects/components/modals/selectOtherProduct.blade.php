<style>
.product-card {
    cursor: pointer;
    transition: 0.2s;
    border: 2px solid #eee;
}

.product-card:hover {
    transform: translateY(-4px);
    border-color: #074707;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>

<div class="modal fade" id="otherProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bx bx-search me-2"></i>Selectionnez un produit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               

                <div class="row g-3">
                    @foreach($allProducts as $product)
                        <div class="col-md-4">
                            <div class="card product-card h-100" onclick="selectProduct('{{ $product }}')">

                                <div class="card-body text-center">
                                    <i class="bx bx-box fa-2x text-primary mb-3"></i>

                                    <h6 class="mb-2 ">{{ $product->libelleproduit }}</h6>

                                    <small class="text-muted">
                                        Code : {{ $product->codeproduit }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>


<script>
function selectProduct(produit) {
    // Si produit est une chaîne JSON, il faut le parser
    let productData;
    
    // Vérifier si produit est une chaîne JSON ou un objet
    if (typeof produit === 'string') {
        try {
            productData = JSON.parse(produit);
        } catch (e) {
            console.error('Erreur de parsing JSON:', e);
            return;
        }
    } else {
        productData = produit;
    }
    
    const codeproduit = productData.codeproduit;
    const productName = productData.libelleproduit;
    
    console.log('Produit sélectionné :', productData);
    console.log('Code produit:', codeproduit);
    console.log('Nom produit:', productName);

    // Mettre à jour le champ caché
    if (document.getElementById('selectedProduct')) {
        document.getElementById('selectedProduct').value = codeproduit;
    }
    
    // Mettre à jour le nom du produit dans le simulateur
    const productNameElement = document.getElementById('selected-product-name');
    if (productNameElement) {
        productNameElement.textContent = productName;
    }
    
    // Cacher la zone de sélection et afficher le simulateur
    const selectionZone = document.getElementById('product-selection-zone');
    const simulatorZone = document.getElementById('product-simulator-zone');
    
    if (selectionZone) {
        selectionZone.style.display = 'none';
    }
    
    if (simulatorZone) {
        simulatorZone.style.display = 'block';
    }

    // Fermer le modal
    const modalElement = document.getElementById('otherProductModal');
    if (modalElement) {
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();
    }
}
</script>

