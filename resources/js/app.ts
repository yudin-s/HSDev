import "./bootstrap"
import Vue from "vue"
import router from './router'
import store from './store/index'
import ExampleComponent from "./components/ExampleComponent.vue";

import MainView from './components/MainView.vue';
import ListElement from './components/ListElement.vue';

Vue.component('example', ExampleComponent);
Vue.component('main-view', MainView);
Vue.component('list-element', ListElement);



new Vue({
    el: '#app',
    router,
    store
})