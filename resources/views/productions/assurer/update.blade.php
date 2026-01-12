<div class="modal fade" id="editAssureModal{{ $assure->id }}" tabindex="-1" aria-hidden="true">

    @php
        $datenaissance = date('Y-m-d', strtotime($assure->datenaissance));
    @endphp
    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Modifier un Assuré</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="card">

                    <div class="card-header">

                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('prod.assures.update', $assure->id) }}"  class="submitForm">

                            @csrf

                            <fieldset class="border p-3">

                                <legend class="float-none w-auto px-2"><small>Information personnelle</small></legend>

                                <div class="col-12 col-lg-6">

                                    <label for="civiliteAssur" class="form-label">Civilité <span class="star">*</span></label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="civiliteAssur" id="inlineRadio1" value="Madame" autocomplete="off" 
                                            {{ $assure->civilite == 'Madame' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="inlineRadio1">Madame</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="civiliteAssur" id="inlineRadio2" value="Mademoiselle" autocomplete="off"
                                            {{ $assure->civilite == 'Mademoiselle' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="civiliteAssur" id="inlineRadio3" value="Monsieur" autocomplete="off"
                                            {{ $assure->civilite == 'Monsieur' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio3">Monsieur</label>
                                    </div>
                                    

                                    @error('civiliteAssur')

                                        <span class="text-danger"> Veuillez remplir le champ nom</span>

                                    @enderror

                                </div>

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6">

                                        <label for="nomAssur" class="form-label">Nom de l'assuré <span class="star">*</span></label>

                                        <input type="text" name="nomAssur" class="form-control" id="nomAssur" value="{{ $assure->nom ?? ''}}"

                                            placeholder="Nom" autocomplete="off" required>

                                        @error('nomAssur')

                                            <span class="text-danger"> Veuillez remplir le champ nom</span>

                                        @enderror

                                    </div>

                                    <div class="col-12 col-lg-6">

                                        <label for="prenomAssur" class="form-label">Prénoms de l'assuré <span class="star">*</span></label>

                                        <input type="text" name="prenomAssur" class="form-control" id="prenomAssur" value="{{ $assure->prenom ?? ''}}"

                                            placeholder="Prénoms" required>

                                        @error('prenomAssur')

                                            <span class="text-danger"> Veuillez remplir le champ prenom </span>

                                        @enderror

                                    </div>

                                </div><!---end row-->

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6">

                                        <label for="datenaissanceAssur" class="form-label">Date de naissance <span class="star">*</span></label>

                                        
                                        <input type="date" name="datenaissanceAssur" class="form-control" id="datenaissanceAssur" value="{{ $datenaissance ?? ''}}"

                                            placeholder="Date de naissance" required>

                                        

                                        @error('datenaissanceAssur')

                                            <span class="text-danger"> Veuillez remplir la date de naissance </span>

                                        @enderror

                                    </div>

                                    <div class="col-12 col-lg-6"> 

                                        <label for="lieunaissanceAssur" class="form-label">Lieu de naissance</label>

                                        <select class="form-select" name="lieunaissanceAssur" id="lieunaissanceAssur" data-placeholder="Sélectionner le lieu">

                                            <option value="{{ $assure->lieunaissance ?? ''}}">{{ $assure->lieunaissance ?? ''}}</option> <!-- Option vide pour le placeholder -->

                                            

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
                                            <input class="form-check-input" type="radio" name="naturepieceAssur" id="CNIAssur" value="CNI"
                                                {{ $assure->naturepiece == 'CNI' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="CNIAssur">CNI</label>
                                        </div>
                                    
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="naturepieceAssur" id="AtestationAssur" value="AT"
                                                {{ $assure->naturepiece == 'AT' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="AtestationAssur">Attestation</label>
                                        </div>
                                    
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="naturepieceAssur" id="PassportAssur" value="Passport"
                                                {{ $assure->naturepiece == 'Passport' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="PassportAssur">Passport</label>
                                        </div> 
                                    </div>
                                    

                                    <div class="col-12 col-lg-6"> 

                                        <label for="numeropieceAssur" class="form-label">numéro de la pièce</label>

                                        <input type="text" name="numeropieceAssur" class="form-control" id="numeropieceAssur" value="{{ $assure->numeropiece ?? ''}}"

                                            placeholder="numero de la pièce d'identité">

                                            

                                        

                                    </div> 

                                </div><!---end row-->

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6"> 

                                        <label for="lieuresidenceAssur" class="form-label">Lieu de residence</label>

                                        <select class="form-select" name="lieuresidenceAssur" id="lieuresidenceAssur" data-placeholder="Sélectionner le lieu">

                                            <option value="{{ $assure->lieuresidence ?? ''}}">{{ $assure->lieuresidence ?? ''}}</option> <!-- Option vide pour le placeholder -->Sélectionner le lieu</option> <!-- Option vide pour le placeholder -->

                                            

                                            @foreach($villes as $ville)

                                                <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 

                                            @endforeach 

                                        </select>

                                    </div>

                                    <div class="col-12 col-lg-6">

                                        <label for="lienParente" class="form-label">Lien de Parenté</label>

                                        <select class="form-select" name="lienParente" id="lienParente"

                                            aria-label="Default select example">

                                            <option value="{{ $assure->lienParente ?? ''}}">{{ $assure->lienParente ?? ''}}</option>

                                            <option value="Conjoint">Conjoint</option>

                                            <option value="Enfant">Enfant</option>

                                            <option value="Autre">Autre</option> 

                                        </select>

                                    </div> 

                                </div>

                                <div class="row g-3 mb-3">

                                    <div class="col-12 col-lg-6">

                                        <label class="form-label">Telephone</label><br>

                                        <div class="input-group mb-3">

                                            <input type="text" name="mobileAssur" class="form-control" id="mobileAssur" value="{{ $assure->mobile ?? ''}}">

                                        </div>

                                        

                                        @error('mobileAssur') 

                                            <span class="text-danger"> Veuillez remplir votre numéro de mobile </span> 

                                        @enderror 

                                    </div>

                                    <div class="col-12 col-lg-6">

                                        <label for="emailAssur" class="form-label">Email</label>

                                        <input type="email" name="emailAssur" class="form-control" id="emailAssur" value="{{ $assure->email ?? ''}}"

                                            placeholder="Email">

                                            

                                        @error('email')

                                        

                                            <span class="text-danger"> Veuillez remplir votre email </span>

                                        

                                        @enderror

                                    </div> 

                                </div>
                            </fieldset>

                            {{-- @if ($contrat->codeproduit === "LFFUN")
                            <fieldset class="border p-4 rounded-3 shadow-sm">
                                <legend class="float-none w-auto px-2 mb-3"><small><strong>État de santé de l'assuré</strong></small></legend>
                            
                                <div class="row g-3 mb-4">
                                    <div class="col-12 col-lg-8">
                                        <label for="nomAssur" class="form-label">L'assuré déclare être en bon état de santé <span class="text-danger">*</span></label>
                                    </div>
                                
                                    <div class="col-12 col-lg-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="EtatSante" id="EtatAssurSain" value="Sain"
                                                {{ $assure->sante->EtatSante == 'Sain' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="EtatAssurSain">Sain</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="EtatSante" id="EtatAssurMalade" value="Malade"
                                                {{ $assure->sante->EtatSante == 'Malade' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="EtatAssurMalade">Malade</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-12 col-lg-4">
                                        <div class="card shadow-sm border-light">
                                            <div class="card-body">
                                                <label for="diabete" class="form-label"><strong>Diabète</strong></label>
                                                <div class="form-check">
                                                    <input type="radio" name="diabete" id="diabeteOui" value="true" class="form-check-input"
                                                        {{ $assure->sante->diabete == 'true' ? 'checked' : '' }}>
                                                    <label for="diabeteOui" class="form-check-label">Oui</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="diabete" id="diabeteNon" value="false" class="form-check-input"
                                                        {{ $assure->sante->diabete == 'false' ? 'checked' : '' }}>
                                                    <label for="diabeteNon" class="form-check-label">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-12 col-lg-3">
                                        <div class="card shadow-sm border-light">
                                            <div class="card-body">
                                                <label for="cancer" class="form-label"><strong>Cancer</strong></label>
                                                <div class="form-check">
                                                    <input type="radio" name="cancer" id="cancerOui" value="true" class="form-check-input"
                                                        {{ $assure->sante->cancer == 'true' ? 'checked' : '' }}>
                                                    <label for="cancerOui" class="form-check-label">Oui</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="cancer" id="cancerNon" value="false" class="form-check-input"
                                                        {{ $assure->sante->cancer == 'false' ? 'checked' : '' }}>
                                                    <label for="cancerNon" class="form-check-label">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-12 col-lg-4">
                                        <div class="card shadow-sm border-light">
                                            <div class="card-body">
                                                <label for="avc" class="form-label"><strong>AVC</strong></label>
                                                <div class="form-check">
                                                    <input type="radio" name="avc" id="avcOui" value="true" class="form-check-input"
                                                        {{ $assure->sante->avc == 'true' ? 'checked' : '' }}>
                                                    <label for="avcOui" class="form-check-label">Oui</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="avc" id="avcNon" value="false" class="form-check-input"
                                                        {{ $assure->sante->avc == 'false' ? 'checked' : '' }}>
                                                    <label for="avcNon" class="form-check-label">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-12 col-lg-4">
                                        <div class="card shadow-sm border-light">
                                            <div class="card-body">
                                                <label for="tension" class="form-label"><strong>Hypertension</strong></label>
                                                <div class="form-check">
                                                    <input type="radio" name="hypertension" id="tensionOui" value="true" class="form-check-input"
                                                        {{ $assure->sante->hypertension == 'true' ? 'checked' : '' }}>
                                                    <label for="tensionOui" class="form-check-label">Oui</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="hypertension" id="tensionNon" value="false" class="form-check-input"
                                                        {{ $assure->sante->hypertension == 'false' ? 'checked' : '' }}>
                                                    <label for="tensionNon" class="form-check-label">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-12 col-lg-4">
                                        <div class="card shadow-sm border-light">
                                            <div class="card-body">
                                                <label for="renalInsuff" class="form-label"><strong>Insuffisance rénale</strong></label>
                                                <div class="form-check">
                                                    <input type="radio" name="insuffRenal" id="renalInsuffOui" value="true" class="form-check-input"
                                                        {{ $assure->sante->insuffrenale == 'true' ? 'checked' : '' }}>
                                                    <label for="renalInsuffOui" class="form-check-label">Oui</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="insuffRenal" id="renalInsuffNon" value="false" class="form-check-input"
                                                        {{ $assure->sante->insuffrenale == 'false' ? 'checked' : '' }}>
                                                    <label for="renalInsuffNon" class="form-check-label">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            
                            </fieldset>
                            @endif --}}
                            

                            <div class="col-12">

                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div class=""> 
                                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Retour</button>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-success px-4">Modifier</button>
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