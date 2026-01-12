document.addEventListener('DOMContentLoaded', function () {
    const sessionData = sessionStorage.getItem('simulationData');
    if (!sessionData) return;

    const simulationData = JSON.parse(sessionData);

    const fieldNames = [
        'periodicite', 'civilite', 'nom', 'prenom', 'datenaissance', 'lieunaissance',
        'naturepiece', 'numeropiece', 'lieuresidence', 'profession', 'employeur',
        'email', 'mobile', 'mobile1', 'telephone', 'primepricipale', 'duree', 'dateEffet', 'capital', 'fraisAdhesion'
    ];

    fieldNames.forEach((name) => {
        const value = simulationData.infoSimulation[name];
        if (value !== undefined) {
            const elements = document.querySelectorAll(`[name="${name}"]`);

            elements.forEach(el => {
                const type = el.type;

                if (type === 'radio') {
                    if (el.value === value) {
                        el.checked = true;
                    }
                    el.disabled = true;

                } else if (type === 'select-one') {
                    el.value = value;
                    el.disabled = true;

                } else {
                    // Cas spécial pour "datenaissance"
                    if (
                        name === 'datenaissance' &&
                        simulationData.infoSimulation.isAssure === 'non' &&
                        simulationData.codeProduit === 'CADENCE'
                    ) {
                        el.value = '';           // vide la valeur
                        el.readOnly = false;     // champ modifiable
                    } else {
                        el.value = value;
                        el.readOnly = true;      // champ verrouillé sinon
                    }
                }
            });
        }
    });
});
