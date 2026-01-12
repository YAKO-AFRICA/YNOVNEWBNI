// var stepper1

// var stepperForm

//  document.addEventListener('DOMContentLoaded', function () {
//   stepper1 = new Stepper(document.querySelector('#stepper1'))


//   // stepper3 = new Stepper(document.querySelector('#stepper3'))

//   var stepperFormEl = document.querySelector('#stepperForm')
//   stepperForm = new Stepper(stepperFormEl, {
//     animation: true
//   })

//   var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
//   var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
//   var inputMailForm = document.getElementById('inputMailForm')
//   var inputPasswordForm = document.getElementById('inputPasswordForm')
//   var form = stepperFormEl.querySelector('.bs-stepper-content form')

//   btnNextList.forEach(function (btn) {
//     btn.addEventListener('click', function () {
//       stepperForm.next()
//     })
//   })

//   stepperFormEl.addEventListener('show.bs-stepper', function (event) {
//     form.classList.remove('was-validated')
//     var nextStep = event.detail.indexStep
//     var currentStep = nextStep

//     if (currentStep > 0) {
//       currentStep--
//     }

//     var stepperPan = stepperPanList[currentStep]

//     if ((stepperPan.getAttribute('id') === 'test-form-1' && !inputMailForm.value.length)
//     || (stepperPan.getAttribute('id') === 'test-form-2' && !inputPasswordForm.value.length)) {
//       event.preventDefault()
//       form.classList.add('was-validated')
//     }
//   })
// })

// document.addEventListener('DOMContentLoaded', function () {
//   // Sélectionner tous les steppers sur la page
//   var steppers = document.querySelectorAll('.bs-stepper');

//   steppers.forEach(function(stepperEl) {
//       // Créer une instance de Stepper pour chaque élément
//       var stepperInstance = new Stepper(stepperEl);

//       var stepperFormEl = stepperEl.querySelector('.bs-stepper-content form');
//       var btnNextList = stepperEl.querySelectorAll('.btn-next-form'); // Sélectionner les boutons "Next"
//       var btnPreviousList = stepperEl.querySelectorAll('.btn-previous-form'); // Sélectionner les boutons "Previous"
//       var form = stepperFormEl;

//       // Ajouter l'événement pour les boutons "Next"
//       btnNextList.forEach(function (btn) {
//           btn.addEventListener('click', function () {
//               // Passer à l'étape suivante
//               stepperInstance.next();
//           });
//       });

//       // Ajouter l'événement pour les boutons "Previous"
//       btnPreviousList.forEach(function (btn) {
//           btn.addEventListener('click', function () {
//               // Revenir à l'étape précédente
//               stepperInstance.previous();
//           });
//       });

//       stepperEl.addEventListener('show.bs-stepper', function (event) {
//           form.classList.remove('was-validated');
//           var nextStep = event.detail.indexStep;
//           var currentStep = nextStep;

//           if (currentStep > 0) {
//               currentStep--;
//           }

//           var stepperPan = stepperEl.querySelector('.bs-stepper-pane.active');

//           // Ajouter une validation basique pour les champs obligatoires
//           if (stepperPan.querySelector('input:invalid')) {
//               event.preventDefault();
//               form.classList.add('was-validated');
//           }
//       });
//   });
// });


var stepper1
var stepper2
//var stepper3
var stepper4
var stepperForm

 document.addEventListener('DOMContentLoaded', function () {
  stepper1 = new Stepper(document.querySelector('#stepper1'))
  stepper2 = new Stepper(document.querySelector('#stepper2'), {
    linear: false
  })

  stepper3 = new Stepper(document.querySelector('#stepper3'))

  var stepperFormEl = document.querySelector('#stepperForm')
  stepperForm = new Stepper(stepperFormEl, {
    animation: true
  })

  var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
  var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
  var inputMailForm = document.getElementById('inputMailForm')
  var inputPasswordForm = document.getElementById('inputPasswordForm')
  var form = stepperFormEl.querySelector('.bs-stepper-content form')

  btnNextList.forEach(function (btn) {
    btn.addEventListener('click', function () {
      stepperForm.next()
    })
  })

  stepperFormEl.addEventListener('show.bs-stepper', function (event) {
    form.classList.remove('was-validated')
    var nextStep = event.detail.indexStep
    var currentStep = nextStep

    if (currentStep > 0) {
      currentStep--
    }

    var stepperPan = stepperPanList[currentStep]

    if ((stepperPan.getAttribute('id') === 'test-form-1' && !inputMailForm.value.length)
    || (stepperPan.getAttribute('id') === 'test-form-2' && !inputPasswordForm.value.length)) {
      event.preventDefault()
      form.classList.add('was-validated')
    }
  })
})


document.addEventListener('DOMContentLoaded', function () {
  // Sélectionner tous les steppers sur la page
  var steppers = document.querySelectorAll('.productions .bs-stepper');

  steppers.forEach(function(stepperEl) {
      // Créer une instance de Stepper pour chaque élément
      var stepperInstance = new Stepper(stepperEl);

      var stepperFormEl = stepperEl.querySelector('.bs-stepper-content form');
      var btnNextList = stepperEl.querySelectorAll('.btn-next-form'); // Sélectionner les boutons "Next"
      var btnPreviousList = stepperEl.querySelectorAll('.btn-previous-form'); // Sélectionner les boutons "Previous"
      var form = stepperFormEl;

      // Ajouter l'événement pour les boutons "Next"
      btnNextList.forEach(function (btn) {
          btn.addEventListener('click', function () {
              // Passer à l'étape suivante
              stepperInstance.next();
          });
      });

      // Ajouter l'événement pour les boutons "Previous"
      btnPreviousList.forEach(function (btn) {
          btn.addEventListener('click', function () {
              // Revenir à l'étape précédente
              stepperInstance.previous();
          });
      });

      stepperEl.addEventListener('show.bs-stepper', function (event) {
          form.classList.remove('was-validated');
          var nextStep = event.detail.indexStep;
          var currentStep = nextStep;

          if (currentStep > 0) {
              currentStep--;
          }

          var stepperPan = stepperEl.querySelector('.bs-stepper-pane.active');

          // Ajouter une validation basique pour les champs obligatoires
          if (stepperPan.querySelector('input:invalid')) {
              event.preventDefault();
              form.classList.add('was-validated');
          }
      });
  });
});