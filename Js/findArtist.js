document.getElementById("button_search").onclick=function() {
    let search= document.querySelector("input[name = 'search']").value;
    if (search!="") {
      location.href="findArtist.php?search="+search;
    }else{
      location.href="findArtist.php?search=all";
    }
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
