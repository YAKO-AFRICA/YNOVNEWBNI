document.addEventListener("DOMContentLoaded", function () {
    // Éléments du formulaire
    const form = document.getElementById("primeForm");
    const dateNaissanceInput = document.getElementById("dateNaissance");
    const ageInput = document.getElementById("age");
    const garantieSeniorCheck = document.getElementById("garantieSeniorCheck");
    const seniorPrimeInputWrapper = document.getElementById("seniorPrimeInputWrapper");
    const resultDiv = document.getElementById("result");
    const primeTotalElement = document.getElementById("primeTotal");
    // const primePrincipElement = document.getElementById("primePrincip");
    const btnSouscription = document.getElementById("btn-souscription");
    const btnReset = document.getElementById("btn-reset");
    
    let hommagePrime = 0;
    let simulationData = null;
    
    

    // Calcul de l'âge à partir de la date de naissance
    dateNaissanceInput.addEventListener("change", function () {
        const dateNaissance = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dateNaissance.getFullYear();
        const m = today.getMonth() - dateNaissance.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < dateNaissance.getDate())) {
            age--;
        }
        ageInput.value = age;
    });

    // Gestion de l'affichage du champ prime senior
    garantieSeniorCheck.addEventListener("change", function() {
        seniorPrimeInputWrapper.style.display = this.checked ? "block" : "none";
        if (!this.checked) {
            document.getElementById("seniorPrimeInput").value = "";
        }
    });

    // Réinitialisation du formulaire
    btnReset.addEventListener("click", function(e) {
        e.preventDefault();
        resetForm();
    });

    function resetForm() {
        form.reset();
        resultDiv.innerHTML = "";
        primeTotalElement.textContent = "0";
        // primePrincipElement.textContent = "0";
        seniorPrimeInputWrapper.style.display = "none";
        btnSouscription.classList.add("btn-inactif");
        simulationData = null;
        
        // Afficher un message de confirmation
        showToast("Formulaire réinitialisé avec succès", "success");
    }

    // Soumission du formulaire
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        
        // Validation du formulaire
        if (!validateForm()) {
            return;
        }

        const fraisAdhesion = 7500;
        let formData = new FormData(this);
        let totalPrime = fraisAdhesion;
        let totalPurePrime = 0;
    
        // Réinitialiser l'affichage des résultats
        resultDiv.innerHTML = "";
        showLoading();

        // Structure principale pour les données de simulation
        simulationData = {
            garantieData: [],
            infoSimulation: {
                primeFinal: totalPrime,
                primepricipale: totalPurePrime,
                codeProduit: formData.get("CodeProduit"),
                periodicite: formData.get("codePeriodicite"),
                duree: formData.get("duree"),
                age: formData.get("age"),
                capital: formData.get("capitalSouscrit"),
                dateEffet: formData.get("dateEffet"),
                datenaissance: formData.get("dateNaissance"),
                fraisAdhesion: fraisAdhesion
            }
        };

        // Filtrer les garanties si nécessaire
        let garantiesToProcess = [...garanties];
        if (garantieSeniorCheck.checked) {
            garantiesToProcess = garantiesToProcess.filter(g => g.codeproduitgarantie !== "SENIOR");
        }

        // Traitement de chaque garantie
        processGaranties(garantiesToProcess, formData, totalPrime, totalPurePrime);
    });

    // Fonction pour valider le formulaire
    function validateForm() {
        if (!dateNaissanceInput.value) {
            showToast("Veuillez saisir votre date de naissance", "error");
            return false;
        }
        
        if (!document.getElementById("capitalSouscrit").value) {
            showToast("Veuillez sélectionner un capital", "error");
            return false;
        }
        
        if (!document.getElementById("dateEffet").value) {
            showToast("Veuillez sélectionner une date d'effet", "error");
            return false;
        }
        
        if (garantieSeniorCheck.checked && !document.getElementById("seniorPrimeInput").value) {
            showToast("Veuillez saisir une prime pour la garantie Senior", "error");
            return false;
        }
        
        return true;
    }

    // Fonction pour traiter les garanties
    function processGaranties(garantiesToProcess, formData, totalPrime, totalPurePrime) {
        let processedCount = 0;
        
        garantiesToProcess.forEach((garantie) => {
            let newFormData = new FormData();
            formData.forEach((value, key) => newFormData.append(key, value));
            newFormData.set("codeGarantie", garantie.codeproduitgarantie);
            newFormData.set("CodeProduitFormule", "YKE_2018_V1");

            fetch("https://api.yakoafricassur.com/enov/prime-garantie", {
                method: "POST",
                body: newFormData
            })
            .then(response => response.json())
            .then(data => {
                processedCount++;
                
                if (!data || data.error) {
                    console.error(`Erreur pour ${garantie.codeproduitgarantie}:`, data?.message || "Réponse vide");
                    return;
                }

                if (Array.isArray(data) && data.length > 0) {
                    let firstRecord = data[0];
                    let prime = firstRecord.Prime || 0;
                    let capital = firstRecord.Capital || 0;

                    // Mise à jour des primes
                    if (garantie.codeproduitgarantie === "HOMMAGE") {
                        hommagePrime = parseInt(prime);
                    }

                    totalPrime += parseInt(prime);
                    totalPurePrime += parseInt(prime);
                    
                    // Mise à jour de l'affichage
                    updateDisplay(garantie, prime, capital, totalPrime, totalPurePrime);

                    // Ajout de la garantie aux données
                    simulationData.garantieData.push({
                        codeGarantie: garantie.codeproduitgarantie,
                        prime: prime,
                        capital: capital,
                        libelle: garantie.libelle,
                    });

                    // Mise à jour des primes finales
                    simulationData.infoSimulation.primeFinal = totalPrime;
                    simulationData.infoSimulation.primepricipale = totalPurePrime;

                    // Vérification si toutes les garanties ont été traitées
                    if (processedCount === garantiesToProcess.length) {
                        if (garantieSeniorCheck.checked) {
                            addSeniorGarantie(formData, totalPrime, totalPurePrime);
                        } else {
                            finishProcess();
                        }
                    }
                }
            })
            .catch(error => {
                processedCount++;
                console.error(`Erreur API pour ${garantie.codeproduitgarantie}:`, error);
                
                if (processedCount === garantiesToProcess.length) {
                    hideLoading();
                    showToast("Une erreur est survenue lors du calcul des primes", "error");
                }
            });
        });
    }

    // Fonction pour ajouter la garantie senior
    function addSeniorGarantie(formData, totalPrime, totalPurePrime) {
        const seniorPrimeInput = document.getElementById("seniorPrimeInput");
        let seniorPrime = parseInt(seniorPrimeInput.value) || 0;
        let seniorCapital = 500000;
        
        if (seniorPrime <= 0) {
            hideLoading();
            showToast("Veuillez saisir une prime valide pour la garantie Senior", "error");
            return;
        }

        let newTotalPrime = totalPrime + seniorPrime;
        let newTotalPurePrime = totalPurePrime + seniorPrime;

        // Mise à jour de l'affichage
        updateSeniorDisplay(seniorPrime, seniorCapital, newTotalPrime, newTotalPurePrime);

        // Ajout de la garantie senior
        simulationData.garantieData.push({
            codeGarantie: "SENIOR",
            prime: seniorPrime,
            capital: seniorCapital,
            libelle: "Garantie optionnelle Senior"
        });

        // Mise à jour des primes finales
        simulationData.infoSimulation.primeFinal = newTotalPrime;
        simulationData.infoSimulation.primepricipale = newTotalPurePrime;

        finishProcess();
    }

    // Fonction pour mettre à jour l'affichage des garanties
    function updateDisplay(garantie, prime, capital, totalPrime, totalPurePrime) {
        primeTotalElement.textContent = totalPrime.toLocaleString('fr-FR');
        // primePrincipElement.textContent = totalPurePrime.toLocaleString('fr-FR');

        resultDiv.innerHTML += `
            <tr>
                <td>${garantie.libelle || garantie.codeproduitgarantie}</td>
                <td class="text-end">${parseInt(prime).toLocaleString('fr-FR')} FCFA</td>
                <td class="text-end">${parseInt(capital).toLocaleString('fr-FR')} FCFA</td>
            </tr>
        `;
    }

    // Fonction pour mettre à jour l'affichage de la garantie senior
    function updateSeniorDisplay(prime, capital, totalPrime, totalPurePrime) {
        primeTotalElement.textContent = totalPrime.toLocaleString('fr-FR');
        // primePrincipElement.textContent = totalPurePrime.toLocaleString('fr-FR');

        resultDiv.innerHTML += `
            <tr>
                <td>Garantie Senior</td>
                <td class="text-end">${prime.toLocaleString('fr-FR')} FCFA</td>
                <td class="text-end">${capital.toLocaleString('fr-FR')} FCFA</td>
            </tr>
        `;
    }

    // Fonction pour masquer l'indicateur de chargement
    function hideLoading() {
        const loadingElements = resultDiv.querySelectorAll('.spinner-border, .text-center');
        loadingElements.forEach(element => element.remove());
    }

    function finishProcess() {
        hideLoading();
        
        // Validation des données
        if (!simulationData || !simulationData.infoSimulation || !simulationData.garantieData || simulationData.garantieData.length === 0) {
            // showToast("Données de simulation invalides", "error");
            return;
        }

        // Affichage des résultats
        resultDiv.innerHTML += `
            
            <tr class="table-primary" colspan="3">
                <td><strong>TOTAL PRIME</strong></td>
                <td class="text-end"><strong>${simulationData.infoSimulation.primepricipale.toLocaleString('fr-FR')} FCFA</strong></td>
            </tr>
        `;

        // Enregistrement dans sessionStorage
        sessionStorage.setItem("simulationData", JSON.stringify(simulationData));

        if (simulationData.infoSimulation.primepricipale > 10) {
            btnSouscription.classList.remove("btn-inactif");
            btnSouscription.disabled = false;
        }

        // Envoi au serveur
        fetch("{{ route('storeSimulationPrime') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") 
            },
            body: JSON.stringify(simulationData)
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(data => {
            if (data && !data.error) {
                
            } else {
                throw new Error(data?.message || "Erreur serveur");
            }
        })
        .catch(error => {
            console.error("Erreur:", error);
            showToast("Erreur: " + error.message, "error");
        });
    }


    // Fonction pour afficher un indicateur de chargement
    function showLoading() {
        resultDiv.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Calcul en cours...</span>
                </div>
                <p class="mt-2">Calcul des primes en cours...</p>
            </div>
        `;
    }

    // Fonction pour masquer l'indicateur de chargement
  
});