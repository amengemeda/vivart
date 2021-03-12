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

function editCraft (craftId) {
    modal1.style.display = "block";
    let xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange= function() {
        if (this.readyState==4 && this.status==200) {
            console.log(this.responseText);
            let craftObject=JSON.parse(this.responseText);
            document.querySelector("#craft_type").value=craftObject.craft_type;
            document.querySelector("#craft_description").value=craftObject.craft_description;
            document.querySelector("#craft_id").value=craftId;
        }
    };
    xmlhttp.open("POST","Logic/logic2.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let data="craft_id="+craftId+"&type=getCraftData";
    xmlhttp.send(data);
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

// var btn2 = document.getElementsByClassName("
// ");

var span2 = document.getElementsByClassName("closeEvent")[0];

 function editEvent(eventId) {
    modal2.style.display = "block";
    let xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange= function() {
        if (this.readyState==4 && this.status==200) {
            // console.log(this.responseText);
            let eventObject=JSON.parse(this.responseText);
            document.querySelector("#event_name").value=eventObject.event_name;
            document.querySelector("#event_description").value=eventObject.event_description;
            document.querySelector("#event_id").value=eventId;
        }
    };
    xmlhttp.open("POST","Logic/logic2.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data="event_id="+eventId+"&type=getEventData";
    xmlhttp.send(data);
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