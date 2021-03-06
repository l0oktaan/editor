
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

import { store } from './store/store';
import Editor from './Editor.vue';

const app = new Vue({
    el: '#app',store,
    components: {
        appEditor: Editor,
        
    }
});
