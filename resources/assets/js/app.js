
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');


import QuestionPage from './pages/QuestionPage.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('question-page', QuestionPage );


const app = new Vue({
    el: '#app'
});

window._ = require('lodash');

try {

    window.$ = window.jQuery = require('jquery');
    require('select2');
    $('select').select2();

} catch (error) {
    console.log(error);
}
