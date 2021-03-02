//For Login
$(document).ready(function () {
    $("#formLogin").submit(function (event) {
        event.preventDefault();
        var email = $("input[name = 'user_email']").val();
        var password = $("input[name = 'user_password']").val();
        var type = "login";
        $.post("Logic/logic.php", {
            email: email,
            password: password,
            type: type
        },
        function (data, status) {
            $("#Message").html(data);
        });
    });
});

$(document).ready(function () {
    $("#formRegister").submit(function (event) {
        event.preventDefault();
        $(".error").text("");
        $(".success").text("");
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

// For Sign Up

