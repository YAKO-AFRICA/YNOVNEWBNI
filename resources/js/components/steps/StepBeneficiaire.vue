<template>
    
    
    <div>
    <label for="lieunaissance" class="form-label">Lieu de naissance</label>
    <select class="form-select" name="lieunaissance" id="lieunaissance">
      <option value="" disabled selected>Sélectionner le lieu</option>
      <option v-for="ville in villes" :key="ville.id" :value="ville.libelleVillle">
        {{ ville.libelleVillle }}
      </option>
    </select>
  </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        villes: window.villes || [], // Récupère les données injectées
      };
    },
  };
  </script>
  