function dropdown() {
  var elements = document.getElementsByClassName("artistDropdown-content");
for(var i=0; i<elements.length; i++) { 
  elements[i].classList.toggle("display");
}
  var element = document.getElementsByClassName("fa-angle-right");
for(var i=0; i<element.length; i++) { 
  element[i].classList.toggle("down");
}
}
