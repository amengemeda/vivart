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


var modal = document.getElementById("myModal");


var btn = document.getElementById("editProfile");


var span = document.getElementsByClassName("close")[0];


btn.onclick = function () {
modal.style.display = "block";

}

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


// For editing gig
var modal1 = document.getElementById("gigModal");

var btn1 = document.getElementById("editGig");

var span1 = document.getElementsByClassName("closeGig")[0];

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

var btn1 = document.getElementById("editEvent");
var span2 = document.getElementsByClassName("closeEvent")[0];

btn1.onclick = function () {
modal2.style.display = "block";

}
span2.onclick = function () {
    modal2.style.display = "none";
    clearMessageField();
}

window.onclick = function (event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
    clearMessageField();
}

//For Craft changing button
function changeCraft(){
    document.getElementById("craft_file").click();
    
}
//For event file changing button
function changeEvent(){ 
    document.getElementById("event_file").click();
}


$(document).ready(function () {
$("#profile_photo_upload").click(function (){
  $("#profile_photo").click();
});  
});

function craftDelete() {
    if (confirm("Do you really want to delete this craft?")) {
        let craftId=document.querySelector("#craft_id").value;
        let xmlhttp= new XMLHttpRequest();
        xmlhttp.onreadystatechange= function() {
            if (this.readyState==4 && this.status==200) {
                if (this.responseText=="Successful") {
                    $("#eventEdit_success").text("Craft Deleted Successfully");
                } else {
                    $("#eventEdit_error").text(this.responseText);
                }
            }
        };
        xmlhttp.open("POST","Logic/logic2.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var data="craft_id="+craftId+"&type=deleteCraft";
        xmlhttp.send(data);
    }
}
function deleteEvent() {
    if (confirm("Do you really want to delete this event?")) {
        let eventId=document.querySelector("#event_id").value;
        let xmlhttp= new XMLHttpRequest();
        xmlhttp.onreadystatechange= function() {
            if (this.readyState==4 && this.status==200) {
                if (this.responseText=="Successful") {
                    $("#eventEdit_success").text("Event Deleted Successfully");
                } else {
                    $("#eventEdit_error").text(this.responseText);
                }
            }
        };
        xmlhttp.open("POST","Logic/logic2.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var data="event_id="+eventId+"&type=deleteEvent";
        xmlhttp.send(data);
    }
   
}

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

$(document).ready(function(){
    $('#eventEdit').submit(function(event){
        event.preventDefault();
        clearMessageField();
        let formData= new FormData($(this)[0]);
        formData.append("type","updateEvent");
        let formEmpty= false;
        for(var value of formData.entries()){
            formEmpty= (value[1]=="")? true:false;
        }
        if (!formEmpty) {
            $.ajax({
                url:'Logic/logic2.php',
                enctype:'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    if (data=="Successful") {
                        $("#eventEdit_success").text("Event Updated Successfully");
                    } else {
                        $("#eventEdit_error").text(data);
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
    $('#craftEdit').submit(function(event){
        event.preventDefault();
        clearMessageField();
        let formData= new FormData($(this)[0]);
        formData.append("type","updateCraft");
        let formEmpty= false;
        for(var value of formData.entries()){
            formEmpty= (value[1]=="")? true:false;
        }
        if (!formEmpty) {
            $.ajax({
                url:'Logic/logic2.php',
                enctype:'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    if (data=="Successful") {
                        $("#craftEdit_success").text("Craft Updated Successfully");
                    } else {
                        $("#craftEdit_error").text(data);
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