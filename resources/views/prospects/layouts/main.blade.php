<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Formulaire de Souscription Assurance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script> --}}


	<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">

    

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        fieldset {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            position: relative;
        }

        legend {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6887ee;
        }


        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3d8a41 0%, #136618 100%);
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            /* max-width: 1000px; */
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #3d8a41 0%, #136618 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
            font-size: 14px;
        }

        /* Progress Bar */
        .progress-container {
            padding: 30px 30px 0;
        }

        .progress-ba {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 40px;
        }

        .progress-ba::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e0e0e0;
            z-index: 0;
        }

        .progress-bar-fill {
            position: absolute;
            top: 20px;
            left: 0;
            height: 3px;
            background: #3d8a41;
            z-index: 1;
            transition: width 0.3s ease;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            background: white;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #999;
            transition: all 0.3s;
        }

        .step.active .step-circle {
            background: #136618;
            color: white;
            transform: scale(1.1);
        }

        .step.completed .step-circle {
            background: #136618;
            color: white;
        }

        .step-label {
            margin-top: 8px;
            font-size: 12px;
            color: #666;
            text-align: center;
            max-width: 100px;
        }

        .step.active .step-label {
            color: #3d8a41;
            font-weight: 600;
        }

        /* Form Steps */
        .form-step {
            display: none;
            padding: 30px;
            animation: fadeIn 0.3s;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #ffae25;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: "";
            width: 6px;
            height: 24px;
            background: #ffae25;
            border-radius: 3px;
        }

        /* .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        } */

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .required::after {
            content: " *";
            color: #ef4444;
        }

        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="tel"],
        input[type="file"],
        select,
        textarea {
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 12px;
            transition: all 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3d8a41;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .radio-group, .checkbox-group {
            display: flex;
            gap: 20px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .radio-label, .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-label input[type="radio"],
        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #3d8a41;
            color: white;
        }

        .btn-primary:hover {
            background: #3d8a41;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            padding: 20px 30px;
            background: #f9fafb;
            border-top: 1px solid #e0e0e0;
        }

        .added-list {
            margin-top: 20px;
        }

        .list-item {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid #ffae25;
        }

        .list-item-info {
            flex: 1;
        }

        .list-item-info strong {
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .list-item-info small {
            color: #666;
            font-size: 12px;
            display: block;
            margin-top: 3px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: #3d8a41;
            color: white;
            padding: 20px;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 20px;
        }

        .close-modal {
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .close-modal:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-body {
            padding: 30px;
        }

        /* Products */
        /* .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        } */

        .product-card {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .product-card:hover {
            border-color: #3d8a41;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .product-card.selected {
            border-color: #3d8a41;
            background: #f0f4ff;
        }

        .product-card input[type="checkbox"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #3d8a41;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .info-box p {
            color: #3d8a41;
            font-size: 14px;
            line-height: 1.6;
        }

        .contact-item {
            background: #f9fafb;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 3px solid #3d8a41;
        }

        .file-upload-area {
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload-area:hover {
            border-color: #3d8a41;
            background: #f9fafb;
        }

        .file-list {
            margin-top: 15px;
        }

        .file-item {
            background: #f9fafb;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .products-grid {
                grid-template-columns: 1fr;
            }

            .progress-ba {
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .step-label {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <main class="py-4 d-flex flex-column justify-content-center align-items-center">
        @yield('content')
    </main>

    {{-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script> --}}

    <!-- Modal Contact -->
    @include('prospects.components.modals.contactModal')

    <!-- Modal Partner -->
    @include('prospects.components.modals.partnerModal')

    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ asset('assets/plugins/select2/js/select2-custom.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        document.addEventListener('DOMContentLoaded', function () {
            const apiUrl = 'https://api.yakoafricassur.com/enov/villes';
            const apiProfessions = 'https://api.yakoafricassur.com/enov/professions';

            // Fonction utilitaire pour mettre en majuscule uniquement la première lettre
            function capitalizeFirstLetter(str) {
                if (!str) return '';
                return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
            }

            // Chargement des villes
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const villeSelect = document.getElementById('lieuresidence');
                    const lieuSelect = document.getElementById('lieunaissance');
                    
                    data.forEach(ville => {
                        const libelleFormate = capitalizeFirstLetter(ville.MonLibelle);

                        const optionVille = document.createElement('option');
                        optionVille.value = libelleFormate;
                        optionVille.textContent = libelleFormate;
                        villeSelect.appendChild(optionVille);

                        const optionLieu = document.createElement('option');
                        optionLieu.value = libelleFormate;
                        optionLieu.textContent = libelleFormate;
                        lieuSelect.appendChild(optionLieu);
                    });
                })
                .catch(error => console.error('Erreur chargement villes:', error));

            // Chargement des professions
            fetch(apiProfessions)
                .then(response => response.json())
                .then(data => {
                    const professionSelect = document.getElementById('profession');
                    
                    data.forEach(profession => {
                        const libelleFormate = capitalizeFirstLetter(profession.MonLibelle);

                        const optionProfession = document.createElement('option');
                        optionProfession.value = libelleFormate;
                        optionProfession.textContent = libelleFormate;
                        professionSelect.appendChild(optionProfession);
                    });
                })
                .catch(error => console.error('Erreur chargement professions:', error));
        });
    </script>

    <script>
        // Variables globales
        let currentStep = 1;
        const totalSteps = 6;
        let contacts = [];
        let partners = [];
        let uploadedFiles = [];

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            updateProgress();
        });

        // Ajouter cette fonction dans la navigation entre les étapes
        function changeStep(direction) {
            if (direction === 1 && !validateStep(currentStep)) {
                return;
            }

            const steps = document.querySelectorAll('.form-step');
            steps[currentStep - 1].classList.remove('active');

            currentStep += direction;

            if (currentStep > totalSteps) currentStep = totalSteps;
            if (currentStep < 1) currentStep = 1;

            steps[currentStep - 1].classList.add('active');
            updateProgress();
            updateButtons();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        

        function validateStep(step) {
            const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            
            for (let field of requiredFields) {
                if (!field.value || (field.type === 'checkbox' && !field.checked) || 
                    (field.type === 'radio' && !document.querySelector(`input[name="${field.name}"]:checked`))) {
                    field.focus();
                    alert('Veuillez remplir tous les champs obligatoires avant de continuer.');
                    return false;
                }
            }

            if (step === 1) {
                const produits = document.querySelectorAll('input[name="produits[]"]:checked');
                if (produits.length === 0) {
                    alert('Veuillez sélectionner au moins un produit d\'assurance.');
                    return false;
                }
            }

            return true;
        }

        function updateProgress() {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            document.getElementById('progressFill').style.width = progress + '%';

            document.querySelectorAll('.step').forEach((step, index) => {
                step.classList.remove('active', 'completed');
                if (index + 1 < currentStep) {
                    step.classList.add('completed');
                } else if (index + 1 === currentStep) {
                    step.classList.add('active');
                }
            });
        }

        function updateButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            prevBtn.style.display = currentStep === 1 ? 'none' : 'inline-block';
            
            if (currentStep === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            } else {
                nextBtn.style.display = 'inline-block';
                submitBtn.style.display = 'none';
            }
        }

        // Gestion des contacts
        function openContactModal() {
            document.getElementById('contactModal').classList.add('active');
            document.getElementById('contactType').value = '';
            document.getElementById('contactValue').value = '';
        }

        function closeContactModal() {
            document.getElementById('contactModal').classList.remove('active');
        }

        function addContact() {
            const type = document.getElementById('contactType').value;
            const value = document.getElementById('contactValue').value;

            if (!type || !value) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            contacts.push({ contactType: type, contact: value });
            renderContacts();
            closeContactModal();
        }

        function renderContacts() {
            const container = document.getElementById('contactsList');
            container.innerHTML = '';

            contacts.forEach((contact, index) => {
                const div = document.createElement('div');
                div.className = 'contact-item';
                div.innerHTML = `
                    <div>
                        <strong>${contact.contactType}</strong>: ${contact.contact}
                    </div>
                    <button type="button" class="btn btn-danger" onclick="removeContact(${index})">
                        Supprimer
                    </button>
                `;
                container.appendChild(div);
            });
        }

        function removeContact(index) {
            contacts.splice(index, 1);
            renderContacts();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Ajouter les écouteurs d'événements à tous les labels
            document.querySelectorAll('.partner-card').forEach(card => {
                card.addEventListener('click', function() {
                    const acteurType = this.getAttribute('data-type');
                    // 1. Affecter la valeur au champ input
                    document.getElementById('partner_type').value = acteurType;
                });
            });
        });

        function addPartner() {
            const nom = document.getElementById('partner_nom').value.trim();
            const prenom = document.getElementById('partner_prenom').value.trim();
            
            

            const typeInput = document.getElementById('partner_type');
            


            // Vérifie si un type est sélectionné
            const type = typeInput ? typeInput.value : '';

            if (!nom || !prenom) {
                alert('Veuillez remplir au moins le nom, prénom et le type de partenaire');
                return;
            }

            const civiliteInput = document.querySelector('input[name="partner_civilite"]:checked');
            // console.log(civiliteInput.value);
            const genreInput = document.querySelector('input[name="partner_genre"]:checked');
            // console.log(genreInput.value);

            const partner = {
                civilite: civiliteInput ? civiliteInput.value : '',
                type: type,
                nom: nom,
                prenom: prenom,
                genre: genreInput ? genreInput.value : '',
                dateNaissance: document.getElementById('partner_dateNaissance').value,
                lieuNaissance: document.getElementById('partner_lieuNaissance').value,
                naturepiece: document.getElementById('partner_naturepiece').value,
                numeropiece: document.getElementById('partner_numeropiece').value,
                email: document.getElementById('partner_email').value,
                mobile: document.getElementById('partner_mobile').value,
                situationMatrimoniale: document.getElementById('partner_situationMatrimoniale').value,
                lieuResidence: document.getElementById('partner_lieuResidence').value,
                adresseComplete: document.getElementById('partner_adresseComplete').value,
                profession: document.getElementById('partner_profession').value,
                employeur: document.getElementById('partner_employeur').value,
                filliation_code: document.getElementById('partner_filliation_code').value
            };

            partners.push(partner);
            renderPartners();

            partnerForm = document.getElementById('partnerForm');

            partnerForm.querySelectorAll('input').forEach(input => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                } else {
                    input.value = '';
                }
            });

        }


        function renderPartners() {
            // const container = document.getElementById('partnersList');
            const containers = document.querySelectorAll('.partnersList');
            containers.forEach(container => {
                container.innerHTML = '';
            });

            partners.forEach((partner, index) => {
                const div = document.createElement('div');
                div.className = 'list-item';
                div.innerHTML = `
                    <div class="list-item-info">
                        <strong>${partner.prenom} ${partner.nom}</strong>
                        <small>${partner.type === 'ASS' ? 'Assuré' : 'Bénéficiaire'} - ${partner.filliation_code || 'Relation non spécifiée'}</small>
                        ${partner.dateNaissance ? `<small>Né(e) le ${partner.dateNaissance}</small>` : ''}
                        ${partner.mobile ? `<small>📱 ${partner.mobile}</small>` : ''}
                    </div>
                    <button type="button" class="btn btn-danger" onclick="removePartner(${index})">
                        Supprimer
                    </button>
                `;
                containers.forEach(container => {
                    container.appendChild(div);
                });
            });
        }
        



        function removePartner(index) {
            partners.splice(index, 1);
            renderPartners();
        }

        // Gestion des produits
        function toggleProduct(card) {
            const checkbox = card.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            card.classList.toggle('selected');
        }

        // Gestion des fichiers
        function handleFileSelect(event) {
            const file = event.target.files[0];
            const nature = document.getElementById('documentNature').value;

            if (!file) return;

            if (!nature) {
                alert('Veuillez sélectionner un type de document');
                event.target.value = '';
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                alert('Le fichier ne doit pas dépasser 5MB');
                event.target.value = '';
                return;
            }

            uploadedFiles.push({ file: file, nature: nature, fileName: file.name });
            document.getElementById('documents_input').value = JSON.stringify(uploadedFiles);
            console.log(uploadedFiles);

            renderFiles();
            event.target.value = '';
        }

        function renderFiles() {
            const container = document.getElementById('filesList');
            container.innerHTML = '';

            uploadedFiles.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'file-item';
                div.innerHTML = `
                    <div>
                        <strong>${item.fileName}</strong>
                        <small style="display: block; color: #666;">${item.nature}</small>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="removeFile(${index})">
                        Supprimer
                    </button>
                `;
                container.appendChild(div);
            });
        }

        function removeFile(index) {
            uploadedFiles.splice(index, 1);
            renderFiles();
        }
    </script>

     @yield('scripts')
</body>
</html>