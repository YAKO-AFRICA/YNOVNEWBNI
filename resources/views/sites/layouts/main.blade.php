<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        
	<!--favicon-->
	<link rel="icon" href="{{ asset('root/images/logo-icon.png')}}" type="image/png"/>
	<!--plugins-->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<!-- loader-->
    <link href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.css')}}" rel="stylesheet" />
    
    {{-- <!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script> --}}
    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}

	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css')}}" rel="stylesheet">
	{{-- <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet"> --}}
	<link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    


    
	<title>YNOV - Plateforme de souscription en ligne</title>
    <style>
        .page-wrapper-site {
            height: 100%;
            margin-top: 20px;
            margin-bottom: 30px;
        }
        input[readonly],
        textarea[readonly],
        select[readonly] {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            cursor: no-drop;
        }

        input[readonly]:hover,
        textarea[readonly]:hover,
        select[readonly]:hover {
            cursor: no-drop;
        }
        .select2-container--default .select2-selection--single {
                height: 38px !important;
                display: flex;
                align-items: center;
            }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
        }
    </style>

</head>

<body >
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('root/images/logo-icon.png')}}" width="90px" height="90px" alt="Preloader"></div>
            </div>
        </div>
    </div>
        <!--wrapper-->
        <div class="wrapper">

            <div class="page-wrapper-site" >
                <div class="page-content" id="app">
                     <!--content-->
                     @yield('content')
                </div>
            </div>
           
            <!--start overlay-->
            {{-- <div class="overlay toggle-icon"></div> --}}
            <!--end overlay-->
            <!--Start Back To Top Button-->
            {{-- <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a> --}}
            <!--End Back To Top Button-->
            {{-- <footer class="page-footer">
                <p class="mb-0">Copyright © 2024 DSI. Tous droits réservés.</p>
            </footer> --}}
        </div>

        {{-- js custome file --}}
        <script src="{{ asset('assets/root/resume.js')}}"></script>
        <script src="{{ asset('assets/js/custom.js')}}"></script>
        <script src="{{ asset('assets/root/simulateur/simulateur.js')}}"></script>
        {{-- <script src="{{ asset('assets/root/coris/capital.js')}}"></script> --}}
        
        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/js/custom.js')}}"></script> 
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
        <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	    <script src="{{ asset('assets/plugins/select2/js/select2-custom.js')}}"></script>
        <script src="{{ asset('assets/plugins/chartjs/js/chart.js')}}"></script>

        <script src="{{ asset('assets/js/index.js')}}"></script>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/flatpickr')}}"></script>
        <script src="{{ asset('assets/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/bs-stepper/js/main.js')}}"></script>
        
       
        <!--app JS-->
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- <script src="{{ mix('js/app.js') }}"></script> --}}

        <script>
            $(document).ready(function() {
                $('.selection').select2({
                    placeholder: "Choisir",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>



        <script>
            $(document).ready(function() {
    

                var table = $('#example2').DataTable({
                    lengthChange: true,
                    buttons: ['copy', 'excel', 'pdf', 'print'],
                    language: {
                        search: "Recherche :",
                    },
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>

        <script src="{{ asset('assets/js/script.js')}}"></script>
        <script src="{{ asset('assets/js/app.js')}}"></script>
        <script src="{{ asset('assets/js/main.js')}}"></script>

        
        
        <script>
		
            $(".datepicker").flatpickr({
                // altInput: true,
                altFormat: "F j, Y",
                dateFormat: "d-m-Y",
                maxDate: "today",
            });
        
            $(".time-picker").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "Y-m-d H:i",
            });
        
            $(".date-time").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        
            $(".date-format").flatpickr({
                // altInput: true, // Affiche un champ alternatif lisible par l'utilisateur
                altFormat: "j F, Y", // Format alternatif en français (ex: 10 décembre, 2024)
                dateFormat: "d-m-Y", // Format réel de la date envoyée (10-12-2024)
                minDate: "today", // La date minimale est aujourd'hui
                // locale: "fr" // Définit la langue en français
            });
        
            $(".date-range").flatpickr({
                mode: "range",
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
        
            $(".date-inline").flatpickr({
                inline: true,
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
        
        </script>

        <script>
             $(document).ready(function () {
                $('#codeproduit').on('change', function () {
                    const codeProduit = $(this).find(':selected').data('code-value'); // Récupère data-code-value
                    const formuleSelect = $('#codeproduitformule');

                    console.log('codeProduit:', codeProduit);

                    // Réinitialise le menu déroulant des formules
                    formuleSelect.html('<option value="">-- Choisir une option --</option>');

                    if (codeProduit) {
                        // Requête AJAX
                        $.ajax({
                            url: `/formules/${codeProduit}`,
                            type: 'GET',
                            success: function (data) {
                                console.log('Données reçues de l\'API :', data); // Inspectez ce qui est reçu
                                data.forEach(item => {
                                    formuleSelect.append(`<option value="${item.CodeProduitFormule}">${item.MonLibelle}</option>`);
                                });
                            },

                            error: function (xhr, status, error) {
                                console.error('Erreur AJAX :', xhr.responseText);
                                alert('Erreur lors de la récupération des formules.');
                            }
                        });
                    }
                });
            });

        </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("multiStepForm");
            const formSteps = document.querySelectorAll(".form-step");
            const stepperSteps = document.querySelectorAll(".stepper .step");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");
            const submitBtn = document.getElementById("submit");
            let currentStep = 0;

            // Met à jour l'affichage des étapes du formulaire et du stepper
            function updateFormAndStepper() {
                // Mettre à jour les étapes du formulaire
                formSteps.forEach((step, index) => {
                    step.classList.toggle("active", index === currentStep);
                });

                // Mettre à jour le stepper
                stepperSteps.forEach((step, index) => {
                    step.classList.toggle("active", index <= currentStep);
                });

                // Gérer la visibilité des boutons
                prevBtn.style.display = currentStep > 0 ? "inline-block" : "none";
                prevBtn.style.display = currentStep < formSteps.length - 2 ? "inline-block" : "none";
                nextBtn.style.display = currentStep < formSteps.length - 2 ? "inline-block" : "none";
                submitBtn.style.display = currentStep === formSteps.length - 2 ? "inline-block" : "none";
            }

            // Valide les champs de l'étape actuelle
            function validateCurrentStep() {
                const activeStep = formSteps[currentStep];
                const requiredFields = activeStep.querySelectorAll("[required]");
                let isValid = true;

                requiredFields.forEach((field) => {
                    if (!field.value.trim()) {
                        field.classList.add("is-invalid");
                        isValid = false;
                    } else {
                        field.classList.remove("is-invalid");
                    }
                });

                if (!isValid) {
                    alert("Veuillez remplir tous les champs obligatoires avant de continuer.");
                }

                return isValid;
            }

            // Gestion du bouton "Suivant"
            nextBtn.addEventListener("click", function () {
                if (validateCurrentStep()) {
                    currentStep++;
                    updateFormAndStepper();
                }
            });

            // Gestion du bouton "Précédent"
            prevBtn.addEventListener("click", function () {
                currentStep--;
                updateFormAndStepper();
            });


            // Initialiser l'affichage des étapes
            updateFormAndStepper();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.app-container');
            if (container) {
                new PerfectScrollbar(container);
            } else {
                console.warn("L'élément '.app-container' est introuvable !");
            }
        })
    </script>
    </body>

</html>