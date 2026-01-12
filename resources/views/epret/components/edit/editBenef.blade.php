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
                            {{-- @dd($pret->beneficiaires) --}}
                                @foreach ($pret->beneficiaires as $beneficiaire)

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

    </div>

{{-- </form> --}}

{{-- beneficiaireaudeces --}}



<div class="modal fade" id="addNewBenefModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un nouveau bénéficiaire</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('epret.addBenefPret') }}" class="submitForm">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="nomBenef" class="form-label">Nom du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" name="nomBenef" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="prenomBenef" class="form-label">Prénoms du bénéficiaire <span class="text-danger">*</span></label>
                            <input type="text" name="prenomBenef" class="form-control" placeholder="Prénoms">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="datenaissanceBenef" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" name="datenaissanceBenef">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="lieunaissanceBenef" class="form-label">Lieu de naissance</label>
                            <select name="lieunaissanceBenef" class="form-select">
                                <option>Sélectionner le lieu</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="lieuresidenceBenef" class="form-label">Lieu de residence</label>
                            <select name="lieuresidenceBenef" class="form-select">
                                <option>Sélectionner le lieu</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="lienParente" class="form-label">Lien de Parenté</label>
                            <select name="lienParente" class="form-select">
                                <option>Sélectionner le lien de Parenté</option>
                                <option value="Conjoint">Conjoint</option>
                                <option value="Enfant">Enfant</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input type="text" name="mobileBenef" class="form-control" placeholder="+225" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="emailBenef" class="form-label">Email</label>
                            <input type="email" name="emailBenef" class="form-control" placeholder="exemple@gmail.com">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label for="partBenef" class="form-label">Part en %</label>
                            <input type="number" name="partBenef" class="form-control" placeholder="0">
                        </div>
                    </div>

                    <input type="hidden" id="pret_id" name="pret_id" value="{{ $pret->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn border-btn" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-two">Ajouter</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>