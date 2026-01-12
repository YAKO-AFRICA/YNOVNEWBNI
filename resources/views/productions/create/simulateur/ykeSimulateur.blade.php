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
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }

    .form-check-label {
        margin-left: 5px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card p-4">
                <h4 class="text-center text-uppercase">Simulateur de prime</h4>
                <fieldset>
                    <legend class="text-center w-auto float-none px-2 "><small>Données de simulation</small></legend>

                    <form id="primeForm">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-header bg-primar text-white">
                                <h5 class="mb-0">Informations de base</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Code Produit</label>
                                        <input type="text" class="form-control" id="CodeProduit" name="CodeProduit" value="{{ $product->CodeProduit}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Périodicité</label>
                                        <select name="codePeriodicite" id="codePeriodicite" class="form-select" required>
                                            <option value="M">Mensuel</option>
                                            <option value="T">Trimestriel</option>
                                            <option value="S">Semestriel</option>
                                            <option value="A">Annuel</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Durée Cotisation</label>
                                        <input type="number" class="form-control" id="duree" name="duree" min="5" max="5" value="5" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Capital Souscrit</label>
                                        <select name="capitalSouscrit" id="capitalSouscrit" class="form-select" required>
                                            <option value="" selected disabled>Choisissez un capital</option>
                                            {{-- <option value="300000">300 000 FCFA</option> --}}
                                            <option value="500000">500 000 FCFA</option>
                                            <option value="750000">750 000 FCFA</option>
                                            <option value="1000000">1 000 000 FCFA</option>
                                            <option value="1250000">1 250 000 FCFA</option>
                                            <option value="1500000">1 500 000 FCFA</option>
                                            <option value="2000000">2 000 000 FCFA</option>
                                            <option value="3000000">3 000 000 FCFA</option>
                                            <option value="4000000">4 000 000 FCFA</option>
                                            <option value="5000000">5 000 000 FCFA</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <label class="form-label">Âge Calculé</label>
                                        <input type="hidden" class="form-control" id="age" name="age">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Date d'effet</label>
                                        <input type="date" class="form-control" id="dateEffet" name="dateEffet" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card mb-4">
                            <div class="card-header bg-primar text-white">
                                <h5 class="mb-0">Options supplémentaires</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="garantieSeniorCheck">
                                    <label class="form-check-label" for="garantieSeniorCheck">
                                        Ajouter la garantie optionnelle Senior
                                    </label>
                                </div>
                    
                                <div class="row" id="seniorPrimeInputWrapper" style="display: none;">
                                    <div class="col-md-6">
                                        <label for="seniorPrimeInput" class="form-label">Prime pour la garantie Senior</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="seniorPrimeInput" placeholder="Saisir la prime">
                                            <span class="input-group-text">FCFA</span>
                                        </div>
                                        <small class="text-muted">Capital assuré: 500 000 FCFA</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4 row">
                            <button type="submit" class="btn btn-primary col">
                                <i class="bi bi-calculator me-2"></i>Simuler
                            </button>
                            <button type="button" id="btn-reset" class="btn btn-outline-secondary me-md-2 col float-start">
                                <i class="bi bi-arrow-counterclockwise me-2"></i>Réinitialiser
                            </button>
                           
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
                            <tbody id="result">
                                
                            </tbody>
                        </table>
                        <table class="table">
                            <tr>
                                <td><strong class="text-uppercase fs-6">Frais d'adhésion </strong><small class="text-muted text-danger">(payable une seul fois)</small></td>
                                <td><span class="text-success">+</span> <strong> {{ number_format(7500, 0, ',', ' ')}}</strong> FCFA</td>
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

                <a href="{{ route('prod.create',$product->CodeProduit) }}" id="btn-souscription" class="btn btn-primary btn btn-inactif">Souscrire</a>
            </div>
        </div>
    </div>
</div>

<script>

    let garanties = @json($productGarantie);

    // document.addEventListener("DOMContentLoaded", function () {
    //     sessionStorage.removeItem("simulationData");
    // });
</script>

@endsection