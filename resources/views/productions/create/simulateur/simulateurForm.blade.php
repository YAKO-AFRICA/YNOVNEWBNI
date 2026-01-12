@extends('layouts.main')

@section('content')
 <!--breadcrumb-->
 <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">
        <a href="/shared/home"><i class="bx bx-home-alt"></i></a>
    </div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item active" aria-current="page">Souscription</li>
                <li class="breadcrumb-item active" aria-current="page">Simulateur de prime</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
    </div>
</div>
<!--end breadcrumb-->


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

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card p-4">
                <h4 class="text-center text-uppercase">Simulateur de prime</h4>
                <fieldset>
                    <legend class="text-center w-auto float-none px-2 "><small>Données de simulation</small></legend>
                
                    <form id="primeFormCAD">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Code Produit :</label>
                                <input type="text" class="form-control" id="CodeProduit" name="CodeProduit" value="{{ $product->CodeProduit}}" required readonly>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Durée Cotisation :</label>
                                <input type="number" class="form-control" id="duree" name="duree" value="10" min="10" max="99" required>
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
                                   {{-- donnée dynamique de capital --}}
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Date de naissance :</label>
                                {{-- <input type="Date" class="form-control" id="birthdate" name="birthdate" autocomplete="off"> --}}
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

                <a href="{{ route('prod.create',$product->CodeProduit) }}" id="btn-souscription" class="btn btn-primary btn btn-inactif">Souscrire</a>
            </div>
        </div>
    </div>
</div>

<script>
    const garanties = @json($productGarantie);
