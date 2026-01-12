@extends('sites.layouts.main')
@section('content')

        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            :root {
                --primary-color: #076633;
                --primary-light: #0a7a3a;
                --success-color: #28a745;
                --gradient-start: #076633;
                --gradient-end: #0a7a3a;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                min-height: 100vh;
            }

            .bg-gradient-primary {
                background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%) !important;
                position: relative;
                overflow: hidden;
            }

            .bg-gradient-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grain)"/></svg>') repeat;
                opacity: 0.1;
            }

            .animate-fade-in {
                animation: fadeInUp 1s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .container.card {
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
                border: none;
                border-radius: 20px;
                margin-top: -50px;
                position: relative;
                z-index: 2;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }

            .card-body {
                padding: 3rem;
            }

            .nav-pills .nav-link.active {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%) !important;
                color: #fff !important;
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(7, 102, 51, 0.3);
                transform: translateY(-2px);
                transition: all 0.3s ease;
            }

            .nav-pills .nav-link {
                color: var(--primary-color) !important;
                border-radius: 15px;
                padding: 1rem 1.5rem;
                margin-bottom: 1rem;
                border: 2px solid transparent;
                transition: all 0.3s ease;
                font-weight: 600;
                text-align: center;
            }

            .nav-pills .nav-link:hover {
                background-color: rgba(7, 102, 51, 0.1) !important;
                border-color: var(--primary-color);
                transform: translateY(-1px);
            }

            .form-control {
                border-radius: 12px;
                border: 2px solid #e9ecef;
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.25rem rgba(7, 102, 51, 0.1);
                background: #fff;
            }

            .form-label {
                font-weight: 600;
                color: #495057;
                margin-bottom: 0.75rem;
            }

            .form-check {
                margin-bottom: 1rem;
            }

            .form-check-input {
                width: 1.25em;
                height: 1.25em;
                margin-top: 0.125em;
                border: 2px solid #dee2e6;
                transition: all 0.3s ease;
            }

            .form-check-input:checked {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            .form-check-input:focus {
                box-shadow: 0 0 0 0.25rem rgba(7, 102, 51, 0.15);
            }

            .form-check-label {
                font-weight: 500;
                color: #495057;
                cursor: pointer;
                padding-left: 0.5rem;
            }

            .btn-calculate {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
                border: none;
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1rem;
                transition: all 0.3s ease;
                box-shadow: 0 8px 25px rgba(7, 102, 51, 0.3);
            }

            .btn-calculate:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 35px rgba(7, 102, 51, 0.4);
                color: white;
            }

            .btn-reset {
                background: #6c757d;
                border: none;
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1rem;
                transition: all 0.3s ease;
            }

            .btn-reset:hover {
                background: #5a6268;
                transform: translateY(-2px);
                color: white;
            }

            .result-box {
                background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
                border-radius: 20px;
                padding: 2rem;
                border: 2px solid #e9ecef;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                height: fit-content;
                position: sticky;
                top: 2rem;
            }

            .result-box h4 {
                color: var(--primary-color);
                font-weight: 700;
                margin-bottom: 1.5rem;
                position: relative;
            }

            .result-box h4::after {
                content: '';
                position: absolute;
                bottom: -0.5rem;
                left: 50%;
                transform: translateX(-50%);
                width: 50px;
                height: 3px;
                background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
                border-radius: 2px;
            }

            #simulationResult p {
                background: rgba(7, 102, 51, 0.05);
                padding: 0.75rem;
                border-radius: 8px;
                margin-bottom: 0.75rem;
                border-left: 4px solid var(--primary-color);
            }

            #simulationResult strong {
                color: var(--primary-color);
            }

            .text-success {
                background: linear-gradient(135deg, #28a745, #20c997);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .simulation-container {
                margin-top: 2rem;
            }

            .bbe {
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 2px solid #e9ecef;
            }

            .d-none {
                display: none !important;
            }

            /* Animation pour les résultats */
            #simulationResult {
                animation: slideInRight 0.5s ease-out;
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .card-body {
                    padding: 1.5rem;
                }
                
                .container.card {
                    margin-top: -30px;
                }
                
                .result-box {
                    margin-top: 2rem;
                    position: static;
                }
                
                .nav {
                    margin-bottom: 2rem;
                }
                
                .nav-pills .nav-link {
                    margin-bottom: 0.5rem;
                }
            }

            /* Amélioration de l'accessibilité */
            .form-control:focus,
            .form-check-input:focus,
            .btn:focus {
                outline: none;
            }

            /* Style pour les alertes de validation */
            .is-invalid {
                border-color: #dc3545 !important;
                box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1) !important;
            }

            .invalid-feedback {
                display: block;
                width: 100%;
                margin-top: 0.25rem;
                font-size: 0.875rem;
                color: #dc3545;
            }
        </style>
        <div class="page-content pb-0 mb-0">
            <!-- Bannière améliorée avec fond dégradé -->
            <section class="banner mt-0 pt-4 pb-5 bg-gradient-primary text-white">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h1 class="display-5 fw-bold mb-3 animate-fade-in">
                                <i class="fas fa-calculator me-2"></i>
                                Simulateur de Prime d'Assurance
                            </h1>
                            <p class="lead mb-4">Obtenez une estimation personnalisée en quelques clics avec notre simulateur intelligent</p>
                            <div class="d-flex justify-content-center gap-3">
                                <h3 class="fw-bold text-success mb-0">
                                    YAKO OBSÈQUES DIASPORA
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Conteneur principal avec ombre portée -->
            <div class="container card">
                <div class="card-body">
                    <div class="row simulation-container">
                        <div class="nav col-md-2 nav-pills" aria-orientation="vertical">
                            <button class="nav-link w-100 fs-5 active">
                                YAKO OBSEQUE DIASPORA
                            </button>
                        </div>
                        
                        <div class="col-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="simulationForm">
                                        <div class="row">
                                            <div class="mb-3 col-12">
                                                <label for="birthDate-LFFUN" class="form-label">
                                                    <i class="fas fa-birthday-cake me-2"></i>Date de naissance
                                                </label>
                                                <input type="date" class="form-control" id="birthDate-LFFUN" required>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="productCode-LFFUN" id="productCode-LFFUN" value="LFFUN">
                                        
                                        <div class="row">
                                            <div class="mb-3 col-12">
                                                <label class="form-label">
                                                    <i class="fas fa-user-friends me-2"></i>Type de souscription
                                                </label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="subscriptionType-LFFUN" id="individuel-LFFUN" value="individuel" checked>
                                                    <label class="form-check-label" for="individuel-LFFUN">
                                                        <i class="fas fa-user me-2"></i>Individuel
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="mb-3 col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="subscriptionType-LFFUN" id="famille-LFFUN" value="famille">
                                                    <label class="form-check-label" for="famille-LFFUN">
                                                        <i class="fas fa-users me-2"></i>Famille
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="mb-4 col-12">
                                                <label class="form-label">
                                                    <i class="fas fa-map-marker-alt me-2"></i>Zone de souscription
                                                </label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="subscriptionZone-LFFUN" id="france-LFFUN" value="france" checked>
                                                    <label class="form-check-label" for="france-LFFUN">
                                                        <i class="fas fa-globe-europe me-2"></i>DIASPORA
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <button type="button" class="btn btn-calculate w-100" onclick="calculatePrime('LFFUN')">
                                                    <i class="fas fa-calculator me-2"></i>Calculer la prime
                                                </button>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <button type="button" class="btn btn-reset w-100" onclick="resetSimulation('LFFUN')">
                                                    <i class="fas fa-undo me-2"></i>Réinitialiser
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 p-0">
                            <div class="result-box">
                                <h4 class="text-center mb-3">
                                    <i class="fas fa-chart-line me-2"></i>Résultat de la simulation
                                </h4>
                                <div id="resultContent" class="text-center">
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle fs-3 mb-3 d-block"></i>
                                        <p>Veuillez remplir le formulaire et cliquer sur "Calculer la prime"</p>
                                    </div>
                                </div>
                                <div id="simulationResult" style="display: none;">
                                    <p><strong><i class="fas fa-birthday-cake me-2"></i>Âge:</strong> <span id="ageResult"></span> ans</p>
                                    <p><strong><i class="fas fa-tag me-2"></i>Type:</strong> <span id="typeResult"></span></p>
                                    <p><strong><i class="fas fa-map-marker-alt me-2"></i>Zone:</strong> <span id="zoneResult"></span></p>
                                    <hr>
                                    <p><strong><i class="fas fa-shield-alt me-2"></i>Capital assuré:</strong> <span id="capitalResult"></span> €</p>
                                    <p><strong><i class="fas fa-euro-sign me-2"></i>Prime annuelle:</strong> <span id="primeResult"></span> €</p>
                                </div>

                                <div class="bbe">
                                    <form id="simulationForm">
                                        <input type="hidden" name="productCode" id="productCode">
                                        <input type="hidden" name="primeSimulateur" id="primeSimulateur">
                                        <input type="hidden" name="capitalSimulateur" id="capitalSimulateur">
                                        <input type="hidden" name="birthDateSimulateur" id="birthDateSimulateur">
                                        <input type="hidden" name="typeSimulateur" id="typeSimulateur">
                                        <button type="button" class="btn btn-calculate w-100 d-none" id="subscribeButton">
                                            <i class="fas fa-pen-fancy me-2"></i>Souscrire
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #076633;
        --primary-light: #0a7a3a;
        --success-color: #28a745;
        --gradient-start: #076633;
        --gradient-end: #0a7a3a;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%) !important;
        position: relative;
        overflow: hidden;
    }

    .bg-gradient-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grain)"/></svg>') repeat;
        opacity: 0.1;
    }

    .animate-fade-in {
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .container.card {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 20px;
        margin-top: -50px;
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .card-body {
        padding: 3rem;
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%) !important;
        color: #fff !important;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(7, 102, 51, 0.3);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link {
        color: var(--primary-color) !important;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        font-weight: 600;
        text-align: center;
    }

    .nav-pills .nav-link:hover {
        background-color: rgba(7, 102, 51, 0.1) !important;
        border-color: var(--primary-color);
        transform: translateY(-1px);
    }

    .form-control {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(7, 102, 51, 0.1);
        background: #fff;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.75rem;
    }

    .form-check {
        margin-bottom: 1rem;
    }

    .form-check-input {
        width: 1.25em;
        height: 1.25em;
        margin-top: 0.125em;
        border: 2px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(7, 102, 51, 0.15);
    }

    .form-check-label {
        font-weight: 500;
        color: #495057;
        cursor: pointer;
        padding-left: 0.5rem;
    }

    .btn-calculate {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border: none;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(7, 102, 51, 0.3);
    }

    .btn-calculate:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(7, 102, 51, 0.4);
        color: white;
    }

    .btn-reset {
        background: #6c757d;
        border: none;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-reset:hover {
        background: #5a6268;
        transform: translateY(-2px);
        color: white;
    }

    .result-box {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border-radius: 20px;
        padding: 2rem;
        border: 2px solid #e9ecef;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        height: fit-content;
        position: sticky;
        top: 2rem;
    }

    .result-box h4 {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .result-box h4::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        border-radius: 2px;
    }

    #simulationResult p {
        background: rgba(7, 102, 51, 0.05);
        padding: 0.75rem;
        border-radius: 8px;
        margin-bottom: 0.75rem;
        border-left: 4px solid var(--primary-color);
    }

    #simulationResult strong {
        color: var(--primary-color);
    }

    .text-success {
        background: linear-gradient(135deg, #28a745, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .simulation-container {
        margin-top: 2rem;
    }

    .bbe {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e9ecef;
    }

    .d-none {
        display: none !important;
    }

    /* Animation pour les résultats */
    #simulationResult {
        animation: slideInRight 0.5s ease-out;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .simulation-container {
            flex-direction: column;
        }
        
        .nav-pills {
            flex-direction: row !important;
            margin-bottom: 2rem;
            justify-content: center;
        }
        
        .nav-pills .nav-link {
            margin: 0 0.5rem;
            padding: 0.75rem 1rem;
        }
        
        .result-box {
            margin-top: 2rem;
            position: static;
        }
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .container.card {
            margin-top: -30px;
        }
        
        .result-box {
            padding: 1.5rem;
        }
        
        .btn-calculate, .btn-reset {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
        
        h1.display-5 {
            font-size: 2rem;
        }
        
        .lead {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }
        
        .nav-pills .nav-link {
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
        }
        
        .form-label, .form-check-label {
            font-size: 0.9rem;
        }
        
        .result-box h4 {
            font-size: 1.25rem;
        }
        
        #simulationResult p {
            font-size: 0.9rem;
        }
        
        .btn-calculate, .btn-reset {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }

    /* Amélioration de l'accessibilité */
    .form-control:focus,
    .form-check-input:focus,
    .btn:focus {
        outline: none;
    }

    /* Style pour les alertes de validation */
    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1) !important;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc3545;
    }
