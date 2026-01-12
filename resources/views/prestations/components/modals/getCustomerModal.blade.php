<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Basic modal</button> --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if(auth()->user()->membre->branche == 'BANKASS')
                <form action="{{ route('prestation.fetchCustomerDetails') }}" method="post" class="submitForm">
                    @csrf
                    <div class="modal-body">
                        <div class="card radius-10">
                            <div class="card-body bg-light-succes rounded">
                                <div class="d-flex align-items-center"> 
                                    <input type="text" class="form-control" name="numCompte" id="numCompte" placeholder="N° de compte du client">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            @else
                <form action="{{ route('prestation.fetchCustomerDetails') }}" method="post" class="submitForm">
                    @csrf
                    <div class="modal-body">
                        <div class="card radius-10">
                            <div class="card-body bg-light-succes rounded">
                                <div class="d-flex align-items-center"> 
                                    <input type="text" class="form-control" name="idcontrat" id="idcontrat" placeholder="ID du contrat d'assurance">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
                
            @endif
            
        </div>
    </div>
</div>