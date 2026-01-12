document.addEventListener("DOMContentLoaded", function () {
    const dateNaissanceInput = document.getElementById("dateNaissance");
    const ageInput = document.getElementById("age");
    const capitalSouscritInput = document.getElementById("capitalSouscrit");
    const codePeriodiciteInput = document.getElementById("codePeriodicite");
    const optionalGarantiesDiv = document.getElementById("optionalGaranties");
    const dureeInput = document.getElementById("duree");
    const resetBtn = document.getElementById('resetBtn');
    let resultDiv = document.getElementById("result");
    
    const authToken = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MjExODcyLCJlbWFpbCI6ImZvcm1hdGlvbi5ibmlAYm5pLmNvbSIsIm5vbSI6IkJOSSIsImNvZGVhZ2VudCI6IkIwNDAiLCJ0eXBlbWVicmUiOm51bGwsInByZW5vbSI6IkZvcm1hdGlvbiJ9.gwxwy43VeMDcfaTpgpFbuWkxjirIBqvuXq3UZOuw_nA";
    
    // Variables pour stocker les données de l'API
    let currentCodeGroupe = null;
    let currentCodeTable = null;
    let ageOptions = [];
    let debounceTimer;
    
    // Fonction pour déterminer la tranche d'âge automatiquement
    function getTrancheAge(ageSaisie) {
        if (ageSaisie <= 29) return "30";
        if (ageSaisie >= 30 && ageSaisie <= 34) return "35";
        if (ageSaisie >= 35 && ageSaisie <= 39) return "40";
        if (ageSaisie >= 40 && ageSaisie <= 44) return "45";
        if (ageSaisie >= 45 && ageSaisie <= 49) return "50";
        if (ageSaisie >= 50 && ageSaisie <= 54) return "55";
        return ""; // Retourne une chaîne vide si l'âge est hors plage
    }
    
    // Charger les garanties optionnelles
    function loadOptionalGaranties() {
        optionalGarantiesDiv.innerHTML = '<h5 class="mb-3">Garanties optionnelles</h5>';
        console.log("garanties", garanties);
        
        garanties.forEach(garantie => {
            if (garantie.estobligatoire === 0) {
                const div = document.createElement('div');
                div.className = 'optional-garantie';
                
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.id = `garantie_${garantie.id}`;
                checkbox.name = `garantie_${garantie.id}`;
                checkbox.value = garantie.codeproduitgarantie;
                checkbox.className = 'form-check-input me-2 garantie-option';
                checkbox.dataset.garantieId = garantie.id;
                
                // Ajouter un événement pour le changement d'état
                checkbox.addEventListener('change', function() {
                    // Stocker l'état de la checkbox SURETÉ
                    if (garantie.codeproduitgarantie === 'SUR') {
                        sessionStorage.setItem('valueSureteCheck', this.checked);
                    }
                    triggerAutoUpdate();
                });
                
                const label = document.createElement('label');
                label.htmlFor = `garantie_${garantie.id}`;
                label.textContent = garantie.libelle;
                label.className = 'form-check-label';
                
                const container = document.createElement('div');
                container.className = 'form-check mb-2';
                container.appendChild(checkbox);
                container.appendChild(label);
                
                div.appendChild(container);
                
                // Ajouter des champs supplémentaires pour SUR
                if (garantie.codeproduitgarantie === 'SUR') {
                    const surContainer = document.createElement('div');
                    surContainer.id = `sur_fields_${garantie.id}`;
                    surContainer.className = 'mt-2';
                    surContainer.style.display = 'none';
                    
                    // Capital
                    const capitalLabel = document.createElement('label');
                    capitalLabel.textContent = 'Capital souhaité (FCFA):';
                    capitalLabel.className = 'form-label';
                    
                    const capitalSelect = document.createElement('select');
                    capitalSelect.className = 'form-select mb-2 sur-capital';
                    capitalSelect.name = `sur_capital_${garantie.id}`;
                    capitalSelect.id = `sur_capital_${garantie.id}`;
                    
                    const capitalOptions = [
                        {value: '500000', text: '500 000'},
                        {value: '1000000', text: '1 000 000'},
                        {value: '1500000', text: '1 500 000'},
                        {value: '2000000', text: '2 000 000'},
                        {value: '2500000', text: '2 500 000'},
                        {value: '3000000', text: '3 000 000'},
                        {value: '3500000', text: '3 500 000'},
                        {value: '4000000', text: '4 000 000'},
                        {value: '4500000', text: '4 500 000'},
                        {value: '5000000', text: '5 000 000'},
                    ];
                    
                    capitalOptions.forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt.value;
                        option.textContent = opt.text;
                        capitalSelect.appendChild(option);
                    });
                    
                    // Ajouter un événement pour le changement de capital
                    capitalSelect.addEventListener('change', function() {
                        triggerAutoUpdate();
                    });
                    
                    // Champ caché pour la tranche d'âge (calculée automatiquement)
                    const ageHiddenInput = document.createElement('input');
                    ageHiddenInput.type = 'hidden';
                    ageHiddenInput.className = 'sur-age-hidden';
                    ageHiddenInput.name = `sur_age_assure_${garantie.id}`;
                    ageHiddenInput.id = `sur_age_assure_${garantie.id}`;
                    
                    // Affichage de la tranche d'âge calculée
                    const ageDisplay = document.createElement('div');
                    ageDisplay.className = 'form-control-plaintext mb-2 p-2 bg-light';
                    ageDisplay.id = `sur_age_display_${garantie.id}`;
                    ageDisplay.textContent = 'Tranche d\'âge : Non calculée';
                    
                    // Informations API
                    const apiInfoDiv = document.createElement('div');
                    apiInfoDiv.id = `api_info_${garantie.id}`;
                    apiInfoDiv.className = 'api-info mt-2';
                    apiInfoDiv.style.display = 'none';
                    
                    const codeTableLabel = document.createElement('p');
                    codeTableLabel.id = `code_table_${garantie.id}`;
                    
                    const codeGroupeLabel = document.createElement('p');
                    codeGroupeLabel.id = `code_groupe_${garantie.id}`;
                    
                    apiInfoDiv.appendChild(codeTableLabel);
                    apiInfoDiv.appendChild(codeGroupeLabel);
                    
                    // Assemblage des éléments
                    surContainer.appendChild(capitalLabel);
                    surContainer.appendChild(capitalSelect);
                    surContainer.appendChild(ageDisplay);
                    surContainer.appendChild(ageHiddenInput);
                    surContainer.appendChild(apiInfoDiv);
                    
                    div.appendChild(surContainer);
                    
                    // Gestion de l'événement change pour la checkbox
                    checkbox.addEventListener('change', function() {
                        surContainer.style.display = this.checked ? 'block' : 'none';
                        apiInfoDiv.style.display = this.checked ? 'block' : 'none';

                        
                        
                        // Mettre à jour l'affichage de la tranche d'âge si la case est cochée
                        if (this.checked) {
                            
                            updateSureteAgeDisplay(garantie.id);
                        }
                    });
                }
                
                optionalGarantiesDiv.appendChild(div);
            }
        });
    }
    
    // Fonction pour mettre à jour l'affichage de la tranche d'âge SURETÉ
    function updateSureteAgeDisplay(garantieId) {
        const ageSaisie = parseInt(ageInput.value);
        const ageDisplay = document.getElementById(`sur_age_display_${garantieId}`);
        const ageHiddenInput = document.getElementById(`sur_age_assure_${garantieId}`);
        
        if (!isNaN(ageSaisie)) {
            const trancheAge = getTrancheAge(ageSaisie);
            if (trancheAge) {
                ageDisplay.textContent = `Tranche d'âge : ${trancheAge} ans (calculée automatiquement)`;
                ageHiddenInput.value = trancheAge;
            } else {
                ageDisplay.textContent = 'Tranche d\'âge : Hors plage autorisée';
                ageHiddenInput.value = '';
            }
        } else {
            ageDisplay.textContent = 'Tranche d\'âge : Veuillez saisir l\'âge d\'abord';
            ageHiddenInput.value = '';
        }
    }
    
    // Fonction pour charger les options d'âge (maintenue pour compatibilité, mais non utilisée pour SURETÉ)
    function loadAgeOptions(selectElement, codeGroupe) {
        // Cette fonction est conservée mais ne sera plus utilisée pour SURETÉ
        // car la tranche d'âge est maintenant calculée automatiquement
    }
    
    // Fonction pour calculer la prime SURETÉ via API
    async function calculatePrimeForSurete(garantieId) {
        const capital = document.getElementById(`sur_capital_${garantieId}`).value;
        const ageHiddenInput = document.getElementById(`sur_age_assure_${garantieId}`);
        const ageAssure = ageHiddenInput.value; // Récupère la valeur du champ caché
        const duree = dureeInput.value;
        
        if (!capital || !ageAssure || !duree || !currentCodeGroupe || !currentCodeTable) {
            console.log("Paramètres manquants pour le calcul SURETÉ");
            return 0;
        }
        
        const params = {
            CodeGroupe: currentCodeGroupe,
            AgeAssure: ageAssure,
            Capital: capital,
            codeTable: currentCodeTable,
            Duree: duree
        };
        console.log("Paramètres pour le calcul SURETÉ:", params);
        
        try {
            const response = await fetch("https://api.yakoafricassur.com/enov/get-prime-by-param-web", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": authToken
                },
                body: JSON.stringify(params)
            });
            
            if (!response.ok) {
                throw new Error("Erreur lors de la requête get-prime-by-param-web");
            }
            
            const data = await response.json();
            
            if (data.error === false && data.dataTablePrimeRes && data.dataTablePrimeRes.length > 0) {
                return parseFloat(data.dataTablePrimeRes[0].Prime) || 0;
            } else {
                console.log("Erreur dans la réponse API pour SURETÉ");
                return 0;
            }
        } catch (error) {
            console.error("Erreur API get-prime-by-param-web :", error);
            return 0;
        }
    }
    
    // Calculer l'âge à partir de la date de naissance
    dateNaissanceInput.addEventListener("change", function () {
        const dateNaissance = new Date(this.value);
        const today = new Date();

        let age = today.getFullYear() - dateNaissance.getFullYear();
        const m = today.getMonth() - dateNaissance.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < dateNaissance.getDate())) {
            age--;
        }

        ageInput.value = age;
        
        // Mettre à jour l'affichage de la tranche d'âge pour toutes les garanties SURETÉ cochées
        document.querySelectorAll('.garantie-option:checked').forEach(checkbox => {
            if (checkbox.value === 'SUR') {
                const garantieId = checkbox.dataset.garantieId;
                updateSureteAgeDisplay(garantieId);
            }
        });
        
        triggerAutoUpdate();
    });
    
    // Gestion du changement de périodicité
    document.getElementById("codePeriodicite").addEventListener("change", function () {
        const codeProduit = document.getElementById("CodeProduit").value;
        const codePeriodicite = this.value;
        
        fetch("https://api.yakoafricassur.com/enov/get-table-prime-web", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": authToken
            },
            body: JSON.stringify({
                CodeProduit: codeProduit,
                CodePeriodicite: codePeriodicite
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur lors de la requête get-table-prime-web");
            }
            return response.json();
        })
        .then(data => {
            if (data.error === false && data.dataTablePrime && data.dataTablePrime.length > 0) {
                currentCodeGroupe = data.dataTablePrime[0].CodeGRoupeIntervalle;
                currentCodeTable = data.dataTablePrime[0].codeTable;
                
                // Déclencher une mise à jour après avoir obtenu les nouvelles données
                triggerAutoUpdate();
            }
        })
        .catch(error => {
            console.error("Erreur API get-table-prime-web :", error);
        });
    });
    
    // Fonction pour déclencher la mise à jour automatique avec debounce
    function triggerAutoUpdate() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(updateSimulationResults, 500);
    }
    
    // Fonction principale pour mettre à jour les résultats de simulation
    async function updateSimulationResults() {
        const capitalSouscrit = parseFloat(capitalSouscritInput.value);
        const age = parseInt(ageInput.value);
        const duree = dureeInput.value;
        // const souscripteurAssur = document.querySelector("[name='isAssure']");
        
        // Vérifier que tous les champs requis sont remplis
        if (!capitalSouscrit || isNaN(age) || !codePeriodiciteInput.value || !duree ) {
            document.getElementById("result").innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">Veuillez remplir tous les champs obligatoires</td>
                </tr>
            `;
            document.getElementById('primeTotal').textContent = '0';
            document.getElementById('btn-souscription').classList.add('btn-inactif');
            return;
        }
        
        // Vérifier l'âge pour chaque garantie
        let ageValid = true;
        console.log("Garanties:", garanties);
        garanties.forEach(garantie => {
            if (age < garantie.agemin || age > garantie.agemax) {
                ageValid = false;
            }
        });
        
        if (!ageValid) {
            document.getElementById("result").innerHTML = `
                <tr>
                    <td colspan="3" class="text-center text-danger">L'âge doit être compris entre les limites spécifiées pour les garanties</td>
                </tr>
            `;
            document.getElementById('primeTotal').textContent = '0';
            document.getElementById('btn-souscription').classList.add('btn-inactif');
            return;
        }
        
        const isAssureInput = document.querySelector('input[name="isAssure"]:checked');
        const isAssure = isAssureInput ? isAssureInput.value : '';


        
        
        let totalPrime = 0;
        let resultDiv = document.getElementById("result");
        resultDiv.innerHTML = "";

        let fraieadhesion = 7500;
        
        // Objet pour stocker toutes les données de simulation
        const simulationData = {
            garantieData: [],
            primeFinale: 0,
            infoSimulation: {
                isAssure : isAssure,
                primepricipale: 0,
                periodicite: codePeriodiciteInput.value,
                capital: 0,
                datenaissance: dateNaissanceInput.value,
                age: age,
                fraisAdhesion: fraieadhesion,
                duree: duree,
                
            },
            codeProduit: document.getElementById("CodeProduit").value,
            valueSureteCheck: sessionStorage.getItem('valueSureteCheck') === 'true' 
        };
        
        // Traiter les garanties obligatoires
        garanties.forEach(garantie => {
            if (garantie.estobligatoire === 1) {
                let prime = 0;
                let capital = 0;
                
                switch(garantie.codeproduitgarantie) {
                    case 'LIB':
                        prime = capitalSouscrit * 0.5;
                        capital = 0;
                        break;
                    case 'DIG':
                        prime = capitalSouscrit * 0.5;
                        capital = 0;
                        break;
                    case 'DECESACC':
                        prime = capitalSouscrit * 0.095;
                        capital = capitalSouscrit;
                        break;
                    default:
                        prime = 0;
                        capital = 0;
                }
                
                totalPrime += prime;
                
                // Ajouter la garantie aux données de simulation
                simulationData.garantieData.push({
                    codeGarantie: garantie.codeproduitgarantie,
                    libelle: garantie.libelle,
                    prime: prime,
                    capital: capital,
                    obligatoire: true
                });
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${garantie.libelle}</td>
                    <td>${prime.toLocaleString('fr-FR')}</td>
                    <td>${capital.toLocaleString('fr-FR')}</td>
                `;
                resultDiv.appendChild(row);
            }
        });
        
        // Traiter les garanties optionnelles cochées
        const selectedOptions = document.querySelectorAll('.garantie-option:checked');
        
        for (const checkbox of selectedOptions) {
            const garantieCode = checkbox.value;
            const garantieId = checkbox.dataset.garantieId;
            const garantie = garanties.find(g => g.codeproduitgarantie === garantieCode);
            
            if (garantie) {
                let prime = 0;
                let capital = 0;
                let surDetails = null;
                
                switch(garantieCode) {
                    case 'SUR':
                        const surCapital = parseFloat(document.getElementById(`sur_capital_${garantieId}`).value);
                        const ageHiddenInput = document.getElementById(`sur_age_assure_${garantieId}`);
                        const selectedAge = ageHiddenInput.value; // Récupère la tranche calculée automatiquement
                        
                        if (!selectedAge) {
                            continue;
                        }
                        
                        // Calculer la prime via API
                        prime = await calculatePrimeForSurete(garantieId);
                        capital = surCapital;
                        
                        // Stocker les détails spécifiques à SUR
                        surDetails = {
                            capitalSouhaite: surCapital,
                            ageAssure: selectedAge,
                            duree: duree,
                            trancheCalculee: true // Indique que la tranche a été calculée automatiquement
                        };
                        break;
                    case 'DECESACC':
                        prime = capitalSouscrit * 0.05;
                        capital = capitalSouscrit;
                        break;
                    default:
                        prime = capitalSouscrit * 0.05;
                        capital = capitalSouscrit;
                }
                
                totalPrime += prime;
                
                // Ajouter la garantie optionnelle aux données de simulation
                simulationData.garantieData.push({
                    codeGarantie: garantieCode,
                    libelle: garantie.libelle,
                    prime: prime,
                    capital: capital,
                    obligatoire: false,
                    surDetails: surDetails
                });
                
                simulationData.infoSimulation.capital += capital;
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${garantie.libelle} (option)</td>
                    <td>${prime.toLocaleString('fr-FR')}</td>
                    <td>${capital.toLocaleString('fr-FR')}</td>
                `;
                resultDiv.appendChild(row);
            }
        }
        
        // Mettre à jour la prime finale
        simulationData.primeFinale = totalPrime;
        simulationData.infoSimulation.primepricipale = totalPrime;

        const firstPrime = totalPrime + fraieadhesion
        
        // Stocker toutes les données en session
        saveToSession(simulationData);
        
        // Mettre à jour le total affiché
        document.getElementById('primeTotal').textContent = firstPrime.toLocaleString('fr-FR');
        
        // Activer le bouton de souscription si tout est valide
        if (totalPrime > 0) {
            document.getElementById('btn-souscription').classList.remove('btn-inactif');
        } else {
            document.getElementById('btn-souscription').classList.add('btn-inactif');
        }
    }
    
    // Fonction pour sauvegarder les données en session
    function saveToSession(simulationData) {
        sessionStorage.setItem('simulationData', JSON.stringify(simulationData));
        console.log('Données de simulation sauvegardées:', simulationData);
    }
    
    // Écouteurs d'événements pour les changements
    dateNaissanceInput.addEventListener("change", triggerAutoUpdate);
    capitalSouscritInput.addEventListener("change", triggerAutoUpdate);
    codePeriodiciteInput.addEventListener("change", triggerAutoUpdate);
    dureeInput.addEventListener("change", triggerAutoUpdate);
    
    // Charger les garanties optionnelles au démarrage
    loadOptionalGaranties();

    // function pour reiniatialisé le simulateur
    resetBtn.addEventListener('click', function() {
        dureeInput.value = '6';
        capitalSouscritInput.value = '';
        codePeriodiciteInput.value = '';
        dateNaissanceInput.value = '';
        ageInput.value = '';
        resultDiv.innerHTML = "";
        const selectedOptions = document.querySelectorAll('.garantie-option:checked');
        selectedOptions.forEach(option => option.checked = false);

        const souscripteurAssur = document.querySelector("[name='isAssure']");
        if(souscripteurAssur) {
            souscripteurAssur.value = "";
        }
        
        // Réinitialiser également l'état de SURETÉ
        sessionStorage.removeItem('valueSureteCheck');
        sessionStorage.removeItem('simulateurData');
        sessionStorage.removeItem('simulationData');
        
    });

    const souscribBtn = document.getElementById('btn-souscription');

    souscribBtn.addEventListener('click', function(event) {
        // Récupère la valeur du radio "isAssure"
        const isAssureInput = document.querySelector('input[name="isAssure"]:checked');
        const isAssure = isAssureInput ? isAssureInput.value : '';

        // Si aucune option n'est cochée → bloquer la redirection
        if (!isAssureInput) {
            event.preventDefault(); 

            swal.fire({
                title: "Veuillez choisir une option (Oui ou Non) pour l'assuré avant de continuer",
                icon: "warning",
                confirmButtonText: "OK"
            });
            
            // Met le focus sur le premier radio pour attirer l’attention
            const firstRadio = document.querySelector('input[name="isAssure"]');
            if (firstRadio) {
                firstRadio.focus();
            }
            return;
        }

        // Si une valeur est cochée → on met à jour la session normalement
        const sessionData = sessionStorage.getItem('simulationData');
        if (sessionData) {
            const simulationData = JSON.parse(sessionData);
            simulationData.infoSimulation.isAssure = isAssure;
            sessionStorage.setItem('simulationData', JSON.stringify(simulationData));
        }
    });


    
    // Déclencher le changement de périodicité au chargement pour initialiser les données
    document.getElementById("codePeriodicite").dispatchEvent(new Event('change'));
});