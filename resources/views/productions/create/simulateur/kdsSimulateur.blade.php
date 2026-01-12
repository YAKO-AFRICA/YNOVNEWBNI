@extends('layouts.main')

@section('content')

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
    
    .optional-garantie {
        background-color: #f8f9fa;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border-left: 4px solid #6c757d;
    }
    
    .api-info {
        background-color: #e9ecef;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        font-size: 0.9em;
    }
    
    .loading {
        color: #6c757d;
        font-style: italic;
    }
    
    .auto-update {
        border-left: 4px solid #0d6efd;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card p-4 auto-update">
                <h4 class="text-center text-uppercase">Simulateur de prime</h4>
                <fieldset>
                    <legend class="text-center w-auto float-none px-2 "><small>Données de simulation</small></legend>
                
                    <form id="primeForm">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Produit :</label>
                                <input type="text" class="form-control" id="CodeProduit" name="CodeProduit" value="{{ $product->CodeProduit}}" required readonly>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Périodicité :</label>
                                <select name="codePeriodicite" id="codePeriodicite" class="form-select" required>
                                    <option value="M">Mensuelle</option>
                                    <option value="T">Trimestrielle</option>
                                    <option value="S">Semestrielle</option>
                                    <option value="A">Annuelle</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Prime souhaitée (F CFA) :</label>
                                <select name="capitalSouscrit" id="capitalSouscrit" class="form-select" required>
                                    <option value="" selected>Sélectionnez une prime</option>
                                    <option value="15000">15 000</option>
                                    <option value="20000">20 000</option>
                                    <option value="25000">25 000</option>
                                    <option value="30000">30 000</option>
                                    <option value="40000">40 000</option>
                                    <option value="50000">50 000</option>
                                    <option value="75000">75 000</option>
                                    <option value="100000">100 000</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-12 col-md-6 mb-3 d-none">
                                <label class="form-label">Âge Calculé :</label>
                                <input type="hidden" class="form-control" id="age" name="age">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Durée (Année):</label>
                                <input type="number" class="form-control" id="duree" name="duree" value="6" min="6" max="99" required>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Date de naissance de l'assuré :</label>
                                <input type="Date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                            </div> 
                           <div class="col-sm-12 col-md-6 mt-4">
                                <div>
                                    <label for="">Le souscripteur est-il l'assuré ?</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="isAssure" id="isAssureOui" value="oui" required>
                                        <label class="form-check-label" for="isAssureOui">Oui</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="isAssure" id="isAssureNon" value="non">
                                        <label class="form-check-label" for="isAssureNon">Non</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        
                        
                        <!-- Section pour les garanties optionnelles -->
                        <div id="optionalGaranties" class="mt-4">
                            <h5 class="mb-3">Garanties optionnelles</h5>
                            <!-- Les garanties optionnelles seront ajoutées ici dynamiquement -->
                        </div>

                        <div class="col">
                            <button type="button" id="resetBtn" class="btn btn-outline-secondary w-100 mt-2">Réinitialiser</button>
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
                        <table class="table table-bordered table-striped ">
                            <thead class="table-light ">
                                <tr>
                                    <th>Garantie</th>
                                    <th>Prime</th>
                                    <th>Capital</th>
                                </tr>
                            </thead>
                            <tbody id="result" class="">
                                <!-- Les résultats seront affichés ici -->
                                <tr>
                                    <td colspan="3" class="text-center">Veuillez remplir les informations de simulation</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <tr>
                                <td><strong class="text-uppercase fs-6">Frais d'adhésion </strong><small class="text-muted text-danger">(payable une seule fois)</small></td>
                                <td><span class="text-success">+</span> <strong> {{ number_format(7500, 0, ',', ' ')}}</strong> FCFA</td>
                            </tr>
                        </table>
                        <div class="ribbon">Prime totale</div>

                        <table class="table">
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Montant total (F CFA):</td>
                                    <td id="primeTotal" class="fw-bold">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <a href="{{ route('prod.create',$product->CodeProduit) }}" id="btn-souscription" class="btn btn-primary btn btn-inactif">Souscrire</a>
            </div>
        </div>
    </div>
</div>

<script>
    const garanties = @json($productGarantie);
</script>
@endsection