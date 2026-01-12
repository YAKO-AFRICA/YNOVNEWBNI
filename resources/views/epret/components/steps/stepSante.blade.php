<fieldset>
    <legend class="float-none w-auto px-2"><small>Questionnaire sur l'état de santé <span class="text-danger">*</span></small></legend>


    <style>
        #selectedDistractions span {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 5px 10px;
            border-radius: 20px;
            margin: 5px;
            font-size: 14px;
        }
        #selectedDistractions span .remove-distraction {
            margin-left: 10px;
            color: red;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
    <!-- Taille et Poids -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label for="taille" class="form-label">Quelle est votre taille ? <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="number" class="form-control" id="taille" placeholder="170" name="taille" value="{{ $simulationData['taille'] ?? '-' }}" disabled required>
            <span class="input-group-text">CM</span>
        </div>
    </div>
    <div class="col-md-6">
        <label for="poids" class="form-label">Quel est votre poids ? <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="number" class="form-control" name="poids" id="poids"  value="{{ $simulationData['poids'] ?? '-' }}" disabled required>
            <span class="input-group-text">KG</span>
        </div>
    </div>
</div>

<!-- Prise de tension -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label for="tensionMin" class="form-label">Tension minimale <span class="text-danger">*</span></label>
        <select name="tensionMin" id="" class="form-select" required>
            <option class="form-option" value="75">75</option>
            <option class="form-option" value="80">80</option>
            <option class="form-option" value="85">85</option>
            <option class="form-option" value="90">90</option>
            <option class="form-option" value="95">95</option>
            <option class="form-option" value="100">100</option>
            <option class="form-option" value="105">105</option>
            <option class="form-option" value="106">106</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="tensionMax" class="form-label">Tension maximale <span class="text-danger">*</span></label>
        <select name="tensionMax" id="tensionMax" class="form-select" required>
            <option class="form-option" value="130">130</option>
            <option class="form-option" value="135">135</option>
            <option class="form-option" value="140">140</option>
            <option class="form-option" value="145">145</option>
            <option class="form-option" value="150">150</option>
            <option class="form-option" value="155">155</option>
            <option class="form-option" value="160">160</option>
            <option class="form-option" value="165">165</option>
            <option class="form-option" value="170">170</option>
            <option class="form-option" value="175">175</option>
        </select>
    </div>
</div>

<!-- Questions générales -->
<div class="mb-4">
    <label class="form-label">Fumez-vous ? <span class="text-danger">*</span></label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="smoking" id="fumeOui" value="Oui" required>
        <label class="form-check-label" for="fumeOui">Oui</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="smoking" id="fumeNon" value="Non">
        <label class="form-check-label" for="fumeNon">Non</label>
    </div>
</div>

<div class="row">
    <div class="mb-4 col">
        <label class="form-label">Buvez-vous de l'alcool ? <span class="text-danger">*</span></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="alcohol" id="alcoolPas" value="Nom" required>
            <label class="form-check-label" for="alcoolPas">Pas du tout</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="alcohol" id="alcoolOccasion" value="Partiel">
            <label class="form-check-label" for="alcoolOccasion">À l'occasion</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="alcohol" id="alcoolRegulier" value="Oui">
            <label class="form-check-label" for="alcoolRegulier">Régulièrement (au moins une fois par semaine)</label>
        </div>
    </div>
    
    <div class="mb-4 col">
        <label class="form-label">Pratiquez-vous une activité sportive régulière ? <span class="text-danger">*</span></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sport" id="sportOui" value="Oui" required>
            <label class="form-check-label" for="sportOui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sport" id="sportNon" value="Non">
            <label class="form-check-label" for="sportNon">Non</label>
        </div>
    </div>
</div>

<div class="mb-4">
    <label for="typeSport" class="form-label">Quel type de sport pratiquez-vous ?</label>
    <input type="text" class="form-control" id="typeSport" name="typeSport" placeholder="Ex: Football">
</div>


<div class="mb-4">
    <label for="distractions" class="form-label">Quelles sont vos distractions ?</label>
    <div class="input-group">
        <input id="distractionsInput" class="form-control" type="text" placeholder="Saisissez ou sélectionnez une distraction" list="distractionsList">
        <datalist id="distractionsList">
            <!-- Les options seront générées dynamiquement -->
        </datalist>
        <button id="addDistraction" class="btn btn-primary" type="button">Ajouter</button>
    </div>
    <div id="selectedDistractions" class="mt-3">
        <!-- Les distractions sélectionnées apparaîtront ici -->
    </div>

    <input type="hidden" id="hiddenDistractionsInput" name="distractions">
</div>



