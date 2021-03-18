$(document).ready(function () {
    var small={width: "240px",height: "205px"};
    var large={width: "400px",height: "382px"};
    var count=2; 
    $(".img").css(small).on('click',function () { 
        $(this).animate((count==2)?large:small);
        count = 2-count;
    });
    $(".video").css(small).on('click',function () { 
        $(this).animate((count==2)?large:small);
        count = 2-count;
        console.log("called");
    });
});

document.getElementById("back").onclick = function () {
        window.history.back();
    };