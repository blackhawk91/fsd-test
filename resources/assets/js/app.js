
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router';
import {routes} from './routes.js';
import VeeValidate from 'vee-validate';
import VueCookie  from 'vue-cookie';

Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(VueCookie);

const router = new VueRouter({
   routes: routes,
   mode: 'history'
});


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('navigation', require('./components/NavComponent.vue'));
Vue.component('vue-pagination', require('./components/PaginationComponent.vue'));


//Set route guard

router.beforeEach(function (to, from, next)  {


    if (to.matched.some(record => { return record.meta.requiresGuest }) && VueCookie.get('token'))
    {
        next({
            path: '/'
        });
    }

    else if (to.matched.some( record => { return record.meta.requiresAuth }) && !VueCookie.get('token'))
    {
        next({
            path: '/login',
            query: { redirect: to.fullPath }
        });
    }

    else {
        next();
    }
});


const app = new Vue({
    el: '#app',
    router: router
});
