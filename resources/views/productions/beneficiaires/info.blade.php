{{-- <form action="" method="post"> --}}

    <div>
        <h5 class="mb-1">Informations sur les bénéficiaire(s)</h5>

        <div class="mx-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewBenefModal">
                    Ajouter un nouveau beneficiare
                </button>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="card col" style="min-height: 60px">
                <div class="card-header">
                    <p>Au terme du contrat 
                        <span class="float-end">
                            <button id="editBtnBeneficiaireauterme" type="button" class="btn btn-sm btn-outline-primary border-0 fs-6">
                                <i class="bx bx-edit"></i>
                            </button>
                        </span>
                    </p>
                </div>
                <div class="card-body text-uppercase">
                    <div class="col" id="beneficiaireText">{{ $contrat->beneficiaireauterme ?? 'Non renseigné' }}</div>
                    <form style="display: none;" id="beneficiaireFormActor">
                        @csrf
                        <input type="hidden" name="contrat_id" value="{{ $contrat->id }}">
                        <select name="beneficiaireauterme" id="beneficiaireSelect" class="form-select">
                            <option value="{{ $contrat->beneficiaireauterme ?? 'Non renseigné' }}" selected>
                                {{ $contrat->beneficiaireauterme ?? 'Non renseigné' }}
                            </option>
                            <option value="Le conjoint non divorcé, ni séparé de corps">Le conjoint non divorcé, ni séparé de corps</option>
                            <option value="Les enfants nés et à naître">Les enfants nés et à naître</option>
                        </select>
                    </form>
                </div>
            </div>
            
            <div class="card col" style="min-height: 60px">
                <div class="card-header">
                    <p>En cas de décès avant le terme
                        <span class="float-end">
                            <button id="editBtnAuDeces" type="button" class="btn btn-sm btn-outline-primary  border-0 fs-6">
                                <i class="bx bx-edit"></i>
                            </button>
                        </span>
                    </p>
                </div>
                    
                <div class="card-body text-uppercase">
                    <div class="col" id="auDecesText">{{ $contrat->beneficiaireaudeces ?? 'Non renseigné' }}</div>
                    <form style="display: none;" id="auDecesForm">
                        @csrf
                        <input type="hidden" name="contrat_id" value="{{ $contrat->id }}">
                        <select name="beneficiaireaudeces" id="benefAuDecesSelect" class="form-select">
                            <option value="{{ $contrat->beneficiaireaudeces ?? 'Non renseigné' }}" selected>
                                {{ $contrat->beneficiaireaudeces ?? 'Non renseigné' }}
                            </option>
                            <option value="Le conjoint non divorcé, ni séparé de corps">Le conjoint non divorcé, ni séparé de corps</option>
                            <option value="Les enfants nés et à naître">Les enfants nés et à naître</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="card">

                <div class="card-body overflow-auto overflow-scroll">

                    <table class="table mb-0 table-striped table-sm responsive table-bordered" id="beneficiariesTable">

                        <thead>

                            <tr style="font-size: 12px">

                                <th scope="col">Nom & Prénoms</th>

                                <th scope="col">Né(e) le</th>

                                {{-- <th scope="col">Lieu de naissance</th>

                                <th scope="col">Lieu de residence</th> --}}

                                <th scope="col">Filiation</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Taux (%)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px">
                            {{-- @dd($contrat->beneficiaires) --}}
                                @foreach ($contrat->beneficiaires as $beneficiaire)

                                <tr id="beneficiaire-row-{{ $beneficiaire->id }}">

                                    <td>{{ $beneficiaire->nom ?? '--'}} {{ $beneficiaire->prenom ?? '--'}}</td>

                                    <td>{{ $beneficiaire->datenaissance ?? '--'}}</td>

                                    {{-- <td>{{ $beneficiaire->lieunaissance ?? '--'}}</td>

                                    <td>{{ $beneficiaire->lieuresidence ?? '--'}}</td> --}}

                                    <td>{{ $beneficiaire->filiation ?? '--'}}</td>

                                    <td>{{ $beneficiaire->mobile ?? '--'}}</td>

                                    <td>{{ $beneficiaire->email ?? '--'}}</td>

                                    <td>{{ $beneficiaire->part ?? '--' }}</td>

                                    <td>
                                        <a href="" data-bs-target="#showBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal"><i class="fadeIn animated bx bx-show fs-4"></i></a>

                                        @if ($beneficiaire->filiation !== "moi-meme")
                                            <a class="mx-2" href="" data-bs-target="#editBenefModal{{ $beneficiaire->id }}" data-bs-toggle="modal"><i class="fadeIn animated bx bx-edit fs-4"></i></a>
                                        @endif

                                        

                                        <a class="deleteConfirmation" data-uuid="{{ $beneficiaire->id }}"
                                            data-type="confirmation_redirect" data-placement="top"
                                            data-token="{{ csrf_token() }}" data-url="{{ route('prod.delete.beneficiaire', $beneficiaire->id) }}"
                                            data-title="Vous êtes sur le point de supprimer {{ $beneficiaire->nom }} {{ $beneficiaire->prenom }}"
                                            data-id="{{ $beneficiaire->id }}" data-param="0"
                                            data-route="{{ route('prod.delete.beneficiaire', $beneficiaire->id) }}">
                                                <i class='bx bxs-trash fs-4'></i>
                                        </a>
                                    </td>

                                </tr>

                                    @include('productions.beneficiaires.show')
                                    @include('productions.beneficiaires.edit')

                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('productions.beneficiaires.addNewBenef')
        @include('productions.components.addActorProposition.addAdherentBenefModal')


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const editBtn = document.getElementById("editBtnBeneficiaireauterme");
                const beneficiaireText = document.getElementById("beneficiaireText");
                const beneficiaireForm = document.getElementById("beneficiaireFormActor");
                const beneficiaireSelect = document.getElementById("beneficiaireSelect");

                // Affiche ou masque le select lorsqu'on clique sur "edit"
                editBtn.addEventListener("click", function () {
                    if (beneficiaireForm.style.display === "none") {
                        beneficiaireForm.style.display = "block";
                        beneficiaireText.style.display = "none";
                    } else {
                        beneficiaireForm.style.display = "none";
                        beneficiaireText.style.display = "block";
                    }
                });

                // Met à jour le contrat via une requête AJAX lors du changement de valeur
                beneficiaireSelect.addEventListener("change", function () {
                    const newValue = beneficiaireSelect.value;
                    const contratId = document.querySelector('input[name="contrat_id"]').value;

                    console.log(`Nouvelle valeur : ${newValue}`);
                    console.log(`ID du contrat : ${contratId}`);

                    fetch("/production/update/benefire/" + contratId, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        },
                        body: JSON.stringify({
                            contrat_id: contratId,
                            beneficiaireauterme: newValue,
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Erreur lors de la mise à jour");
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Réponse du serveur :", data);
                        if (data.success) {
                            beneficiaireText.textContent = newValue;
                            beneficiaireForm.style.display = "none";
                            beneficiaireText.style.display = "block";
                        } else {
                            alert("La mise à jour a échoué. Veuillez réessayer.");
                        }
                    })
                    .catch(error => {
                        console.error("Erreur :", error);
                        alert("Une erreur est survenue lors de la mise à jour.");
                    });
                });


            });

        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const editBtnAuDeces = document.getElementById("editBtnAuDeces");

                editBtnAuDeces.addEventListener("click", function () {
                    if (auDecesForm.style.display === "none") {
                        auDecesForm.style.display = "block";
                        auDecesText.style.display = "none";
                    } else {
                        auDecesForm.style.display = "none";
                        auDecesText.style.display = "block";
                    }
                });

                benefAuDecesSelect.addEventListener("change", function () {
                    const newValue = benefAuDecesSelect.value;
                    const contratId = document.querySelector('input[name="contrat_id"]').value;

                    fetch("/production/update/benefDeces/" + contratId, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        },
                        body: JSON.stringify({
                            contrat_id: contratId,
                            beneficiaireaudeces: newValue,
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Erreur lors de la mise à jour");
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Réponse du serveur :", data);
                        if (data.success) {
                            auDecesText.textContent = newValue;
                            auDecesForm.style.display = "none";
                            auDecesText.style.display = "block";
                        } else {
                            alert("La mise à jour a échoué. Veuillez réessayer.");
                        }
                    })
                    .catch(error => {
                        console.error("Erreur :", error);
                        alert("Une erreur est survenue lors de la mise à jour.");
                    });
                });

            });
        </script>
    </div>

{{-- </form> --}}

{{-- beneficiaireaudeces --}}