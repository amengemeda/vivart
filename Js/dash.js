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
