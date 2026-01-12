@extends('sites.layouts.main')
@section('content')
    {{-- <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideIn 0.8s ease-out;
            display: flex;
            flex-direction: column;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(-50%, -50%) rotate(0deg); }
            50% { transform: translate(-50%, -50%) rotate(180deg); }
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
        }

        .input-section {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background: #f8f9fa;
        }

        .result-section {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .form-section {
            margin-bottom: 30px;
            padding: 25px;
            background: white;
            border-radius: 15px;
            border-left: 5px solid #4CAF50;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .form-section:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.4rem;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '📋';
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
        }

        select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }

        .pathology-section {
            background: #fff3cd;
            border-left-color: #ffc107;
        }

        .pathology-section .section-title::before {
            content: '⚕️';
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            padding: 12px;
            background: white;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .checkbox-item:hover {
            border-color: #4CAF50;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .checkbox-item input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
            accent-color: #4CAF50;
        }

        .checkbox-item.checked {
            border-color: #4CAF50;
            background: #f8fff8;
        }

        .prime-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2196F3;
            margin: 20px 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .details {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            width: 100%;
            max-width: 400px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 1.1rem;
            color: #2196F3;
        }

        .age-info {
            background: #e8f5e8;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            border-left: 4px solid #4CAF50;
        }

        .age-info h4 {
            color: #2e7d32;
            margin-bottom: 8px;
        }

        .age-info ul {
            margin-left: 20px;
            color: #388e3c;
        }

        .warning {
            background: #fff3e0;
            border: 1px solid #ffb74d;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            color: #e65100;
        }

        .warning::before {
            content: '⚠️ ';
            font-size: 1.2rem;
        }

        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
        }

        .btn-secondary {
            background: #f1f1f1;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .saved-indicator {
            background: #4CAF50;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-top: 15px;
            display: none;
            animation: fadeInOut 3s ease-in-out;
        }

        @keyframes fadeInOut {
            0%, 100% { opacity: 0; }
            10%, 90% { opacity: 1; }
        }

        .pathology-icon {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .result-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .simulation-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #ff9800;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .content-wrapper {
                flex-direction: column;
            }
            
            .input-section, .result-section {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .prime-display {
                font-size: 2rem;
            }
            
            .checkbox-group {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .simulation-badge {
                position: relative;
                top: 0;
                right: 0;
                margin-bottom: 15px;
                display: inline-block;
            }
        }
    </style> --}}

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #00695c 0%, #004d40 100%);
        min-height: 100vh;
        padding: 30px;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 20px;
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        overflow: hidden;
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .header {
        background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
        color: white;
        padding: 40px;
        text-align: center;
        position: relative;
    }

    .header h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .header p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .content-wrapper {
        display: flex;
        flex-wrap: wrap;
    }

    .input-section, .result-section {
        flex: 1;
        min-width: 320px;
        padding: 35px;
    }

    .input-section {
        background: #f9f9f9;
        border-right: 2px solid #eee;
    }

    .result-section {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .form-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }

    .form-section:hover {
        transform: translateY(-3px);
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1976d2;
    }

    .section-title::before {
        content: "💡";
    }

    select {
        width: 100%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 10px;
        font-size: 1rem;
        transition: 0.3s;
    }

    select:focus {
        border-color: #1976d2;
        box-shadow: 0 0 5px rgba(25,118,210,0.3);
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-top: 15px;
    }

    .checkbox-item {
        background: #fff;
        border: 2px solid #ddd;
        border-radius: 12px;
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .checkbox-item:hover {
        border-color: #1976d2;
        background: #f1f8ff;
    }

    .checkbox-item.checked {
        border-color: #388e3c;
        background: #e8f5e9;
    }

    .prime-display {
        font-size: 2.8rem;
        font-weight: 700;
        color: #00695c;
        margin: 25px 0;
        text-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .details {
        width: 100%;
        max-width: 420px;
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-row:last-child {
        border-bottom: none;
        font-weight: 700;
        color: #1976d2;
    }

    .btn {
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-primary {
        background: linear-gradient(135deg, #388e3c 0%, #2e7d32 100%);
        color: white;
    }

    .btn-primary:hover {
        background: #1b5e20;
    }

    .btn-secondary {
        background: #eeeeee;
        color: #333;
    }

    .btn-secondary:hover {
        background: #ddd;
    }

    .action-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .content-wrapper { flex-direction: column; }
        .input-section { border-right: none; border-bottom: 2px solid #eee; }
    }
</style>


    <div class="page-content pb-0 mb-0">
        <div class="container">
            <div class="header">
                <h1>YAKO SOUTIEN FIDELE</h1>
                <p>Simulateur de prime d'assurance</p>
            </div>
        
            <div class="content-wrapper">
                <div class="input-section">
                    <div class="form-section">
                        <h3 class="section-title">Informations de base</h3>
                        
                        <div class="form-group">
                            <label for="typeContrat">Type de contrat :</label>
                            <select id="typeContrat" onchange="updatePrime()">
                                <option value="">-- Sélectionnez --</option>
                                <option value="individuel">Tarif individuel</option>
                                <option value="groupe">Tarif groupe (min. 10 contrats)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="capital">Capital assuré par personne :</label>
                            <select id="capital" onchange="updatePrime()">
                                <option value="">-- Sélectionnez --</option>
                                <option value="500000">500 000 FCFA</option>
                                <option value="1000000">1 000 000 FCFA</option>
                            </select>
                        </div>

                        <div class="age-info">
                            <h4>Conditions d'âge :</h4>
                            <ul>
                                <li>Souscripteur : 18 à 50 ans</li>
                                <li>Ascendant : jusqu'à 78 ans (père, mère, beaux-parents, famille élargie)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-section pathology-section">
                        <h3 class="section-title">Pathologies existantes</h3>
                        <p>Cochez les pathologies concernant le souscripteur ou l'ascendant :</p>
                        <div class="warning">
                            Chaque pathologie cochée ajoute une surprime de 5 500 FCFA à la prime annuelle.
                        </div>
                        
                        <div class="checkbox-group">
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="diabete" onchange="updatePrime()">
                                <label for="diabete"><span class="pathology-icon">🩸</span> Diabète</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="drepanocytose" onchange="updatePrime()">
                                <label for="drepanocytose"><span class="pathology-icon">🔴</span> Drépanocytose</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="cirrhose" onchange="updatePrime()">
                                <label for="cirrhose"><span class="pathology-icon">🍺</span> Cirrhose de foie</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="pulmonaire" onchange="updatePrime()">
                                <label for="pulmonaire"><span class="pathology-icon">🫁</span> Infection pulmonaire chronique</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="cancer" onchange="updatePrime()">
                                <label for="cancer"><span class="pathology-icon">🎗️</span> Cancer</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="hepatite" onchange="updatePrime()">
                                <label for="hepatite"><span class="pathology-icon">🦠</span> Hépatite</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="hypertension" onchange="updatePrime()">
                                <label for="hypertension"><span class="pathology-icon">❤️</span> Hypertension artérielle</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="cardiaque" onchange="updatePrime()">
                                <label for="cardiaque"><span class="pathology-icon">💓</span> Maladie cardiaque</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="renale" onchange="updatePrime()">
                                <label for="renale"><span class="pathology-icon">🧪</span> Insuffisance rénale</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="neurologique" onchange="updatePrime()">
                                <label for="neurologique"><span class="pathology-icon">🧠</span> Maladie neurologique dégénérative</label>
                            </div>
                            
                            <div class="checkbox-item" onclick="toggleCheckbox(this)">
                                <input type="checkbox" id="autre" onchange="updatePrime()">
                                <label for="autre"><span class="pathology-icon">🔍</span> Autre pathologie</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn btn-primary" onclick="saveSimulation()">
                            💾 Enregistrer la simulation
                        </button>
                        <button class="btn btn-secondary" onclick="resetSimulation()">
                            🔄 Réinitialiser
                        </button>
                    </div>
                    
                    <div id="savedIndicator" class="saved-indicator">
                        ✅ Simulation enregistrée dans la session
                    </div>
                </div>
                
                <div class="result-section">
                    <span class="simulation-badge">SIMULATION EN TEMPS RÉEL</span>
                    
                    <div class="result-card">
                        <h3 class="section-title">Résultat de la simulation</h3>
                        
                        <div class="prime-display" id="primeTotal">
                            -- FCFA/an
                        </div>
                        
                        <div class="details" id="detailsCalcul" style="display: none;">
                            <div class="detail-row">
                                <span>Prime de base :</span>
                                <span id="primeBase">0 FCFA</span>
                            </div>
                            <div class="detail-row">
                                <span>Surprimes pathologies :</span>
                                <span id="surprimes">0 FCFA</span>
                            </div>
                            <div class="detail-row">
                                <span>Nombre de pathologies :</span>
                                <span id="nbPathologies">0</span>
                            </div>
                            <div class="detail-row">
                                <span>TOTAL ANNUEL :</span>
                                <span id="totalFinal">0 FCFA</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="age-info" style="margin-top: 20px;">
                        <h4>💡 Information importante</h4>
                        <p>Cette simulation est indicative. Un examen médical peut être requis pour confirmer votre éligibilité.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // Tarifs de base
        const tarifs = {
            individuel: {
                500000: 30000,
                1000000: 58000
            },
            groupe: {
                500000: 26000,
                1000000: 55000
            }
        };

        const surprimePathologie = 5500;

        // Fonction pour récupérer les données de session
        function getSouscriptionData() {
            const data = sessionStorage.getItem('souscriptionData');
            return data ? JSON.parse(data) : {};
        }

        // Fonction pour sauvegarder les données en session
        function saveSouscriptionData(data) {
            sessionStorage.setItem('souscriptionData', JSON.stringify(data));
            console.log('✅ Données mises à jour dans la session :', data);
        }

        // Fonction pour mettre à jour les données de simulation
        function updateSimulationData(fields) {
            const data = getSouscriptionData();
            if (!data.simulationData) data.simulationData = {};
            Object.assign(data.simulationData, fields);
            saveSouscriptionData(data);
        }

        function toggleCheckbox(element) {
            const checkbox = element.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                element.classList.add('checked');
            } else {
                element.classList.remove('checked');
            }
            
            updatePrime();
        }

        function updatePrime() {
            const typeContrat = document.getElementById('typeContrat').value;
            const capital = document.getElementById('capital').value;
            
            // Récupérer toutes les pathologies cochées
            const pathologies = [
                'diabete', 'drepanocytose', 'cirrhose', 'pulmonaire',
                'cancer', 'hepatite', 'hypertension', 'cardiaque',
                'renale', 'neurologique', 'autre'
            ];
            
            let nbPathologies = 0;
            pathologies.forEach(pathologie => {
                if (document.getElementById(pathologie).checked) {
                    nbPathologies++;
                }
            });

            if (typeContrat && capital) {
                const primeBase = tarifs[typeContrat][capital];
                const surprimes = nbPathologies * surprimePathologie;
                const primeTotal = primeBase + surprimes;

                // Affichage des résultats
                document.getElementById('primeTotal').textContent = 
                    new Intl.NumberFormat('fr-FR').format(primeTotal) + ' FCFA/an';
                
                document.getElementById('primeBase').textContent = 
                    new Intl.NumberFormat('fr-FR').format(primeBase) + ' FCFA';
                
                document.getElementById('surprimes').textContent = 
                    new Intl.NumberFormat('fr-FR').format(surprimes) + ' FCFA';
                
                document.getElementById('nbPathologies').textContent = nbPathologies;
                
                document.getElementById('totalFinal').textContent = 
                    new Intl.NumberFormat('fr-FR').format(primeTotal) + ' FCFA';

                document.getElementById('detailsCalcul').style.display = 'block';

                // Animation de mise à jour
                const primeDisplay = document.getElementById('primeTotal');
                primeDisplay.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    primeDisplay.style.transform = 'scale(1)';
                }, 200);
                
                // Sauvegarder les données de simulation
                updateSimulationData({
                    typeContrat,
                    capital,
                    nbPathologies,
                    primeBase,
                    surprimes,
                    primeTotal,
                    pathologies: getSelectedPathologies()
                });
                
            } else {
                document.getElementById('primeTotal').textContent = '-- FCFA/an';
                document.getElementById('detailsCalcul').style.display = 'none';
            }
        }

        function getSelectedPathologies() {
            const pathologies = [
                'diabete', 'drepanocytose', 'cirrhose', 'pulmonaire',
                'cancer', 'hepatite', 'hypertension', 'cardiaque',
                'renale', 'neurologique', 'autre'
            ];
            
            const selected = [];
            pathologies.forEach(pathologie => {
                if (document.getElementById(pathologie).checked) {
                    selected.push(pathologie);
                }
            });
            
            return selected;
        }

        function saveSimulation() {
            const data = getSouscriptionData();
            
            if (!data.simulationData || !data.simulationData.typeContrat) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Simulation incomplète',
                    text: 'Veuillez d\'abord effectuer une simulation avant de l\'enregistrer.',
                    confirmButtonText: 'Fermer'
                });
                return;
            }
            
            // Afficher l'indicateur de sauvegarde
            const indicator = document.getElementById('savedIndicator');
            indicator.style.display = 'block';
            
            setTimeout(() => {
                indicator.style.display = 'none';
            }, 3000);
            
            Swal.fire({
                icon: 'success',
                title: 'Simulation enregistrée',
                text: 'Vos paramètres de simulation ont été sauvegardés.',
                confirmButtonText: 'Continuer'
            });
        }

        function resetSimulation() {
            // Réinitialiser le formulaire
            document.getElementById('typeContrat').value = '';
            document.getElementById('capital').value = '';
            
            // Décocher toutes les pathologies
            const pathologies = [
                'diabete', 'drepanocytose', 'cirrhose', 'pulmonaire',
                'cancer', 'hepatite', 'hypertension', 'cardiaque',
                'renale', 'neurologique', 'autre'
            ];
            
            pathologies.forEach(pathologie => {
                const checkbox = document.getElementById(pathologie);
                checkbox.checked = false;
                const item = checkbox.closest('.checkbox-item');
                if (item) item.classList.remove('checked');
            });
            
            // Réinitialiser l'affichage des résultats
            document.getElementById('primeTotal').textContent = '-- FCFA/an';
            document.getElementById('detailsCalcul').style.display = 'none';
            
            // Réinitialiser les données de session
            const userData = getSouscriptionData().utilisateur || null;
            const newSessionData = userData ? { utilisateur: userData } : {};
            saveSouscriptionData(newSessionData);
            
            Swal.fire({
                icon: 'success',
                title: 'Simulation réinitialisée',
                text: 'Tous les champs ont été remis à zéro.',
                confirmButtonText: 'Fermer'
            });
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            // Animation d'entrée pour les éléments
            const sections = document.querySelectorAll('.form-section');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    section.style.transition = 'all 0.6s ease';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });
            
            // Charger les données de session si elles existent
            const data = getSouscriptionData();
            if (data.simulationData) {
                // Préremplir le formulaire avec les données de session
                if (data.simulationData.typeContrat) {
                    document.getElementById('typeContrat').value = data.simulationData.typeContrat;
                }
                if (data.simulationData.capital) {
                    document.getElementById('capital').value = data.simulationData.capital;
                }
                
                // Cocher les pathologies précédemment sélectionnées
                if (data.simulationData.pathologies) {
                    data.simulationData.pathologies.forEach(pathologie => {
                        const checkbox = document.getElementById(pathologie);
                        if (checkbox) {
                            checkbox.checked = true;
                            const item = checkbox.closest('.checkbox-item');
                            if (item) item.classList.add('checked');
                        }
                    });
                }
                
                // Mettre à jour l'affichage
                updatePrime();
            }
        });
    </script>
@endsection