
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

Vue.component('example-component', require('./components/ExampleComponent.vue'));

window.swal = require('sweetalert');

const app = new Vue({
    el: '#app',
    methods: {
        confirmDelete(msg, blogId) {

            swal(msg, {
                buttons: {
                    cancel: 'Cancel',
                    continue: {
                        text: 'Yes',
                        value: blogId
                    }
                }
            }).then(blogId => {

                if ( ! blogId) {
                    return false;
                }

                let url = '/blogs/' + blogId;

                window.axios.delete(url)
                    .then(res => {
                        window.location = res.data.redirect;
                    }).catch(err => {
                        console.error(err);
                    });
            });
        }
    }
});
