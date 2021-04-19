//For Login
function clearMessageField() {
    $(".error").text("");
    $(".success").text("");
}

$(document).ready(function () {
    $("#formLogin").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        var email = $("input[name = 'user_email']").val();
        var password = $("input[name = 'user_password']").val();
        var type = "login";
        $.post("Logic/logic.php", {
            email: email,
            password: password,
            type: type
        },
        function (data, status) {
            if (data=="Successful") {
                window.location.href="dashboard.php";
                $(".success").text(data);
            } else {
                $(".error").text(data);
            }
        });
    });
});

$(document).ready(function () {
    $("#formRegister").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let form=$("#formRegister")[0];
        let formData= new FormData(form);
        formData.append("type","register");
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
                        $(".success").text("Account Created Successfully");
                    } else {
                        $(".error").text(data);
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
    $("#addEvent").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let form=$("#addEvent")[0];
        let formData= new FormData(form);
        formData.append("type","addEvent");
        let formEmpty= false;
        for(var value of formData.entries()){
            formEmpty= (value[1]=="" && value['name']!=null)? true:false;
        }
        if(!formEmpty){
            $.ajax({
                url: 'Logic/logic2.php',
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

$(document).ready(function(){
    $("#addCraft").submit(function(event){
        event.preventDefault();
        clearMessageField();
        let formdata = new FormData($(this)[0]);
        formdata.append("type","addCraft");
        $.ajax({
            type: 'POST',
            url: "Logic/logic2.php",
            data: formdata,
            processData: false, // jQuery does not process the sent data
            contentType: false, // jQuery don't set the Content-Type request header
            success: function(data){
                if (data=="Successful") {
                    $("#craftUpload_success").text("Craft uploaded Successfully");
                } else {
                   $("#craftUpload_error").text(data);
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
                window.location.href="Signin_&_Login.php";
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
