import "./bootstrap"
import Vue from "vue"
import router from './router'
import store from './store/index'
import ExampleComponent from "./components/ExampleComponent.vue";

import MainView from './components/MainView.vue';

Vue.component('example', ExampleComponent);
Vue.component('main-view', MainView);



new Vue({
    el: '#app',
    router,
    store
})