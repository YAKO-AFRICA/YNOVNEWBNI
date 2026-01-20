<!doctype html>
<html lang="fr">

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/pfjd5f3rf5sx7e99t8p7wi1x9yz3phproft7hk92nakivoru/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: 'textarea.tinymce-editor',
                height: 400,
                language: 'fr_FR', // Interface en français
                plugins: [
                    'advlist autolink lists link image charmap preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table emoticons wordcount help',
                    'export pagebreak codesample'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic underline strikethrough forecolor backcolor | ' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image media emoticons | ' +
                    'table codesample export | removeformat | fullscreen preview help',

                menubar: 'file edit view insert format tools table help',

                // Style par défaut du contenu
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px; line-height:1.6 }',

                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image media',

                // Gestion des uploads (images & vidéos)
                file_picker_callback: function(callback, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');

                    if (meta.filetype === 'image') {
                        input.setAttribute('accept', 'image/*');
                    } else if (meta.filetype === 'media') {
                        input.setAttribute('accept', 'video/*');
                    }

                    input.onchange = function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function() {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            callback(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                },

                // Options supplémentaires
                table_default_attributes: {
                    border: '1'
                },
                table_default_styles: {
                    'border-collapse': 'collapse',
                    'width': '100%'
                },
                codesample_languages: [{
                        text: 'HTML/XML',
                        value: 'markup'
                    },
                    {
                        text: 'JavaScript',
                        value: 'javascript'
                    },
                    {
                        text: 'CSS',
                        value: 'css'
                    },
                    {
                        text: 'PHP',
                        value: 'php'
                    },
                    {
                        text: 'Python',
                        value: 'python'
                    },
                    {
                        text: 'Java',
                        value: 'java'
                    },
                    {
                        text: 'C#',
                        value: 'csharp'
                    }
                ]
            });
        </script>


    <style>
        :root {
            --primary-color: #076633;
            --secondary-color: #0766339a;
            --success-color: #f7a400;
            --warning-color: #f7a400;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
        }
        .badge {
        display: inline-block;
        padding: 0.2rem 0.5rem;
        color: #fff;
        border-radius: 0.25rem;
        font-size: 12px;
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

    <style>
        /* Style des notifications */
        .unread-notification {
            background-color: rgba(13, 110, 253, 0.05);
            border-left: 3px solid #ff0000;
        }
        
        .read-notification {
            opacity: 0.7;
        }
        
        .notification-item:hover {
            background-color: #f8f9fa !important;
        }
        
        .notification-list::-webkit-scrollbar {
            width: 6px;
        }
        
        .notification-list::-webkit-scrollbar-thumb {
            background-color: #dee2e6;
            border-radius: 3px;
        }
        
        .alert-count {
            font-size: 0.65rem;
            padding: 0.25em 0.4em;
            min-width: 1.5em;
        }

        /* Style global pour tous les champs readonly */
        input[readonly],
        textarea[readonly],
        select[readonly] {
            background-color: #9a9ea14b !important; /* gris foncé */
            color: #000 !important;            /* texte blanc */
            cursor: not-allowed;                  /* curseur interdit */
            pointer-events: none;                 /* désactive toute interaction souris */
            opacity: 0.8;                         /* effet légèrement grisé */
        }

        /* Optionnel : pour que le texte ne soit pas sélectionnable */
        input[readonly]::selection,
        textarea[readonly]::selection {
            background: transparent;
        }

        input[readonly]:hover,
        textarea[readonly]:hover,
        select[readonly]:hover {
            cursor: no-drop;
        }

    </style>

    
	<title>YNOV - Plateforme de souscription en ligne</title>
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
            
        @php
            $unreadNotifications = auth()->user()->unreadNotifications;
            $allNotifications = auth()->user()->notifications;

        @endphp

            <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100"></div>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-url="">
                    <div class="toast-header">
                        <strong class="me-auto" id="toast-title">Notification</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body" id="toast-body"></div>
                </div>
            </div>

            
            @include('layouts.sidebar')

            <div class="page-wrapper">
                <div class="page-content" id="app">
                    @yield('content')
                </div>

            </div>
           
            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <!--end overlay-->
            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
            <!--End Back To Top Button-->
            <footer class="page-footer">
                <p class="mb-0">Copyright © 2024 DSI. Tous droits réservés.</p>
            </footer>
        </div>

        

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

        {{-- js custome file --}}
         <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('root/resume.js')}}"></script>
        <script src="{{ asset('assets/root/simulateur/primes.js')}}"></script>
        <script src="{{ asset('assets/root/simulateur/doihooSimulateur.js')}}"></script>
        <script src="{{ asset('assets/root/simulateur/simulateurKDS.js')}}"></script>
        <script src="{{ asset('assets/root/simulateur/simulateurCADE.js')}}"></script>
        <script src="{{ asset('assets/root/simulateur/simulateur.js')}}"></script>
        <script src="{{ asset('assets/root/simulateur/ykeSimulateur.js')}}"></script>
        <script src="{{ asset('assets/js/fieldsForm.js')}}"></script>
        
       
        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
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
        {{-- <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- <script src="{{ mix('js/app.js') }}"></script> --}}

        <script type="module" src="{{ asset('api/request.js') }}"></script>

        {{-- <script src=https://touchpay.gutouch.com/touchpay/script/prod_touchpay-0.0.1.js type="text/javascript"></script> --}}

        


        <script>
            function checkNotifications() {
                fetch("{{ route('notifications.check') }}")
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    if (data.count > 0) {
                        // 🔔 Jouer un son une seule fois
                        let audio = new Audio('{{ asset("assets/root/sounds/notification.mp3") }}');
                        audio.play().catch(err => console.log("Audio bloqué :", err));

                        // Mettre à jour un badge ou compteur
                        document.getElementById('alert-count').innerHTML = data.unreadNotificationsCount;


                        // 🎉 Afficher un toast pour chaque notification
                        data.notifications.forEach(notif => {
                            Swal.fire({
                                toast: true,
                                timerProgressBar: true,
                                position: 'bottom-end',
                                icon: 'info',
                                title: notif.data.title,
                                html: `<a href="${notif.data.url}" style="color:#0d6efd;text-decoration:underline">Voir plus</a>`,
                                showConfirmButton: false,
                                timer: 5000
                            });
                        });
                    }
                })
                .catch(error => console.error('Erreur notif:', error));
            }

            // Vérifie toutes les 40 secondes
            setInterval(checkNotifications, 40000);
        </script>


 


        <script>
            $(document).ready(function() {
    

                var table = $('#example2').DataTable({
                    order: [[ 0, "desc" ]],
                    lengthChange: true,
                    buttons: ['copy', 'excel', 'pdf', 'print'],
                    language: {
                                search: "Recherche :",
                                lengthMenu: "Afficher _MENU_ lignes",
                                zeroRecords: "Aucun enregistrement trouvé",
                                info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                                infoEmpty: "Aucun enregistrement disponible",
                                infoFiltered: "(filtré à partir de _MAX_ enregistrements)",
                                paginate: {
                                    first: "Premier",
                                    last: "Dernier",
                                    next: "Suivant",
                                    previous: "Précédent",
                                },
                            },
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });
            $(document).ready(function() {
    

                var table = $('#example3').DataTable({
                    order: [[ 0, "desc" ]],
                    lengthChange: true,
                    buttons: ['copy', 'excel', 'pdf', 'print'],
                    language: {
                                search: "Recherche :",
                                lengthMenu: "Afficher _MENU_ lignes",
                                zeroRecords: "Aucun enregistrement trouvé",
                                info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                                infoEmpty: "Aucun enregistrement disponible",
                                infoFiltered: "(filtré à partir de _MAX_ enregistrements)",
                                paginate: {
                                    first: "Premier",
                                    last: "Dernier",
                                    next: "Suivant",
                                    previous: "Précédent",
                                },
                            },
                });

                table.buttons().container()
                    .appendTo('#example3_wrapper .col-md-6:eq(0)');
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.selection').select2({
                    placeholder: "Choisir",
                    allowClear: true,
                    width: '100%',
                });
            });
        </script>

        

        <script src="{{ asset('assets/js/script.js')}}"></script>
        <script src="{{ asset('assets/js/app.js')}}"></script>
        <script src="{{ asset('assets/js/main.js')}}"></script>
        <script src="{{ asset('assets/js/user.js')}}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const today = new Date().toISOString().split('T')[0]; // date actuelle au format YYYY-MM-DD
                const dateInputs = document.querySelectorAll('input[name="dateEffet"]');

                dateInputs.forEach(input => {
                    // Empêche la sélection d'une date antérieure
                    input.setAttribute('min', today);

                    // Vérifie la valeur à la saisie
                    input.addEventListener('change', function () {
                        if (this.value < today) {
                            swal.fire({
                                icon: 'error',
                                title: 'Date antérieure non autorisée',
                                text: 'Veuillez choisir une date posterieure ou la date actuelle.',
                            })
                            this.value = ''; // vide le champ
                        }
                    });
                });
            });
        </script>


        
        
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
                altFormat: "j F, Y",
                dateFormat: "d-m-Y", // Format réel de la date envoyée (10-12-2024)
                minDate: "today", // La date minimale est aujourd'hui
                locale: "fr" // Définit la langue en français
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
                    prevBtn.style.display = currentStep < formSteps.length - 1 ? "inline-block" : "none";
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

                //const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                //console.log('CSRF Token:', csrfToken);
            })
        </script>

        <script>
            const noCopy = document.querySelector('.no-copy');
            const noCut = document.querySelector('.no-cut');
            const noPaste = document.querySelector('.no-paste');

            noCopy.addEventListener('copy', function(event) {
                event.preventDefault();
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La copie de ce champ est désactivée.',
                    showConfirmButton: false,
                    timer: 1500
                })

            });

            noCut.addEventListener('cut', function(e) {
                e.preventDefault();
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La coupe de ce champ est désactivée.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });

            noPaste.addEventListener('paste', function(e) {
                e.preventDefault();
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La coller de ce champ est désactivée.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>


        

    </body>

</html>