</style>
<div class="page-content pb-0 mb-0">
    <!-- Bannière améliorée avec fond dégradé -->
    <section class="banner mt-0 pt-4 pb-5 bg-gradient-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-5 fw-bold mb-3 animate-fade-in text-light">
                        <i class="fas fa-calculator me-2"></i>
                        Simulateur de Prime d'Assurance
                    </h1>
                    <p class="lead mb-4">Obtenez une estimation personnalisée en quelques clics avec notre simulateur intelligent</p>
                    {{-- <div class="d-flex justify-content-center gap-3">
                        <h3 class="fw-bold text-success mb-0">
                            YAKO OBSÈQUES DIASPORA
                        </h3>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Conteneur principal avec ombre portée -->
    <div class="container card">
        <div class="card-body">
            <div class="row simulation-container">
                <div class="nav col-md-2 nav-pills flex-column" aria-orientation="vertical">
                    <button class="nav-link w-100 fs-5 active">
                        YAKO OBSEQUE DIASPORA
                    </button>
                </div>
                
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="simulationForm">
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="birthDate-LFFUN" class="form-label">
                                            <i class="fas fa-birthday-cake me-2"></i>Date de naissance de l'assuré principal
                                        </label>
                                        <input type="date" class="form-control" id="birthDate-LFFUN" required>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="productCode-LFFUN" id="productCode-LFFUN" value="LFFUN">
                                
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label class="form-label">
                                            <i class="fas fa-user-friends me-2"></i>Type de souscription
                                        </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subscriptionType-LFFUN" id="individuel-LFFUN" value="individuel" checked>
                                            <label class="form-check-label" for="individuel-LFFUN">
                                                <i class="fas fa-user me-2"></i>Individuel
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subscriptionType-LFFUN" id="famille-LFFUN" value="famille">
                                            <label class="form-check-label" for="famille-LFFUN">
                                                <i class="fas fa-users me-2"></i>Famille
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="mb-4 col-12">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Zone de souscription
                                        </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subscriptionZone-LFFUN" id="france-LFFUN" value="france" checked>
                                            <label class="form-check-label" for="france-LFFUN">
                                                <i class="fas fa-globe-europe me-2"></i>DIASPORA
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <button type="button" class="btn btn-calculate w-100" onclick="calculatePrime('LFFUN')">
                                            <i class="fas fa-calculator me-2"></i>Calculer la prime
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <button type="button" class="btn btn-reset w-100" onclick="resetSimulation('LFFUN')">
                                            <i class="fas fa-undo me-2"></i>Réinitialiser
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="result-box">
                        <h4 class="text-center mb-3">
                            <i class="fas fa-chart-line me-2"></i>Résultat de la simulation
                        </h4>
                        <div id="resultContent" class="text-center">
                            <div class="text-muted">
                                <i class="fas fa-info-circle fs-3 mb-3 d-block"></i>
                                <p>Veuillez remplir le formulaire et cliquer sur "Calculer la prime"</p>
                            </div>
                        </div>
                        <div id="simulationResult" style="display: none;">
                            <p><strong><i class="fas fa-birthday-cake me-2"></i>Âge:</strong> <span id="ageResult"></span> ans</p>
                            <p><strong><i class="fas fa-tag me-2"></i>Type:</strong> <span id="typeResult"></span></p>
                            <p class="d-none"><strong><i class="fas fa-map-marker-alt me-2 "></i>Zone:</strong> <span id="zoneResult"></span></p>
                            <hr>
                            <p><strong><i class="fas fa-shield-alt me-2"></i>Capital assuré:</strong> <span id="capitalResult"></span> €</p>
                            <p><strong><i class="fas fa-euro-sign me-2"></i>Prime annuelle:</strong> <span id="primeResult"></span> €</p>
                        </div>

                        <div class="bbe">
                            <form id="simulationForm">
                                <input type="hidden" name="productCode" id="productCode">
                                <input type="hidden" name="primeSimulateur" id="primeSimulateur">
                                <input type="hidden" name="capitalSimulateur" id="capitalSimulateur">
                                <input type="hidden" name="birthDateSimulateur" id="birthDateSimulateur">
                                <input type="hidden" name="typeSimulateur" id="typeSimulateur">
                                <button type="button" class="btn btn-calculate w-100 d-none" id="subscribeButton">
                                    <i class="fas fa-pen-fancy me-2"></i>Souscrire
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>



        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const user = @json($user);

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
            function calculatePrime(codeProduit) {
                // Récupérer les valeurs du formulaire spécifique au produit
                const birthDateInput = document.getElementById('birthDate-' + codeProduit);
                const birthDate = new Date(birthDateInput.value);

                const subscriptionType = document.querySelector(`input[name="subscriptionType-${codeProduit}"]:checked`).value;
                const subscriptionZone = document.querySelector(`input[name="subscriptionZone-${codeProduit}"]:checked`).value;

                // Vérifier la date
                if (isNaN(birthDate.getTime())) {
                    swal.fire({
                        icon: 'warning',
                        title: 'Désolé',
                        text: 'Veuillez entrer une date de naissance valide',
                        confirmButtonText: 'Fermer'
                    });
                    return;
                }

                // Calcul de l'âge
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                // Limite d'âge
                if (age > 80) {
                    swal.fire({
                        icon: 'warning',
                        title: 'Désolé',
                        text: 'Ce simulateur est valable pour les personnes de 80 ans maximum',
                        confirmButtonText: 'Fermer'
                    });
                    return;
                }

                // Calcul capital & prime
                let capital, prime;
                if (age < 66) {
                    if (subscriptionType === 'individuel') {
                        if (subscriptionZone === 'france') {
                            capital = 7500;
                            prime = 198;
                        } else {
                            capital = 4500;
                            prime = 119;
                        }
                    } else { // famille
                        if (subscriptionZone === 'france') {
                            capital = 30000;
                            prime = 390;
                        } else {
                            capital = 18000;
                            prime = 233;
                        }
                    }
                } else { // 66-75 ans
                    if (subscriptionType === 'individuel') {
                        if (subscriptionZone === 'france') {
                            capital = 7500;
                            prime = 297;
                        } else {
                            capital = 4500;
                            prime = 178;
                        }
                    } else {
                        if (subscriptionZone === 'france') {
                            capital = 30000;
                            prime = 585;
                        } else {
                            capital = 18000;
                            prime = 349;
                        }
                    }
                }

                // Mise à jour des résultats
                document.getElementById('ageResult').textContent = age;
                document.getElementById('typeResult').textContent = (subscriptionType === 'individuel') ? 'Individuel' :
                    'Famille';
                document.getElementById('zoneResult').textContent = (subscriptionZone === 'france') ? 'France' : 'Zone CIMA';
                document.getElementById('capitalResult').textContent = capital.toLocaleString('fr-FR');
                document.getElementById('primeResult').textContent = prime.toLocaleString('fr-FR');

                document.getElementById('productCode').value = codeProduit;
                document.getElementById('primeSimulateur').value = prime;
                document.getElementById('capitalSimulateur').value = capital;
                document.getElementById('birthDateSimulateur').value = birthDateInput.value.replace(/\//g, '-');
                document.getElementById('typeSimulateur').value = subscriptionType;

                // Affichage des résultats
                document.getElementById('resultContent').style.display = 'none';
                document.getElementById('simulationResult').style.display = 'block';
                document.getElementById('subscribeButton').classList.remove('d-none');
                document.getElementById('subscribeButton').style.display = 'block';
            }

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

            function attachSimulationListeners() {
                const codeProduit = document.getElementById('productCode-{{ $product->CodeProduit }}').value;

                document.getElementById('birthDate-' + codeProduit)?.addEventListener('change', (e) => {
                    updateSimulationData({ birthDate: e.target.value });
                });

                document.querySelectorAll(`input[name="subscriptionType-${codeProduit}"]`).forEach(input => {
                    input.addEventListener('change', (e) => {
                        updateSimulationData({ subscriptionType: e.target.value });
                    });
                });

                document.querySelectorAll(`input[name="subscriptionZone-${codeProduit}"]`).forEach(input => {
                    input.addEventListener('change', (e) => {
                        updateSimulationData({ subscriptionZone: e.target.value });
                    });
                });
            }

            function saveSimulationResult(birthDate,age, type, zone, capital, prime) {
                updateSimulationData({
                    birthDate: birthDate.replace(/\//g, '-'),
                    age,
                    type,
                    zone,
                    capital,
                    prime,
                    productCode: document.getElementById('productCode-{{ $product->CodeProduit }}').value
                });
            }

            function resetSimulation(codeProduit) {
                const form = document.getElementById('simulationForm');
                form.reset();

                document.getElementById('resultContent').style.display = 'block';
                document.getElementById('simulationResult').style.display = 'none';
                document.getElementById('subscribeButton').style.display = 'none';

                const user = @json($user);
                
                sessionStorage.removeItem('souscriptionData');
                 console.log('🔁 Session réinitialisée, avant suppression :', sessionStorage.getItem('souscriptionData'));
                
                // Recréer l'objet de session avec l'utilisateur
                const newSessionData = {
                    utilisateur: user,
                };
                

                sessionStorage.setItem('souscriptionData', JSON.stringify(newSessionData));
                
                console.log('🔁 Session réinitialisée, utilisateur conservé :', newSessionData);
            }

            const originalCalculatePrime = calculatePrime;
            calculatePrime = function (codeProduit) {
                originalCalculatePrime(codeProduit);

                const age = document.getElementById('ageResult').textContent;
                const type = document.getElementById('typeResult').textContent;
                const zone = document.getElementById('zoneResult').textContent;
                const capital = document.getElementById('capitalResult').textContent;
                const prime = document.getElementById('primeResult').textContent;
                const birthDate = document.getElementById('birthDateSimulateur').value;

                saveSimulationResult(birthDate,age, type, zone, capital, prime);

                console.log('📊 Résultats de simulation sauvegardés :', {birthDate, age, type, zone, capital, prime });
            };

            document.addEventListener('DOMContentLoaded', () => {
                attachSimulationListeners();

                const data = getSouscriptionData();
                console.log('📦 Session actuelle à l\'initialisation :', data);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                sessionStorage.removeItem('souscriptionData');

                const user = @json($user);

                // Recréer l'objet de session avec l'utilisateur
                const newSessionData = {
                    utilisateur: user,
                };
                sessionStorage.setItem('souscriptionData', JSON.stringify(newSessionData));

                const subscribeBtn = document.getElementById('subscribeButton');

                if (subscribeBtn) {
                    subscribeBtn.addEventListener('click', () => {

                        const souscriptionData = getSouscriptionData();
                        
                        const codeProduit = souscriptionData.simulationData.productCode;
                        const codePartner = souscriptionData.utilisateur.codepartenaire;

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
                        }
                    });
                } else {
                    console.error('❌ Bouton "Souscrire" introuvable dans le DOM');
                }
            });
        </script>

        <script>
            // Animation pour les éléments
            document.addEventListener('DOMContentLoaded', function() {
                const elements = document.querySelectorAll('.animate-fade-in');
                
                elements.forEach((el, index) => {
                    setTimeout(() => {
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, index * 200);
                });
                
                // Effet parallaxe au scroll
                window.addEventListener('scroll', function() {
                    const scrollPosition = window.pageYOffset;
                    const banner = document.querySelector('.banner');
                    banner.style.backgroundPositionY = `${scrollPosition * 0.5}px`;
                });
            });
        </script>

@endsection

