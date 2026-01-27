// Debut js perso prestation

document.addEventListener("DOMContentLoaded", function () {
    // let TotalEncaissement = TotalEncaissement;
    // alert(TotalEncaissement);
    // Récupérer les éléments du DOM
    const operateurInputs = document.querySelectorAll(
        'input[name="Operateur"]'
    );
    const telPaiementInput = document.getElementById("TelPaiement");
    const confirmTelPaiementInput =
        document.getElementById("ConfirmTelPaiement");

    let selectedOperateur = ""; // Variable pour stocker l'opérateur sélectionné

    desactiverChamps();

    // Fonction pour activer ou désactiver les champs de telPaiement et confirmTelPaiement
    function activerChamps() {
        telPaiementInput.disabled = false;
        confirmTelPaiementInput.disabled = false;
    }

    function desactiverChamps() {
        telPaiementInput.disabled = true;
        confirmTelPaiementInput.disabled = true;
    }

    // Ajouter un écouteur pour chaque input radio
    operateurInputs.forEach((input) => {
        input.addEventListener("change", function () {
            let prefix = "";
            selectedOperateur = this.value; // Mettre à jour l'opérateur sélectionné
            switch (this.value) {
                case "Orange_money":
                    prefix = "07";
                    break;
                case "MTN_money":
                    prefix = "05";
                    break;
                case "Moov_money":
                    prefix = "01";
                    break;
            }
            if (prefix) {
                activerChamps();
                telPaiementInput.value = prefix;
                confirmTelPaiementInput.value = prefix;
            }
        });
    });

    // Fonction pour vérifier le préfixe en fonction de l'opérateur
    const validatePrefix = (input) => {
        const value = input.value;
        let requiredPrefix = "";

        switch (selectedOperateur) {
            case "Orange_money":
                requiredPrefix = "07";
                break;
            case "MTN_money":
                requiredPrefix = "05";
                break;
            case "Moov_money":
                requiredPrefix = "01";
                break;
        }

        if (!value.startsWith(requiredPrefix)) {
            const message = `Le numéro saisi doit commencer par ${requiredPrefix} pour ${selectedOperateur.replace(
                "_",
                " "
            )}.`;
            alert(message);
            input.classList.add("is-invalid");
        } else {
            input.classList.remove("is-invalid");
        }
    };

    // Ajouter l'événement 'blur' pour valider le préfixe uniquement
    [telPaiementInput, confirmTelPaiementInput].forEach((input) => {
        input.addEventListener("blur", function () {
            validatePrefix(this);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.etaperdv'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    // const telPaiementField = document.getElementById('TelPaiement');
    // const confirmTelPaiementField = document.getElementById('ConfirmTelPaiement');
    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape
        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }


    // Gestionnaire pour les boutons "Next"
    nextButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // // Vérifier si on est sur l'étape contenant les champs de téléphone
            // if (currentContainer.contains(telPaiementField)) {
            //     if (!validateTelFields()) {
            //         alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
            //         return; // Arrêter si les champs ne sont pas valides
            //     }
            // }

            if (validateStep(currentContainer)) {
                // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
                setTimeout(() => {
                    currentContainer.classList.add('d-none');
                    nextStep.classList.remove('d-none');
                }, 1000); // 1 seconde
            }
        });
    });
    submitdrvButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle

            if (validateStep(currentContainer)) {
                // Si les champs sont valides, attendre 1 seconde avant de soumettre le formulair
                setTimeout(() => {
                    return;
                }, 500);
            }
        });
    });

    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const OTP_API = document.getElementById("OTP_API").value;
    const steps = document.querySelectorAll(".etape, .etapePrest"); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll(".next-btn"); // Boutons "Next"
    // const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll(".prev-btn"); // Boutons "Prev"
    const telPaiementField = document.getElementById("TelPaiement");
    const ibanPaiementField = document.getElementById("IBAN");
    let ibanField = document.querySelectorAll(".rib-input");
    // let rib = Array.from(ibanField).map(input => input.value).join('');
    // const confirmIbanPaiementField = document.getElementById('ConfirmIBAN');
    const confirmTelPaiementField =
        document.getElementById("ConfirmTelPaiement");
    const otpContainer = document.getElementById("OTP");
    const resendOtpLink = document.querySelector(".resend-otp-link");
    // const otpInputs = document.querySelectorAll('.otp-input');
    const otpTimer = document.createElement("div"); // Timer pour afficher le compte à rebours
    // const montantSouhaite = document.getElementById('montantSouhaite');
    const ibanPaiementSection = document.getElementById("IBANPaiement");
    const telPaiementSection = document.getElementById("TelephonePaiement");

    const operateurInputs = document.querySelectorAll(
        'input[name="Operateur"]'
    );
    const telOtpField = document.getElementById("TelOtp");
    // const telPaiementInput = document.getElementById('TelPaiement');
    // const confirmTelPaiementInput = document.getElementById('ConfirmTelPaiement');

    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll("input, textarea, select"); // Tous les champs de l'étape

        allFields.forEach((field) => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add("is-invalid"); // Ajouter une classe pour indiquer une erreur
                field.classList.remove("is-valid"); // Retirer la classe valide
            } else {
                field.classList.remove("is-invalid"); // Retirer la classe d'erreur
                field.classList.add("is-valid"); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }
    function validateIbanFields() {
        // const ibanPaiementField = document.getElementById('ibanPaiement');
        // const confirmIbanPaiementField = document.getElementById('confirmIbanPaiement');
        const ibanPaiementSection = document.getElementById("IBANPaiement");

        const ibanValue = ibanPaiementField.value.trim();

        // const confirmIbanValue = confirmIbanPaiementField.value.trim();

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!ibanPaiementSection.classList.contains("d-none")) {
            // Réinitialiser les classes d'erreur
            ibanField.forEach((input) => {
                input.classList.remove("is-invalid");
            });
            // ibanPaiementField.classList.remove('is-invalid');
            // confirmIbanPaiementField.classList.remove('is-invalid');

            // Vérification : Les champs ne doivent pas être vides
            if (ibanValue.length == 0) {
                isValid = false;
                // ibanField.classList.add('is-invalid');
                ibanField.forEach((input) => {
                    input.classList.add("is-invalid");
                    input.classList.remove("is-valid");
                });
                // ibanPaiementField.classList.add('is-invalid');
                // confirmIbanPaiementField.classList.add('is-invalid');
                alert("Veuillez saisir Obligatoirement un RIB.");
            }

            // Vérification : Les valeurs doivent correspondre
            else if (ibanValue.length !== 24) {
                isValid = false;
                ibanField.forEach((input) => {
                    if (
                        input.value.length == 0 ||
                        input.value == null ||
                        input.value == undefined ||
                        input.value == " "
                    ) {
                        input.classList.add("is-invalid");
                        input.classList.remove("is-valid");
                    } else {
                        input.classList.remove("is-invalid");
                        input.classList.add("is-valid");
                    }
                });
                // confirmIbanPaiementField.classList.add('is-invalid');
                alert(
                    "Le RIB doit contenir exactement 24 chiffres. Veuillez saisir tous les champs."
                );
            }

            // Si tout est valide, retirer les classes d'erreur
            if (isValid) {
                ibanField.forEach((input) => {
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                });
                // ibanPaiementField.classList.remove('is-invalid');
                // confirmIbanPaiementField.classList.remove('is-invalid');
            }
        }

        return isValid;
    }

    function validateTelFields() {
        const telValue = telPaiementField.value.trim();
        const confirmTelValue = confirmTelPaiementField.value.trim();
        const telPaiementSection = document.getElementById("TelephonePaiement");

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!telPaiementSection.classList.contains("d-none")) {
            // Vérifier si les champs ne sont pas vides
            if (!telValue || !confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add("is-invalid");
                confirmTelPaiementField.classList.add("is-invalid");
            }
            // Vérifier si les valeurs correspondent
            else if (telValue !== confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add("is-invalid");
                confirmTelPaiementField.classList.add("is-invalid");
            } else {
                // Tout est valide, retirer les classes d'erreur
                telPaiementField.classList.remove("is-invalid");
                confirmTelPaiementField.classList.remove("is-invalid");
            }

            // Vérifier le format du numéro (exemple : 10 chiffres)
            const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
            if (!phoneRegex.test(telValue)) {
                isValid = false;
                telPaiementField.classList.add("is-invalid");
            } else {
                telPaiementField.classList.remove("is-invalid");
            }
        }
        return isValid;
    }

    // Fonction pour envoyer l'OTP
    async function sendOtp(phone) {
        const phoneNumber = phone.trim();
        // const firstTwoDigits = phone.substring(0, 2); // pour logique opérateur future

        try {
            const response = await fetch(`${OTP_API}api/send-otp`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    telIndicatif: "225",
                    telephone: phoneNumber,
                    operation_type: "Demande de prestation"
                })
            });

            const data = await response.json();

            if (data.status === 200) {
                Swal.fire({
                    icon: "success",
                    title: "Code de confirmation envoyé !",
                    text: `Un code de confirmation a été envoyé sur le numéro ${phoneNumber}`,
                    showConfirmButton: true,
                    confirmButtonText: "OK",
                    timer: 2000
                });
                startOtpTimer(); // Démarre le compte à rebours OTP
                return true;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur s'est produite lors de l'envoi du code de confirmation.",
                });
                return false;
            }
        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: "error",
                title: "Erreur de connexion",
                text: "Impossible de contacter le serveur OTP. Veuillez réessayer.",
            });
            return false;
        }
    }
    // async function sendOtp(phone) {
    //     let phoneNumber = "225" + phone;
    //     let firstTwoDigits = phone.substring(0, 2); // Extraire les deux premiers chiffres de phone

    //     if (firstTwoDigits == "07" || firstTwoDigits == "05") {
    //         try {
    //             const response = await fetch("/api/send-otpByOrangeAPI", {
    //                 method: "POST",
    //                 headers: {
    //                     "Content-Type": "application/json",
    //                     "X-CSRF-TOKEN": document
    //                         .querySelector('meta[name="csrf-token"]')
    //                         .getAttribute("content"),
    //                 },
    //                 body: JSON.stringify({ TelPaiement: phoneNumber }),
    //             });

    //             const result = await response.json();

    //             if (response.ok) {
    //                 swal.fire({

    //                     icon: "success",
    //                     title: "Code de confirmation envoyé !",
    //                     text: "Un code de confirmation a été envoyé sur le numéro " + phoneNumber,
    //                     showConfirmButton: true,
    //                     confirmButtonText: "OK",
    //                     timer: 2000
                        
    //                 })
    //                 // alert(
    //                 //     `Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`
    //                 // );
    //                 startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
    //                 return true;
    //             } else {
    //                 alert(
    //                     "Une erreur s'est produite lors de l'envoi du code de confirmation."
    //                 );
    //                 // alert(result.error || "Une erreur s'est produite lors de l'envoi du code de confirmation.");
    //                 return false;
    //             }
    //         } catch (error) {
    //             alert(
    //                 "Une erreur s'est produite lors de l'envoi du code de confirmation."
    //             );
    //             console.error(error);
    //             return false;
    //         }
    //     } else if (firstTwoDigits == "01") {
    //         try {
    //             const response = await fetch("/api/send-otpByInfobipAPI", {
    //                 method: "POST",
    //                 headers: {
    //                     "Content-Type": "application/json",
    //                     "X-CSRF-TOKEN": document
    //                         .querySelector('meta[name="csrf-token"]')
    //                         .getAttribute("content"),
    //                 },
    //                 body: JSON.stringify({ TelPaiement: phoneNumber }),
    //             });

    //             const result = await response.json();

    //             if (response.ok) {
    //                 swal.fire({
    //                     icon: "success",
    //                     title: "Code de confirmation envoyé !",
    //                     text: "Un code de confirmation a été envoyé sur le numéro " + phoneNumber,
    //                     showConfirmButton: true,
    //                     confirmButtonText: "OK",
    //                     timer: 2000
                        
    //                 })
                    
    //                 startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
    //                 return true;
    //             } else {
    //                 alert(
    //                     result.error ||
    //                         "Une erreur s'est produite lors de l'envoi du code de confirmation."
    //                 );
    //                 return false;
    //             }
    //         } catch (error) {
    //             alert(
    //                 "Une erreur s'est produite lors de l'envoi du code de confirmation."
    //             );
    //             console.error(error);
    //             return false;
    //         }
    //     }
    // }

    // Fonction pour démarrer le compte à rebours pour l'expiration de l'OTP
    let otpExpirationTime = 3 * 60; // 5 minutes en secondes
    let otpInterval;

    function startOtpTimer() {
        otpTimer.classList.add("otp-timer");
        otpContainer.appendChild(otpTimer); // Ajouter le timer à l'interface
        updateOtpTimer();

        otpInterval = setInterval(() => {
            otpExpirationTime--;
            updateOtpTimer();

            if (otpExpirationTime <= 0) {
                clearInterval(otpInterval);
                otpTimer.textContent = "Le code de confirmation a expiré.";
                resendOtpLink.classList.remove("d-none"); // Afficher le lien pour renvoyer l'OTP
            }
        }, 1000); // Met à jour chaque seconde
    }

    function updateOtpTimer() {
        const minutes = Math.floor(otpExpirationTime / 60);
        const seconds = otpExpirationTime % 60;
        otpTimer.textContent = `Temps restant: ${minutes}:${
            seconds < 10 ? "0" : ""
        }${seconds}`;
    }

    // Fonction pour renvoyer l'OTP
    resendOtpLink.addEventListener("click", async function () {
        otpExpirationTime = 3 * 60; // Réinitialiser le temps d'expiration
        clearInterval(otpInterval); // Arrêter l'ancien intervalle
        resendOtpLink.classList.add("d-none"); // Cacher le lien pendant l'envoi de l'OTP
        let phoneNumber = null;
        if (telPaiementField.value != null && telPaiementField.value != "") {
            phoneNumber = telPaiementField.value.trim();
        } else {
            phoneNumber = telOtpField.value.trim();
        }
        const otpSent = await sendOtp(phoneNumber);

        if (!otpSent) {
            return; // Arrêter si l'OTP n'a pas pu être envoyé
        }
        // else{
        //     startOtpTimer();
        //     alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
        // }
    });

    const montantSouhaiteField = document.getElementById("montantSouhaite");
    const typeprestation_id = document.getElementById("typeprestation_id").value;
    const typeprestation_idNotOut = ['2','4','5'];
    const typeprestation_idOut = ['3', '6', '7', '8', '9'];
    const AutresInfos = document.getElementById("AutresInfos");
    const capitalField = document.getElementById("Capital");
    const TotalEncaissementField = document.getElementById("TotalEncaissement");
    const msgError = $("#msgerror");
    const msgSuccess = $("#msgesucces");
    const ibanMsgError = $("#ibanMsgError");
    const ibanMsgSuccess = $("#ibanMsgSuccess");
    const ibanConfirmMsgError = $("#ibanConfirmMsgError");
    const ibanConfirmMsgSuccess = $("#ibanConfirmMsgSuccess");
    const telMsgError = $("#telMsgError");
    const telMsgSuccess = $("#telMsgSuccess");
    const telConfirmMsgError = $("#telConfirmMsgError");
    const telConfirmMsgSuccess = $("#telConfirmMsgSuccess");
    const countError = $("#counterror");
    const countSuccess = $("#countesucces");
    const btnIbanPaiementSuivant = document.getElementById(
        "btnIbanPaiementSuivant"
    );
    const btnTelPaiementSuivant = document.getElementById(
        "btnTelPaiementSuivant"
    );
    const btnContratSuivant = document.getElementById("btnContratSuivant");

    btnContratSuivant.disabled = true;

    // Vérification des champs de IBAN si présents dans l'étape actuelle
    if (!ibanPaiementSection.classList.contains("d-none")) {
        // Réinitialisation des messages
        ibanMsgError.text("").hide();
        ibanMsgSuccess.text("").hide();
        btnIbanPaiementSuivant.disabled = true;

        // Fonction pour mettre à jour le champ IBAN
        function updateIBAN() {
            let ibanValue = "";
            ibanField.forEach((input) => {
                ibanValue += input.value;
                if (
                    input.value.length == 0 ||
                    input.value == null ||
                    input.value == undefined ||
                    input.value == " "
                ) {
                    input.classList.add("is-invalid");
                    input.classList.remove("is-valid");
                } else {
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                }
                ibanValue = ibanValue.replace(/[^a-zA-Z0-9]/g, "");
                if (ibanValue.length < 24 || ibanValue.length > 24) {
                    // ibanPaiementField.classList.add('is-invalid');
                    // ibanPaiementField.classList.remove('is-valid');
                    ibanMsgSuccess.text("").hide();
                    ibanMsgError
                        .text(
                            "Le RIB doit contenir exactement 24 caractères. Veuillez saisir tous les champs."
                        )
                        .show();
                    btnIbanPaiementSuivant.disabled = true;
                } else {
                    // ibanPaiementField.classList.remove('is-invalid');
                    // ibanPaiementField.classList.add('is-valid');
                    ibanMsgSuccess.text("Vous pouvez passer au suivant").show();
                    ibanMsgError.text("").hide();
                    btnIbanPaiementSuivant.disabled = false;
                }
            });
            ibanPaiementField.value = ibanValue;
        }

        // Écoute les changements dans chaque champ d'entrée
        ibanField.forEach((input) => {
            input.addEventListener("input", updateIBAN);
        });

    
    }

    if (!telPaiementSection.classList.contains("d-none")) {
        btnTelPaiementSuivant.disabled = true;
        let selectedOperateur = ""; // Variable pour stocker l'opérateur sélectionné
        // let prefix = operateurInputs.checked
        // ? operateurInputs.value === 'Orange_money' ? '07'
        // : operateurInputs.value === 'Moov_money' ? '01'
        // : operateurInputs.value === 'MTN_money' ? '05'
        // : null
        // : null;
        // Ajouter un écouteur pour chaque input radio
        operateurInputs.forEach((input) => {
            input.addEventListener("change", function () {
                let prefix = "";
                selectedOperateur = this.value; // Mettre à jour l'opérateur sélectionné
                switch (this.value) {
                    case "Orange_money":
                        prefix = "07";
                        break;
                    case "MTN_money":
                        prefix = "05";
                        break;
                    case "Moov_money":
                        prefix = "01";
                        break;
                }
                telPaiementField.addEventListener("input", function (e) {
                    const telValue = e.target.value.trim();
                    let firstTwoDigits = telValue.substring(0, 2); // Extraire les deux premiers chiffres de phone
                    // Réinitialisation des messages
                    telMsgError.text("").hide();
                    telMsgSuccess.text("").hide();

                    if (telValue.length != 10 || firstTwoDigits !== prefix) {
                        telPaiementField.classList.add("is-invalid");
                        telPaiementField.classList.remove("is-valid");
                        telMsgError
                            .text(
                                "Le numéro de téléphone doit avoir 10 caractères et doit commencer par " +
                                    prefix +
                                    "."
                            )
                            .show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        telPaiementField.classList.remove("is-invalid");
                        telPaiementField.classList.add("is-valid");
                        telMsgSuccess
                            .text("Le numéro de téléphone est valide.")
                            .show();
                        // btnTelPaiementSuivant.disabled = false;
                    }
                });

                confirmTelPaiementField.addEventListener("input", function (e) {
                    const confirmTel = e.target.value.trim();
                    const telValue = telPaiementField.value.trim();
                    telConfirmMsgError.text("").hide();
                    telConfirmMsgSuccess.text("").hide();

                    if (confirmTel !== telValue || confirmTel.length !== 10) {
                        confirmTelPaiementField.classList.add("is-invalid");
                        confirmTelPaiementField.classList.remove("is-valid");
                        telConfirmMsgError
                            .text(
                                "Le numéro de téléphone de confirmation est ne correspond pas."
                            )
                            .show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        confirmTelPaiementField.classList.remove("is-invalid");
                        confirmTelPaiementField.classList.add("is-valid");
                        telConfirmMsgSuccess
                            .text(
                                "Le numéro de téléphone de confirmation est correct."
                            )
                            .show();
                        btnTelPaiementSuivant.disabled = false;
                    }
                });
            });
        });
    }

    // console.log(typeprestation_id);
    // console.log(typeprestation_idOut);
    // console.log(typeprestation_idNotOut);

    if (typeprestation_idOut.includes(typeprestation_id)) {
        btnContratSuivant.disabled = false;
        montantSouhaiteField.required = false;
        montantSouhaiteField.readOnly = true;
        montantSouhaiteField.value = "0";
    }else{
        // btnContratSuivant.disabled = true;
        // montantSouhaiteField.readOnly = false;
        // montantSouhaiteField.value = "";
        montantSouhaiteField.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\s/g, "").replace(/[^0-9]/g, ""); // Supprime espaces et caractères non numériques
    
            if (value) {
                e.target.value = parseInt(value, 10).toLocaleString("fr-FR"); // Formate avec séparateurs de milliers
            } else {
                e.target.value = ""; // Champ vide si suppression complète
            }
    
            // Vérifier si le montant souhaité est valide
            const montantSouhaite = parseInt(value, 10) || 0; // Valeur saisie ou 0 si vide
    
            const capital = parseFloat(capitalField.value.replace(/\s/g, "")) || 0; // Supprimer les espaces avant conversion
            const TotalEncaissement =
                parseFloat(TotalEncaissementField.value.replace(/\s/g, "")) || 0; // Supprimer les espaces avant conversion
            // const moitieCapital = capital / 2;
            const moitieCapital = TotalEncaissement * 0.4;
            // const moitieCapital = TotalEncaissement / 2;
            const moitieCapitalFormate = moitieCapital.toLocaleString("fr-FR");
    
            // Réinitialiser les messages d'erreur et de succès
            msgError.text("").hide();
            msgSuccess.text("").hide();
            countError.text("").hide();
            countSuccess.text("").hide();
    
            if (montantSouhaite > moitieCapital || montantSouhaite <= 0) {
                msgError
                    .text(
                        `Selon les termes du contrat, vous ne pouvez pas demander ce montant.`
                    )
                    .show();
                montantSouhaiteField.classList.add("is-invalid");
                montantSouhaiteField.classList.remove("is-valid");
                // desactiver le bouton
                btnContratSuivant.disabled = true;
            } else if (montantSouhaiteField.value.trim() === "") {
                montantSouhaiteField.classList.remove("is-invalid");
                montantSouhaiteField.classList.remove("is-valid");
                // desactiver le bouton
                btnContratSuivant.disabled = true;
            } else if (montantSouhaite <= moitieCapital && montantSouhaite > 0) {
                msgSuccess
                    .text(
                        `Le montant définitif sera calculé en fonction de la situation du contrat.`
                    )
                    .show();
                montantSouhaiteField.classList.remove("is-invalid");
                montantSouhaiteField.classList.add("is-valid");
                // activer le bouton
                btnContratSuivant.disabled = false;
            }
        });
        montantSouhaiteField.addEventListener("blur", function (e) {
            if (e.target.value.trim() !== "") {
                e.target.value = parseInt(
                    e.target.value.replace(/\s/g, ""),
                    10
                ).toLocaleString("fr-FR");
            }
        });
    }


    AutresInfos.addEventListener("input", function () {
        const charLimit = 400; // Limite en caractères
        // Compter le nombre de mots
        const wordCount = AutresInfos.value
            .trim()
            .split(/\s+/)
            .filter((word) => word.length > 0).length;

        $("#totalMot").text(wordCount + " mots saisis");

        const AutresInfosValue = AutresInfos.value;
        const charCount = AutresInfosValue.length; // Compter les caractères
        const remainingChars = charLimit - charCount; // Calculer les caractères restants

        // Mettre à jour le compteur des caractères restants
        $("#totalChar").text(
            remainingChars >= 0
                ? remainingChars + " caractères restants :"
                : 0 + " caractères restants :"
        );
        // Réinitialiser les messages
        countSuccess.text("").hide();
        countError.text("").hide();

        if (charCount === 0) {
            // Pas de texte
            AutresInfos.classList.remove("is-valid", "is-invalid");
        } else if (charCount <= charLimit) {
            // Nombre de caractères valide
            AutresInfos.classList.add("is-valid");
            AutresInfos.classList.remove("is-invalid");
            countSuccess
                .text(`La zone de saisie contient ${charCount} caractères.`)
                .show();
        } else {
            // Bloquer l'entrée de texte si la limite est atteinte
            const truncatedText = AutresInfosValue.substring(0, charLimit); // Tronquer le texte à la limite
            AutresInfos.value = truncatedText;
            AutresInfos.classList.add("is-invalid");
            AutresInfos.classList.remove("is-valid");
            countError
                .text(
                    `Nombre de caractères maximum atteint (${charLimit}). La saisie est bloquée.`
                )
                .show();
        }
    });

    nextButtons.forEach((button) => {
        button.addEventListener("click", async function () {
            const currentContainer = this.closest(".etape, .etapePrest"); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // Vérification des champs de téléphone si présents dans l'étape actuelle
            if (currentContainer.contains(telPaiementField)) {
                if (!validateTelFields()) {
                    alert(
                        "Veuillez vérifier que les numéros de téléphone sont conformes."
                    );
                    return; // Arrêter si les champs de téléphone ne sont pas valides
                }
            }

            // Vérification des champs de IBAN si présents dans l'étape actuelle
            if (currentContainer.contains(ibanPaiementField)) {
                const ibanValue = ibanPaiementField.value.trim();
                if (!validateIbanFields()) {
                    alert("Veuillez vérifier que les informations de paiement sont conformes.");
                    return; // Arrêter si les champs de IBAN ne sont pas valides
                }
            }

            // Vérification du montant souhaité par rapport au capital
            const montantSouhaite = parseFloat(montantSouhaiteField.value) || 0;
            const capital = parseFloat(capitalField.value) || 0;
            const TotalEncaissement =
                parseFloat(TotalEncaissementField.value.replace(/\s/g, "")) ||
                0; // Supprimer les espaces avant conversion
            const moitieCapital = TotalEncaissement * 0.4;
            // const moitieCapital = capital / 2;
            const moitieCapitalFormate = moitieCapital.toLocaleString("fr-FR");

            if (typeprestation_idNotOut.includes(typeprestation_id)) {
                if (montantSouhaite > moitieCapital || montantSouhaite <= 0) {
                    alert(
                        `Selon les termes du contrat, vous ne pouvez pas demander ce montant.`
                    );
                    // alert(
                    //     `Selon les termes du contrat, le montant souhaité doit être supérieur à 0 et inferieur ou égal à ${moitieCapitalFormate} FCFA.`
                    // );
                    msgError
                        .text(
                            `Selon les termes du contrat, vous ne pouvez pas demander ce montant.`
                        )
                        .show();
                    // ajouter une bordure rouge si le montant souhaité est invalide
                    montantSouhaiteField.classList.add("is-invalid");
                    montantSouhaiteField.classList.remove("is-valid");
                    return; // Arrêter si le montant souhaité n'est pas valide
                }
            }
            // Vérification et envoi de l'OTP
            if (
                currentContainer.contains(telPaiementField) &&
                !telPaiementSection.classList.contains("d-none")
            ) {
                const phoneNumber = telPaiementField.value.trim();
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                }
            } else {
                const phoneNumber = telOtpField.value.trim();
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                }
            }

            // Vérification de validation des champs pour l'étape actuelle
            if (validateStep(currentContainer)) {
                // Attendre 1 seconde avant de passer à l'étape suivante si tout est valide
                setTimeout(() => {
                    currentContainer.classList.add("d-none"); // Cacher l'étape actuelle
                    nextStep.classList.remove("d-none"); // Afficher l'étape suivante
                }, 1000); // 1 seconde
            }
        });
    });

    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const currentContainer = this.closest(".etape, .etapePrest"); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add("d-none");
            prevStep.classList.remove("d-none");
        });
    });

    $(document).ready(function () {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $("#single-select-fiel").trigger("change");
    });
    $(document).on("change", "#single-select-fiel", function () {
        const idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné
        const spinner = document.getElementById("spinner"); // Spinner pour l'indicateur de chargement
        const DetailContratBtn = document.getElementById("DetailContratBtn"); // Spinner pour l'indicateur de chargement
        // $("#detailContratModalLabel").text('Selectionnez un contrat pour voir ses details');
        // Désactiver le champ et afficher le spinner
        montantSouhaiteField.disabled = true;
        spinner.style.display = "block";
        DetailContratBtn.style.display = "none";
        if (idcontrat) {
            $.ajax({
                url: "/api/fetch-contract-details", // Route Laravel ghfghfgh
                type: "POST",
                data: {
                    idcontrat: idcontrat,
                    _token: document.querySelector('meta[name="csrf-token"]').content, // Le token CSRF pour sécuriser la requête
                },
                dataType: "json", // Assurez-vous que la réponse attendue est en JSON
                success: function (response) {
                    if (response.status === "success") {
                        const details = response.data.details;
                        // console.log(response.data);
                        if (details && details.length > 0) {
                            // console.log(details);
                            const CapitalSouscrit = parseInt(
                                details[0].CapitalSouscrit
                            );
                            // let totalEncaissement = TotalEncaissement;

                            // console.log("Total Encaissement:", totalEncaissement);
                            var Prime = parseInt(details[0].TotalPrime);
                            const CapitalFormate =
                                CapitalSouscrit.toLocaleString("fr-FR");
                            // var DureeCotisationAns = parseInt(details[0].DureeCotisationAns);
                            $("#Capital").val(CapitalSouscrit);
                            // $("#Produit").text(details[0].produit);
                            $("#Produit").text(
                                "Produit : " + details[0].produit
                            );
                            $("#adher").text(
                                details[0].nomSous + " " + details[0].PrenomSous
                            );
                            $("#idProp").text(details[0].IdProposition);
                            $("#CodeProp").text(details[0].CodeProposition);
                            $("#Codeprop").text(details[0].CodepropositionForm);
                            $("#CodeCons").text(
                                details[0].CodeConseiller +
                                    " - " +
                                    details[0].NomAgent
                            );
                            $("#produitSous").text(details[0].produit);
                            $("#Prime").text(Prime + " FCFA");
                            $("#DateEffet").text(details[0].DateEffetReel);
                            $("#DateFinAdhesion").text(details[0].FinAdhesion);

                            $("#detailContratModalLabel").text(
                                "Information sur le contrat " +
                                    details[0].IdProposition
                            );

                            DetailContratBtn.style.display = "block";
                        } else {
                            console.error(
                                "Aucun détail trouvé pour ce contrat."
                            );
                        }
                    } else {
                        alert("Erreur : " + response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert(
                        "Erreur lors de la récupération des informations du contrat."
                    );
                },
                complete: function () {
                    // Masquer le spinner et activer le champ après la récupération des données
                    spinner.style.display = "none";
                    montantSouhaiteField.disabled = false;
                    DetailContratBtn.style.display = "block";
                },
            });
        } else {
            // Si aucun contrat sélectionné, masquer le spinner et désactiver le champ
            spinner.style.display = "none";
            montantSouhaiteField.disabled = true;
            DetailContratBtn.style.display = "none";
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const OTP_API = document.getElementById("OTP_API").value;
    const steps = document.querySelectorAll(".etapeEdit, .etapeEditPrest"); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll(".next-btn"); // Boutons "Next"
    // const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll(".prev-btn"); // Boutons "Prev"
    const telPaiementField = document.getElementById("TelPaiement");
    const ibanPaiementField = document.getElementById("IBAN");
    let ibanField = document.querySelectorAll(".rib-input");
    // let rib = Array.from(ibanField).map(input => input.value).join('');
    // const confirmIbanPaiementField = document.getElementById('ConfirmIBAN');
    const confirmTelPaiementField =
        document.getElementById("ConfirmTelPaiement");
    const otpContainer = document.getElementById("OTP-edit");
    // const otpContainer = document.getElementById("OTP");
    const resendOtpLink = document.querySelector(".resend-otp-link-edit");
    // const resendOtpLink = document.querySelector(".resend-otp-link");
    // const otpInputs = document.querySelectorAll('.otp-input');
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpTimer = document.createElement("div"); // Timer pour afficher le compte à rebours
    // const montantSouhaite = document.getElementById('montantSouhaite');
    const ibanPaiementSection = document.getElementById("IBANPaiement");
    const telPaiementSection = document.getElementById("TelephonePaiement");

    const operateurInputs = document.querySelectorAll(
        'input[name="Operateur"]'
    );
    const telOtpField = document.getElementById("TelOtp");
    // const telPaiementInput = document.getElementById('TelPaiement');
    // const confirmTelPaiementInput = document.getElementById('ConfirmTelPaiement');

    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll("input, textarea, select"); // Tous les champs de l'étape

        allFields.forEach((field) => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add("is-invalid"); // Ajouter une classe pour indiquer une erreur
                field.classList.remove("is-valid"); // Retirer la classe valide
            } else {
                field.classList.remove("is-invalid"); // Retirer la classe d'erreur
                field.classList.add("is-valid"); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }
    function validateIbanFields() {
        // const ibanPaiementField = document.getElementById('ibanPaiement');
        // const confirmIbanPaiementField = document.getElementById('confirmIbanPaiement');
        const ibanPaiementSection = document.getElementById("IBANPaiement");

        const ibanValue = ibanPaiementField.value.trim();

        // const confirmIbanValue = confirmIbanPaiementField.value.trim();

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!ibanPaiementSection.classList.contains("d-none")) {
            // Réinitialiser les classes d'erreur
            ibanField.forEach((input) => {
                input.classList.remove("is-invalid");
            });
            // ibanPaiementField.classList.remove('is-invalid');
            // confirmIbanPaiementField.classList.remove('is-invalid');

            // Vérification : Les champs ne doivent pas être vides
            if (ibanValue.length == 0) {
                isValid = false;
                // ibanField.classList.add('is-invalid');
                ibanField.forEach((input) => {
                    input.classList.add("is-invalid");
                    input.classList.remove("is-valid");
                });
                // ibanPaiementField.classList.add('is-invalid');
                // confirmIbanPaiementField.classList.add('is-invalid');
                alert("Veuillez saisir Obligatoirement un RIB.");
            }

            // Vérification : Les valeurs doivent correspondre
            else if (ibanValue.length !== 24) {
                isValid = false;
                ibanField.forEach((input) => {
                    if (
                        input.value.length == 0 ||
                        input.value == null ||
                        input.value == undefined ||
                        input.value == " "
                    ) {
                        input.classList.add("is-invalid");
                        input.classList.remove("is-valid");
                    } else {
                        input.classList.remove("is-invalid");
                        input.classList.add("is-valid");
                    }
                });
                // confirmIbanPaiementField.classList.add('is-invalid');
                alert(
                    "Le RIB doit contenir exactement 24 chiffres. Veuillez saisir tous les champs."
                );
            }

            // Si tout est valide, retirer les classes d'erreur
            if (isValid) {
                ibanField.forEach((input) => {
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                });
                // ibanPaiementField.classList.remove('is-invalid');
                // confirmIbanPaiementField.classList.remove('is-invalid');
            }
        }

        return isValid;
    }

    function validateTelFields() {
        const telValue = telPaiementField.value.trim();
        const confirmTelValue = confirmTelPaiementField.value.trim();
        const telPaiementSection = document.getElementById("TelephonePaiement");

        let isValid = true;

        // Vérifier si la section n'est pas masquée
        if (!telPaiementSection.classList.contains("d-none")) {
            // Vérifier si les champs ne sont pas vides
            if (!telValue || !confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add("is-invalid");
                confirmTelPaiementField.classList.add("is-invalid");
            }
            // Vérifier si les valeurs correspondent
            else if (telValue !== confirmTelValue) {
                isValid = false;
                telPaiementField.classList.add("is-invalid");
                confirmTelPaiementField.classList.add("is-invalid");
            } else {
                // Tout est valide, retirer les classes d'erreur
                telPaiementField.classList.remove("is-invalid");
                confirmTelPaiementField.classList.remove("is-invalid");
            }

            // Vérifier le format du numéro (exemple : 10 chiffres)
            const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
            if (!phoneRegex.test(telValue)) {
                isValid = false;
                telPaiementField.classList.add("is-invalid");
            } else {
                telPaiementField.classList.remove("is-invalid");
            }
        }
        return isValid;
    }

   
    async function sendOtp(phone) {
        const phoneNumber = phone.trim();
        // const firstTwoDigits = phone.substring(0, 2); // pour logique opérateur future

        try {
            const response = await fetch(`${OTP_API}api/send-otp`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    telIndicatif: "225",
                    telephone: phoneNumber,
                    operation_type: "Demande de prestation"
                })
            });

            const data = await response.json();

            if (data.status === 200) {
                Swal.fire({
                    icon: "success",
                    title: "Code de confirmation envoyé !",
                    text: `Un code de confirmation a été envoyé sur le numéro ${phoneNumber}`,
                    showConfirmButton: true,
                    confirmButtonText: "OK",
                    timer: 2000
                });
                startOtpTimer(); // Démarre le compte à rebours OTP
                return true;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur s'est produite lors de l'envoi du code de confirmation.",
                });
                return false;
            }
        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: "error",
                title: "Erreur de connexion",
                text: "Impossible de contacter le serveur OTP. Veuillez réessayer.",
            });
            return false;
        }
    }

    // Fonction pour démarrer le compte à rebours pour l'expiration de l'OTP
    let otpExpirationTime = 3 * 60; // 5 minutes en secondes
    let otpInterval;

    function startOtpTimer() {
        otpTimer.classList.add("otp-timer-edit");
        // otpTimer.classList.add("otp-timer");
        otpContainer.appendChild(otpTimer); // Ajouter le timer à l'interface
        updateOtpTimer();

        otpInterval = setInterval(() => {
            otpExpirationTime--;
            updateOtpTimer();

            if (otpExpirationTime <= 0) {
                clearInterval(otpInterval);
                otpTimer.textContent = "Le code de confirmation a expiré.";
                resendOtpLink.classList.remove("d-none"); // Afficher le lien pour renvoyer l'OTP
            }
        }, 1000); // Met à jour chaque seconde
    }

    function updateOtpTimer() {
        const minutes = Math.floor(otpExpirationTime / 60);
        const seconds = otpExpirationTime % 60;
        otpTimer.textContent = `Temps restant: ${minutes}:${
            seconds < 10 ? "0" : ""
        }${seconds}`;
    }

    // Fonction pour renvoyer l'OTP
    resendOtpLink.addEventListener("click", async function () {
        otpExpirationTime = 3 * 60; // Réinitialiser le temps d'expiration
        clearInterval(otpInterval); // Arrêter l'ancien intervalle
        resendOtpLink.classList.add("d-none"); // Cacher le lien pendant l'envoi de l'OTP
        let phoneNumber = null;
        if (telPaiementField.value != null && telPaiementField.value != "") {
            phoneNumber = telPaiementField.value.trim();
        } else {
            phoneNumber = telOtpField.value.trim();
        }
        const otpSent = await sendOtp(phoneNumber);

        if (!otpSent) {
            return; // Arrêter si l'OTP n'a pas pu être envoyé
        }
        // else{
        //     startOtpTimer();
        //     alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
        // }
    });

    const montantSouhaiteField = document.getElementById("montantSouhaite");
    const AutresInfos = document.getElementById("AutresInfos");
    // const capitalField = document.getElementById("Capital");
    // const TotalEncaissementField = document.getElementById("TotalEncaissement");
    // const msgError = $("#msgerror");
    // const msgSuccess = $("#msgesucces");
    const ibanMsgError = $("#ibanMsgError");
    const ibanMsgSuccess = $("#ibanMsgSuccess");
    // const ibanConfirmMsgError = $("#ibanConfirmMsgError");
    // const ibanConfirmMsgSuccess = $("#ibanConfirmMsgSuccess");
    const telMsgError = $("#telMsgError");
    const telMsgSuccess = $("#telMsgSuccess");
    const telConfirmMsgError = $("#telConfirmMsgError");
    const telConfirmMsgSuccess = $("#telConfirmMsgSuccess");
    const countError = $("#counterror");
    const countSuccess = $("#countesucces");
    const btnIbanPaiementSuivant = document.getElementById(
        "btnIbanPaiementSuivant"
    );
    const btnTelPaiementSuivant = document.getElementById(
        "btnTelPaiementSuivant"
    );
    const btnContratSuivant = document.getElementById("btnContratVersMDP");

    btnContratSuivant.disabled = true;

    // Vérification des champs de IBAN si présents dans l'étape actuelle
    if (!ibanPaiementSection.classList.contains("d-none")) {
        // Réinitialisation des messages
        ibanMsgError.text("").hide();
        ibanMsgSuccess.text("").hide();
        btnIbanPaiementSuivant.disabled = true;

        // Fonction pour mettre à jour le champ IBAN
        function updateIBAN() {
            let ibanValue = "";
            ibanField.forEach((input) => {
                ibanValue += input.value;
                if (
                    input.value.length == 0 ||
                    input.value == null ||
                    input.value == undefined ||
                    input.value == " "
                ) {
                    input.classList.add("is-invalid");
                    input.classList.remove("is-valid");
                } else {
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                }
                ibanValue = ibanValue.replace(/[^a-zA-Z0-9]/g, "");
                if (ibanValue.length < 24 || ibanValue.length > 24) {
                    // ibanPaiementField.classList.add('is-invalid');
                    // ibanPaiementField.classList.remove('is-valid');
                    ibanMsgSuccess.text("").hide();
                    ibanMsgError
                        .text(
                            "Le RIB doit contenir exactement 24 caractères. Veuillez saisir tous les champs."
                        )
                        .show();
                    btnIbanPaiementSuivant.disabled = true;
                } else {
                    // ibanPaiementField.classList.remove('is-invalid');
                    // ibanPaiementField.classList.add('is-valid');
                    ibanMsgSuccess.text("Vous pouvez passer au suivant").show();
                    ibanMsgError.text("").hide();
                    btnIbanPaiementSuivant.disabled = false;
                }
            });
            ibanPaiementField.value = ibanValue;
        }

        // Écoute les changements dans chaque champ d'entrée
        ibanField.forEach((input) => {
            input.addEventListener("input", updateIBAN);
        });
    }

    if (!telPaiementSection.classList.contains("d-none")) {
        btnTelPaiementSuivant.disabled = true;
        let selectedOperateur = ""; // Variable pour stocker l'opérateur sélectionné
        // let prefix = operateurInputs.checked
        // ? operateurInputs.value === 'Orange_money' ? '07'
        // : operateurInputs.value === 'Moov_money' ? '01'
        // : operateurInputs.value === 'MTN_money' ? '05'
        // : null
        // : null;
        // Ajouter un écouteur pour chaque input radio
        operateurInputs.forEach((input) => {
            input.addEventListener("change", function () {
                let prefix = "";
                selectedOperateur = this.value; // Mettre à jour l'opérateur sélectionné
                switch (this.value) {
                    case "Orange_money":
                        prefix = "07";
                        break;
                    case "MTN_money":
                        prefix = "05";
                        break;
                    case "Moov_money":
                        prefix = "01";
                        break;
                }
                telPaiementField.addEventListener("input", function (e) {
                    const telValue = e.target.value.trim();
                    let firstTwoDigits = telValue.substring(0, 2); // Extraire les deux premiers chiffres de phone
                    // Réinitialisation des messages
                    telMsgError.text("").hide();
                    telMsgSuccess.text("").hide();

                    if (telValue.length != 10 || firstTwoDigits !== prefix) {
                        telPaiementField.classList.add("is-invalid");
                        telPaiementField.classList.remove("is-valid");
                        telMsgError
                            .text(
                                "Le numéro de téléphone doit avoir 10 caractères et doit commencer par " +
                                    prefix +
                                    "."
                            )
                            .show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        telPaiementField.classList.remove("is-invalid");
                        telPaiementField.classList.add("is-valid");
                        telMsgSuccess
                            .text("Le numéro de téléphone est valide.")
                            .show();
                        // btnTelPaiementSuivant.disabled = false;
                    }
                });

                confirmTelPaiementField.addEventListener("input", function (e) {
                    const confirmTel = e.target.value.trim();
                    const telValue = telPaiementField.value.trim();
                    telConfirmMsgError.text("").hide();
                    telConfirmMsgSuccess.text("").hide();

                    if (confirmTel !== telValue || confirmTel.length !== 10) {
                        confirmTelPaiementField.classList.add("is-invalid");
                        confirmTelPaiementField.classList.remove("is-valid");
                        telConfirmMsgError
                            .text(
                                "Le numéro de téléphone de confirmation est ne correspond pas."
                            )
                            .show();
                        btnTelPaiementSuivant.disabled = true;
                    } else {
                        confirmTelPaiementField.classList.remove("is-invalid");
                        confirmTelPaiementField.classList.add("is-valid");
                        telConfirmMsgSuccess
                            .text(
                                "Le numéro de téléphone de confirmation est correct."
                            )
                            .show();
                        btnTelPaiementSuivant.disabled = false;
                    }
                });
            });
        });
    }

    if(montantSouhaiteField.value.trim() !== "") {
        // montantSouhaiteField.value = parseInt(montantSouhaiteField.value.replace(/\s/g, ''), 10).toLocaleString('fr-FR');
         // activer le bouton
         btnContratSuivant.disabled = false;
    }

    
    AutresInfos.addEventListener("input", function () {
        const charLimit = 400; // Limite en caractères
        // Compter le nombre de mots
        const wordCount = AutresInfos.value
            .trim()
            .split(/\s+/)
            .filter((word) => word.length > 0).length;

        $("#totalMot").text(wordCount + " mots saisis");

        const AutresInfosValue = AutresInfos.value;
        const charCount = AutresInfosValue.length; // Compter les caractères
        const remainingChars = charLimit - charCount; // Calculer les caractères restants

        // Mettre à jour le compteur des caractères restants
        $("#totalChar").text(
            remainingChars >= 0
                ? remainingChars + " caractères restants :"
                : 0 + " caractères restants :"
        );
        // Réinitialiser les messages
        countSuccess.text("").hide();
        countError.text("").hide();

        if (charCount === 0) {
            // Pas de texte
            AutresInfos.classList.remove("is-valid", "is-invalid");
        } else if (charCount <= charLimit) {
            // Nombre de caractères valide
            AutresInfos.classList.add("is-valid");
            AutresInfos.classList.remove("is-invalid");
            countSuccess
                .text(`La zone de saisie contient ${charCount} caractères.`)
                .show();
        } else {
            // Bloquer l'entrée de texte si la limite est atteinte
            const truncatedText = AutresInfosValue.substring(0, charLimit); // Tronquer le texte à la limite
            AutresInfos.value = truncatedText;
            AutresInfos.classList.add("is-invalid");
            AutresInfos.classList.remove("is-valid");
            countError
                .text(
                    `Nombre de caractères maximum atteint (${charLimit}). La saisie est bloquée.`
                )
                .show();
        }
    });

    nextButtons.forEach((button) => {
        button.addEventListener("click", async function () {
            const currentContainer = this.closest(".etapeEdit, .etapeEditPrest"); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // Vérification des champs de téléphone si présents dans l'étape actuelle
            if (currentContainer.contains(telPaiementField)) {
                if (!validateTelFields()) {
                    alert(
                        "Veuillez vérifier que les numéros de téléphone sont conformes."
                    );
                    return; // Arrêter si les champs de téléphone ne sont pas valides
                }
            }

            // Vérification des champs de IBAN si présents dans l'étape actuelle
            if (currentContainer.contains(ibanPaiementField)) {
                const ibanValue = ibanPaiementField.value.trim();
                if (!validateIbanFields()) {
                    alert("Veuillez vérifier que les IBAN sont conformes.");
                    return; // Arrêter si les champs de IBAN ne sont pas valides
                }
            }

            
            // Vérification et envoi de l'OTP
            if (
                currentContainer.contains(telPaiementField) &&
                !telPaiementSection.classList.contains("d-none")
            ) {
                const phoneNumber = telPaiementField.value.trim();
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                }
            } else {
                const phoneNumber = telOtpField.value.trim();
                console.log("phoneNumber = ", phoneNumber);
                // si tous les champs required ne sont pas renseignés bloqué l'envoi de l'OTP
                if (!validateStep(currentContainer)) {
                    return;
                } else {
                    const otpSent = await sendOtp(phoneNumber);

                    if (!otpSent) {
                        return; // Arrêter si l'OTP n'a pas pu être envoyé
                    }
                }
            }

            // Vérification de validation des champs pour l'étape actuelle
            if (validateStep(currentContainer)) {
                // Attendre 1 seconde avant de passer à l'étape suivante si tout est valide
                setTimeout(() => {
                    currentContainer.classList.add("d-none"); // Cacher l'étape actuelle
                    nextStep.classList.remove("d-none"); // Afficher l'étape suivante
                }, 1000); // 1 seconde
            }
        });
    });

    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const currentContainer = this.closest(".etapeEdit, .etapeEditPrest"); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add("d-none");
            prevStep.classList.remove("d-none");
        });
    });

    $(document).ready(function () {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $("#idcontratEdit").trigger("change");
    });
    $(document).on("change", "#idcontratEdit", function () {
        const idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné
        const spinner = document.getElementById("spinner"); // Spinner pour l'indicateur de chargement
        const DetailContratBtn = document.getElementById("DetailContratBtn"); // Spinner pour l'indicateur de chargement
        // $("#detailContratModalLabel").text('Selectionnez un contrat pour voir ses details');
        // Désactiver le champ et afficher le spinner
        montantSouhaiteField.disabled = true;
        spinner.style.display = "block";
        DetailContratBtn.style.display = "none";
        if (idcontrat) {
            $.ajax({
                url: "/api/fetch-contract-details", // Route Laravel
                type: "POST",
                data: {
                    idcontrat: idcontrat,
                    _token: document.querySelector('meta[name="csrf-token"]').content, // Le token CSRF pour sécuriser la requête
                },
                dataType: "json", // Assurez-vous que la réponse attendue est en JSON
                success: function (response) {
                    if (response.status === "success") {
                        const details = response.data.details;
                        console.log(response.data);
                        if (details && details.length > 0) {
                            // console.log(details);
                            const CapitalSouscrit = parseInt(
                                details[0].CapitalSouscrit
                            );
                            // let totalEncaissement = TotalEncaissement;

                            // console.log("Total Encaissement:", totalEncaissement);
                            var Prime = parseInt(details[0].TotalPrime);
                            const CapitalFormate =
                                CapitalSouscrit.toLocaleString("fr-FR");
                            // var DureeCotisationAns = parseInt(details[0].DureeCotisationAns);
                            $("#Capital").val(CapitalSouscrit);
                            // $("#Produit").text(details[0].produit);
                            $("#Produit").text(
                                "Produit : " + details[0].produit
                            );
                            $("#adher").text(
                                details[0].nomSous + " " + details[0].PrenomSous
                            );
                            $("#idProp").text(details[0].IdProposition);
                            $("#CodeProp").text(details[0].CodeProposition);
                            $("#Codeprop").text(details[0].CodepropositionForm);
                            $("#CodeCons").text(
                                details[0].CodeConseiller +
                                    " - " +
                                    details[0].NomAgent
                            );
                            $("#produitSous").text(details[0].produit);
                            $("#Prime").text(Prime + " FCFA");
                            $("#DateEffet").text(details[0].DateEffetReel);
                            $("#DateFinAdhesion").text(details[0].FinAdhesion);

                            $("#detailContratModalLabel").text(
                                "Information sur le contrat " +
                                    details[0].IdProposition
                            );

                            DetailContratBtn.style.display = "block";
                        } else {
                            console.error(
                                "Aucun détail trouvé pour ce contrat."
                            );
                        }
                    } else {
                        alert("Erreur : " + response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert(
                        "Erreur lors de la récupération des informations du contrat."
                    );
                },
                complete: function () {
                    // Masquer le spinner et activer le champ après la récupération des données
                    spinner.style.display = "none";
                    montantSouhaiteField.disabled = false;
                    DetailContratBtn.style.display = "block";
                },
            });
        } else {
            // Si aucun contrat sélectionné, masquer le spinner et désactiver le champ
            spinner.style.display = "none";
            montantSouhaiteField.disabled = true;
            DetailContratBtn.style.display = "none";
        }
    });

});