<!-- Questions médicales -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label class="form-label">Avez-vous déjà été victime d'un accident ?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="accident" id="accidentOui" value="Oui" required>
            <label class="form-check-label" for="accidentOui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="accident" id="accidentNon" value="Non">
            <label class="form-check-label" for="accidentNon">Non</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Suivez-vous un traitement médical ces 6 derniers mois ?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="treatment" id="treatmentOui" value="Oui" required>
            <label class="form-check-label" for="treatmentOui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="treatment" id="treatmentNon" value="Non">
            <label class="form-check-label" for="treatmentNon">Non</label>
        </div>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label class="form-label">Avez-vous déjà subi une transfusion de sang ? <span class="text-danger">*</span></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="transSang" id="transSangOui" value="Oui" required>
            <label class="form-check-label" for="transSangOui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="transSang" id="transSangNon" value="Non">
            <label class="form-check-label" for="transSangNon">Non</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Avez-vous déjà subi des interventions chirurgicales ? <span class="text-danger">*</span></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="interChirugiale" id="interChirugialeOui" value="Oui" required>
            <label class="form-check-label" for="interChirugialeOui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="interChirugiale" id="interChirugialeNon" value="Non">
            <label class="form-check-label" for="interChirugialeNon">Non</label>
        </div>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label class="form-label">Devez-vous subir une intervention chirurgicale ? <span class="text-danger">*</span></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="prochaineInterChirugiale" id="prochaineInterChirugialeOui" value="Oui" required>
            <label class="form-check-label" for="prochaineInterChirugialeOui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="prochaineInterChirugiale" id="prochaineInterChirugialeNon" value="Non">
            <label class="form-check-label" for="prochaineInterChirugialeNon">Non</label>
        </div>
    </div>
    
</div>

<!-- Maladies -->
<fieldset class="mb-4">
    <legend class="float-none w-auto px-2"><small>Etes vous sous traitement médical pour, ou souffrez vous d'une de ces maladies ? </small></legend>
    <div class="card p-4">
        <form id="medicalHistoryForm">
           <div class="row">
                <div class="mb-3 col">
                    <label class="form-label">Diabète *</label>
                    <div class="form-check">
                        <input type="radio" id="diabetesYes" name="diabetes" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="diabetesYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="diabetesNo" name="diabetes" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="diabetesNo">Non</label>
                    </div>
                </div>
        
                <div class="mb-3 col">
                    <label class="form-label">Hypertension artérielle *</label>
                    <div class="form-check">
                        <input type="radio" id="hypertensionYes" name="hypertension" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="hypertensionYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="hypertensionNo" name="hypertension" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="hypertensionNo">Non</label>
                    </div>
                </div>
           </div>
    
            <div class="row">
                <div class="mb-3 col">
                    <label class="form-label">Drépanocytose *</label>
                    <div class="form-check">
                        <input type="radio" id="sickleCellYes" name="sickleCell" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="sickleCellYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="sickleCellNo" name="sickleCell" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="sickleCellNo">Non</label>
                    </div>
                </div>
        
                <div class="mb-3 col">
                    <label class="form-label">Cirrhose de foie *</label>
                    <div class="form-check">
                        <input type="radio" id="liverCirrhosisYes" name="liverCirrhosis" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="liverCirrhosisYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="liverCirrhosisNo" name="liverCirrhosis" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="liverCirrhosisNo">Non</label>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="mb-3 col">
                    <label class="form-label">Affections pulmonaires *</label>
                    <div class="form-check">
                        <input type="radio" id="lungDiseaseYes" name="lungDisease" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="lungDiseaseYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="lungDiseaseNo" name="lungDisease" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="lungDiseaseNo">Non</label>
                    </div>
                </div>
        
                <div class="mb-3 col">
                    <label class="form-label">Cancer *</label>
                    <div class="form-check">
                        <input type="radio" id="cancerYes" name="cancer" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="cancerYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="cancerNo" name="cancer" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="cancerNo">Non</label>
                    </div>
                </div>
            </div>
    
           <div class="row">
                <div class="mb-3 col" >
                    <label class="form-label">Anémie *</label>
                    <div class="form-check">
                        <input type="radio" id="anemiaYes" name="anemia" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="anemiaYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="anemiaNo" name="anemia" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="anemiaNo">Non</label>
                    </div>
                </div>
        
                <div class="mb-3 col">
                    <label class="form-label">Insuffisance rénale *</label>
                    <div class="form-check">
                        <input type="radio" id="kidneyFailureYes" name="kidneyFailure" value="Oui" class="form-check-input" required>
                        <label class="form-check-label" for="kidneyFailureYes">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="kidneyFailureNo" name="kidneyFailure" value="Non" class="form-check-input" required>
                        <label class="form-check-label" for="kidneyFailureNo">Non</label>
                    </div>
                </div>
           </div>
    
            <div class="mb-3">
                <label class="form-label">Avez-vous déjà été victime d’un AVC ? *</label>
                <div class="form-check">
                    <input type="radio" id="strokeYes" name="stroke" value="Oui" class="form-check-input" required>
                    <label class="form-check-label" for="strokeYes">Oui</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="strokeNo" name="stroke" value="Non" class="form-check-input" required>
                    <label class="form-check-label" for="strokeNo">Non</label>
                </div>
            </div>
        </form>
    </div>
    
