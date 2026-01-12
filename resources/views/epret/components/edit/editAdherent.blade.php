<form action="{{ route('epret.adherent.update', $pret->adherent->id)}}" method="post" class="submitForm">

    @csrf

    <div class="row g-3 mb-3">

        <div class="col-12">

            <label class="form-label">Civilité <span class="star">*</span></label><br>

        

            @php

                $civilite = $pret->adherent->civilite ?? '';

            @endphp

        

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Madame" 

                       autocomplete="on" required data-invalid-message="Veuillez cocher la civilité" 

                       {{ $civilite === 'Madame' ? 'checked' : '' }}>

                <label class="form-check-label" for="inlineRadio1">Madame</label>

            </div>

            

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Mademoiselle" 

                       autocomplete="on" required {{ $civilite === 'Mademoiselle' ? 'checked' : '' }}>

                <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>

            </div>

            

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio3" value="Monsieur" 

                       autocomplete="on" required {{ $civilite === 'Monsieur' ? 'checked' : '' }}>

                <label class="form-check-label" for="inlineRadio3">Monsieur</label>

            </div>

        

            @error('civilite')

                <span class="text-danger">Veuillez cocher la civilité</span>

            @enderror

        </div>        

    </div>

    <!---end row-->

    <div class="row g-3 mb-3">

        <div class="col-12 col-lg-6">

            <label for="FisrtName" class="form-label">Nom <span class="star">*</span></label>

            <input type="text" name="nom" class="form-control" value="{{ $pret->adherent->nom ?? ''}}" id="FisrtName" placeholder="Nom" autocomplete="on" required>

            @error('nom')

                <span class="text-danger">Veuillez remplir le champ nom</span>

            @enderror

        </div>

        <div class="col-12 col-lg-6">

            <label for="LastName" class="form-label">Prénoms <span class="star">*</span></label>

            <input type="text" name="prenom" class="form-control" value="{{ $pret->adherent->prenom ?? ''}}" id="LastName" placeholder="Prénoms" autocomplete="on" required>

            @error('prenom')

                <span class="text-danger">Veuillez remplir le champ prenom</span>

            @enderror

        </div>

    </div>

    <!---end row-->

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="Date_naissance" class="form-label">Date de naissance <span class="star">*</span></label>
            <input type="date" name="datenaissance" value="{{ $pret->adherent->datenaissance ?? ''}}" class="form-control" id="Datnaissance"
                placeholder="Date de naissance" autocomplete="on" required>

            @error('datenaissance')
                <span class="text-danger"> Veuillez remplir la date de naissance </span>
            @enderror
        </div>

        <div class="col-12 col-lg-6">

            <label for="lieunaissanc" class="form-label">Lieu de naissance</label>

            <select class="form-select" name="lieunaissance" id="lieunaissance"

                 data-placeholder="Sélectionner le lieu" autocomplete="on">

                <option selected value="{{ $pret->adherent->lieunaissance ?? ''}}">{{ $pret->adherent->lieunaissance ?? ''}}</option>

            

                @foreach($villes as $ville)

                    @if($pret->adherent->lieunaissance !== $ville->libelleVillle)

                        <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>

                    @endif

                @endforeach

            </select>

        </div>

    </div>

    <!---end row-->

    <div class="row g-3 mb-3">

        <div class="col-12 col-lg-4">

            <label for="" class="form-label">Nature de la pièce <span class="star">*</span></label>

            <br>

        

            @php

                $naturepiece = $pret->adherent->naturepiece ?? '';

            @endphp

        

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="naturepiece" id="CNI" value="CNI" 

                       autocomplete="on" required {{ $naturepiece === 'CNI' ? 'checked' : '' }}>

                <label class="form-check-label" for="CNI">CNI</label>

            </div>

        

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="naturepiece" id="Atestation" value="AT" 

                       autocomplete="on" required {{ $naturepiece === 'AT' ? 'checked' : '' }}>

                <label class="form-check-label" for="Atestation">Attestation</label>

            </div>

        

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="naturepiece" id="Passport" value="Passport" 

                       autocomplete="on" required {{ $naturepiece === 'Passport' ? 'checked' : '' }}>

                <label class="form-check-label" for="Passport">Passport</label>

            </div>

        

            @error('naturepiece')

                <span class="text-danger">Veuillez cocher la nature de la pièce</span>

            @enderror

        </div> 
        <input type="hidden" name="contrat_id" value="{{ $pret->id ?? ''}}">       

        <div class="col-12 col-lg-4">

            <label for="numeropiece" class="form-label">numéro de la pièce<span class="star">*</span></label>

            <input type="text" name="numeropiece" value="{{ $pret->adherent->numeropiece ?? ''}}" class="form-control" id="numeropiece"

                placeholder="Nature de la pièce d'identité" autocomplete="on" required>



            @error('numeropiece')

                <span class="text-danger"> Veuillez remplir le numéro de la pièce </span>



            @enderror

        </div>

        <div class="col-12 col-lg-4">

            <label for="lieuresidence" class="form-label">Lieu de residence <SPAN class="text-danger">*</SPAN></label>

            <select class="form-select" name="lieuresidence" id="lieuresidence" data-placeholder="Sélectionner le lieu" autocomplete="on" required>

                <option selected value="{{ $pret->adherent->lieuresidence ?? ''}}">{{ $pret->adherent->lieuresidence ?? ''}}</option>

                @foreach($villes as $ville)

                    @if($pret->adherent->lieuresidence !== $ville->libelleVillle)

                        <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>

                    @endif

                @endforeach

            </select>

        </div>

    </div>

    <!---end row-->

    <div class="row g-3 mb-3">

        <div class="col-12 col-lg-6">

            <label for="profession" class="form-label">Profession</label>

            <select class="form-select" name="profession" id="profession" autocomplete="on">

                <option selected value="{{ $pret->adherent->profession ?? ''}}">{{ $pret->adherent->profession ?? ''}}</option>



                @foreach($professions as $profession)

                    @if($pret->adherent->profession !== $profession->MonLibelle)

                        <option value="{{ $profession->MonLibelle }}">{{ $profession->MonLibelle }}</option>

                    @endif

                @endforeach

            </select>

        </div>

        <div class="col-12 col-lg-6">

            <label for="employeur" class="form-label">Secteur d'activites</label>

            <select class="form-select" name="employeur" id="employeur" autocomplete="on">

                <option selected value="{{ $pret->adherent->employeur ?? ''}}">{{ $pret->adherent->employeur ?? ''}}</option>



                @foreach($secteurActivites as $secteurActivite)

                    @if($pret->adherent->employeur !== $secteurActivite->MonLibelle)

                        <option value="{{ $secteurActivite->MonLibelle }}">{{ $secteurActivite->MonLibelle }}</option>

                    @endif

                @endforeach

            </select>

        </div>



    </div>

    <div class="row g-3 mb-3">

        <div class="col-12">

            <label for="email" class="form-label">Email <span class="star">*</span></label>

            <input type="email" name="email" value="{{ $pret->adherent->email ?? ''}}" class="form-control" id="email" placeholder="Email" autocomplete="on" required>



            @error('email')



                <span class="text-danger"> Veuillez remplir votre email </span>



            @enderror

        </div>

    </div>

    <div class="row g-3 mb-3">

        <div class="col-12 col-lg-4">

            <label class="form-label">Mobile <span class="star">*</span></label><br>

            <div class="input-group mb-3">

                <input type="text" name="mobile" value="{{ $pret->adherent->mobile ?? ''}}" class="form-control" autocomplete="on" required>

            </div>



            @error('mobile')

                <span class="text-danger"> Veuillez remplir votre numéro de mobile </span>

            @enderror





        </div>

        <div class="col-12 col-lg-4">

            <label class="form-label">Mobile 2</label><br>

            <div class="input-group mb-3">

                <input type="text" name="mobile1" value="{{ $pret->adherent->mobile1 ?? ''}}" class="form-control" autocomplete="on">

            </div>

        </div>

        <div class="col-12 col-lg-4">



            <label class="form-label">Telephone</label><br>

            <div class="input-group mb-3">

                <input type="text" name="telephone" value="{{ $pret->adherent->telephone ?? ''}}" class="form-control" autocomplete="on">

            </div>

            </select>

        </div>

    </div>

    <!---end row-->

    <fieldset class="border p-3">

        <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoins</small></legend>

        <div class="row g-3 mb-3">

            <div class="col-12 col-lg-8">

                <label for="contact_nom" class="form-label">Nom et Prénoms <span class="text-danger">*</span></label>

                <input type="text" name="personneressource" value="{{ $pret->personneressource ?? ''}}" class="form-control" id="contact_nom" placeholder="Nom et Prénoms" required>

            </div>

            <div class="col-12 col-lg-4">

                <label class="form-label">Contact <span class="text-danger">*</span></label><br>

                <div class="input-group mb-3">

                    <input type="text" name="contactpersonneressource" value="{{ $pret->contactpersonneressource ?? ''}}" class="form-control" aria-label="Text input with select" required>

                </div>

            </div>

        </div>



        <div class="row g-3 mb-3">

            <div class="col-12 col-lg-8">

                <label for="contact_nom" class="form-label">Nom et Prénoms</label>

                <input type="text" name="personneressource2" value="{{ $pret->personneressource2 ?? ''}}" class="form-control" id="contact_nom" placeholder="Nom et Prénoms">

            </div>

            <div class="col-12 col-lg-4">

                <label class="form-label">Contact</label><br>

                <div class="input-group mb-3">

                    <input type="text" name="contactpersonneressource2" value="{{ $pret->contactpersonneressource2 ?? ''}}" class="form-control" aria-label="Text input with select">

                </div>

            </div>

        </div>
    </fieldset>

    <div class="row g-3 mb-3">

        <div class="col-12 col-lg-6">

            <button type="submit" class="btn btn-success">Enregistrer</button>

        </div>

    </div>



</form>