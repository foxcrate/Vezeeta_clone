
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueSocketio from 'vue-socket.io';
import socketio from 'socket.io-client';
window.Vue = require('vue');
Vue.use(VueSocketio, socketio(':6999'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Message', require('./components/Message.vue').default);
Vue.component('Nurse', require('./components/Nurse.vue').default);
Vue.component('User', require('./components/User.vue').default);

const app = new Vue({
    el: '#app'
});