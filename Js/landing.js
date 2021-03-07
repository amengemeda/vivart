function clearMessageField() {
    $(".error").text("");
    $(".success").text("");
}
$(document).ready(function () {
    var small={width: "240px",height: "205px"};
    var large={width: "400px",height: "375px"};
    var count=2; 
    $(".img").css(small).on('click',function () { 
        $(this).animate((count==2)?large:small);
        count = 2-count;
        console.log("called");
    });
    $(".video").css(small).on('click',function () { 
        $(this).animate((count==2)?large:small);
        count = 2-count;
        console.log("called");
    });
});
     // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("editProfile");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
modal.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
clearMessageField();
modal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
if (event.target == modal) {
    modal.style.display = "none";
}
}


// For editing craft
var modal1 = document.getElementById("craftModal");

var btn1 = document.getElementById("editCraft");

var span1 = document.getElementsByClassName("closeCraft")[0];

btn1.onclick = function () {
    modal1.style.display = "block";
}

span1.onclick = function () {
    modal1.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

//For editing event
var modal2 = document.getElementById("editModal");

var btn2 = document.getElementById("editEvent");

var span2 = document.getElementsByClassName("closeEvent")[0];

btn2.onclick = function () {
    modal2.style.display = "block";
}

span2.onclick = function () {
    modal2.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}


$(document).ready(function () {
$("#profile_photo_upload").click(function (){
  $("#profile_photo").click();
});  
});



$(document).ready(function () {
    $("#update_profile").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let form=$("#update_profile")[0];
        let formData= new FormData(form);
        formData.append("type","updateProfile");
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
                        $("#profileUpload_success").text("Profile Updated Successfully");
                    } else {
                        $("#profileUpload_error").text(data);
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