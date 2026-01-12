

<div class="modal fade" id="showPrestationModal{{ $item->CodeProduit }}" tabindex="-1"
    aria-labelledby="showPrestationModalLabel{{ $item->CodeProduit }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Liste des prestations pour {{ $item->MonLibelle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($item->typePrestations->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($item->typePrestations as $prestItem)
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                id="product-{{ $prestItem->id }}">
                                <span>
                                    {{ $prestItem->prestation->libelle }} (impact :
                                    {{ $prestItem->prestation->impact == 1 ? 'Sortie de portefeuille' : 'Pas de sortie de portefeuille' }})
                                </span>
                                <a class="deleteConfirmation ms-3" data-uuid="{{ $prestItem->id }}"
                                    data-type="confirmation_redirect" data-placement="top"
                                    data-token="{{ csrf_token() }}"
                                    data-url="{{ route('setting.prestation_product.destroy', $prestItem->id) }}"
                                    data-title="Vous êtes sur le point de retirer la prestation {{ $prestItem->prestation->libelle }}"
                                    data-id="{{ $prestItem->id }}" data-param="0"
                                    data-route="{{ route('setting.prestation_product.destroy', $prestItem->id) }}">
                                    <i class='bx bxs-trash' style="cursor: pointer"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Aucune prestation associée à ce produit.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
