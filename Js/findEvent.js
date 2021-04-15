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
    
$(document).ready(function () {
	var small={width: "240px",height: "205px"};
	var large={width: "400px",height: "382px"};
	var count=2; 
	$(".img").css(small).on('click',function () { 
		$(this).animate((count==2)?large:small);
		count = 2-count;
	});
});