$(".wrapper").on('click', '.deleteConfirmation', function () {
    var type = $(this).data('type');
    var title = $(this).data('title');
    var message = $(this).data('message');
    var id = $(this).data('id');
    var uuid = $(this).data('uuid');
    var token = $(this).data('token');
    var url = $(this).data('url');
    var urlback = $(this).data('urlback');
    var param = $(this).data('param');
    var param2 = $(this).data('param2');
    var param3 = $(this).data('param3');
    showConfirm_submit(id, uuid, token, url, title, message, param, param2, param3, urlback);
});

function notifier(type, message) {
    Lobibox.notify(type, {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: message
	});
}

function showConfirm_submit(id, uuid, token, url, title, message, param, param2, param3, urlback) {
    Swal.fire({
            title: title,
            text: message,
            icon: "warning",
            buttons: true,
            dangerMode: true,

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, continuer !',
            cancelButtonText: 'Annuler',
            confirmButtonClass: 'btn btn-warning',
            cancelButtonClass: 'btn btn-danger ml-1',
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id,
                        uuid: uuid,
                        _token: token,
                        param: param,
                        param2: param2,
                        urlback: urlback
                    },
                    dataType: "json",

                    beforeSend: function () { // if form submit
                        Swal.fire({
                            title: "En cours de traitement...",
                            text: "Patientez un instant",
                            imageUrl: "/assets/img/images/loading.gif",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function (data) {
                        if (data.type === "success") { //if formData forme is very good
                            // Swal.fire(data.message, {
                            //     icon: "success"
                            // });
                            // window.location.href =data.urlback;
                            sendSuccess(data.title, data.message, data.urlback);

                        } else {
                            Swal.fire(data.message, {});
                        }
                    },
                    error: function (data) {
                        if (data.type === "error") { // if error occured
                            Swal.fire(data.message, {});
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                /*Swal.fire({
                    title: 'Cancelled',
                    text: 'Your imaginary file is safe :)',
                    type: 'error',
                    confirmButtonClass: 'btn btn-success',
                })*/
            }

        });
}

function loading() {
    Swal.fire({
        // title: "En cours de traitement...",
        text: "Traitement en cours",
        imageUrl: "/assets/root/images/loading.gif",
        imageWidth: 50,
        imageHeight: 50,
        showConfirmButton: false,
        allowOutsideClick: true
    });
}

//debut fonction sendSuccess
function sendSuccess(title, message, urlback = '') { // retour en cas de success d'envoi de formulaire
    if (urlback != '') {
        if (urlback == 'back') {
            //Si url de retour exist
            Swal.fire({
                icon: 'success',
                //title: title,
                text: message,
                showConfirmButton: false,
                timer: 3000
            });
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            //Si url de retour exist
            Swal.fire({
                icon: 'success',
                //title: title,
                text: message,
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(() => {
                window.location.href = urlback;
            }, 2000);
        }
    } else {
        //Si url de retour exist pas dans le retour du formulaire
        Swal.fire({
            icon: 'success',
            //title: title,
            text: message,
            showConfirmButton: true,
            // timer: 2000
        })
        $('.sendForm')[0].reset();
    }
}

function SendError(title, messageError) { //fonction pour envoi de formulaire chargement loading
    Swal.fire({
        icon: 'error',
        title: title,
        text: messageError,
        confirmButtonText: 'FERMER'
    })
} //fin de la focntion SendError


$(".wrapper").on('submit', '.submitForm', function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var formData = new FormData(this);

    $.ajax({
        url: action,
        type: 'POST',
        data: formData,
        async: false,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () { // if form submit
            loading();
        },
        success: function (data) {
            if (data.type == "success") { //if formData forme is very good
                sendSuccess(data.title, data.message, data.urlback);
            } else {
                SendError(data.title, data.message);
            }
        },
        error: function (data) {
            if (data.type == "error") { // if error occured
                SendError("messageError");
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


// document.querySelectorAll('input[name="modepaiement"]').forEach((radio) => {
//     radio.addEventListener('change', function () {
//         const modeBancaire = document.getElementById('mode_bancaire');
        
//         // Vérifie si "Virement bancaire" ou "Prélèvement à la source" est sélectionné
//         if (this.value === 'Virement_bancaire' || this.value === 'Prelvement_source') {
//             modeBancaire.style.display = 'block';
//         } else {
//             modeBancaire.style.display = 'none';
//         }
//     });
// });

    document.addEventListener('DOMContentLoaded', function () {
        const modePaiementRadios = document.querySelectorAll('input[name="modepaiement"]');
        const modeBancaire = document.getElementById('mode_bancaire');
        const modeSource = document.getElementById('mode_source');
        const modeMobile = document.getElementById('mode_mobile');

        // Fonction pour afficher ou masquer le bloc "mode_bancaire"
        function toggleModeBancaire() {
            const selectedRadio = document.querySelector('input[name="modepaiement"]:checked');
            if (selectedRadio && (selectedRadio.value === 'VIR' || selectedRadio.value === 'BANK')) {
                modeBancaire.style.display = 'block';
                modeSource.style.display = 'none';
            }else if (selectedRadio && (selectedRadio.value === 'SOURCE')) {
                modeSource.style.display = 'block';
                modeBancaire.style.display = 'none';
            } else {
                modeBancaire.style.display = 'none';
                modeSource.style.display = 'none';
            }
        }

        // Vérifier l'état initial au chargement de la page
        toggleModeBancaire();

        // Ajouter un gestionnaire d'événement pour les changements
        modePaiementRadios.forEach((radio) => {
            radio.addEventListener('change', toggleModeBancaire);
        });
    });

    document.querySelectorAll('input[name="modepaiement"]').forEach((radio) => {
        radio.addEventListener('change', function () {
            const modeMobile = document.getElementById('mode_mobile');
            
            // Vérifie si "paiement mobile" est sélectionné
            if (this.value === 'Mobile_money') {
                modeMobile.style.display = 'block';
            } else {
                modeMobile.style.display = 'none';
            }
        });
    });
    // window.onload = function() {
    //     const today = new Date();
    //     const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
    //     const dateEffet = document.getElementById('DateEffet');
    //     dateEffet.value = nextMonth.toISOString().split('T')[0];
    // }

    window.onload = function() {
        const today = new Date();
        const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
        const dateEffet = document.getElementById('DateEffet');
        dateEffet.value = nextMonth.toISOString().split('T')[0]; // Format YYYY-MM-DD

        // Mettre à jour l'affichage avec la valeur initiale
        const displayDateEffet = document.getElementById('displayDateEffet');
        displayDateEffet.textContent = dateEffet.value; // Affiche la valeur initiale
    }

    // Écouteur d'événement pour mettre à jour l'affichage lors du changement de valeur
    document.getElementById('DateEffet').addEventListener('change', function() {
        const dateEffetInput = document.getElementById('DateEffet');
        const displayDateEffet = document.getElementById('displayDateEffet');
        const effetValue = dateEffetInput.value;
        
        // Mettre à jour l'affichage de la date d'effet
        displayDateEffet.textContent = effetValue;
        console.log("Valeur après modification : ", effetValue);
    });

    function previewFiles(event, previewAreaId) {
        const files = event.target.files;
        const previewArea = document.getElementById(previewAreaId);
        previewArea.innerHTML = '';  // Effacer les aperçus précédents

        for (const file of files) {
            const fileType = file.type;
            const reader = new FileReader();

            reader.onload = function(e) {
                let previewElement;
                if (fileType.startsWith('image/')) {
                    previewElement = document.createElement('img');
                    previewElement.src = e.target.result;
                    previewElement.style.width = '100px';
                    previewElement.style.margin = '5px';
                } else if (fileType === 'application/pdf') {
                    previewElement = document.createElement('embed');
                    previewElement.src = e.target.result;
                    previewElement.type = 'application/pdf';
                    previewElement.style.width = '100px';
                    previewElement.style.height = '100px';
                    previewElement.style.margin = '5px';
                } else {
                    previewElement = document.createElement('p');
                    previewElement.textContent = file.name;
                }
                previewArea.appendChild(previewElement);
            };

            reader.readAsDataURL(file);
        }
    }
    // <script>
    document.addEventListener("DOMContentLoaded", function () {
        const primeInput = document.getElementById("primepricipale");
        const primeError = document.getElementById("primepricipale-error");
        const minPrimeValue = 1000000; // Montant minimal requis

        // Ajouter un écouteur d'événement pour la saisie de l'utilisateur
        primeInput.addEventListener("input", function () {
            const value = parseFloat(primeInput.value);

            // Vérifier si la valeur est inférieure au montant minimal
            if (isNaN(value) || value < minPrimeValue) {
                primeError.style.display = "block"; // Afficher l'erreur
                primeInput.classList.add("is-invalid"); // Ajoute une bordure rouge au champ
            } else {
                primeError.style.display = "none";
                primeInput.classList.remove("is-invalid");
            }
        });

        // Validation lors de l'envoi du formulaire
        const form = primeInput.closest("form");
        if (form) {
            form.addEventListener("submit", function (event) {
                const value = parseFloat(primeInput.value);

                if (isNaN(value) || value < minPrimeValue) {
                    event.preventDefault();
                    primeError.style.display = "block";
                    primeInput.classList.add("is-invalid");
                    alert("Veuillez entrer un montant valide pour la primepricipale (au moins 1 000 000).");
                }
            });
        }
    });
// </script>
