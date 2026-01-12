<div class="container-fluid">
    <form method="POST" action="{{ route('epret.update', $pret->id) }}" class="submitForm">
        @csrf

        <fieldset>
            <legend class="float-none w-auto px-2"><small>Informations sur le prêt</small></legend>

            <!-- Nature du prêt -->
            <div class="row">
                <h6>Nature du prêt</h6>
                <div class="col">
                    <input type="radio" name="naturePret" class="form-check-input" value="Nouveau pret" 
                           {{ ($pret->naturepret ?? '') === 'Nouveau pret' ? 'checked' : '' }} required>
                    <label for="naturePret" class="form-check-label">Nouveau prêt</label>
                </div>
                <div class="col">
                    <input type="radio" name="naturePret" class="form-check-input" value="Rachat interne" 
                           {{ ($pret->naturepret ?? '') === 'Rachat interne' ? 'checked' : '' }} required>
                    <label for="naturePret" class="form-check-label">Rachat interne</label>
                </div>
                <div class="col">
                    <input type="radio" name="naturePret" class="form-check-input" value="Rachat externe" 
                           {{ ($pret->naturepret ?? '') === 'Rachat externe' ? 'checked' : '' }} required>
                    <label for="naturePret" class="form-check-label">Rachat externe</label>
                </div>
            </div>
            <!-- Type de prêt -->
            <div class="row mt-4">
                <h6>Type de prêt</h6>
                <div class="col">
                    <input type="radio" name="typPret" class="form-check-input" value="Prêt à la consommation" 
                           {{ ($pret->typepret ?? '') === 'Prêt à la consommation' ? 'checked' : '' }} required>
                    <label for="typPret" class="form-check-label">Prêt à la consommation</label>
                </div>
                <div class="col">
                    <input type="radio" name="typPret" class="form-check-input" value="Prêt immobilier" 
                           {{ ($pret->typepret ?? '') === 'Prêt immobilier' ? 'checked' : '' }} required>
                    <label for="typPret" class="form-check-label">Prêt immobilier</label>
                </div>
            </div>

            <!-- Dates -->
            <div class="row my-4">
                <fieldset class="col">
                    <legend class="float-none w-auto px-2"><small>Date de mise en place prévue</small></legend>
                    <input id="loanDateMiseEnPlace" type="date" class="form-control" name="loanDateMiseEnPlace" 
                           value="{{ $pret->effetgarantie ?? '' }}">
                </fieldset>

                <fieldset class="col mx-2">
                    <legend class="float-none w-auto px-2"><small>Première échéance de remboursement prévue <span class="text-danger">*</span></small></legend>
                    <input id="firstDateEcheance" type="date" class="form-control" name="firstDateEcheance" 
                           value="{{ $pret->dateecheancedebut ?? '' }}" required>
                </fieldset>

                <fieldset class="col">
                    <legend class="float-none w-auto px-2"><small>Dernière échéance de remboursement prévue <span class="text-danger">*</span></small></legend>
                    <input id="lasLoanDateRembour" type="date" class="form-control" name="lasLoanDateRembour" 
                           value="{{ $pret->dateecheancefin ?? '' }}" required>
                </fieldset>
            </div>

            <!-- Périodicités -->
            <div class="row mt-4">
                <div class="col-6">
                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Périodicité de remboursement <span class="text-danger">*</span></small></legend>
                        <div class="row">
                            @foreach (['M' => 'Mensuelle', 'T' => 'Trimestrielle', 'S' => 'Semestrielle', 'A' => 'Annuelle', 'U' => 'Versement Unique'] as $value => $label)
                                <div class="col">
                                    <div class="form-check">
                                        <input type="radio" name="periodiciterRembou" class="form-check-input" value="{{ $value }}" 
                                               {{ ($pret->remboursement ?? '') === $value ? 'checked' : '' }} required>
                                        <label class="form-check-label">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>

                <div class="col-6">
                    <fieldset>
                        <legend class="float-none w-auto px-2"><small>Périodicité de paiement de la prime <span class="text-danger">*</span></small></legend>
                        <div class="row">
                            @foreach (['M' => 'Mensuelle', 'T' => 'Trimestrielle', 'S' => 'Semestrielle', 'A' => 'Annuelle', 'U' => 'Versement Unique'] as $value => $label)
                                <div class="col">
                                    <div class="form-check">
                                        <input type="radio" name="periodiciterPrime" class="form-check-input" value="{{ $value }}" 
                                               {{ ($pret->periodicite ?? '') === $value ? 'checked' : '' }} required>
                                        <label class="form-check-label">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            </div>

            <!-- Submit -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </fieldset>
    </form>
</div>
