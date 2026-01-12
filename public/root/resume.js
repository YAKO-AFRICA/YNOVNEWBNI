document.addEventListener("DOMContentLoaded", function () {
    // Fonction principale pour mettre à jour le résumé
    function updateResume() {
        // Fonction helper pour récupérer les valeurs
        const getValue = (name) => {
            const element = document.querySelector(`[name="${name}"]`);
            if (element) {
                if (element.type === 'radio' || element.type === 'checkbox') {
                    const checked = document.querySelector(`[name="${name}"]:checked`);
                    return checked ? checked.value : '';
                }
                return element.value;
            }
            return sessionStorage.getItem(name) || '';
        };

        // Fonction pour formater la date
        const formatDate = (dateString) => {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR');
        };

        // Fonction pour formater les montants
        const formatAmount = (amount) => {
            if (!amount) return '--';
            return new Intl.NumberFormat('fr-FR').format(amount) + ' FCFA';
        };

        // Mise à jour des informations personnelles
        document.getElementById('displayCivility').textContent = getValue('civilite') || '--';
        document.getElementById('displayNom').textContent = getValue('nom') || '--';
        document.getElementById('displayPrenom').textContent = getValue('prenom') || '--';
        document.getElementById('displayBirthday').textContent = formatDate(getValue('datenaissance')) || '--';
        document.getElementById('displayLieuNaissance').textContent = $('#lieunaissance').select2('data')[0]?.text || getValue('lieunaissance') || '--';
        document.getElementById('displayResidence').textContent = $('#lieuresidence').select2('data')[0]?.text || getValue('lieuresidence') || '--';
        document.getElementById('displayNumPiece').textContent = `${getValue('naturepiece') || ''} ${getValue('numeropiece') || ''}`.trim() || '--';
        document.getElementById('displayProfession').textContent = $('#profession').select2('data')[0]?.text || getValue('profession') || '--';
        document.getElementById('displayEmployeur').textContent = $('#employeur').select2('data')[0]?.text || getValue('employeur') || '--';
        document.getElementById('displayEmail').textContent = getValue('email') || '--';
        document.getElementById('displayTelephone').textContent = getValue('telephone') || '--';
        document.getElementById('displayMobile').textContent = getValue('mobile') || '--';
        document.getElementById('displayMobile1').textContent = getValue('mobile1') || '--';

        // Mise à jour des informations du contrat
        document.getElementById('displayDateEffet').textContent = formatDate(getValue('dateEffet')) || '--';
        document.getElementById('displayPrimePrincipale').textContent = formatAmount(getValue('primepricipale'));
        document.getElementById('displayFraisAdhesion').textContent = formatAmount(getValue('fraisAdhesion'));
        document.getElementById('displayCapital').textContent = formatAmount(getValue('capital'));
        document.getElementById('displayModePaiement').textContent = getPaymentMethodLabel(getValue('modepaiement')) || '--';
        document.getElementById('displayOrganisme').textContent = $('#banque').val() || '--';
        document.getElementById('displayAgence').textContent = $('#Agence').val() || '--';
        document.getElementById('displayNumeroCompte').textContent = getValue('numerocompte') || '--';
        document.getElementById('displayPeriodicite').textContent = getPeriodicityLabel(getValue('periodicite')) || '--';
    }

    // Fonctions pour les libellés
    function getPaymentMethodLabel(value) {
        const methods = {
            'VIR': 'Virement bancaire',
            'ESP': 'Espèce',
            'CHK': 'Chèque',
            'Mobile_money': 'Mobile money',
            'SOURCE': 'Prélèvement à la source'
        };
        return methods[value] || value;
    }

    function getPeriodicityLabel(value) {
        const periods = {
            'M': 'Mensuelle',
            'T': 'Trimestrielle',
            'S': 'Semestrielle',
            'A': 'Annuelle',
            'U': 'Versement unique'
        };
        return periods[value] || value;
    }

    // Liste des champs à surveiller
    const fieldsToWatch = [
        // Informations personnelles
        'civilite', 'nom', 'prenom', 'datenaissance', 'lieunaissance',
        'naturepiece', 'numeropiece', 'lieuresidence', 'profession',
        'employeur', 'email', 'mobile', 'mobile1', 'telephone',
        
        // Informations du contrat
        'modepaiement', 'organisme', 'agence', 'numerocompte',
        'dateEffet', 'primepricipale', 'fraisAdhesion', 'capital',
        'periodicite', 'numMobile'
    ];

    // Ajout des écouteurs d'événements
    fieldsToWatch.forEach(field => {
        const elements = document.querySelectorAll(`[name="${field}"]`);
        elements.forEach(element => {
            element.addEventListener('input', updateResume);
            element.addEventListener('change', updateResume);
        });
    });

    // Écouteurs pour les Select2
    const select2Fields = ['lieunaissance', 'lieuresidence', 'profession', 'employeur', 'banque', 'Agence'];
    select2Fields.forEach(field => {
        $(`#${field}`).on("select2:select select2:change", updateResume);
    });

    // Gestion de l'affichage des modes de paiement
    document.querySelectorAll('input[name="modepaiement"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('mode_bancaire').style.display = 
                (this.value === 'VIR' || this.value === 'SOURCE') ? 'block' : 'none';
            document.getElementById('mode_mobile').style.display = 
                (this.value === 'Mobile_money') ? 'block' : 'none';
            updateResume();
        });
    });

    // Mise à jour initiale
    updateResume();

    // Fonction pour être appelée quand l'étape résumé est affichée
    window.onResumeStepShow = function() {

        updateResume();
    };
    
});

{/* <script> */}
    document.addEventListener('DOMContentLoaded', function() {
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
    });
{/* </script> */}
