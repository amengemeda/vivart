//Redirect
    document.getElementById("findEvents").onclick = function () {
      location.href = "findEvent.html";
    };

    document.getElementById("findArtists").onclick = function () {
      location.href = "findArtist.php?search=all";
    };

    document.getElementById("recruitor").onclick = function () {
      location.href = "recruitorRegister_Login.html";
    };

    document.getElementById("artist").onclick = function () {
      location.href = "SignIn_&_Login.php";
    };

    document.getElementById("addTalent").onclick = function () {
      location.href = "SignIn_&_Login.html";
    };



    var modal = document.getElementById("myModal");

    var btn = document.getElementById("sign");

    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
      modal.style.display = "block";

    }


    span.onclick = function () {
      modal.style.display = "none";
    }


    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

  var modal = document.getElementById("myModal");

    var btn1 = document.getElementById("log");

    var span = document.getElementsByClassName("close")[0];

    btn1.onclick = function () {
      modal.style.display = "block";

    }


    span.onclick = function () {
      modal.style.display = "none";
    }

    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
   function findArtist(element) {
    location.href="findArtist.php?search="+element.value;
   }
  