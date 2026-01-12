<div class="modal fade" id="editBenefModal{{ $beneficiaire->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Modifier les informations du bénéficiaire</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('prod.update.beneficiaires', $beneficiaire->id) }}" class="submitForm" >

                    @csrf

                    <div class="row g-3 mb-3">

                        <div class="col-12 col-lg-6">

                            <label for="nomBenef" class="form-label">Nom du bénéficiaire</label>

                            <input type="text" id="nomBenef" class="form-control" placeholder="Nom" name="nomBenef" value="{{ $beneficiaire->nom ?? '' }}">

                        </div>

                        <div class="col-12 col-lg-6">

                            <label for="prenomBenef" class="form-label">Prénoms du bénéficiaire</label>

                            <input type="text" id="prenomBenef" class="form-control" placeholder="Prénoms" name="prenomBenef" value="{{ $beneficiaire->prenom ?? '' }}">

                        </div>

                    </div>
                    <div class="col-12">
                        <label for="datenaissance" class="form-label">Date de naissance</label>
                        <input type="date" id="datenaissanceBenef" class="form-control" name="datenaissanceBenef" value="{{ $beneficiaire->datenaissance ?? '' }}">
                    </div>

                    <div class="row g-3 mb-3">

                        <div class="col-12 col-lg-6">

                            <label for="lieuresidenceBenef" class="form-label">Lieu de residence</label>

                            <select id="lieuresidenceBenef" class="form-select" name="lieuresidenceBenef">

                                <option value="{{ $beneficiaire->lieuresidence ?? '' }}">{{ $beneficiaire->lieuresidence ?? '' }}</option>

                                @foreach($villes as $ville)

                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option> 

                                @endforeach 

                            </select>

                        </div>

                        <div class="col-12 col-lg-6">

                            <label for="lienParente" class="form-label">Lien de Parenté</label>

                            <select id="lienParente" class="form-select" name="lienParente">
                                <option value="{{ $beneficiaire->filiation ?? '' }}">{{ $beneficiaire->filiation ?? '' }}</option>
                                @if ($beneficiaire->filiation == 'Conjoint')
                                    <option value="moi-meme">Moi meme</option>
                                    <option value="Enfant">Enfant</option>
                                    <option value="Autre">Autre</option>
                                @elseif ($beneficiaire->filiation == 'Enfant')
                                    <option value="moi-meme">Moi meme</option>
                                    <option value="Conjoint">Conjoint</option>
                                    <option value="Autre">Autre</option>
                                @elseif ($beneficiaire->filiation == 'Autre')
                                    <option value="moi-meme">Moi meme</option>
                                    <option value="Conjoint">Conjoint</option>
                                    <option value="Enfant">Enfant</option>
                                @elseif ($beneficiaire->filiation == 'moi-meme')
                                    <option value="Conjoint">Conjoint</option>
                                    <option value="Enfant">Enfant</option>
                                    <option value="Autre">Autre</option>
                                @else
                                    <option value="Conjoint">Conjoint</option>
                                    <option value="moi-meme">Moi meme</option>
                                    <option value="Enfant">Enfant</option>
                                    <option value="Autre">Autre</option>
                                @endif
                            </select>

                        </div>
                    </div>

                    <div class="row g-3 mb-3">

                        <div class="col-12 col-lg-6">

                            <label class="form-label">Téléphone</label>

                            <input type="text" id="mobileBenef" class="form-control" placeholder="Téléphone" name="mobileBenef" value="{{ $beneficiaire->mobile ?? '' }}">

                        </div>

                        <div class="col-12 col-lg-6">

                            <label for="emailBenef" class="form-label">Email</label>

                            <input type="email" id="emailBenef" class="form-control" placeholder="Email" name="emailBenef" value="{{ $beneficiaire->email ?? '' }}">

                        </div>

                    </div>

                    <div class="row g-3 mb-3">

                        <div class="col-12">

                            <label for="partBenef" class="form-label">Part en %</label>

                            <input type="number" id="partBenef" class="form-control" placeholder="Part du bénéficiaire" name="partBenef" value="{{ $beneficiaire->part ?? '' }}">

                        </div>

                    </div>

                    {{-- <input type="hidden" name="contrat" value="{{ $pret->id }}"> --}}

                    <div class="modal-footer d-flex justify-content-between">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                        <button type="submit" class="btn btn-success">Modifier</button>

                    </div>

                </form> 

            </div>

        </div>

    </div>

</div>