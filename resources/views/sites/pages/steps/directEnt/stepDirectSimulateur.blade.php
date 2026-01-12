@extends('sites.layouts.main')
@section('content')
    <style>
        /* body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #00695c 0%, #004d40 100%);
            min-height: 100vh;
            color: #333;
        }

        .page-content {
            padding: 30px 0;
        } */

        .main-container {
            border-radius: 20px;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 50px rgba(0,0,0,0.2);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            background: linear-gradient(135deg, #00695c 0%, #00695c 100%);
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

        .simulation-section {
            padding: 30px;
            background: #f8f9fa;
        }

        .results-section {
            padding: 30px;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            min-height: 100vh;
            position: sticky;
            top: 0;
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
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1976d2;
        }

        .section-title.medical::before {
            content: "⚕️";
        }

        .section-title.info::before {
            content: "📋";
        }

        .section-title.result::before {
            content: "💰";
        }

        .form-control, .form-select {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1976d2;
            box-shadow: 0 0 10px rgba(25,118,210,0.2);
        }

        .medical-questions {
            background: #fff8e1;
            border-left: 4px solid #ffc107;
        }

        .question-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .question-item {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .question-item:hover {
            border-color: #1976d2;
            background: #f1f8ff;
        }

        .question-item.checked {
            border-color: #4caf50;
            background: #e8f5e9;
        }

        .question-text {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        .pathology-label {
            font-size: 0.95rem;
            color: #777;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .result-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .prime-display {
            font-size: 3rem;
            font-weight: 700;
            color: #00695c;
            margin: 25px 0;
            text-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .details {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            font-size: 1.05rem;
        }

        .detail-row:last-child {
            border-bottom: none;
            font-weight: 700;
            color: #1976d2;
            font-size: 1.2rem;
        }

        .btn-custom {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: all 0.3s;
            margin: 5px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background: #6c757d;
            color: white;
        }

        .btn-secondary-custom:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .age-info {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .age-info h6 {
            color: #1565c0;
            margin-bottom: 8px;
        }

        .warning-box {
            background: #fff3e0;
            border: 1px solid #ffb74d;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            color: #e65100;
        }

        .info-badge {
            background: #ff9800;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .question-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .prime-display {
                font-size: 2.2rem;
            }
            
            .header h1 {
                font-size: 2.2rem;
            }
        }
    </style>
    <div class="container page-content">
        <div class="container-fluid">
            <div class="main-container">
                <div class="header">
                    <h1 class="text-white">YAKO SOUTIEN FIDELE</h1>
                    <p>Simulateur de prime d'assurance - Protection pour vous et vos proches</p>
                </div>

                <div class="row g-0">
                    <!-- Section Simulation - Col 8 -->
                    <div class="col-lg-8">
                        <div class="simulation-section">
                            <!-- Informations de base -->
                            <div class="form-section">
                                <h3 class="section-title info">Informations de base</h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="typeContrat" class="form-label">Type de contrat</label>
                                        <select id="typeContrat" class="form-select" onchange="updatePrime()">
                                            <option value="">-- Sélectionnez --</option>
                                            <option value="individuel">Tarif individuel</option>
                                            <option value="groupe">Tarif groupe (min. 10 contrats)</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="capital" class="form-label">Capital assuré par personne</label>
                                        <select id="capital" class="form-select" onchange="updatePrime()">
                                            <option value="">-- Sélectionnez --</option>
                                            <option value="500000">500 000 FCFA</option>
                                            <option value="1000000">1 000 000 FCFA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="age-info">
                                    <h6>Conditions d'éligibilité</h6>
                                    <ul class="mb-0">
                                        <li><strong>Souscripteur :</strong> 18 à 50 ans</li>
                                        <li><strong>Ascendant :</strong> jusqu'à 78 ans (père, mère, beaux-parents, famille élargie)</li>
                                    </ul>
                                </div>
                            </div>

                            <input type="hidden" name="productCode" id="productCode" value="{{ $codeProduit }}">

                            <!-- Questionnaire médical -->
                            <div class="form-section medical-questions">
                                <h3 class="section-title medical">Questionnaire médical</h3>
                                <p class="text-muted mb-3">Cochez les pathologies concernant le souscripteur ou l'ascendant à assurer :</p>
                                
                                <div class="warning-box">
                                    <strong>Important :</strong> Chaque pathologie cochée entraîne une surprime de 5 500 FCFA par an.
                                </div>

                                <div class="question-grid">
                                    <div class="question-item" onclick="toggleQuestion(this, 'diabete')">
                                        <input type="checkbox" id="diabete" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Souffrez-vous de diabète ?</div>
                                        <div class="pathology-label">🩸 Diabète (type 1 ou 2)</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'hypertension')">
                                        <input type="checkbox" id="hypertension" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Avez-vous de l'hypertension ?</div>
                                        <div class="pathology-label">❤️ Hypertension artérielle</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'drepanocytose')">
                                        <input type="checkbox" id="drepanocytose" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Êtes-vous atteint de drépanocytose ?</div>
                                        <div class="pathology-label">🔴 Drépanocytose</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'pulmonaire')">
                                        <input type="checkbox" id="pulmonaire" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Avez-vous des problèmes pulmonaires chroniques ?</div>
                                        <div class="pathology-label">🫁 Infection pulmonaire chronique</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'cirrhose')">
                                        <input type="checkbox" id="cirrhose" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Souffrez-vous de cirrhose du foie ?</div>
                                        <div class="pathology-label">🍺 Cirrhose hépatique</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'cardiaque')">
                                        <input type="checkbox" id="cardiaque" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Avez-vous une maladie cardiaque ?</div>
                                        <div class="pathology-label">💓 Pathologie cardiaque</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'cancer')">
                                        <input type="checkbox" id="cancer" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Avez-vous eu ou avez-vous un cancer ?</div>
                                        <div class="pathology-label">🎗️ Cancer (toute forme)</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'renale')">
                                        <input type="checkbox" id="renale" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Souffrez-vous d'insuffisance rénale ?</div>
                                        <div class="pathology-label">🧪 Insuffisance rénale</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'hepatite')">
                                        <input type="checkbox" id="hepatite" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Êtes-vous porteur d'hépatite ?</div>
                                        <div class="pathology-label">🦠 Hépatite (B, C ou autre)</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'neurologique')">
                                        <input type="checkbox" id="neurologique" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Avez-vous une maladie neurologique ?</div>
                                        <div class="pathology-label">🧠 Maladie neurologique dégénérative</div>
                                    </div>

                                    <div class="question-item" onclick="toggleQuestion(this, 'autre')">
                                        <input type="checkbox" id="autre" style="display: none;" onchange="updatePrime()">
                                        <div class="question-text">Avez-vous une autre pathologie grave ?</div>
                                        <div class="pathology-label">🔍 Autre pathologie majeure</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="text-center mt-4">
                                <button class="btn btn-custom btn-primary-custom" onclick="saveSimulation()">
                                    💾 Adherer au produit
                                </button>
                                <button class="btn btn-custom btn-secondary-custom" onclick="resetSimulation()">
                                    🔄 Réinitialiser
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Section Résultats - Col 4 -->
                    <div class="col-lg-4">
                        <div class="results-section">
                            <div class="info-badge">SIMULATION EN TEMPS RÉEL</div>
                            
                            <div class="result-card">
                                <h3 class="section-title result">Résultat de simulation</h3>
                                
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
                                
                                <div class="age-info mt-3">
                                    <h6>💡 Information importante</h6>
                                    <p class="mb-0 small">Cette simulation est indicative. Un examen médical peut être requis pour confirmer votre éligibilité selon les pathologies déclarées.</p>
                                </div>
                            </div>
                            
                            <!-- Informations complémentaires -->
                            <div class="result-card">
                                <h5 class="text-primary mb-3">📊 Avantages du produit</h5>
                                <ul class="list-unstyled text-start">
                                    <li class="mb-2">✅ Couverture souscripteur + 1 ascendant</li>
                                    <li class="mb-2">✅ Tarif dégressif pour les groupes</li>
                                    <li class="mb-2">✅ Prise en charge jusqu'à 78 ans</li>
                                    <li class="mb-2">✅ Capital garanti en cas de décès</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

         document.addEventListener('DOMContentLoaded', function () {
            const user = @json($user);
            console.log('✅ Utilisateur chargé depuis le serveur :', user);

            let data = JSON.parse(sessionStorage.getItem('souscriptionData') || '{}');

            // Met à jour uniquement si l'utilisateur n'est pas encore sauvegardé
            if (!data.utilisateur) {
                data.utilisateur = user;
                sessionStorage.setItem('souscriptionData', JSON.stringify(data));
                console.log('✅ Utilisateur sauvegardé dans la session :', data.utilisateur);
            } else {
                console.log('ℹ️ Utilisateur déjà présent dans la session :', data.utilisateur);
            }
        });

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

        // Gestion de la session
        function getSouscriptionData() {
            const data = sessionStorage.getItem('souscriptionData');
            return data ? JSON.parse(data) : {};
        }

        function saveSouscriptionData(data) {
            sessionStorage.setItem('souscriptionData', JSON.stringify(data));
            console.log('✅ Données mises à jour dans la session :', data);
        }

        function updateSimulationData(fields) {
            const data = getSouscriptionData();
            if (!data.simulationData) data.simulationData = {};
            Object.assign(data.simulationData, fields);
            saveSouscriptionData(data);
        }

        function toggleQuestion(element, checkboxId) {
            const checkbox = document.getElementById(checkboxId);
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
                'diabete', 'hypertension', 'drepanocytose', 'pulmonaire',
                'cirrhose', 'cardiaque', 'cancer', 'renale',
                'hepatite', 'neurologique', 'autre'
            ];
            
            let nbPathologies = 0;
            const selectedPathologies = [];
            pathologies.forEach(pathologie => {
                if (document.getElementById(pathologie).checked) {
                    nbPathologies++;
                    selectedPathologies.push(pathologie);
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
                primeDisplay.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    primeDisplay.style.transform = 'scale(1)';
                }, 200);
                
                // Sauvegarder les données de simulation
                updateSimulationData({
                    typeContrat,
                    type: typeContrat,
                    capital,
                    nbPathologies,
                    primeBase,
                    primepricipale: primeBase,
                    prime : primeTotal,
                    surprimes,
                    primeTotal,
                    productCode: document.getElementById('productCode').value,
                    pathologies: selectedPathologies,
                    timestamp: new Date().toISOString()
                });
                
                
            } else {
                document.getElementById('primeTotal').textContent = '-- FCFA/an';
                document.getElementById('detailsCalcul').style.display = 'none';
            }
        }

        function saveSimulation() {
            const data = getSouscriptionData();
            
            if (!data.simulationData || !data.simulationData.typeContrat) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Simulation incomplète',
                    text: 'Veuillez d\'abord effectuer une simulation complète avant de l\'enregistrer.',
                    confirmButtonText: 'Compris'
                });
                return;
            }

                        
            const codeProduit = data.simulationData.productCode;
            const codePartner = data.utilisateur.codepartenaire;

            if (codeProduit && codePartner) {
                const url = `/site/create/${codeProduit}/${codePartner}`;
                console.log('🔗 Redirection vers :', url);
                window.location.href = url;
            } else {
                console.warn('❌ Code produit ou code partenaire manquant dans la session');
                Swal.fire({
                    icon: 'warning',
                    title: 'Données manquantes',
                    text: 'Impossible de continuer, certaines données de simulation ou utilisateur sont absentes.',
                    confirmButtonText: 'Fermer'
                });

                // toast.fire({
                //     icon: 'warning',
                //     title: 'Données manquantes',
                //     position: 'top-right',
                //     text: 'Impossible de continuer, certaines données de simulation ou utilisateur sont absentes.',
                //     confirmButtonText: 'Fermer'
                // });
            }
            
            // Swal.fire({
            //     icon: 'success',
            //     title: 'Simulation sauvegardée !',
            //     text: 'Vos paramètres de simulation ont été enregistrés avec succès.',
            //     confirmButtonText: 'Parfait',
            //     timer: 2500,
            //     timerProgressBar: true
            // });
            
            console.log('💾 Simulation sauvegardéettttttttttttttttttttttttttttttttttttttttt :', data.simulationData);
        }

        function resetSimulation() {
            Swal.fire({
                title: 'Confirmer la réinitialisation',
                text: 'Êtes-vous sûr de vouloir réinitialiser la simulation ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, réinitialiser',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Réinitialiser le formulaire
                    document.getElementById('typeContrat').value = '';
                    document.getElementById('capital').value = '';
                    
                    // Décocher toutes les pathologies
                    const pathologies = [
                        'diabete', 'hypertension', 'drepanocytose', 'pulmonaire',
                        'cirrhose', 'cardiaque', 'cancer', 'renale',
                        'hepatite', 'neurologique', 'autre'
                    ];
                    
                    pathologies.forEach(pathologie => {
                        const checkbox = document.getElementById(pathologie);
                        checkbox.checked = false;
                        const questionItem = checkbox.closest('.question-item');
                        if (questionItem) questionItem.classList.remove('checked');
                    });
                    
                    // Réinitialiser l'affichage
                    document.getElementById('primeTotal').textContent = '-- FCFA/an';
                    document.getElementById('detailsCalcul').style.display = 'none';
                    
                    // Réinitialiser la session
                    sessionStorage.removeItem('souscriptionData');

                    const user = @json($user);
                    console.log('✅ Utilisateur chargé depuis le serveur :', user);

                    let data = JSON.parse(sessionStorage.getItem('souscriptionData') || '{}');

                    // Met à jour uniquement si l'utilisateur n'est pas encore sauvegardé
                    if (!data.utilisateur) {
                        data.utilisateur = user;
                        sessionStorage.setItem('souscriptionData', JSON.stringify(data));
                        console.log('✅ Utilisateur sauvegardé dans la session :', data.utilisateur);
                    } else {
                        console.log('ℹ️ Utilisateur déjà présent dans la session :', data.utilisateur);
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Simulation réinitialisée',
                        text: 'Tous les champs ont été remis à zéro.',
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            });
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            sessionStorage.removeItem('souscriptionData');
            sessionStorage.removeItem('souscriptionData');
            const user = @json($user);
            console.log('✅ Utilisateur chargé depuis le serveur :', user);

            let data = JSON.parse(sessionStorage.getItem('souscriptionData') || '{}');

            // Met à jour uniquement si l'utilisateur n'est pas encore sauvegardé
            if (!data.utilisateur) {
                data.utilisateur = user;
                sessionStorage.setItem('souscriptionData', JSON.stringify(data));
                console.log('✅ Utilisateur sauvegardé dans la session :', data.utilisateur);
            } else {
                console.log('ℹ️ Utilisateur déjà présent dans la session :', data.utilisateur);
            }
            // Animation d'entrée
            // const sections = document.querySelectorAll('.form-section');
            // sections.forEach((section, index) => {
            //     section.style.opacity = '0';
            //     section.style.transform = 'translateY(20px)';
            //     setTimeout(() => {
            //         section.style.transition = 'all 0.6s ease';
            //         section.style.opacity = '1';
            //         section.style.transform = 'translateY(0)';
            //     }, index * 200);
            // });

            // // Message de bienvenue
            // setTimeout(() => {
            //     Swal.fire({
            //         title: 'Bienvenue !',
            //         text: 'Simulez votre prime YAKO SOUTIEN FIDELE en quelques clics',
            //         icon: 'info',
            //         confirmButtonText: 'Commencer',
            //         timer: 3000,
            //         timerProgressBar: true
            //     });
            // }, 1000);
        });
    </script>
@endsection