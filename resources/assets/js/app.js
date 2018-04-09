
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

const app = new Vue({
    el: '#app',
    data: {
        profile_upload_filename: "Choose file"
    },
    methods: {
        onSelectProfileUploadImage: function(event){
            console.log(this,event.target.value, "onSelect");
            console.log("app", app.profile_upload_src);
            console.log("files", event.target.files[0]);
            // this.profile_upload_src = event.target.files[0];
            this.profile_upload_filename = event.target.files[0].name;
            var fReader = new FileReader();
            
            fReader.onload = function(e){
                // app.profile_upload_src = fReader.result;
                $("#profile-preview").attr("src", e.target.result);
                console.log($("#profile-preview"));
                // console.log("onloaded", e.target.result);
            }
            fReader.readAsDataURL(event.target.files[0]);
        }
    }
});
