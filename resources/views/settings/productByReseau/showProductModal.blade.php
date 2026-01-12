<div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel{{ $item->id }}">Liste des produits</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($item->products->isEmpty())
                    <p>Aucun produit associé à cet élément.</p>
                @else
                    <ul class="list-group">
                        @foreach ($item->products as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="product-{{ $item->id }}">
                                <span>
                                    {{ $item->libelleproduit }} (Code : {{ $item->codeproduitformule }})
                                </span>
                                {{-- <button class="btn btn-danger btn-sm delete-product"> --}}
                                    <a class="deleteConfirmation ms-3" data-uuid="{{$item->id}}"
                                        data-type="confirmation_redirect" data-placement="top"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{route('setting.destroy.productReseau',$item->id)}}"
                                        data-title="Vous êtes sur le point de supprimer {{$item->libelleproduit}} "
                                        data-id="{{$item->id}}" data-param="0"
                                        data-route="{{route('setting.destroy.productReseau',$item->id)}}">
                                        <i class='bx bxs-trash' style="cursor: pointer"></i>
                                    </a>
                                {{-- </button> --}}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>