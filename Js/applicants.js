function dropdown(gigId) {
  console.log(gigId);
  let selectorOne="artistDropdown"+gigId;
  var elements = document.getElementById(selectorOne);
  if (elements!=null) {
    elements.classList.toggle("display");
  }
  let selectorTwo="fa-angle-right"+gigId;
  var element = document.getElementById(selectorTwo);
  if (element!=null) {
    element.classList.toggle("down");
  }
  
}

function approve(applicantId,gigId) {
  if (confirm("Do you want to accept the application of this artist? The artist will get notified.")) {
    $.post("Logic/r_logic.php",{
      type:"approveGigApplication",
      applicantId:applicantId,
      gigId:gigId
    }, function (data) {
      if (data=="success") {
        alert("You have successfully accepeted the application. You can get the contact details of the artist in the approved artists page.");
        location.reload();
      }else{
        console.log(data);
      }
    });
  }
}
function decline(applicantId,gigId) {
  if (confirm("Do you want to decline the application of this artist? The artist will get notified.")) {
    $.post("Logic/r_logic.php",{
      type:"declineGigApplication",
      applicantId:applicantId,
      gigId:gigId
    }, function (data) {
      if (data=="success") {
        alert("You have successfully declined the application.");
        location.reload();
      }else{
        alert(data);
      }
    });
  }
}

function artistProfile(artistId) {
  location.href="artistProfile.php?profile_id="+artistId;
}