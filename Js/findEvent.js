document.getElementById("logo").onclick = function () {
      location.href = "index.html";
    };



$(document).ready(function(){
		$("#search_text").keyup(function(event){
		var search = $(this).val();
		var type = "search";
    	$.post("Logic/logic2.php", {
    		search: search,
    		type: type
    	}, function (data){
    		$("#search_results").html(data);
    		
    	});		
	});
});
    
