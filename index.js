//if you're checking these codes sir, i'm really sorry for not separating properly all the javascript codes.
//we encountered a lot of bugs when we separate the javascript code from the file where we need it.

$(document).ready(function () {
  $.get("php/roomavailable.php", function (data) {
    const availableStandardRooms = data[0].available_rooms;
    $("#standard").text(`Available Standard Rooms: ${availableStandardRooms}`);

    console.log(`Available Standard Rooms: ${availableStandardRooms}`);
  });
});

document.getElementById("logout").addEventListener("click", function () {
  if (!confirm("Are you sure you want to logout?")) {
    return;
  }
  window.location.href = "login.php";
});
