<!-- Modal -->
<div class="modal fade" id="createPropositionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Assuré</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        {{-- {{ $product->MonLibelle }} --}}
                    </div>
                    <div class="card-body">
                        <form action="" method="" id="AddAssureForm">
                            <div class="col-12 col-lg-6">
                                <label for="civiliteAssur" class="form-label">Civilité <span class="star">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input civiliteAssur" type="radio" name="civiliteAssur" id="inlineRadio1" value="Madame" autocomplete="off" required>
                                    <label class="form-check-label" for="inlineRadio1">Madame</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input civiliteAssur" type="radio" name="civiliteAssur" id="inlineRadio2" value="Mademoiselle" autocomplete="off">
                                    <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input civiliteAssur" type="radio" name="civiliteAssur" id="inlineRadio3" value="Monsieur" autocomplete="off">
                                    <label class="form-check-label" for="inlineRadio3">Monsieur</label>
                                </div>
                                @error('civiliteAssur')
                                    <span class="text-danger"> Veuillez remplir le champ nom</span>
                                @enderror
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-6">
                                    <label for="nomAssur" class="form-label">Nom de l'assuré <span class="star">*</span></label>
                                    <input type="text" name="nomAssur" class="form-control" id="nomAssur"
                                        placeholder="Nom" autocomplete="off" required>
                                    @error('nomAssur')
                                        <span class="text-danger"> Veuillez remplir le champ nom</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="prenomAssur" class="form-label">Prénoms de l'assuré <span class="star">*</span></label>
                                    <input type="text" name="prenomAssur" class="form-control" id="prenomAssur"
                                        placeholder="Prénoms" required>
                                    @error('prenomAssur')
                                        <span class="text-danger"> Veuillez remplir le champ prenom </span>
                                    @enderror
                                </div>
                            </div><!---end row-->
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-6">
                                    <label for="datenaissanceAssur" class="form-label">Date de naissance <span class="star">*</span></label>
                                    <input type="date" name="datenaissanceAssur" class="form-control" id="datenaissanceAssur"
                                        placeholder="Date de naissance" required>
                                    
                                    @error('datenaissanceAssur')
                                        <span class="text-danger"> Veuillez remplir la date de naissance </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-6"> 
                                    <label for="lieunaissanceAssur" class="form-label">Lieu de naissance</label>
                                    <select class="form-select" name="lieunaissanceAssur" id="lieunaissanceAssur" data-codeproduit="{{ $product->CodeProduit }}" data-placeholder="Sélectionner le lieu">
                                        <option value="" selected>Sélectionner le lieu</option> <!-- Option vide pour le placeholder -->
                                        
                                        @foreach($villes as $ville)
                                            <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 
                                        @endforeach 
                                    </select>
                                </div>
                            </div><!---end row-->
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-6">
                                    <label for="" class="form-label">Nature de la pièce</label>
                                    <br> 
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input naturepieceAssur" type="radio" name="naturepieceAssur" id="CNIAssur" value="CNI">
                                        <label class="form-check-label" for="CNIAssur">CNI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input naturepieceAssur" type="radio" name="naturepieceAssur" id="AtestationAssur" value="AT">
                                        <label class="form-check-label" for="AtestationAssur">Attestation</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input naturepieceAssur" type="radio" name="naturepieceAssur" id="PassportAssur" value="Passport">
                                        <label class="form-check-label" for="PassportAssur">Passeport</label>
                                    </div> 
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="naturepieceAssur" id="carteConsulaire" value="Carte Consulaire" autocomplete="on" >
                                        <label class="form-check-label" for="carteConsulaire">Carte Consulaire</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="naturepieceAssur" id="AutrePiece" value="Autre">
                                        <label class="form-check-label" for="AutrePiece">Autre</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6"> 
                                    <label for="numeropieceAssur" class="form-label">numéro de la pièce</label>
                                    <input type="text" name="numeropieceAssur" class="form-control" id="numeropieceAssur"
                                        placeholder="numero de la pièce d'identité">
                                        
                                     
                                </div> 
                            </div><!---end row-->
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-6"> 
                                    <label for="lieuresidenceAssur" class="form-label">Lieu de residence</label>
                                    <select class="form-select" name="lieuresidenceAssur" id="lieuresidenceAssur" data-placeholder="Sélectionner le lieu">
                                        <option selected value="">Sélectionner le lieu</option> <!-- Option vide pour le placeholder -->
                                        
                                        @foreach($villes as $ville)
                                            <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="lienParente" class="form-label">Lien de Parenté <span class="text-danger">*</span></label>
                                    <select class="form-select" name="lienParente" id="lienParente"
                                        aria-label="Default select example" required>

                                        <option selected value="" disabled>Sélectionner le lien de Parenté</option>

                                        @foreach ($filliations as $item)
                                            <option value="{{ $item->CodeFiliation }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Telephone</label><br>
                                    <div class="input-group mb-3">
                                        <input type="tel" name="mobileAssur" id="mobileAssur" class="form-control" placeholder="ex: +225 0701020304" minlength="10" maxlength="15" >
                                    </div>
                                    
                                    @error('mobileAssur')
                                        <span class="text-danger"> Veuillez remplir votre numéro de mobile </span> 
                                    @enderror 
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="emailAssur" class="form-label">Email</label>
                                    <input type="email" name="emailAssur" class="form-control" id="emailAssur"
                                        placeholder="Email">
                                        
                                    @error('email')
                                        <span class="text-danger"> Veuillez remplir votre email </span>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div class="">
                                        <button type="button" class="btn border-btn" data-bs-dismiss="modal">Retour</button>
                                    </div>
                                    <div class="">
                                        <button type="button" class="btn btn-two" id="btn-ajouter">Ajouter</button>
                                    </div>
                                </div>
                                
                            </div> 
                        </form> 
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>