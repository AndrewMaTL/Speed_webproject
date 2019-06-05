// goabal values
var role;
// role menu selection
function role_menu_Patient() {
   role = 'Patient';
}
function role_menu_Housekeeper() {
   role = 'Housekeeper';
}
function role_menu_Chef() {
   role = 'Chef';
}
function role_menu_Admin() {
   role = 'Admin';
}
// index page order button
function check() {
  // var role = document.getElementById("inputRole").value;
  var room = document.getElementById("inputRoom").value;
  var hkid = document.getElementById("inputHKid").value;
  if (role) {
    if (room) {
      if (hkid) {
        login();
      } else {
        document.getElementById("message").innerHTML = "Please fill in your HKID.";
        $('.dim.d-none').removeClass('d-none');
        document.getElementById("boxm").style.display = "block";
      }
    } else {
      document.getElementById("message").innerHTML = "Please fill in your Room Number.";
      $('.dim.d-none').removeClass('d-none');
      document.getElementById("boxm").style.display = "block";
    }
  } else {
    document.getElementById("message").innerHTML = "Please fill in your Role.";
    $('.dim.d-none').removeClass('d-none');
    document.getElementById("boxm").style.display = "block";
  }
}

function login() {
  var room = document.getElementById("inputRoom").value;
  var res = room.toLowerCase();
  room = res;
  var hkid = document.getElementById("inputHKid").value;
  var res = hkid.toLowerCase();
  hkid = res;
  var c = 0;
  if (role === "patient" || role === "Patient" || role === "PATIENT") {
    /* jump to patient page*/
    for (i in patientArray.pList) {
		  if (room == bStr.pList[i].pRoom) {
			if (hkid == bStr.pList[i].pHKID) {
			  var name = bStr.pList[i].pName;
			  c = 1;
			  sessionStorage.setItem("name", name);
			  sessionStorage.setItem("room", room);
			  sessionStorage.setItem("hkid", hkid);
			  sessionStorage.setItem("role", role);
			}
		  }
		
	}
    if (c == 1) {
      document.getElementById("boxs").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    } else if (c == 0) {
      document.getElementById("boxf").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    }
  } else if (role == "Chef" || role == "CHEF" || role == "chef") {
    /* jump to chef page*/
    for (i in accountArray.aList) {
		if (accountArray.aList[i].aType == role) {
		  if (room == zStr.aList[i].aID) {
			if (hkid == zStr.aList[i].aPW) {
			  sessionStorage.setItem("room", room);
			  sessionStorage.setItem("hkid", hkid);
			  c = 1;
			}
		  }
		}
	}
    if (c == 1) {
      document.getElementById("link").innerHTML = "<a href='chef_menu.html'>Go</a>";
      document.getElementById("boxs").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    } else {
      document.getElementById("boxf").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    }
  } else if (role == "admin" || role == "ADMIN" || role == "Admin") {
    /* jump to admin page*/
    for (i in accountArray.aList) {
		if (accountArray.aList[i].aType == role) {
		  if (room == zStr.aList[i].aID) {
			if (hkid == zStr.aList[i].aPW) {
			  sessionStorage.setItem("room", room);
			  sessionStorage.setItem("hkid", hkid);
			  c = 1;
			}
		  }
		}
	}
    if (c == 1) {
      document.getElementById("link").innerHTML = "<a href='admin_patient.html'>Go</a>";
      document.getElementById("boxs").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    } else {
      document.getElementById("boxf").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    }
  } else if (role == "Housekeeper" || role == "housekeeper" || role == "HOUSEKEEPER") {
    /* jump to housekeeper page*/
    for (i in accountArray.aList) {
		if (accountArray.aList[i].aType == role) {
		  if (room == zStr.aList[i].aID) {
			if (hkid == zStr.aList[i].aPW) {
			  sessionStorage.setItem("room", room);
			  sessionStorage.setItem("hkid", hkid);
			  c = 1;
			}
		  }
		}
	}
    if (c == 1) {
      document.getElementById("link").innerHTML = "<a href='housekeeper_patient.html'>Go</a>";
      document.getElementById("boxs").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    } else {
      document.getElementById("boxf").style.display = "block";
      $('.dim.d-none').removeClass('d-none');
    }
  }
  
}
function retry() {
  document.getElementById("boxm").style.display = "none";
  document.getElementById("boxf").style.display = "none";
  $('.dim').addClass('d-none');
}
function showMenu(n) {
  var a = 0;
  var c = 0;
  var b = n.getAttribute('value');
  var i1 = document.getElementById("img1");
  var i2 = document.getElementById("img2");
  var i3 = document.getElementById("img3");
  var i4 = document.getElementById("img4");
  var n1 = document.getElementById("n1");
  var n2 = document.getElementById("n2");
  var n3 = document.getElementById("n3");
  var n4 = document.getElementById("n4");
  n1.innerHTML = "<h4>" + cStr.fList[a].fName + "</h4>";
  for (a in cStr.fList) {
    if (cStr.fList[a].fMealType == b) {
      if (c == 0) {
        i1.innerHTML = "<img src='" + cStr.fList[a].fPicLink + "'>";
        n1.innerHTML = cStr.fList[a].fName;
        c++;
      } else if (c == 1) {
        i2.innerHTML = "<img src='" + cStr.fList[a].fPicLink + "'>";
        n2.innerHTML = cStr.fList[a].fName;
        c++;
      } else if (c == 2) {
        i3.innerHTML = "<img src='" + cStr.fList[a].fPicLink + "'>";
        n3.innerHTML = cStr.fList[a].fName;
        c++;
      } else if (c == 3) {
        i4.innerHTML = "<img src='" + cStr.fList[a].fPicLink + "'>";
        n4.innerHTML = cStr.fList[a].fName;
        c++;
      }
    }
  }
  if (c == 3) {
    c = 0;
    a = 0;
  }
}


$(document).ready(function(){
  
  $(".role_dropdown").click(function(){
    $(".role_menu").toggleClass("showMenu");
      $(".role_menu > li").click(function(){
        $(".role_dropdown > p").html($(this).html());
          $(".role_menu").removeClass("showMenu");
      });
  });
  
});

