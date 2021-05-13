require('./bootstrap');

import Vue from 'vue';
import VueRouter from "vue-router";
import routes from "./routes";
import Home from "./Home";

Vue.use(VueRouter);

new Vue({
    router: new VueRouter(routes),
    render: h => h(Home)
}).$mount('#app')
