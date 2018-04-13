window.Vue = require('vue');
console.log("register.js");

window.onload = function(){
    const register = new Vue({
        el: "#register",
        data: {
            profile_upload_filename: "Choose file"
        },
        methods: {
            onSelectProfileUploadImage: function(event){
                console.log(this,event.target.value, "onSelect");
                console.log("app", register.profile_upload_src);
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
}
