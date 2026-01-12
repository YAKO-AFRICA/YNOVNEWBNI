/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import { createApp } from 'vue'; // Utilisez la version moderne de Vue.js

// require('./bootstrap');
import MultiStepForm from './components/MultiStepForm.vue';

const app = createApp({});
app.component('multi-step-form', MultiStepForm);
app.mount('#app');


