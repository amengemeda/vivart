//For Login
function clearMessageField() {
    $(".error").text("");
    $(".success").text("");
}
  

$(document).ready(function () {
    $("#rFormLogin").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        var email = $("input[name = 'recruitor_email']").val();
        var password = $("input[name = 'recruitor_password']").val();
        var type = "r_login";
        $.post("Logic/logic.php", {
            email: email,
            password: password,
            type: type
        },
        function (data, status) {
            if (data=="Successful") {
                window.location.href="r_dashboard.php";
                $(".success").text(data);
            } else {
                $(".error").text(data);
            }
        });
    });
});

$(document).ready(function () {
    $("#rFormRegister").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let form=$("#rFormRegister")[0];
        let formData= new FormData(form);
        formData.append("type","r_register");
        console.log("called");
        let formEmpty= false;
        for(var value of formData.entries()){
            formEmpty= (value[1]=="")? true:false;
        }
        if(!formEmpty){
            $.ajax({
                url: 'Logic/logic.php',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    if (data=="success") {
                        $("#r_reg_success").text("Account Created Successfully");
                    } else {
                        $("#r_reg_error").text(data);
                    }
                },
                error: function (e) {
                    alert(e.responseText);
                    console.log("ERROR : ", e);
                }
                });        
        }else{
            $(".error").text("All fields are required");
        } 
    });
});


$(document).ready(function () {
    $("#r_addEvent").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let formData= new FormData($(this)[0]);
        formData.append("type","r_addEvent");
        let formEmpty= false;
        for(var value of formData.entries()){
            formEmpty= (value[1]=="" && value['name']!=null)? true:false;
        }
        if(!formEmpty){
            $.ajax({
                url: 'Logic/r_logic.php',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    if (data=="Successful") {
                        $("#eventUpload_success").text("Event uploaded Successfully");
                    } else {
                        $("#eventUpload_error").text(data);
                    }
                }
                });        
        }else{
            $(".error").text("All fields are required");
        } 
    });
});

$(document).ready(function(){
    $("#r_addGig").submit(function(event){
        event.preventDefault();
        clearMessageField();
        let formdata = new FormData($(this)[0]);
        formdata.append("type","r_addGig");
        $.ajax({
            type: 'POST',
            url: "Logic/r_logic.php",
            data: formdata,
            processData: false, // jQuery does not process the sent data
            contentType: false, // jQuery don't set the Content-Type request header
            success: function(data){
                if (data=="Successful") {
                    $("#gigUpload_success").text("Gig uploaded Successfully");
                } else {
                   $("#gigUpload_error").text(data);
                }
            }
        });
    });
});


$(document).ready(function () {
    
    $("#logout").click(function () {
        console.log("called");
    let formData= new FormData();
    formData.append("type","logout");
    $.ajax({
        url: 'Logic/logic2.php',
        enctype: 'multipart/form-data',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function(data){
            if (data=="logged out") {
                window.location.href="r_Signin_&_Login.php";
            } else {
                alert(data);
            }
        },
        error: function (e) {
            alert(e.responseText);
            console.log("ERROR : ", e);
        }
        });        
    });


}); 
// For Sign Up
