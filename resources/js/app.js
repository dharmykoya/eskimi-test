require('./bootstrap');

import Vue from 'vue';
import App from "./components/App";
import router from './router';
Vue.component('modal', () =>
    import('./components/Modal')
);
import './css/app.scss'


Vue.config.ignoredElements = [/^ion-/];
Vue.config.productionTip = false;
Vue.config.devtools = process.env.VUE_APP_ENV !== 'production';

window.App = new Vue({
    router,
    ...App,
}).$mount('#app');
