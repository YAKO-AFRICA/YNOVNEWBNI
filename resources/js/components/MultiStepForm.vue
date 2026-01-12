<template>
    <form>
      <slot></slot>
    </form>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentStep: 0, // Étape actuelle
        steps: 6, // Nombre total d'étapes
        errors: {}, // Gestion des erreurs
      };
    },
    methods: {
      // Étape précédente
      goToPreviousStep() {
        this.currentStep--;
      },
      // Étape suivante avec validation
      goToNextStep() {
        if (this.validateCurrentStep()) {
          this.currentStep++;
        }
      },
      // Validation des champs obligatoires pour l'étape actuelle
      validateCurrentStep() {
        const activeStep = document.querySelector(".form-step.active");
        const requiredFields = activeStep.querySelectorAll("[required]");
        let isValid = true;
  
        requiredFields.forEach((field) => {
          if (!field.value.trim()) {
            field.classList.add("error");
            isValid = false;
          } else {
            field.classList.remove("error");
          }
        });
  
        if (!isValid) {
          alert("Veuillez remplir tous les champs obligatoires avant de continuer.");
        }
  
        return isValid;
      },
    },
  };
  </script>
  
  <style>
  /* Style pour cacher les étapes non actives */
  .form-step {
    display: none;
  }
  .form-step.active {
    display: block;
  }
  .error {
    border: 1px solid red;
  }
  .form-navigation {
    margin-top: 20px;
  }
  button {
    margin-right: 10px;
  }
  </style>
  