<div class="modal fade" id="showMotifRejetModal{{ $prestation->code }}" tabindex="-1"
    aria-labelledby="showMotifRejetModalLabel{{ $prestation->code }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Motifs de rejet de la prestation {{ $prestation->code }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($prestation->motifrejet->isNotEmpty())
                    <ul class="list-group container">
                        @foreach ($prestation->motifrejet as $motifItem)
                            <li class="list-group-item text-wrap"
                                id="product-{{ $motifItem->id }}">
                                    {{ $motifItem->motif->libelle }}
                                    <br>
                                    @if($motifItem->motif->code == "MRP-00003")
                                        <small class="text-danger">Veuillez supprimer le document RIB de la liste des documents joints et de charger un autre plus lisible</small>
                                    @endif
                                    @if($motifItem->motif->code == "MRP-00004")
                                        <small class="text-danger">Veuillez supprimer le document CNI de la liste des documents joints et de charger un autre plus lisible</small>
                                    @endif
                            </li>
                            
                        @endforeach
                        @if($prestation->observationtraitement != null || $prestation->observationtraitement != '')
                            <li class="list-group-item bg-light text-dark w-100 text-wrap">
                                <h3 class="">Observation</h3>
                                {{ $prestation->observationtraitement }}
                            </li>
                        @endif
                    </ul>
                @else
                    <p class="text-center">Aucun motif de rejet pour cette prestation.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
