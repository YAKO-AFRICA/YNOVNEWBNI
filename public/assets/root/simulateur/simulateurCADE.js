document.addEventListener('DOMContentLoaded', function() {
    // Éléments du DOM
    const elements = {
        form: document.getElementById('primeFormCAD'),
        productCode: document.getElementById('CodeProduit'),
        frequency: document.getElementById('codePeriodicite'),
        capital: document.getElementById('capital'),
        age: document.getElementById('ageSelect'),
        duration: document.getElementById('duree'),
        resultsContainer: document.getElementById('resultGaranties'),
        mainPremium: document.getElementById('primePrincip'),
        totalPremium: document.getElementById('primeTotal'),
        subscribeBtn: document.getElementById('btn-souscription'),
        resetBtn: document.getElementById('resetBtn')
    };

    // Constantes
    const constants = {
        ADHESION_FEE: 7500,
        AUTH_TOKEN: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MjExODcyLCJlbWFpbCI6ImZvcm1hdGlvbi5ibmlAYm5pLmNvbSIsIm5vbSI6IkJOSSIsImNvZGVhZ2VudCI6IkIwNDAiLCJ0eXBlbWVicmUiOm51bGwsInByZW5vbSI6IkZvcm1hdGlvbiJ9.gwxwy43VeMDcfaTpgpFbuWkxjirIBqvuXq3UZOuw_nA",
        API_ENDPOINTS: {
            tables: "https://api.yakoafricassur.com/enov/get-table-prime-web",
            capitals: "https://api.yakoafricassur.com/enov/get-capital-web",
            ages: "https://api.yakoafricassur.com/enov/get-age-prime-web",
            primes: "https://api.yakoafricassur.com/enov/get-prime-by-param-web"
        }
    };

    // État de l'application
    const state = {
        primesTable: [],
        currentCalculations: [],
        isCalculating: false,
        cache: {
            tables: {},
            capitals: {},
            ages: {}
        }
    };

    // Initialisation
    init();

    function init() {
        setupEventListeners();
        loadSessionData();
        
        if (isFormComplete()) {
            calculatePremiums();
        }
    }

    function setupEventListeners() {
        elements.form.addEventListener('submit', handleFormSubmit);
        elements.subscribeBtn.addEventListener('click', handleSubscription);
        elements.resetBtn.addEventListener('click', resetSimulation);
        
        elements.productCode.addEventListener('change', loadAllData);
        elements.frequency.addEventListener('change', loadAllData);
        elements.capital.addEventListener('change', debounce(calculatePremiums, 300));
        elements.age.addEventListener('change', debounce(calculatePremiums, 300));
        elements.duration.addEventListener('input', debounce(calculatePremiums, 300));
    }

    // Gestion des données de session
    function loadSessionData() {
        const savedData = getSessionData();
        if (!savedData) return;

        // Restaurer les valeurs de base
        if (savedData.parameters) {
            elements.frequency.value = savedData.parameters.periodicity || '';
            elements.duration.value = savedData.parameters.duration || '10';
        }

        // Charger les données si le produit est sélectionné
        if (savedData.parameters?.productCode) {
            loadAllData().then(() => {
                if (savedData.parameters?.capital) elements.capital.value = savedData.parameters.capital;
                if (savedData.parameters?.age) elements.age.value = savedData.parameters.age;
                
                if (savedData.results?.coverages?.length > 0) {
                    state.currentCalculations = savedData.results.coverages;
                    updateResultsDisplay();
                }
            });
        }
    }

    function saveSessionData() {
        // const simulationData = {
        //     parameters: {
        //         productCode: elements.productCode.value,
        //         periodicity: elements.frequency.value,
        //         capital: parseFloat(elements.capital.value),
        //         age: parseInt(elements.age.value),
        //         duration: parseInt(elements.duration.value),
        //         calculationDate: new Date().toISOString()
        //     },
        //     results: {
        //         totalPremium: parseCurrency(elements.totalPremium.textContent),
        //         mainPremium: parseCurrency(elements.mainPremium.textContent),
        //         adhesionFee: constants.ADHESION_FEE,
        //         coverages: state.currentCalculations.map(item => ({
        //             code: getCoverageCode(item.coverageName),
        //             name: item.coverageName,
        //             premium: item.premium,
        //             capital: item.capital,
        //             isMandatory: isMandatoryCoverage(item.coverageName)
        //         }))
        //     },
        //     metadata: {
        //         version: "2.0",
        //         origin: "education-plus-simulator"
        //     }
        // };

        const simulationData = {
            garantieData: state.currentCalculations.map(item => ({
                codeGarantie: getCoverageCode(item.coverageName),
                libelle: item.coverageName,
                prime: item.premium,
                capital: item.capital,
                isMandatory: isMandatoryCoverage(item.coverageName)
            })),
            infoSimulation: {
                primepricipale: parseCurrency(elements.mainPremium.textContent),
                periodicite: elements.frequency.value,
                capital: parseFloat(elements.capital.value),
                age: parseInt(elements.age.value),
                fraisAdhesion: constants.ADHESION_FEE,
                duree: parseInt(elements.duration.value),
                primeFinale: parseCurrency(elements.totalPremium.textContent),
            }
        };

        sessionStorage.setItem('simulationData', JSON.stringify(simulationData));
        console.log('Données sauvegardées:', simulationData);
    }

    function getSessionData() {
        const savedData = sessionStorage.getItem('simulationData');
        return savedData ? JSON.parse(savedData) : null;
    }

    // Fonctions principales
    async function loadAllData() {
        const productCode = elements.productCode.value.trim();
        const periodicity = elements.frequency.value.trim();

        if (!productCode || !periodicity) return;

        resetSelect(elements.capital, 'Sélectionnez un capital');
        resetSelect(elements.age, 'Sélectionnez une plage d\'âge');
        
        try {
            const cacheKey = `${productCode}_${periodicity}`;
            
            if (!state.cache.tables[cacheKey]) {
                const tableResponse = await apiRequest(
                    constants.API_ENDPOINTS.tables, 
                    { 
                        CodeProduit: productCode, 
                        CodePeriodicite: periodicity 
                    }
                );
                state.primesTable = tableResponse.dataTablePrime || [];
                state.cache.tables[cacheKey] = state.primesTable;
            } else {
                state.primesTable = state.cache.tables[cacheKey];
            }

            const groupCode = state.primesTable[0]?.CodeGRoupeIntervalle;
            if (!groupCode) throw new Error("Aucune table trouvée");

            // Chargement des capitaux
            if (!state.cache.capitals[groupCode]) {
                const capitalResponse = await apiRequest(
                    constants.API_ENDPOINTS.capitals,
                    { CodeGroupe: groupCode }
                );
                state.cache.capitals[groupCode] = capitalResponse.dataCapital || [];
            }
            populateSelect(elements.capital, state.cache.capitals[groupCode], 'Capital', 'Libelle');

            // Chargement des âges
            if (!state.cache.ages[groupCode]) {
                const ageResponse = await apiRequest(
                    constants.API_ENDPOINTS.ages,
                    { CodeGroupe: groupCode }
                );
                state.cache.ages[groupCode] = ageResponse.dataTableAge || [];
            }
            populateSelect(elements.age, state.cache.ages[groupCode], 'AgeAssure', 'Titre');

            saveSessionData();

        } catch (error) {
            console.error("Erreur API:", error);
            showError("Erreur lors du chargement des données. Veuillez réessayer.");
        }
    }

    async function calculatePremiums() {
        if (state.isCalculating || !isFormComplete()) return;

        state.isCalculating = true;
        state.currentCalculations = [];
        showLoadingState();

        try {
            const calculations = garanties.map(async coverage => {
                const tableMatch = state.primesTable.find(
                    t => t.CodeProduitGarantie === coverage.codeproduitgarantie,
                );
                if (!tableMatch) return null;

                const requestData = {
                    CodeGroupe: tableMatch.CodeGRoupeIntervalle,
                    AgeAssure: parseInt(elements.age.value),
                    Capital: parseFloat(elements.capital.value),
                    codeTable: tableMatch.codeTable,
                    Duree: parseInt(elements.duration.value)
                };

                try {
                    const response = await apiRequest(
                        constants.API_ENDPOINTS.primes,
                        requestData
                    );
                    
                    return {
                        coverageName: coverage.libelle,
                        capital: requestData.Capital,
                        premium: parseFloat(response.dataTablePrimeRes[0]?.Prime || 0),
                        code: coverage.codeproduitgarantie
                    };
                } catch (error) {
                    console.error(`Erreur calcul pour ${coverage.libelle}:`, error);
                    return null;
                }
            });

            const results = await Promise.all(calculations);
            state.currentCalculations = results.filter(Boolean);
            
            updateResultsDisplay();
            saveSessionData();
            
        } catch (error) {
            console.error("Erreur calcul des primes:", error);
            showError("Erreur lors du calcul. Vérifiez les données saisies.");
        } finally {
            state.isCalculating = false;
        }
    }

    // Fonctions d'affichage
    function updateResultsDisplay() {
        if (state.currentCalculations.length === 0) {
            elements.resultsContainer.innerHTML = '<tr><td colspan="3" class="text-center">Aucun résultat</td></tr>';
            elements.mainPremium.textContent = formatCurrency(0);
            elements.totalPremium.textContent = formatCurrency(0);
            return;
        }

        elements.resultsContainer.innerHTML = '';
        
        let mainPremium = 0;
        let totalPremium = 0;

        state.currentCalculations.forEach(item => {
            const row = document.createElement('tr');
            
            mainPremium += item.premium;
            totalPremium += item.premium;
            
            row.innerHTML = `
                <td>${item.coverageName} ${isMandatoryCoverage(item.coverageName) ? '' : '(option)'}</td>
                <td class="text-end">${formatCurrency(item.premium)}</td>
                <td class="text-end">${formatCurrency(item.capital)}</td>
            `;
            elements.resultsContainer.appendChild(row);
        });

        elements.mainPremium.textContent = formatCurrency(mainPremium);
        elements.totalPremium.textContent = formatCurrency(totalPremium + constants.ADHESION_FEE);
        elements.subscribeBtn.classList.remove('btn-inactif');
    }

    function showLoadingState() {
        elements.resultsContainer.innerHTML = '<tr><td colspan="3" class="text-center">Calcul en cours...</td></tr>';
        elements.subscribeBtn.classList.add('btn-inactif');
    }

    // Gestion des interactions
    function handleFormSubmit(e) {
        e.preventDefault();
        calculatePremiums();
    }

    function handleSubscription(e) {
        if (elements.subscribeBtn.classList.contains('btn-inactif')) {
            e.preventDefault();
            showError("Veuillez compléter la simulation avant de souscrire");
            return;
        }

        saveSessionData();
    }

    function resetSimulation() {
        // Réinitialisation des champs
        elements.frequency.value = '';
        resetSelect(elements.capital, 'Sélectionnez un capital');
        resetSelect(elements.age, 'Sélectionnez un âge');
        elements.duration.value = '10';
        
        // Réinitialisation des résultats
        elements.resultsContainer.innerHTML = '';
        elements.mainPremium.textContent = formatCurrency(0);
        elements.totalPremium.textContent = formatCurrency(0);
        elements.subscribeBtn.classList.add('btn-inactif');
        
        // Nettoyage du state et du cache
        state.primesTable = [];
        state.currentCalculations = [];
        
        // Nettoyage du sessionStorage
        sessionStorage.removeItem('simulationData');
    }

    // Fonctions utilitaires
    async function apiRequest(url, body, retries = 3) {
        for (let i = 0; i < retries; i++) {
            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: { 
                        "Content-Type": "application/json", 
                        "Authorization": constants.AUTH_TOKEN 
                    },
                    body: JSON.stringify(body)
                });
                
                if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);
                
                const data = await response.json();
                if (data.error) throw new Error(data.error);
                
                return data;
            } catch (error) {
                if (i === retries - 1) throw error;
                await new Promise(resolve => setTimeout(resolve, 1000 * (i + 1)));
            }
        }
    }

    function isFormComplete() {
        return elements.frequency.value && elements.capital.value && 
               elements.age.value && elements.duration.value;
    }

    function populateSelect(select, items, valueField, textField) {
        resetSelect(select, `Sélectionnez un ${select.id === 'capital' ? 'capital' : 'âge'}`);
        
        if (Array.isArray(items)) {
            items.forEach(item => {
                const option = document.createElement('option');
                option.value = item[valueField];
                option.textContent = item[textField];
                select.appendChild(option);
            });
        }
    }

    function resetSelect(select, placeholder) {
        select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('fr-FR', { 
            minimumFractionDigits: 2,
            maximumFractionDigits: 2 
        }).format(amount) + ' FCFA';
    }

    function parseCurrency(currencyString) {
        return parseFloat(currencyString.replace(/\s/g, '').replace('FCFA', '')) || 0;
    }

    function showError(message) {
        let errorContainer = document.getElementById('error-container');
        if (!errorContainer) {
            errorContainer = document.createElement('div');
            errorContainer.id = 'error-container';
            document.querySelector('.card-body').prepend(errorContainer);
        }
        
        errorContainer.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    }

    function getCoverageCode(coverageName) {
        const coverage = garanties.find(g => g.libelle === coverageName);
        return coverage ? coverage.codeproduitgarantie : '';
    }

    function isMandatoryCoverage(coverageName) {
        const coverage = garanties.find(g => g.libelle === coverageName);
        return coverage ? coverage.estobligatoire === 1 : false;
    }

    function debounce(func, delay) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }
});