window.onload = function(){
    $("#profile").change(function(event){
        console.log(this,event.target.value, "onSelect");
        // console.log("app", register.profile_upload_src);
        console.log("files", event.target.files[0]);
        // this.profile_upload_src = event.target.files[0];
        let profile_upload_filename = event.target.files[0].name;
        console.log(profile_upload_filename);
        $("#profile-label").text(profile_upload_filename);
        var fReader = new FileReader();
        
        fReader.onload = function(e){
            // app.profile_upload_src = fReader.result;
            $("#profile-preview").attr("src", e.target.result);
            console.log($("#profile-preview"));
            // console.log("onloaded", e.target.result);
        }
        fReader.readAsDataURL(event.target.files[0]);
    })
}