<div class="form-grid">
    <div class="row mb-3">
        <div class="form-group col-sm-12 col-md-6 col-lg-6 mb-3">
            <label>Déjà Client YAKO AFRICA ?</label>
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="dejaClient" value="oui"> Oui
                </label>
                <label class="radio-label">
                    <input type="radio" name="dejaClient" value="non"> Non
                </label>
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label>Date d'Effet</label>
            <input type="date" name="datteEffet">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12 col-md-6 col-lg-6 mb-3">
            <label>Mode de Paiement</label>
            <select name="modePaiement">
                <option value="">Sélectionner</option>
                <option value="especes">Espèces</option>
                <option value="cheque">Chèque</option>
                <option value="virement">Virement bancaire</option>
                <option value="mobile_money">Mobile Money</option>
                <option value="carte">Carte bancaire</option>
            </select>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label>Périodicité de Paiement</label>
            <select name="periodicite">
                <option value="">Sélectionner</option>
                <option value="mensuel">Mensuel</option>
                <option value="trimestriel">Trimestriel</option>
                <option value="semestriel">Semestriel</option>
                <option value="annuel">Annuel</option>
            </select>
        </div>
    </div>
    
    <!-- Conteneur pour les champs dynamiques -->
    <div class="dynamic-payment-fields"></div>
</div>

