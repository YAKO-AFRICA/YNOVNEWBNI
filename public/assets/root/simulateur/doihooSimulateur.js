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
    const resetBtn = document.getElementById('resetBtn');
    const primeForm = document.getElementById('doihooSimulateurForm');

    
    const FRAIS_ADHESION = 7500;
    let donneesGlobale = [];

    let simulationData = {
        garantieData: [],
        infoSimulation: {}
    };
    
    const authToken = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MjExODcyLCJlbWFpbCI6ImZvcm1hdGlvbi5ibmlAYm5pLmNvbSIsIm5vbSI6IkJOSSIsImNvZGVhZ2VudCI6IkIwNDAiLCJ0eXBlbWVicmUiOm51bGwsInByZW5vbSI6IkZvcm1hdGlvbiJ9.gwxwy43VeMDcfaTpgpFbuWkxjirIBqvuXq3UZOuw_nA";

    let tablePrimes = [];
    let currentCalculations = [];
    let calculationInProgress = false;

    // Charger les données sauvegardées depuis la session si elles existent
    loadFromSession();

    const dataCache = {
        tables: {},
        capitals: {},
        ages: {}
    };

    // Empêcher la soumission du formulaire
    primeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        calculatePrimes();
    });

    document.getElementById('btn-souscription').addEventListener('click', function(e) {
        if (this.classList.contains('btn-inactif')) {
            e.preventDefault();
            showError("Veuillez compléter la simulation avant de souscrire");
            return;
        }

        const simulationData = {
            garantieData: donneesGlobale,
            infoSimulation: {
                codeProduit: codeProduitInput.value,
                periodicite: periodiciteSelect.value,
                capital: capitalSelect.value,
                primepricipale: parseFloat(primePrincipElement.textContent.replace(/\s/g, '').replace('FCFA', '')),
                age: ageSelect.value,
                duree: dureeContratInput.value,
                fraisAdhesion: FRAIS_ADHESION,
                primeFinale: parseFloat(primeTotalElement.textContent.replace(/\s/g, '').replace('FCFA', '')),
            }
        };
        
        sessionStorage.setItem('simulationData', JSON.stringify(simulationData));

        console.log('Données de simulation sauvegardées:', simulationData);

        console.log('Données de sdonneesGlobaleimulation sauvegardées donneesGlobale:', donneesGlobale);

    });

  

    resetBtn.addEventListener('click', function() {
        // Réinitialiser les champs
        periodiciteSelect.value = '';
        capitalSelect.innerHTML = '<option value="" selected>Sélectionnez un capital</option>';
        ageSelect.innerHTML = '<option value="" selected disabled>Sélectionnez un age</option>';
        dureeContratInput.value = '8';
        
        // Réinitialiser les résultats
        resultContainer.innerHTML = '';
        primePrincipElement.textContent = '0';
        primeTotalElement.textContent = '0';
        btnSouscription.classList.add('btn-inactif');
        
        // Effacer complètement la session
        sessionStorage.removeItem('simulationData');
        sessionStorage.removeItem('simulationData');

        sessionStorage.removeItem('donneesGlobale');
        
        // Réinitialiser les données
        tablePrimes = [];
        currentCalculations = [];
    });


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

            console.log('Code Groupe:', codeGroupe);

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

        donneesGlobale = [];
        
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
            const calculations = garanties.map(async garantie => {
                const match = tablePrimes.find(t => t.CodeProduitGarantie === garantie.codeproduitgarantie);
                if (!match) return null;
            
                const isDoihoo = garantie.codeproduitgarantie === "DOI_2020";
                const adjustedCapital = isDoihoo ? (capital * 0.2) : capital;
            
                const requestBody = {
                    CodeGroupe: match.CodeGRoupeIntervalle,
                    AgeAssure: age,
                    Capital: adjustedCapital,
                    codeTable: match.codeTable,
                    Duree: duree
                };
            
            
                try {
                    const response = await fetchWithRetry(
                        "https://api.yakoafricassur.com/enov/get-prime-by-param-web", 
                        requestBody
                    );
                    
                    const prime = parseFloat(response.dataTablePrimeRes[0]?.Prime || 0);

                    donneesGlobale.push({
                        codeGarantie: garantie.codeproduitgarantie,
                        libelle: garantie.libelle,
                        capital: adjustedCapital,
                        prime: prime
                    });


                    const simulationData = {
                        garantieData: donneesGlobale,
                        infoSimulation: {
                            codeProduit: codeProduitInput.value,
                            periodicite: periodiciteSelect.value,
                            capital: capitalSelect.value,
                            primepricipale: parseFloat(primePrincipElement.textContent.replace(/\s/g, '').replace('FCFA', '')),
                            age: ageSelect.value,
                            duree: dureeContratInput.value,
                            fraisAdhesion: FRAIS_ADHESION,
                            primeFinale: parseFloat(primeTotalElement.textContent.replace(/\s/g, '').replace('FCFA', '')),
                        }
                    };
                    
                    sessionStorage.setItem('simulationData', JSON.stringify(simulationData));
            

                    return {
                        libelle: garantie.libelle,
                        capital: adjustedCapital,
                        prime: prime
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
            
            primePrincipale += item.prime;
            primeTotale += item.prime;
            
            row.innerHTML = `
                <td>${item.libelle}</td>
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

  

    function loadFromSession() {
        const savedData = sessionStorage.getItem('simulationData');
        if (savedData) {
            const data = JSON.parse(savedData);
            
            if (data.codePeriodicite) periodiciteSelect.value = data.codePeriodicite;
            if (data.duree) dureeContratInput.value = data.duree;
            
            // Si des données existent, déclencher le chargement automatique
            if (data.codeProduit && data.codePeriodicite) {
                fetchAllData().then(() => {
                    // Après le chargement, restaurer les sélections
                    if (data.capital) capitalSelect.value = data.capital;
                    if (data.age) ageSelect.value = data.age;
                    
                    // Si tout est complet, recalculer les primes
                    if (data.capital && data.age && data.currentCalculations) {
                        currentCalculations = data.currentCalculations;
                        updateResultsUI();
                    }
                });
            }
        }
    }

    // Fonctions utilitaires
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
        
        let errorContainer = document.getElementById('error-container');
        if (!errorContainer) {
            errorContainer = document.createElement('div');
            errorContainer.id = 'error-container';
            document.querySelector('.card-body').prepend(errorContainer);
        }
        
        errorContainer.innerHTML = '';
        errorContainer.appendChild(alert);
    }

    // Gestion des événements avec debounce
    const debounce = (func, delay) => {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    };

    // Écouteurs d'événements
    codeProduitInput.addEventListener('change', fetchAllData);
    periodiciteSelect.addEventListener('change', fetchAllData);
    capitalSelect.addEventListener('change', debounce(calculatePrimes, 300));
    ageSelect.addEventListener('change', debounce(calculatePrimes, 300));
    dureeContratInput.addEventListener('input', debounce(calculatePrimes, 300));
    
    // Calcul automatique si tous les champs sont déjà remplis au chargement
    if (periodiciteSelect.value && capitalSelect.value && ageSelect.value && dureeContratInput.value) {
        calculatePrimes();
    }

   
});

