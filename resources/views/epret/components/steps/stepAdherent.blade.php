
@php
    $valueDateNaissance = isset($simulationData['dateNaissance']) 
    ? date('Y-m-d', strtotime($simulationData['dateNaissance'])) 
    : '';
@endphp
<div class="row g-3 mb-3">
    <div class="col-12">
        <label class="form-label">Civilité <span class="star">*</span></label> <br>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Madame" autocomplete="on" required data-invalid-message="Veuillez cocher la civilité">
            <label class="form-check-label" for="inlineRadio1">Madame</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Mademoiselle" autocomplete="on" required>
            <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio3" value="Monsieur" autocomplete="on" required>
            <label class="form-check-label" for="inlineRadio3">Monsieur</label>
        </div>
        @error('civilite')
            <span class="text-danger"> Veuillez cocher la civilité </span>
        @enderror
    </div>
</div>

<div class="row g-3 mb-3">
    <!-- Champ Nom -->
    <div class="col-12 col-lg-6">
        <label for="FisrtName" class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" name="nom" class="form-control" id="FisrtName" placeholder="Nom" autocomplete="on" required>
        @error('nom')
            <span class="text-danger">Veuillez remplir le champ nom</span>
        @enderror
    </div>
    <!-- Champ Prénoms -->
    <div class="col-12 col-lg-6">
        <label for="LastName" class="form-label">Prénoms <span class="text-danger">*</span></label>
        <input type="text" name="prenom" class="form-control" id="LastName" placeholder="Prénoms" autocomplete="on" required>
        @error('prenom')
            <span class="text-danger">Veuillez remplir le champ prenom</span>
        @enderror
    </div>
</div>
<!---end row-->
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6">
        <label for="Date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
        <input type="date" name="datenaissance" class="form-control" id="Date_naissance"
            placeholder="Date de naissance" autocomplete="on" value="{{$valueDateNaissance}}" required readonly>

            <span class="text-danger date-error"></span>

        @error('datenaissance')
            <span class="text-danger"> Veuillez remplir la date de naissance </span>
        @enderror
    </div>
    
    <div class="col-12 col-lg-6">
        <label for="lieunaissanc-{{ $product->CodeProduit }}" class="form-label">Lieu de naissance</label>
        <select class="form-select selection" name="lieunaissance" id="lieunaissance"
            data-codeproduit="{{ $product->CodeProduit }}" data-placeholder="Sélectionner le lieu" autocomplete="on">
            <option disabled selected value="">Sélectionner le lieu</option>

            @foreach($villes as $ville)
                <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
            @endforeach
        </select>
    </div>
</div>
<!---end row-->
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-4">
        <label for="" class="form-label">Nature de la pièce <span class="text-danger">*</span></label>
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="naturepiece" id="CNI" value="CNI" autocomplete="on" required>
            <label class="form-check-label" for="CNI">CNI</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="naturepiece" id="Atestation" value="AT" autocomplete="on" required>
            <label class="form-check-label" for="Atestation">Atestation</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="naturepiece" id="Passport" value="Passport" autocomplete="on" required>
            <label class="form-check-label" for="Passport">Passport</label>
        </div>

        @error('naturepiece')
            <span class="text-danger"> Veuillez cocher la nature de la pièce </span>
        @enderror
    </div>
    <div class="col-12 col-lg-4">
        <label for="numeropiece" class="form-label">numéro de la pièce<span class="text-danger">*</span></label>
        <input type="text" name="numeropiece" class="form-control" id="numeropiece"
            placeholder="Nature de la pièce d'identité" autocomplete="on" required>

        @error('numeropiece')
            <span class="text-danger"> Veuillez remplir le numéro de la pièce </span>
        @enderror
    </div>
    <div class="col-12 col-lg-4">
        <label for="lieuresidence" class="form-label">N° de compte</label>
        <input type="number" name="numerocompte" class="form-control" id="numerocompte">
    </div>
</div>
<!---end row-->
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-4">
        <label for="profession" class="form-label">Profession</label>
        <select class="form-select selection" name="profession" id="profession" autocomplete="on">
            <option disabled selected value="">Sélectionner la profession</option>

            @foreach($professions as $profession)
                <option value="{{ $profession->MonLibelle }}">{{ $profession->MonLibelle }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label for="employeur" class="form-label">Secteur d'activites</label>
        <select class="form-select selection" name="employeur" id="employeur" autocomplete="on">
            <option disabled selected value="">Sélectionner le secteur d'activites</option>

            @foreach($secteurActivites as $secteurActivite)
                <option value="{{ $secteurActivite->MonLibelle }}">{{ $secteurActivite->MonLibelle }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label for="lieuresidence" class="form-label">Lieu de residence</label>
        <select class="form-select selection" name="lieuresidence" id="lieuresidence" autocomplete="on">
            <option disabled selected value="">Sélectionner le lieu</option>

            @foreach($villes as $ville)
                <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
            @endforeach
        </select>
    </div>

</div>
<div class="row g-3 mb-3">
    <div class="col-12">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="on" >

        @error('email')

            <span class="text-danger"> Veuillez remplir votre email </span>

        @enderror
    </div>
</div>
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-4">
        <label class="form-label">Mobile <span class="text-danger">*</span></label><br>
        <div class="input-group mb-3">
            <input type="text" name="mobile" class="form-control" autocomplete="on">
        </div>

        @error('mobile')
            <span class="text-danger"> Veuillez remplir votre numéro de mobile </span>
        @enderror


    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label">Mobile 2</label><br>
        <div class="input-group mb-3">
            <input type="text" name="mobile1" class="form-control" autocomplete="on">
        </div>
    </div>
    <div class="col-12 col-lg-4">

        <label class="form-label">Telephone</label><br>
        <div class="input-group mb-3">
            <input type="text" name="telephone" class="form-control" autocomplete="on">
        </div>
        </select>
    </div>
</div>
<!---end row-->
<fieldset class="border p-3">
    <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoins</small></legend>

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-8">
            <label for="contact_nom" class="form-label">Nom et Prénoms</label>
            <input type="text" name="personneressource" class="form-control" id="contact_nom" placeholder="Nom et Prénoms">
        </div>
        <div class="col-12 col-lg-4">
            <label class="form-label">Contact</label><br>
            <div class="input-group mb-3">
                <input type="text" name="contactpersonneressource" class="form-control" aria-label="Text input with select">
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-8">
            <label for="contact_nom" class="form-label">Nom et Prénoms</label>
            <input type="text" name="personneressource2" class="form-control" id="contact_nom" placeholder="Nom et Prénoms">
        </div>
        <div class="col-12 col-lg-4">
            <label class="form-label">Contact</label><br>
            <div class="input-group mb-3">
                <input type="text" name="contactpersonneressource2" class="form-control" aria-label="Text input with select">
            </div>
        </div>
    </div>
</fieldset>


