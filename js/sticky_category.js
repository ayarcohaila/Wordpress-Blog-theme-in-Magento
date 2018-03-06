window.onscroll = function() {myFunction()};

var header = document.getElementById("category");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

console.log('test');
