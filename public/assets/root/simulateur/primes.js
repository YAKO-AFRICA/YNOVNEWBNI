document.addEventListener("DOMContentLoaded", function () {
    const produitCode = document.getElementById("produitCode");
    const primeSouhaite = document.getElementById("primepricipale");

    function updateSimulationData() {
        const primeValue = parseFloat(primeSouhaite.value);
        if (isNaN(primeValue)) return;

        const produitValue = produitCode.value;
        const FRAIS_ADHESION = 0;
        const garantiesData = [];

        if (produitValue === "PFA_IND") {
            garantiesData.push(
                {
                    codeGarantie: "SECU",
                    libelle: "SECURITE",
                    capital: 0,
                    prime: primeValue * 0.6
                },
                {
                    codeGarantie: "PERF",
                    libelle: "PERFORMANCE",
                    capital: 0,
                    prime: primeValue * 0.4
                }
            );

            const simulationData = {
                garantieData: garantiesData,
                infoSimulation: {
                    codeProduit: produitValue,
                    primepricipale: primeValue,
                    fraisAdhesion: FRAIS_ADHESION,
                    primeFinale: primeValue
                }
            };

            sessionStorage.setItem('simulationData', JSON.stringify(simulationData));
            
            // Vérification immédiate
            const stored = sessionStorage.getItem('simulationData');
            console.log('Vérification:', stored ? JSON.parse(stored) : 'VIDE');

            if (stored) {
                document.getElementById("simulationDataInput").value = stored;
            }

            const garantieTable = document.getElementById('garantiesTableBody');
    
            function updateGarantiesTable() {
                const donneSession = sessionStorage.getItem('simulationData');
                
                // Vider le tableau
                garantieTable.innerHTML = '';
                
                if (donneSession) {
                    try {
                        const simulationData = JSON.parse(donneSession);
                        let garanties = [];
                        let totalPrimeGaranties = 0;

                        // Récupérer les garanties selon la structure des données
                        if (Array.isArray(simulationData)) {
                            garanties = simulationData;
                        } else if (simulationData.garantieData) {
                            garanties = simulationData.garantieData;
                        } else if (simulationData.garanties) {
                            garanties = simulationData.garanties;
                        }

                        // Afficher les garanties
                        if (garanties.length > 0) {
                            garanties.forEach(garantie => {
                                const prime = parseInt(garantie.prime || garantie.Prime || 0);
                                totalPrimeGaranties += prime;
                                
                                const garantieRow = document.createElement('tr');
                                garantieRow.innerHTML = `
                                    <td>${garantie.libelle || garantie.Libelle || '--'}</td>
                                    <td>${garantie.codeGarantie || garantie.CodeGarantie || '--'}</td>
                                    <td>${prime.toLocaleString('fr-FR')} FCFA</td>
                                `;
                                garantieTable.appendChild(garantieRow);
                            });

                            // Ajouter la ligne de total
                            const totalRow = document.createElement('tr');
                            totalRow.className = 'table-active fw-bold';
                            totalRow.innerHTML = `
                                <td colspan="2">Total des garanties</td>
                                <td>${totalPrimeGaranties.toLocaleString('fr-FR')} FCFA</td>
                            `;
                            garantieTable.appendChild(totalRow);

                        } else {
                            // Aucune garantie
                            garantieTable.innerHTML = `
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Aucune garantie sélectionnée
                                    </td>
                                </tr>`;
                        }

                        // Afficher la prime principale (si elle existe dans les données)
                        if (simulationData.infoSimulation?.primepricipale || simulationData.PrimeTotal) {
                            const primepricipale = parseInt(simulationData.infoSimulation?.primepricipale || simulationData.PrimeTotal || 0);
                        }
                        
                    } catch (e) {
                        console.error("Erreur lors du parsing des données:", e);
                        garantieTable.innerHTML = `
                            <tr>
                                <td colspan="3" class="text-center text-danger py-3">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Erreur lors du chargement des données
                                </td>
                            </tr>`;
                    }
                } else {
                    // Aucune donnée en session
                    garantieTable.innerHTML = `
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Aucune donnée de simulation trouvée
                            </td>
                        </tr>`;
                }
            }

            // Initialisation
            updateGarantiesTable();

            // Écouter les changements dans le sessionStorage
            window.addEventListener('storage', function(e) {
                if (e.key === 'simulationData') {
                    updateGarantiesTable();
                }
            });
        }
    }

    primeSouhaite.addEventListener("blur", updateSimulationData);

  
});

