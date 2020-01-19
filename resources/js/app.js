require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import App from "./App";

const app= new Vue({
    components: { App },
    template: "<App/>"
}).$mount("#app");
