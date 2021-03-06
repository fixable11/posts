require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import App from "./App";
import router from './router';
import store from "./store";

const app= new Vue({
    components: { App },
    template: "<App/>",
    router,
    store,
}).$mount("#app");
