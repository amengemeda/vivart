// Sidebar Toggle Codes;

var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");
var sidebarCloseIcon = document.getElementById("sidebarIcon");

function toggleSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add("sidebar_responsive");
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove("sidebar_responsive");
    sidebarOpen = false;
  }
}
if (document.getElementById("logo")!=null) {
  document.getElementById("logo").onclick = function () {
    location.href = "index.html";
  };
}
if (document.getElementsByClassName("logo")[0]!=null) {
  document.getElementsByClassName("logo")[0].onclick = function () {
    location.href = "index.html";
  };
}
    


$(document).ready(function () {
  $("#event_upload_file").click(function (){
  console.log("called");
      $("#eventPhoto").click();
  }); 
  $("#craft_upload_file").click(function (){
    console.log("called");
        $("#craft_photo").click();
    });      
  $("#gig_upload_file").click(function (){
    console.log("called");
        $("#gig_file").click();
    });            
  });
  function chooseEventFile() {
      
  }
  function chooseCraftFile() {
      
  }
  
  function applyforGig(gigId) {
    console.log("Gig id: "+gigId);
    let formData= new FormData();
    formData.append("gig_id",gigId);
    formData.append("type","applyForGig");
    if (confirm("Do you want to apply for this gig? This will send your information to the recruiter.")) {
      $.ajax({
        url: 'Logic/logic2.php',
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data){
            alert(data);
        },
        error: function (e) {
            alert(e.responseText);
            console.log("ERROR : ", e);
        }
      });        
    }
  }
