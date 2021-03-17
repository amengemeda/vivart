document.getElementById("logo").onclick = function () {
      location.href = "index.html";
    };
    
document.getElementById("button_search").onclick=function() {
    let search= document.querySelector("input[name = 'search']").value;
    if (search!="") {
      location.href="findArtist.php?search="+search;
    }else{
      location.href="findArtist.php?search=all";
    }
  }
  function checkProfile(userId) {
    window.location.href="artistProfile.php?profile_id="+userId;
  }
  // $(document).ready(function() {
  //   $("#search_form").submit(function (event) {
  //     event.preventDefault();
  //     console.log("called");
  //     var search = $("input[name = 'search']").val();
  //     if (search!="") {
  //       location.href="findArtist.php?search="+search;
  //       console.log("called");
  //     }else{
  //       location.href="findArtist.php?search=all";
  //       console.log("twice");
  //     }
  //   });
  // });
