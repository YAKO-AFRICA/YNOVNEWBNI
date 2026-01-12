<template>
    <div>
      <h3>Informations sante</h3>
      <!-- Formulaire pour cette étape -->
      <input type="text" v-model="adherent.name" placeholder="Nom de l'adhérent" />
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        adherent: {
          name: '',
        },
      };
    },
  };
  </script>
  