<script>
// Version simplifiée et corrigée du script
document.addEventListener('DOMContentLoaded', function() {
    const modePaiementSelect = document.querySelector('select[name="modePaiement"]');
    const dynamicFieldsContainer = document.querySelector('.dynamic-payment-fields');
    
    if (!modePaiementSelect || !dynamicFieldsContainer) {
        console.error('Éléments requis non trouvés');
        return;
    }
    
    // Définition des champs pour chaque mode de paiement
    const fieldsConfig = {
        'virement': {
            title: 'Coordonnées Bancaires',
            fields: [
                {
                    name: 'banque',
                    label: 'Banque',
                    type: 'text',
                    required: true,
                    className: 'col-sm-12 col-md-12 col-lg-12'
                },
                {
                    name: 'codeBanque',
                    label: 'Code Banque',
                    type: 'text',
                    required: true,
                    className: 'col-sm-12 col-md-6 col-lg-3'
                },
                {
                    name: 'codeGuichet',
                    label: 'Code Guichet',
                    type: 'text',
                    required: true,
                    className: 'col-sm-12 col-md-6 col-lg-3'
                },
                {
                    name: 'numeroCompte',
                    label: 'Numéro de Compte',
                    type: 'text',
                    required: true,
                    className: 'col-sm-12 col-md-6 col-lg-3'
                },
                {
                    name: 'cleRib',
                    label: 'Clé RIB',
                    type: 'text',
                    required: true,
                    className: 'col-sm-12 col-md-6 col-lg-3'
                },
                {
                    name: 'rib',
                    label: 'RIB Complet',
                    type: 'text',
                    required: true,
                    className: 'col-sm-12 col-md-12 col-lg-12',
                    readonly: true,
                    placeholder: 'Sera généré automatiquement'
                }
            ]
        },
        'mobile_money': {
            title: 'Informations Mobile Money',
            fields: [
                {
                    name: 'numeroCompte',
                    label: 'Numéro de Téléphone',
                    type: 'tel',
                    required: true,
                    className: 'col-sm-12 col-md-12 col-lg-12',
                    pattern: '[0-9]{9,12}',
                    placeholder: 'Ex: 771234567'
                }
            ]
        },
        'especes': {
            title: '',
            fields: []
        },
        'cheque': {
            title: '',
            fields: []
        },
        'carte': {
            title: 'Informations Carte Bancaire',
            fields: [
                {
                    name: 'numeroCarte',
                    label: 'Numéro de Carte',
                    type: 'text',
                    required: true,
                    className: 'col-sm-12 col-md-12 col-lg-12',
                    placeholder: 'XXXX-XXXX-XXXX-XXXX'
                }
            ]
        }
    };
    
    // Fonction pour générer automatiquement le RIB
    function generateRIB() {
        const codeBanque = document.querySelector('input[name="codeBanque"]')?.value || '';
        const codeGuichet = document.querySelector('input[name="codeGuichet"]')?.value || '';
        const numeroCompte = document.querySelector('input[name="numeroCompte"]')?.value || '';
        const cleRib = document.querySelector('input[name="cleRib"]')?.value || '';
        
        if (codeBanque && codeGuichet && numeroCompte && cleRib) {
            return `${codeBanque}${codeGuichet}${numeroCompte}${cleRib}`;
        }
        return '';
    }
    
    // Fonction pour mettre à jour les champs requis
    function updateRequiredFields() {
        const selectedMode = modePaiementSelect.value;
        const allInputs = dynamicFieldsContainer.querySelectorAll('input, select, textarea');
        
        // Enlever l'attribut required de tous les champs dynamiques
        allInputs.forEach(input => {
            input.removeAttribute('required');
            input.classList.remove('is-invalid');
        });
        
        // Ajouter required seulement pour le mode sélectionné
        if (fieldsConfig[selectedMode]) {
            fieldsConfig[selectedMode].fields.forEach(field => {
                if (field.required) {
                    const input = dynamicFieldsContainer.querySelector(`[name="${field.name}"]`);
                    if (input) {
                        input.setAttribute('required', 'required');
                    }
                }
            });
        }
    }
    
    // Fonction pour afficher/masquer les champs
    function togglePaymentFields() {
        const selectedMode = modePaiementSelect.value;
        
        // Vider le conteneur
        dynamicFieldsContainer.innerHTML = '';
        
        // Vérifier si le mode nécessite des champs supplémentaires
        if (selectedMode && fieldsConfig[selectedMode] && fieldsConfig[selectedMode].fields.length > 0) {
            const config = fieldsConfig[selectedMode];
            
            // Créer une nouvelle ligne pour les champs dynamiques
            const row = document.createElement('div');
            row.className = 'row mb-3 dynamic-fields-row';
            
            // Ajouter un titre si configuré
            if (config.title) {
                const titleCol = document.createElement('div');
                titleCol.className = 'col-12';
                titleCol.innerHTML = `<h5 class="mt-3 mb-2">${config.title}</h5>`;
                row.appendChild(titleCol);
            }
            
            // Ajouter chaque champ
            config.fields.forEach(field => {
                const col = document.createElement('div');
                col.className = `form-group ${field.className || 'col-sm-12 col-md-6 col-lg-6'}`;
                
                const fieldId = `payment_${field.name}`;
                let fieldHTML = `
                    <label for="${fieldId}">${field.label}${field.required ? ' *' : ''}</label>
                `;
                
                const attrs = [];
                if (field.required) attrs.push('required');
                if (field.readonly) attrs.push('readonly');
                if (field.placeholder) attrs.push(`placeholder="${field.placeholder}"`);
                if (field.pattern) attrs.push(`pattern="${field.pattern}"`);
                if (field.maxlength) attrs.push(`maxlength="${field.maxlength}"`);
                
                fieldHTML += `<input type="${field.type}" 
                                      name="${field.name}" 
                                      id="${fieldId}"
                                      class="form-control"
                                      ${attrs.join(' ')}>`;
                
                col.innerHTML = fieldHTML;
                row.appendChild(col);
            });
            
            dynamicFieldsContainer.appendChild(row);
            
            // Ajouter des écouteurs d'événements pour les champs RIB
            if (selectedMode === 'virement') {
                const ribInputs = ['codeBanque', 'codeGuichet', 'numeroCompte', 'cleRib'];
                
                ribInputs.forEach(inputName => {
                    const input = document.querySelector(`input[name="${inputName}"]`);
                    if (input) {
                        input.addEventListener('blur', () => {
                            const rib = generateRIB();
                            const ribField = document.querySelector('input[name="rib"]');
                            if (ribField) {
                                ribField.value = rib;
                            }
                        });
                        
                        input.addEventListener('input', () => {
                            // Validation en temps réel
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                            } else {
                                input.classList.remove('is-invalid');
                                
                                // Mettre à jour le RIB automatiquement
                                const rib = generateRIB();
                                const ribField = document.querySelector('input[name="rib"]');
                                if (ribField) {
                                    ribField.value = rib;
                                }
                            }
                        });
                    }
                });
            }
        }
        
        // Mettre à jour les champs requis
        updateRequiredFields();
    }
    
    // Initialiser l'écouteur d'événements
    modePaiementSelect.addEventListener('change', togglePaymentFields);
    
    // Vérifier s'il y a déjà une valeur sélectionnée (pour le rechargement de page)
    if (modePaiementSelect.value) {
        togglePaymentFields();
    }
});
</script>