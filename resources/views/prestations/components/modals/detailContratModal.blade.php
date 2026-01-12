<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Basic modal</button> --}}
<!-- Modal -->
<div class="modal fade" id="detailContratModal" tabindex="-1" aria-labelledby="detailContratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailContratModalLabel">Selectionnez un contrat pour voir ses details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card radius-10">
                    <div class="card-body rounded">
                        <div class="shadow-none mb-3">
                            <div class="card-header">
                                <h5 class="mb-0 text-center">Détail du contrat</h5>
                            </div>
                            <div class="row py-3">
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <dl class="row">
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Adherent:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="adher"></dd>
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">ID du contrat:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="idProp"></dd>
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">N° Proposition:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="CodeProp"></dd>
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">N° Bulletin:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="Codeprop"></dd>
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Conseiller:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="CodeCons"></dd>
                                    </dl>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <dl class="row">
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Produit:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="produitSous"></dd>
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Prime:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="Prime"></dd>
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date d'effet:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="DateEffet"></dd>
                                        <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date de fin:</dt>
                                        <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="DateFinAdhesion"></dd>
                                    </dl>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">OK </button>
            </div>
        </div>
    </div>
</div>