</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const codeProduitInput = document.getElementById('CodeProduit');
        const periodiciteSelect = document.getElementById('codePeriodicite');
        const capitalSelect = document.getElementById('capital');
        const ageSelect = document.getElementById('ageSelect');
        const dureeContratInput = document.getElementById('duree');
        const resultContainer = document.getElementById('resultGaranties');
        const primePrincipElement = document.getElementById('primePrincip');
        const primeTotalElement = document.getElementById('primeTotal');
        const btnSouscription = document.getElementById('btn-souscription');

        const garanties = @json($productGarantie);
        const FRAIS_ADHESION = 7500;
        
        const authToken = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MjExODcyLCJlbWFpbCI6ImZvcm1hdGlvbi5ibmlAYm5pLmNvbSIsIm5vbSI6IkJOSSIsImNvZGVhZ2VudCI6IkIwNDAiLCJ0eXBlbWVicmUiOm51bGwsInByZW5vbSI6IkZvcm1hdGlvbiJ9.gwxwy43VeMDcfaTpgpFbuWkxjirIBqvuXq3UZOuw_nA";

        let tablePrimes = [];
        let currentCalculations = [];
        let calculationInProgress = false;

        // Optimisation: Cache les données déjà récupérées
        const dataCache = {
            tables: {},
            capitals: {},
            ages: {}
        };

        async function fetchAllData() {
            const codeProduit = codeProduitInput.value.trim();
            const codePeriodicite = periodiciteSelect.value.trim();

            if (!codeProduit || !codePeriodicite) return;

            resetSelect(capitalSelect, 'Sélectionnez un capital');
            resetSelect(ageSelect, 'Sélectionnez une plage d\'âge');
            
            try {
                // Récupération des tables de primes
                const cacheKey = `${codeProduit}_${codePeriodicite}`;
                if (!dataCache.tables[cacheKey]) {
                    const tableResponse = await fetchWithRetry(
                        "https://api.yakoafricassur.com/enov/get-table-prime-web", 
                        { CodeProduit: codeProduit, CodePeriodicite: codePeriodicite }
                    );
                    tablePrimes = tableResponse.dataTablePrime || [];
                    if (tablePrimes.length === 0) throw new Error("Aucune table trouvée");
                    dataCache.tables[cacheKey] = tablePrimes;
                } else {
                    tablePrimes = dataCache.tables[cacheKey];
                }

                const codeGroupe = tablePrimes[0].CodeGRoupeIntervalle;

                // Récupération des capitaux
                if (!dataCache.capitals[codeGroupe]) {
                    const capitalResponse = await fetchWithRetry(
                        "https://api.yakoafricassur.com/enov/get-capital-web", 
                        { CodeGroupe: codeGroupe }
                    );
                    dataCache.capitals[codeGroupe] = capitalResponse.dataCapital || [];
                }
                
                populateSelect(capitalSelect, dataCache.capitals[codeGroupe], 'Capital', 'Libelle');

                // Récupération des âges
                if (!dataCache.ages[codeGroupe]) {
                    const ageResponse = await fetchWithRetry(
                        "https://api.yakoafricassur.com/enov/get-age-prime-web", 
                        { CodeGroupe: codeGroupe }
                    );
                    dataCache.ages[codeGroupe] = ageResponse.dataTableAge || [];
                }
                
                populateSelect(ageSelect, dataCache.ages[codeGroupe], 'AgeAssure', 'Titre');

            } catch (err) {
                console.error("Erreur API :", err.message);
                showError("Une erreur est survenue lors du chargement des données. Veuillez réessayer.");
            }
        }

        async function calculatePrimes() {
            if (calculationInProgress) return;
            
            const capital = parseFloat(capitalSelect.value);
            const age = parseInt(ageSelect.value);
            const duree = parseInt(dureeContratInput.value);
            const codeProduit = codeProduitInput.value;
            const codePeriodicite = periodiciteSelect.value;

            if (!capital || !age || !duree || !codeProduit || !codePeriodicite || tablePrimes.length === 0) {
                return;
            }

            calculationInProgress = true;
            currentCalculations = [];
            resultContainer.innerHTML = '<tr><td colspan="3" class="text-center">Calcul en cours...</td></tr>';
            btnSouscription.classList.add('btn-inactif');
            
            try {
                // Utilisation de Promise.all pour paralléliser les requêtes
                const calculations = garanties.map(async garantie => {
                    const match = tablePrimes.find(t => t.CodeProduitGarantie === garantie.codeproduitgarantie);
                    if (!match) return null;

                    const requestBody = {
                        CodeGroupe: match.CodeGRoupeIntervalle,
                        AgeAssure: age,
                        Capital: capital,
                        codeTable: match.codeTable,
                        Duree: duree
                    };

                    try {
                        const response = await fetchWithRetry(
                            "https://api.yakoafricassur.com/enov/get-prime-by-param-web", 
                            requestBody
                        );
                        
                        const prime = parseFloat(response.dataTablePrimeRes[0]?.Prime || 0);
                        return {
                            garantie: garantie.libelle,
                            capital: capital,
                            prime: prime,
                            isPrincipale: garantie.codeproduitgarantie === tablePrimes[0].CodeProduitGarantie
                        };
                    } catch (err) {
                        console.error(`Erreur calcul prime pour ${garantie.libelle}:`, err.message);
                        return null;
                    }
                });

                const results = await Promise.all(calculations);
                currentCalculations = results.filter(r => r !== null);
                
                updateResultsUI();
                
            } catch (err) {
                console.error("Erreur générale calcul primes:", err.message);
                showError("Une erreur est survenue lors du calcul des primes. Veuillez vérifier les données saisies.");
            } finally {
                calculationInProgress = false;
            }
        }

        function updateResultsUI() {
            if (currentCalculations.length === 0) {
                resultContainer.innerHTML = '<tr><td colspan="3" class="text-center">Aucun résultat trouvé</td></tr>';
                primePrincipElement.textContent = '0';
                primeTotalElement.textContent = '0';
                return;
            }

            resultContainer.innerHTML = '';
            
            let primePrincipale = 0;
            let primeTotale = 0;

            currentCalculations.forEach(item => {
                const row = document.createElement('tr');
                
                // Suppression de la vérification isPrincipale
                primePrincipale += item.prime;
                primeTotale += item.prime;
                
                row.innerHTML = `
                    <td>${item.garantie}</td>
                    <td class="text-end">${formatCurrency(item.prime)}</td>
                    <td class="text-end">${formatCurrency(item.capital)}</td>
                `;
                resultContainer.appendChild(row);
            });

            primePrincipElement.textContent = formatCurrency(primePrincipale);
            primeTotalElement.textContent = formatCurrency(primeTotale + FRAIS_ADHESION);
            
            // Activer le bouton de souscription si calcul réussi
            btnSouscription.classList.remove('btn-inactif');
        }

        // Fonctions utilitaires améliorées
        async function fetchWithRetry(url, body, retries = 3) {
            for (let i = 0; i < retries; i++) {
                try {
                    const response = await fetch(url, {
                        method: "POST",
                        headers: { 
                            "Content-Type": "application/json", 
                            "Authorization": authToken 
                        },
                        body: JSON.stringify(body)
                    });
                    
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    
                    const data = await response.json();
                    if (data.error) throw new Error(data.error);
                    
                    return data;
                } catch (err) {
                    if (i === retries - 1) throw err;
                    await new Promise(resolve => setTimeout(resolve, 1000 * (i + 1)));
                }
            }
        }

        function populateSelect(select, items, valueField, textField) {
            resetSelect(select, `Sélectionnez un ${select.id === 'capital' ? 'capital' : 'âge'}`);
            
            if (Array.isArray(items)) {
                items.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item[valueField];
                    opt.textContent = item[textField];
                    select.appendChild(opt);
                });
            }
        }

        function resetSelect(select, placeholder) {
            select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('fr-FR', { 
                style: 'decimal', 
                minimumFractionDigits: 2,
                maximumFractionDigits: 2 
            }).format(amount) + ' FCFA';
        }

        function showError(message) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-danger alert-dismissible fade show';
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            // Trouver ou créer un conteneur pour les erreurs
            let errorContainer = document.getElementById('error-container');
            if (!errorContainer) {
                errorContainer = document.createElement('div');
                errorContainer.id = 'error-container';
                document.querySelector('.card-body').prepend(errorContainer);
            }
            
            errorContainer.innerHTML = '';
            errorContainer.appendChild(alert);
        }

        // Gestion des événements avec debounce pour éviter des appels trop fréquents
        const debounce = (func, delay) => {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        };

        codeProduitInput.addEventListener('change', fetchAllData);
        periodiciteSelect.addEventListener('change', fetchAllData);
        capitalSelect.addEventListener('change', debounce(calculatePrimes, 300));
        ageSelect.addEventListener('change', debounce(calculatePrimes, 300));
        dureeContratInput.addEventListener('input', debounce(calculatePrimes, 300));
    });
</script> --}}

@endsection

