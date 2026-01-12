<div class="container-fluid">
   

    <fieldset>
        <legend class="float-none w-auto px-2"><small>Informations sur le pret</small></legend>

        <div class="row">
            <h6>Nature du prêt</h6>
            <div class="col">
                <input type="radio" name="naturePret" class="form-check-input" value="Nouveau pret" required>
                <label for="naturePret" class="form-check-label">Nouveau pret</label>
            </div>
            <div class="col">
                <input type="radio" name="naturePret" value="Rachat interne" class="form-check-input" required>
                <label for="naturePret" class="form-check-label">Rachat interne</label>
            </div>
            <div class="col">
                <input type="radio" name="naturePret" value="Rachat externe" class="form-check-input" required>
                <label for="naturePret" class="form-check-label">Rachat externe</label>
            </div>
        </div>

        <div class="row my-4">
            <div class="col">
                <Label class="form-label">Montant du pret</Label>
                <input class="form-control" type="number" value="{{ $simulationData['montant'] ?? '-' }}" readonly> 
                <input class="form-control" type="hidden" name="montant" value="{{ $simulationData['montant'] ?? '-' }}"> 
            </div>
            <div class="col">
                <Label class="form-label">Duree du pret (Mois)</Label>
                <input class="form-control" type="number"  value="{{ $simulationData['duree'] ?? '-' }}" readonly>
                <input class="form-control" type="hidden" id="dureeCotation" name="duree" value="{{ $simulationData['duree'] ?? '-' }}">
            </div>
        </div>

        <input class="form-control" type="hidden" name="prime" value="{{ $simulationData['prime'] ?? '-' }}">
        <input class="form-control" type="hidden" name="primeObseque" value="{{ $simulationData['primeObseque'] ?? '0'  }}">
        <input class="form-control" type="hidden" name="primeEmprunteur" value="{{ $simulationData['primeEmprunteur'] ?? '0'  }}">

        <div class="row">
            <h6>Type de pret</h6>
            <div class="col">
                <input type="radio" name="typPret" class="form-check-input" value="Prêt à la consommation" required>
                <label for="typPret" class="form-check-label">Prêt à la consommation
                </label>
            </div>
            <div class="col">
                <input type="radio" name="typPret" value="Prêt immobilier" class="form-check-input" required>
                <label for="typPret" class="form-check-label">Prêt immobilier</label>
            </div>
        </div>

        <div class="row my-4">
            <fieldset class="col">
                <legend class="float-none w-auto px-2"><small>Date de la mise en place prévue</small></legend>
                <input id="loanDateMiseEnPlace" type="date" class="form-control" value="" name="loanDateMiseEnPlace" oninput="updateDisplay()">
            </fieldset>
        
            <fieldset class="col mx-2">
                <legend class="float-none w-auto px-2"><small>Première échéance de remboursement prévue <span class="text-danger">*</span></small></legend>
                <input id="firstDateEcheance" type="date" class="form-control" name="firstDateEcheance" required oninput="updateDisplay()">
            </fieldset>
        
            <fieldset class="col">
                <legend class="float-none w-auto px-2"><small>Dernière échéance de remboursement prévue <span class="text-danger">*</span></small></legend>
                <input id="lasLoanDateRembour" type="date" class="form-control" name="lasLoanDateRembour" oninput="updateDisplay()">
            </fieldset>
        </div>  

        

        <div class="row mt-4">
            <div class="col-6">
                <fieldset>
                    <legend class="float-none w-auto px-2"><small>Périodicite de remboursement <span class="text-danger">*</span></small></legend>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" class="form-check-input" value="M" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterRembou">Mensuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" class="form-check-input" value="T" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterRembou">Trimestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" class="form-check-input" value="S" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterRembou">Semestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" class="form-check-input" value="A" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterRembou">Annuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" class="form-check-input" value="U" required onclick="updateDisplay()"     >
                                <label class="form-check-label" for="periodiciterRembou">Versement Unique</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset>
                    <legend class="float-none w-auto px-2"><small>Périodicité de paiement de la prime <span class="text-danger">*</span></small></legend>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" class="form-check-input" value="M" required onclick="updateDisplay()">
                                <label class="form-check-label" for="">Mensuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" class="form-check-input" value="T" required onclick="updateDisplay()">
                                <label class="form-check-label" for="">Trimestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" class="form-check-input" value="S" required onclick="updateDisplay()">
                                <label class="form-check-label" for="">Semestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" class="form-check-input" value="A" required onclick="updateDisplay()">
                                <label class="form-check-label" for="">Annuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" class="form-check-input" value="U" required onclick="updateDisplay()">
                                <label class="form-check-label" for="">Versement Unique</label>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
    </fieldset>
    
    <script>
        const dateInput = document.getElementById('loanDateMiseEnPlace');
        const today = new Date();
        const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
        dateInput.value = nextMonth.toISOString().split('T')[0];
    </script>

    <script>
        document.querySelectorAll('input[name="naturePret"]').forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked) {
                    const naturePret = radio.value;

                    document.getElementById('naturePret').innerText = naturePret;
                }
            });
        })
    </script>

        
    <script>
        const firstDateEcheance = document.getElementById("firstDateEcheance");
        const duree = document.getElementById("dureeCotation");

        firstDateEcheance.addEventListener("blur", function() {
            const dateSaisie = new Date(firstDateEcheance.value);
    
            const moisAjoutes = parseInt(duree.value);
            console.log("Mois ajoutes:", moisAjoutes);
            const nouvelleDate = new Date(dateSaisie.setMonth(dateSaisie.getMonth() + moisAjoutes));
            const lasLoanDateRembour = document.getElementById("lasLoanDateRembour");
            lasLoanDateRembour.value = nouvelleDate.toISOString().split('T')[0];
        });
    </script>
</div>


