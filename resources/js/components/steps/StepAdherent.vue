<template>
    <div>
      <form @submit.prevent="handleSubmit">
        <!-- Civilité -->
        <div class="row g-3 mb-3">
          <div class="col-12">
            <label class="form-label">Civilité <span class="text-danger">*</span></label><br />
            <div v-for="option in civiliteOptions" :key="option.value" class="form-check form-check-inline">
              <input
                class="form-check-input"
                type="radio"
                :id="'civilite-' + option.value"
                v-model="form.civilite"
                :value="option.value"
                required
              />
              <label class="form-check-label" :for="'civilite-' + option.value">{{ option.label }}</label>
            </div>
            <span v-if="errors.civilite" class="text-danger">{{ errors.civilite }}</span>
          </div>
        </div>
  
        <!-- Nom et Prénoms -->
        <div class="row g-3 mb-3">
          <div class="col-12 col-lg-6">
            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" id="nom" v-model="form.nom" class="form-control" required />
            <span v-if="errors.nom" class="text-danger">{{ errors.nom }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <label for="prenom" class="form-label">Prénoms <span class="text-danger">*</span></label>
            <input type="text" id="prenom" v-model="form.prenom" class="form-control" required />
            <span v-if="errors.prenom" class="text-danger">{{ errors.prenom }}</span>
          </div>
        </div>
  
        <!-- Date de naissance et Lieu -->
        <div class="row g-3 mb-3">
          <div class="col-12 col-lg-6">
            <label for="datenaissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
            <input type="date" id="datenaissance" v-model="form.datenaissance" class="form-control" required />
            <span v-if="errors.datenaissance" class="text-danger">{{ errors.datenaissance }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <label for="lieunaissance" class="form-label">Lieu de naissance</label>
            <select id="lieunaissance" v-model="form.lieunaissance" class="form-select">
              <option value="" disabled selected>Sélectionner le lieu</option>
              <option v-for="ville in villes" :key="ville.libelleVillle" :value="ville.libelleVillle">
                {{ ville.libelleVillle }}
              </option>
            </select>
          </div>
        </div>
  
        <!-- Nature de la pièce -->
        <div class="row g-3 mb-3">
          <div class="col-12 col-lg-4">
            <label class="form-label">Nature de la pièce <span class="text-danger">*</span></label><br />
            <div v-for="option in naturePieceOptions" :key="option.value" class="form-check form-check-inline">
              <input
                class="form-check-input"
                type="radio"
                :id="'piece-' + option.value"
                v-model="form.naturepiece"
                :value="option.value"
                required
              />
              <label class="form-check-label" :for="'piece-' + option.value">{{ option.label }}</label>
            </div>
            <span v-if="errors.naturepiece" class="text-danger">{{ errors.naturepiece }}</span>
          </div>
          <div class="col-12 col-lg-4">
            <label for="numeropiece" class="form-label">Numéro de la pièce <span class="text-danger">*</span></label>
            <input type="text" id="numeropiece" v-model="form.numeropiece" class="form-control" required />
            <span v-if="errors.numeropiece" class="text-danger">{{ errors.numeropiece }}</span>
          </div>
          <div class="col-12 col-lg-4">
            <label for="numerocompte" class="form-label">N° de compte</label>
            <input type="number" id="numerocompte" v-model="form.numerocompte" class="form-control" />
          </div>
        </div>
  
        <!-- Profession, Secteur d'activités et Résidence -->
        <div class="row g-3 mb-3">
          <div class="col-12 col-lg-4">
            <label for="profession" class="form-label">Profession</label>
            <select id="profession" v-model="form.profession" class="form-select">
              <option value="" disabled selected>Sélectionner la profession</option>
              <option v-for="profession in professions" :key="profession.MonLibelle" :value="profession.MonLibelle">
                {{ profession.MonLibelle }}
              </option>
            </select>
          </div>
          <div class="col-12 col-lg-4">
            <label for="secteur" class="form-label">Secteur d'activités</label>
            <select id="secteur" v-model="form.employeur" class="form-select">
              <option value="" disabled selected>Sélectionner le secteur d'activités</option>
              <option v-for="secteur in secteurActivites" :key="secteur.MonLibelle" :value="secteur.MonLibelle">
                {{ secteur.MonLibelle }}
              </option>
            </select>
          </div>
          <div class="col-12 col-lg-4">
            <label for="lieuresidence" class="form-label">Lieu de résidence</label>
            <select id="lieuresidence" v-model="form.lieuresidence" class="form-select">
              <option value="" disabled selected>Sélectionner le lieu</option>
              <option v-for="ville in villes" :key="ville.libelleVillle" :value="ville.libelleVillle">
                {{ ville.libelleVillle }}
              </option>
            </select>
          </div>
        </div>
  
        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Soumettre</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          civilite: '',
          nom: '',
          prenom: '',
          datenaissance: '',
          lieunaissance: '',
          naturepiece: '',
          numeropiece: '',
          numerocompte: '',
          profession: '',
          employeur: '',
          lieuresidence: '',
        },
        errors: {},
        villes: [], // Dynamically populated
        professions: [], // Dynamically populated
        secteurActivites: [], // Dynamically populated
        civiliteOptions: [
          { value: 'Madame', label: 'Madame' },
          { value: 'Mademoiselle', label: 'Mademoiselle' },
          { value: 'Monsieur', label: 'Monsieur' },
        ],
        naturePieceOptions: [
          { value: 'CNI', label: 'CNI' },
          { value: 'AT', label: 'Attestation' },
          { value: 'Passport', label: 'Passport' },
        ],
      };
    },
    mounted() {
      this.fetchData();
    },
    methods: {
      fetchData() {
        // Simule une API Laravel pour charger les données
        axios.get('/api/form-data').then((response) => {
          this.villes = response.data.villes;
          this.professions = response.data.professions;
          this.secteurActivites = response.data.secteurActivites;
        });
      },
      handleSubmit() {
        // Validation et soumission
        console.log(this.form);
      },
    },
  };
  </script>
  
  <style>
  /* Ajoutez vos styles si nécessaire */
  </style>
  