</fieldset>
</fieldset>

{{-- 
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Base de distractions
    const distractionsBase = [
        "Cuisine",
        "Lecture",
        "Musique",
        "Voyage",
        "Sport",
        "Jeux vidéo",
        "Jardinage",
        "Peinture",
        "Danse",
        "Photographie",
    ];

    // Références des éléments
    const distractionsInput = document.getElementById("distractionsInput");
    const distractionsList = document.getElementById("distractionsList");
    const addDistractionBtn = document.getElementById("addDistraction");
    const selectedDistractionsContainer = document.getElementById("selectedDistractions");

    // Initialisation du datalist avec les options
    distractionsBase.forEach(distraction => {
        const option = document.createElement("option");
        option.value = distraction;
        distractionsList.appendChild(option);
    });

    // Gestion de l'ajout d'une distraction
    addDistractionBtn.addEventListener("click", function () {
        const distractionValue = distractionsInput.value.trim();
        if (distractionValue && !isDistractionAlreadyAdded(distractionValue)) {
            addDistraction(distractionValue);
            distractionsInput.value = ""; // Réinitialise le champ
        }
    });

    // Vérifie si une distraction est déjà ajoutée
    function isDistractionAlreadyAdded(value) {
        return Array.from(selectedDistractionsContainer.children).some(
            child => child.textContent.trim().startsWith(value)
        );
    }

    // Ajoute une distraction à la liste sélectionnée
    function addDistraction(value) {
        const span = document.createElement("span");
        span.textContent = value;

        const removeBtn = document.createElement("span");
        removeBtn.textContent = "x";
        removeBtn.classList.add("remove-distraction");
        removeBtn.addEventListener("click", function () {
            span.remove();
        });

        span.appendChild(removeBtn);
        selectedDistractionsContainer.appendChild(span);
    }
});

</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Base de distractions
        const distractionsBase = [
            "Cuisine",
            "Lecture",
            "Musique",
            "Voyage",
            "Sport",
            "Jeux vidéo",
            "Jardinage",
            "Peinture",
            "Danse",
            "Photographie",
        ];

        // Références des éléments
        const distractionsInput = document.getElementById("distractionsInput");
        const distractionsList = document.getElementById("distractionsList");
        const addDistractionBtn = document.getElementById("addDistraction");
        const selectedDistractionsContainer = document.getElementById("selectedDistractions");
        const hiddenDistractionsInput = document.getElementById("hiddenDistractionsInput");

        // Initialisation du datalist avec les options
        distractionsBase.forEach(distraction => {
            const option = document.createElement("option");
            option.value = distraction;
            distractionsList.appendChild(option);
        });

        // Gestion de l'ajout d'une distraction
        addDistractionBtn.addEventListener("click", function () {
            const distractionValue = distractionsInput.value.trim();
            if (distractionValue && !isDistractionAlreadyAdded(distractionValue)) {
                addDistraction(distractionValue);
                updateHiddenInput(); // Met à jour l'input caché
                distractionsInput.value = ""; // Réinitialise le champ
            }
        });

        // Vérifie si une distraction est déjà ajoutée
        function isDistractionAlreadyAdded(value) {
            return Array.from(selectedDistractionsContainer.children).some(
                child => child.textContent.trim().startsWith(value)
            );
        }

        // Ajoute une distraction à la liste sélectionnée
        function addDistraction(value) {
            const span = document.createElement("span");
            span.textContent = value;

            const removeBtn = document.createElement("span");
            removeBtn.textContent = " x";
            removeBtn.classList.add("remove-distraction");
            removeBtn.style.cursor = "pointer";
            removeBtn.style.color = "red";
            removeBtn.addEventListener("click", function () {
                span.remove();
                updateHiddenInput(); // Met à jour l'input caché après suppression
            });

            span.appendChild(removeBtn);
            selectedDistractionsContainer.appendChild(span);
        }

        // Met à jour l'input caché avec les distractions sélectionnées
        function updateHiddenInput() {
            const selectedDistractions = Array.from(selectedDistractionsContainer.children).map(
                child => child.textContent.replace(" x", "").trim()
            );
            hiddenDistractionsInput.value = selectedDistractions.join(","); // Stocke les distractions sous forme de chaîne
        }
    });
</script>


