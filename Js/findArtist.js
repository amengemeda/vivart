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
  $(document).ready(function(){
		$("#search_text").keyup(function(event){
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('search');
    console.log("Param: "+myParam);
		var search = $(this).val();
		var type = "artist_search";
    	$.post("Logic/logic2.php", {
    		search: search,
    		type: type,
        param:myParam
    	}, function (data){
    		$("#search_results").html(data);
    		
    	});		
	});
});