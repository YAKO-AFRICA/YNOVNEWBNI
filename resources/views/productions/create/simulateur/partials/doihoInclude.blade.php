<style>
    .ribbon {
        position: relative;
        background: #11771f;
        color: white;
        padding: 10px;
        font-weight: bold;
        text-align: center;
        border-radius: 5px 5px 0 0;
    }

    .btn-inactif {
        background-color: #d9d9d9;
        color: #666;
        cursor: not-allowed;
        pointer-events: none;
    }
    
    .form-check-label {
        margin-left: 5px;
    }
</style>

@php
    $productGarantie = App\Models\ProduitGarantie::where(['codeproduit' => "DOIHOO", 'branche' => 'IND'])->get();
@endphp

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card p-4">
                <h4 class="text-center text-uppercase">Simulateur de prime</h4>
                <fieldset>
                    <legend class="text-center w-auto float-none px-2 "><small>Données de simulation</small></legend>
                
                    <form id="doihooSimulateurForm">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Code Produit :</label>
                                <input type="text" class="form-control" id="CodeProduit" name="CodeProduit" value="DOIHOO" required readonly>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Durée Cotisation :</label>
                                <input type="number" class="form-control" id="duree" name="duree" value="8" required readonly>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Code Périodicité :</label>
                                <select name="codePeriodicite" id="codePeriodicite" class="form-control" required autocomplete="off">
                                    <option value="" selected>Sélectionnez une périodicité</option>
                                    <option value="M">MENSUELLE</option>
                                    <option value="T">TRIMESTRIELLE</option>
                                    <option value="S">SEMESTRIELLE</option>
                                    <option value="A">ANNUELLE</option>
                                </select>
                            </div>

                           
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Capital Souscrit :</label>
                              
                                <select class="form-control" id="capital" required autocomplete="off">
                                    <option value="" selected>Sélectionnez un capital</option>
                                    <option value="1000000">1 000 000 FCFA</option>
                                    <option value="2000000">2 000 000 FCFA</option>
                                    <option value="3000000">3 000 000 FCFA</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Date de naissance :</label>
                                <select class="form-control" id="ageSelect" required autocomplete="off">
                                    <option value="" selected disabled>Sélectionnez un age</option>
                                    {{-- donnée dynamique de ageSelect --}}
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100">Simuler</button>
                            </div>
                            <div class="col">
                                <button type="button" id="resetBtn" class="btn btn-outline-secondary w-100 mt-2">Réinitialiser</button>
                            </div>
                        </div>
                        
                        
                    </form>
                </fieldset>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
           <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-white text-center py-3">
                    <h5 class="text-uppercase mb-0">Résultat du simulateur</h5>
                </div>

                <div class="card-body">
                    <div class="container">
                        
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Garantie</th>
                                    <th>Prime</th>
                                    <th>Capital</th>
                                </tr>
                            </thead>
                            <tbody id="resultGaranties">
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Prime principale :</td>
                                    <td id="primePrincip" class="fw-bold">0</td>
                                </tr>
                            </tfoot>
                        </table>
                        <table class="table">
                            <tr>
                                <td><strong class="text-uppercase">Frais d'adhésion</strong><small class="text-muted text-danger">(payable une seul fois)</small></td>
                                <td><span class="text-success fs-6">+</span> <strong> {{ number_format(7500, 0, ',', ' ')}}</strong> FCFA</td>
                            </tr>
                        </table>
                        <div class="ribbon">Prime Totale</div>

                        <table class="table">
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Montant Total :</td>
                                    <td id="primeTotal" class="fw-bold">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <button onclick="getSimulationData()" id="btn-souscription" class="btn btn-primary btn-inactif">Souscrire</button>

                {{-- <a href="" onclick="getSimulationData()" class="btn btn-primary btn btn-inactif">Souscrire</a> --}}
            </div>
        </div>
    </div>

    <script>
        const garanties = @json($productGarantie);
    </script>
</div>