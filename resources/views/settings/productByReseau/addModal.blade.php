<div class="modal fade" id="addProductReseau{{ $item->id }}" tabindex="-1" aria-labelledby="membreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="membreModalLabell">Attribuer un Produit au reseau</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('setting.store.product.by.reseau') }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <fieldset class="border p-3">
                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Produits commercialisé</h5></small></legend>
                            <input type="text" name="codereseau" id="codereseau" value="{{ $item->id }}" class="form-control" hidden>
                            <div class="mb-4">
                                <label class="form-label" for="codeproduit">Code Produit:</label>
                                <select name="codeproduit" class="form-select produit-select" id="codeproduitId-{{ $item->id }}" required>
                                    <option value="">-- Choisir une option --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->CodeProduit }}" data-code-produit-value="{{ $product->CodeProduit }}">{{ $product->MonLibelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="codeproduitformule">Code Produit Formule:</label>
                                <select name="codeproduitformule" class="form-select formule-select" id="codeproduitformule-{{ $item->id }}">
                                    <option value="">-- Choisir une option --</option>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Femer</button>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('produit-select')) {
                    const produitSelect = e.target;
                    const reseauId = produitSelect.id.split('-')[1];
                    const formuleSelect = document.getElementById('codeproduitformule-' + reseauId);
                    
                    const selectedOption = produitSelect.options[produitSelect.selectedIndex];
                    const codeProduit = selectedOption.value;
        
                    console.log('Code Produit sélectionné:', codeProduit);
        
                    // Réinitialiser les options
                    formuleSelect.innerHTML = '<option value="">-- Choisir une option --</option>';
        
                    if (codeProduit) {
                        console.log('Envoi requête AJAX pour code:', codeProduit);
                        
                        fetch('/formules/' + codeProduit)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Erreur réseau');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Réponse API:', data);
                                
                                if (Array.isArray(data) && data.length > 0) {
                                    data.forEach(item => {
                                        if (item.CodeProduitFormule && item.MonLibelle) {
                                            const option = document.createElement('option');
                                            option.value = item.CodeProduitFormule;
                                            option.textContent = item.MonLibelle;
                                            formuleSelect.appendChild(option);
                                        }
                                    });
                                } else {
                                    console.warn('Aucune formule disponible');
                                    const option = document.createElement('option');
                                    option.value = '';
                                    option.textContent = 'Aucune formule disponible';
                                    formuleSelect.appendChild(option);
                                }
                            })
                            .catch(error => {
                                console.error('Erreur fetch:', error);
                                alert('Erreur lors du chargement des formules');
                            });
                    }
                }
            });
        });
        </script>


</div>