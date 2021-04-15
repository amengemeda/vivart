function clearMessageField() {
    $(".error").text("");
    $(".success").text("");
}
$(document).ready(function () {
    var small={width: "240px",height: "205px"};
    var large={width: "400px",height: "375px"};
    var count=2; 
    $(".video").css(small).on('click',function () { 
        $(this).animate((count==2)?large:small);
        count = 2-count;
        console.log("called");
    });
});

var imageModal = document.getElementById("imageModal");

var modalImg = document.getElementById("img01");

function zoomImage (element) {
    imageModal.style.display = "block";
    modalImg.src = element.src;
}


var span = document.getElementsByClassName("closeImage")[0];

if (span!=null) {
    span.onclick = function () {
        imageModal.style.display = "none";
    } 
}


window.onclick = function (event) {
    imageModal.style.display = "none";
}



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
if(document.getElementById("gigModal")){
    var modal1 = document.getElementById("gigModal");

    //var btn1 = document.getElementById("editGig");

    var span1 = document.getElementsByClassName("closeGig")[0];

    span1.onclick = function () {
    modal1.style.display = "none";
    location.reload();
    }

    window.onclick = function (event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
    }
}


function editGig(gigId) {
    //console.log(gigId);
    modal1.style.display = "block";
    let xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange= function() {
        if (this.readyState==4 && this.status==200) {
            //console.log(this.responseText);
            let gigObject=JSON.parse(this.responseText);
            document.querySelector("#gig_name").value=gigObject.gig_name;
            document.querySelector("#gig_description").value=gigObject.gig_description;
            document.querySelector("#gig_id").value=gigId;
        }
    };
    xmlhttp.open("POST","Logic/r_logic.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data="gig_id="+gigId+"&type=getGigData";
    xmlhttp.send(data);
}


//For editing event
if(document.getElementById("editModal")){
    var modal2 = document.getElementById("editModal");

    //var btn1 = document.getElementById("editEvent");

    var span2 = document.getElementsByClassName("closeEvent")[0];

    span2.onclick = function () {
        modal2.style.display = "none";
        clearMessageField();
        location.reload();
    }

    window.onclick = function (event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
        clearMessageField();
    }

}


function editEvent(eventId) {
    //console.log(eventId);
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
    xmlhttp.open("POST","Logic/r_logic.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data="event_id="+eventId+"&type=getEventData";
    xmlhttp.send(data);
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

function gigDelete() {
    if (confirm("Do you really want to delete this gig?")) {
        let gigId=document.querySelector("#gig_id").value;
        let xmlhttp= new XMLHttpRequest();
        xmlhttp.onreadystatechange= function() {
            if (this.readyState==4 && this.status==200) {
                if (this.responseText=="Successful") {
                    $("#gigEdit_success").text("Gig Deleted Successfully");
                } else {
                    $("#gigEdit_error").text(this.responseText);
                }
            }
        };
        xmlhttp.open("POST","Logic/r_logic.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var data="gig_id="+gigId+"&type=deleteGig";
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
        xmlhttp.open("POST","Logic/r_logic.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var data="event_id="+eventId+"&type=deleteEvent";
        xmlhttp.send(data);
    }
   
}

$(document).ready(function () {
    $("#update_profile").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let formData= new FormData($(this)[0]);
        formData.append("type","updateProfile");
        let formEmpty= false;
        for(var value of formData.entries()){
            formEmpty= (value[1]=="")? true:false;
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
                url:'Logic/r_logic.php',
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
    $('#gigEdit').submit(function(event){
        event.preventDefault();
        clearMessageField();
        console.log("called");
        let formData= new FormData($(this)[0]);
        formData.append("type","updateGig");        
        let formEmpty= false;
        for(var value of formData.entries()){
            formEmpty= (value[1]=="")? true:false;
        }
        if (!formEmpty) {
            $.ajax({
                url:'Logic/r_logic.php',
                enctype:'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    if (data=="Successful") {
                        $("#gigEdit_success").text("Gig Updated Successfully");
                    } else {
                        $("#gigEdit_error").text(data);
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