document.addEventListener("DOMContentLoaded", function () {
    // const selectLieuRDV = document.getElementById('single-select-optgroup-field');
    const selectLieuRDV = document.getElementById("idTblBureau");
    const inputDateRDV = document.getElementById("daterdv");
    const selectOptionsRdv = document.getElementById("optionsRdv");
    const spinner = document.getElementById("spinner");
    const spinnerDaterdv = document.getElementById("spinnerDaterdv");

    inputDateRDV.disabled = true;
    // selectLieuRDV.addEventListener('change', function() {
    //   if (this.value !== '') {
    //     inputDateRDV.disabled = false;
    //     selectOptionsRdv.disabled = false;
    //   } else {
    //     inputDateRDV.disabled = true;
    //     selectOptionsRdv.disabled = true;
    //   }
    // });

    $(document).ready(function () {
        var availableOptions = []; // Un tableau pour stocker les options de RDV disponibles
        var availableOptions = []; // Tableau pour stocker les options de RDV disponibles

        $("#idTblBureau").on("change", function () {
            var id = $(this).val();
            if (spinner) {
                spinner.style.display = "block";
            }
            $.ajax({
                type: "GET",
                url: "/rdv/optionDate/" + id,
                dataType: "json",
                success: function (data) {
                    if (data.status === "success" && data.data.length > 0) {
                        var jmax = "";
                        var lieu = "";
                        var jours = [];
                        availableOptions = []; // Réinitialiser les options disponibles
                        // Boucle à travers les données reçues
                        $.each(data.data, function (index, villeReseau) {
                            lieu =
                                villeReseau.libelleVilleBureau ||
                                "Lieu inconnu"; // Récupérer le nom du lieu
                            $.each(
                                villeReseau.option_rdv,
                                function (index, optionRdv) {
                                    // Sauvegarder les options dans un tableau
                                    availableOptions.push({
                                        codejour: optionRdv.codejour,
                                        codelieu: optionRdv.codelieu,
                                        nbmax: optionRdv.nbmax,
                                    });

                                    // Générer les options pour l'élément #optionsRdv
                                    jmax +=
                                        '<option value="' +
                                        optionRdv.nbmax +
                                        '">' +
                                        optionRdv.jour +
                                        "</option>";
                                    jours.push(optionRdv.jour); // Ajouter le jour à la liste des jours disponibles
                                }
                            );
                        });

                        // Mettre à jour les champs HTML
                        $("#optionsRdv").html(jmax); // Liste des options
                        $("#lieurdv").text(lieu); // Nom du lieu
                        $("#jourRdv").text(jours.join(" - ")); // Liste des jours disponibles
                        inputDateRDV.disabled = false;
                        if (spinner) {
                            spinner.style.display = "none";
                        }
                    } else {
                        alert(
                            "Aucune information disponible pour ce lieu de RDV."
                        );
                        $("#lieurdv").text(""); // Réinitialiser le lieu
                        $("#jourRdv").text(""); // Réinitialiser les jours
                    }
                    if (spinner) {
                        spinner.style.display = "none";
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erreur AJAX : ", xhr.responseText);
                    alert(
                        "Une erreur est survenue lors de la récupération des données."
                    );
                    $("#lieurdv").text(""); // Réinitialiser le lieu
                    $("#jourRdv").text(""); // Réinitialiser les jours
                    if (spinner) {
                        spinner.style.display = "none";
                    }
                },
            });
        });

        $("#daterdv").on("change", function () {
            var idTblBureau = $("#idTblBureau").val();
            var daterdv = $(this).val(); // Exemple : 10/12/2024
            // Réinitialiser les messages à chaque changement
            $("#msgerror").text("").hide(); // Masquer le message d'erreur
            $("#msgesucces").text("").hide(); // Masquer le message de succès
            if (spinnerDaterdv) {
                spinnerDaterdv.style.display = "block";
            }
            if (daterdv) {
                // Conversion de la date au format JavaScript
                var parts = daterdv.split("-"); // Supposons que le format est d/m/Y
                var dateObj = new Date(parts[2], parts[1] - 1, parts[0]); // Année, mois (0-indexé), jour

                // Vérification si la date est un samedi (6) ou un dimanche (0)
                var day = dateObj.getDay();
                if (day === 0 || day === 6) {
                    alert(
                        "Les rendez-vous ne peuvent pas être pris le week-end ou les jours fériés. Veuillez sélectionner un jour en semaine."
                    );
                    $('input[name="daterdv"]').val("");
                    $("#msgerror")
                        .text(
                            "Les rendez-vous ne peuvent pas être pris le week-end ou les jours fériés. Veuillez sélectionner un jour en semaine."
                        )
                        .show();
                    return; // Arrête l'exécution
                }
            }

            if (idTblBureau && daterdv) {
                // Filtrage des options disponibles pour la date sélectionnée
                var availableForDate = availableOptions.filter(function (
                    option
                ) {
                    return (
                        option.codelieu == idTblBureau &&
                        parseInt(option.codejour) === dateObj.getDay()
                    );
                });

                if (availableForDate.length > 0) {
                    // Si des options sont disponibles pour la date et le lieu
                    $.each(availableForDate, function (index, option) {
                        var Nbmax = parseInt(option.nbmax);

                        // Vérification de la disponibilité des places
                        $.ajax({
                            type: "GET",
                            url: "/rdv/getRdv",
                            data: {
                                idTblBureau: idTblBureau,
                                daterdv: daterdv,
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.status === "success") {
                                    var orderInsert = parseInt(
                                        data.data.orderInsert
                                    );
                                    if (orderInsert >= Nbmax) {
                                        alert(
                                            "Plus de places disponibles à cette date."
                                        );
                                        $('input[name="daterdv"]').val("");
                                        $("#msgerror")
                                            .text(
                                                "Plus de places disponibles à cette date."
                                            )
                                            .show();
                                        return;
                                    } else {
                                        var remainingSlots =
                                            Nbmax - orderInsert;
                                        $("#msgesucces")
                                            .text(
                                                "Il reste " +
                                                    remainingSlots +
                                                    " place(s) à cette date."
                                            )
                                            .show();
                                    }
                                } else {
                                    $("#msgesucces")
                                        .text(
                                            "Il reste " +
                                                Nbmax +
                                                " place(s) à cette date."
                                        )
                                        .show();
                                }
                                if (spinnerDaterdv) {
                                    spinnerDaterdv.style.display = "none";
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(
                                    "Erreur AJAX : ",
                                    xhr.responseText
                                );
                                alert(
                                    "Erreur lors de la vérification de la disponibilité."
                                );
                                $('input[name="daterdv"]').val("");
                                if (spinnerDaterdv) {
                                    spinnerDaterdv.style.display = "none";
                                }
                            },
                        });
                    });
                } else {
                    alert(
                        "Cette date n'est pas disponible pour ce lieu de RDV. Veuillez choisir une autre."
                    );
                    $('input[name="daterdv"]').val("");
                    $("#msgerror")
                        .text(
                            "Cette date n'est pas disponible pour ce lieu de RDV. Veuillez choisir une autre."
                        )
                        .show();
                    if (spinnerDaterdv) {
                        spinnerDaterdv.style.display = "none";
                    }
                }
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Bouton pour passer à l'étape suivante
    document
        .querySelector(".next-step-btn")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Empêche l'action par défaut du bouton

            // Valider tous les champs de l'étape actuelle
            if (validateStep1()) {
                // Si les champs sont valides, attendre 2 secondes avant de passer à l'étape suivante
                setTimeout(() => {
                    stepper1.next();
                }, 1000); // 1 seconde
            }
        });

    // Fonction pour valider tous les champs de l'étape
    function validateStep1() {
        const inputs = document.querySelectorAll(".etape input"); // Sélectionner tous les champs dans l'étape actuelle
        let isValid = true;

        inputs.forEach((input) => {
            if (input.hasAttribute("required") && !input.value.trim()) {
                // Si le champ est requis et vide, afficher le message d'erreur et la bordure rouge
                input.classList.add("is-invalid");
                input.classList.remove("is-valid");
                isValid = false;
            } else {
                // Si le champ est valide (ou non requis mais rempli), ajouter une bordure verte
                input.classList.remove("is-invalid");
                input.classList.add("is-valid");
            }
        });

        return isValid;
    }
});


document.addEventListener("DOMContentLoaded", function () {

    // Bouton pour passer à l'étape suivante
    document.querySelector(".next-step-btnEdit")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Empêche l'action par défaut du bouton

            // Valider tous les champs de l'étape actuelle
            if (validateStep1()) {
                // Si les champs sont valides, attendre 2 secondes avant de passer à l'étape suivante
                
                setTimeout(() => {
                    stepper1.next();
                }, 1000); // 1 seconde
            }
        });

    // Fonction pour valider tous les champs de l'étape
    function validateStep1() {
        const inputs = document.querySelectorAll(".etapeEdit input"); // Sélectionner tous les champs dans l'étape actuelle
        let isValid = true;

        inputs.forEach((input) => {
            if (input.hasAttribute("required") && !input.value.trim()) {
                // Si le champ est requis et vide, afficher le message d'erreur et la bordure rouge
                input.classList.add("is-invalid");
                input.classList.remove("is-valid");
                isValid = false;
            } else {
                // Si le champ est valide (ou non requis mais rempli), ajouter une bordure verte
                input.classList.remove("is-invalid");
                input.classList.add("is-valid");
            }
        });

        return isValid;
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner le lien "Supprimer mon choix"
    const clearChoiceLink = document.getElementById("clearChoise");

    // Boutons à masquer après réinitialisation
    const nextButtons = [
        // document.getElementById('next-stepper3'),
        document.getElementById("nextPhone"),
    ];

    // Ajouter un gestionnaire d'événements au clic
    clearChoiceLink.addEventListener("click", function () {
        // Sélectionner tous les boutons radio avec le nom "Operateur"
        const Operateur = document.querySelectorAll('input[name="Operateur"]');
        const moyenPaiement = document.querySelectorAll(
            'input[name="moyenPaiement"]'
        );

        // Parcourir les boutons radio et les désélectionner
        Operateur.forEach((radio) => {
            radio.checked = false;
        });
        moyenPaiement.forEach((radio) => {
            radio.checked = false;
        });

        // Masquer les boutons concernés
        nextButtons.forEach((button) => {
            button.style.display = "none"; // Masquer le bouton
        });

        // Optionnel : Ajouter un effet visuel ou un message si nécessaire
        console.log("Choix réinitialisé, boutons masqués.");
    });

    // Afficher les boutons si une option est sélectionnée
    const OperateurInputs = document.querySelectorAll(
        'input[name="Operateur"]'
    );
    OperateurInputs.forEach((input) => {
        input.addEventListener("change", function () {
            // Vérifier si un opérateur est sélectionné
            const selected = Array.from(OperateurInputs).some(
                (radio) => radio.checked
            );

            // Afficher ou masquer les boutons en conséquence
            nextButtons.forEach((button) => {
                button.style.display = selected ? "inline-block" : "none";
            });
        });
    });
});

// document.addEventListener("DOMContentLoaded", function () {
//     const ibanPaiementField = document.getElementById("IBAN");
// });


document.addEventListener("DOMContentLoaded", function () {

    const OTP_API = document.getElementById("OTP_API").value;
    // Initialisation du timer
    // let otpTimer = document.getElementById('otp-timer');
    // let timeLeft = 5 * 60; // 5 minutes en secondes
    let otpInputs = document.querySelectorAll(".otp-input");
    // let resendOtpLink = document.querySelector('.resend-otp-link');
    let nextStepBtn = document.querySelector(".next-step-btn2");

    // Écouter les entrées OTP
    otpInputs.forEach((input, index) => {
        input.addEventListener("input", function () {
            if (this.value.length === this.maxLength) {
                // Passer à l'entrée suivante
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            }
        });
    });

    // Fonction pour envoyer l'OTP au serveur pour validation
    function sendOtpVerification() {
        let otp = Array.from(otpInputs)
            .map((input) => input.value)
            .join("");
        let telPaiementField = document.getElementById("TelPaiement");
        let TelOtp = document.getElementById("TelOtp");
        let phone = null;
        if (telPaiementField.value != null && telPaiementField.value != "") {
            phone = telPaiementField.value.trim();
        } else {
            phone = TelOtp.value.trim();
        }
        let phoneNumber = "225" + phone;

        fetch(`${OTP_API}api/verify-otp`, {
        // fetch("/api/verify-otp", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                telephone: phoneNumber,
                otp: otp,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    // L'OTP est valide, on passe à l'étape suivante
                    nextStepBtn.disabled = false; // Activer le bouton "Suivant"
                    otpInputs.forEach((input) => {
                        input.classList.remove("is-invalid");
                        input.classList.add("is-valid"); // Ajouter une bordure verte
                    });
                    swal.fire({
                        icon: "success",
                        title: "Votre numéro de téléphone a été vérifié avec succès.",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    // Passer à l'étape suivante après un délai d'une seconde
                    setTimeout(() => {
                        stepper1.next();
                    }, 1000);
                } else {
                    // L'OTP est invalide
                    // nextStepBtn.disabled = true; // Désactiver le bouton "Suivant"
                    otpInputs.forEach((input) => {
                        input.classList.remove("is-valid");
                        input.classList.add("is-invalid"); // Ajouter une bordure rouge
                        input.value = "";
                    });
                    swal.fire({
                        icon: "error",
                        title: "Le code de vérification est invalide ou a expiré.",
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    // alert("Le code de vérification est invalide ou a expiré.");
                }
            })
            .catch((error) => {
                console.error(
                    "Erreur lors de la vérification de l'OTP:",
                    error
                );
            });
    }

    // Gestion du clic sur "Suivant" pour vérifier l'OTP
    nextStepBtn.addEventListener("click", function () {
        sendOtpVerification();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const OTP_API = document.getElementById("OTP_API").value;
    // Initialisation du timer
    // let otpTimer = document.getElementById('otp-timer');
    // let timeLeft = 5 * 60; // 5 minutes en secondes
    let otpInputs = document.querySelectorAll(".otp-input");
    // let resendOtpLink = document.querySelector('.resend-otp-link');
    let nextStepBtn = document.querySelector(".next-step-btnEdit2");

    // Écouter les entrées OTP
    otpInputs.forEach((input, index) => {
        input.addEventListener("input", function () {
            if (this.value.length === this.maxLength) {
                // Passer à l'entrée suivante
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            }
        });
    });

    // Fonction pour envoyer l'OTP au serveur pour validation
    function sendOtpVerification() {
        let otp = Array.from(otpInputs)
            .map((input) => input.value)
            .join("");
        let telPaiementField = document.getElementById("TelPaiement");
        let TelOtp = document.getElementById("TelOtp");
        let phone = null;
        if (telPaiementField.value != null && telPaiementField.value != "") {
            phone = telPaiementField.value.trim();
        } else {
            phone = TelOtp.value.trim();
        }
        let phoneNumber = "225" + phone;

        fetch(`${OTP_API}api/verify-otp`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                telephone: phoneNumber,
                otp: otp,
                
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    // L'OTP est valide, on passe à l'étape suivante
                    nextStepBtn.disabled = false; // Activer le bouton "Suivant"
                    otpInputs.forEach((input) => {
                        input.classList.remove("is-invalid");
                        input.classList.add("is-valid"); // Ajouter une bordure verte
                    });
                    swal.fire({
                        icon: "success",
                        title: "Votre numéro de téléphone a été vérifié avec succès.",
                        showConfirmButton: false,
                        timer: 1500,
                    })

                    // Passer à l'étape suivante après un délai d'une seconde
                    setTimeout(() => {
                        stepper1.next();
                    }, 1000);
                } else {
                    // L'OTP est invalide
                    // nextStepBtn.disabled = true; // Désactiver le bouton "Suivant"
                    otpInputs.forEach((input) => {
                        input.classList.remove("is-valid");
                        input.classList.add("is-invalid"); // Ajouter une bordure rouge
                        input.value = "";
                    });
                    swal.fire({
                        icon: "error",
                        title: "Le code de vérification est invalide ou a expiré.",
                        showConfirmButton: false,
                        timer: 1500,
                    })
                }
            })
            .catch((error) => {
                console.error(
                    "Erreur lors de la vérification de l'OTP:",
                    error
                );
            });
    }

    // Gestion du clic sur "Suivant" pour vérifier l'OTP
    nextStepBtn.addEventListener("click", function () {
        sendOtpVerification();
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const moyenPaiementInputs = document.querySelectorAll('input[name="moyenPaiement"]');
    const operateurSection = document.getElementById('Operateur');
    const telPaiementSection = document.getElementById('TelephonePaiement');
    const otpSection = document.querySelector('.otp-container');
    const ibanPaiementSection = document.getElementById('IBANPaiement');
    const nextBtn = document.querySelector('#nextPhone'); // Bouton "next" spécifique pour Mobile Money
    const operateurInputs = document.querySelectorAll('input[name="Operateur"]');

    moyenPaiementInputs.forEach(input => {
        input.addEventListener('change', function () {
            if (input.value === "Mobile_Money") {
                // Afficher les sections Mobile Money
                operateurSection.classList.remove('d-none');
                telPaiementSection.classList.remove('d-none');
                // otpSection.parentElement.classList.remove('d-none');
                ibanPaiementSection.classList.add('d-none'); // Cacher IBAN

                // Ajouter les attributs requis
                setRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement', 'FicheID-file-uploa', 'AttestationClotureCompte-file-uploa']);
                setRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);
                removeRequired(['IBAN', 'ConfirmIBAN', 'RIB-file-uploa']);

                // Vérifier la sélection d'un opérateur
                toggleNextBtn();
            } else if (input.value === "Virement_Bancaire") {
                // Afficher la section IBAN
                ibanPaiementSection.classList.remove('d-none');
                operateurSection.classList.add('d-none'); // Cacher opérateur
                telPaiementSection.classList.add('d-none'); // Cacher téléphone
                // otpSection.parentElement.classList.remove('d-none'); // Cacher OTP

                // Ajouter les attributs requis
                setRequired(['IBAN', 'ConfirmIBAN', 'RIB-file-uploa']);
                removeRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement', 'FicheID-file-uploa', 'AttestationClotureCompte-file-uploa']);
                // removeRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);
                setRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);

                // Masquer le bouton "next" pour Mobile Money
                nextBtn.classList.add('d-none');
            }
        });
    });

    // Vérifier si un opérateur est sélectionné pour afficher/masquer le bouton
    operateurInputs.forEach(input => {
        input.addEventListener('change', toggleNextBtn);
    });

    function toggleNextBtn() {
        const isSelected = Array.from(operateurInputs).some(input => input.checked);
        if (isSelected) {
            nextBtn.classList.remove('d-none');
        } else {
            nextBtn.classList.add('d-none');
        }
    }

    // Fonctions pour gérer les champs requis
    function setRequired(fields) {
        fields.forEach(id => {
            const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
            if (field) field.setAttribute('required', true);
        });
    }

    function removeRequired(fields) {
        fields.forEach(id => {
            const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
            if (field) field.removeAttribute('required');
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const mobileMoneyCheckbox = document.getElementById("mobileMoney");
    const virementBancaireCheckbox =
        document.getElementById("virementBancaire");
    // IDs des éléments à afficher ou masquer
    const elementsMobileMoney = [
        "Operateur",
        "Operateur-btn",
        "TelephonePaiement",
        "btn-TelephonePaiement",
        "FicheIDNum",
        "btnTelPaiementSuivant",
        "AttestationClotureCompte"
    ];
    const elementsVirementBancaire = [
        "next-stepper4",
        "IBANPaiement",
        "btn-IBANPaiement",
        "RIB-file",
        "prev-btnPrest1",
        "btnIbanPaiementSuivant",
    ];

    function toggleElements() {
        // Vérifie les cases cochées
        const isMobileMoneyChecked = mobileMoneyCheckbox.checked;
        const isVirementBancaireChecked = virementBancaireCheckbox.checked;

        // Logique d'affichage et masquage
        if (isMobileMoneyChecked && isVirementBancaireChecked) {
            // Afficher les éléments pour les deux options
            showElements(elementsMobileMoney.concat(["IBANPaiement"]));
            hideElements(["next-stepper4", "btn-IBANPaiement"]);
        } else if (isMobileMoneyChecked) {
            // Afficher uniquement pour Mobile Money
            showElements(elementsMobileMoney);
            hideElements(elementsVirementBancaire);
        } else if (isVirementBancaireChecked) {
            // Afficher uniquement pour Virement Bancaire
            showElements(elementsVirementBancaire);
            hideElements(elementsMobileMoney);
        } else {
            // Si aucune option n'est cochée, tout est masqué
            hideElements(elementsMobileMoney.concat(elementsVirementBancaire));
        }
    }

    // Fonction pour afficher des éléments
    function showElements(ids) {
        ids.forEach((id) => {
            const element = document.getElementById(id);
            if (element) {
                element.classList.remove("d-none");
            }
        });
    }

    // Fonction pour masquer des éléments
    function hideElements(ids) {
        ids.forEach((id) => {
            const element = document.getElementById(id);
            if (element) {
                element.classList.add("d-none");
            }
        });
    }

    // Ajoute les écouteurs d'événements
    mobileMoneyCheckbox.addEventListener("change", toggleElements);
    virementBancaireCheckbox.addEventListener("change", toggleElements);

    // Appelle la fonction une première fois pour gérer l'état initial
    toggleElements();
});



