<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: login.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/nav.css" />
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/hover.css" />
  <link rel="stylesheet" href="css/custom-styles.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Dashboard</title>

  <style>
    body {
      -ms-overflow-style: none;

      scrollbar-width: none;

      overflow-y: scroll;
    }

    body::-webkit-scrollbar {
      display: none;
    }
  </style>
</head>

<body>




  <div class="my-nav fixed-top" style="background-color: black;">

    <nav class="navbar navbar-expand-md green-nav space">
      <div class="container-fluid">
        <a class="try" href="Index.php" style="height: 80px; padding-left: 10px; color: white;"><img src="images\hotel-logo (2).png" alt="" class="logo img-fluid" /></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item text-light me-4">
              <a class="nav-link home  text-light" style="letter-spacing: 0.2em;" aria-current="page" href="Index.php">MAIN</a>
            </li>
            <li class="nav-item me-4">
              <a class="nav-link about  text-light" style="letter-spacing: 0.2em;" href="reservation-booking.php">RESERVATION/BOOKING</a>
            </li>
            <li class="nav-item me-4">
              <a class="nav-link members  text-light" style="letter-spacing: 0.2em;" href="search.php">SEARCH</a>
            </li>
            <li class="nav-item d-flex justify-content-center align-items-center">
              <button class="btn" id="logout" title="Logout"><a href="logout.php"><i class="fa fa-sign-out" style="font-size:24px;color:white;top:-9px"></i></a></button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>


  <div class="d-flex justify-content-around align-items-center text-light flex-wrap flex-wrap" style="margin-top: 130px;">
    <div class="d-flex justify-content-center align-items-center flex-md-column a p-4">
      <div class="b">
        <h4>
          Standard room
        </h4>
        <div class="mt-4 pt-2"> <span class="me-2">Availables:</span>
          <span id="standard" class="mt-3 h5"></span>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center align-items-center flex-md-column a p-4">
      <div class="b">
        <h4>
          Family room
        </h4>
        <div class="mt-4 pt-2"> <span class="me-2">Availables:</span>
          <span id="family" class="mt- h5"></span>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center align-items-center flex-md-column a p-4">
      <div class="b">
        <h4>
          Suites room
        </h4>
        <div class="mt-4 pt-2"> <span class="me-2">Availables:</span>
          <span id="suites" class="mt-3 h5"></span>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center align-items-center flex-md-column a p-4">
      <div class="b">
        <h4>
          Total revenue
        </h4>
        <div class="mt-4"> <span class="me-2"><img src="images/download-removebg-preview.png" height="45px" alt=""></span>
          <span id="revenue" class="mt-3 h5">

          </span>
        </div>
      </div>
    </div>
  </div>

  <div id="roomTableContainer" class="m-5">
    <table>
      <thead>
        <tr>
          <th>Room Number</th>
          <th>Name</th>
          <th>Booking ID</th>
          <th>Reservation ID</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="roomTable">
      </tbody>
    </table>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <script>
    document.getElementById("logout").addEventListener("click", function() {
      if (!confirm("Are you sure you want to logout?")) {
        return;
      }

      window.location.href = "login.php";
    });
  </script>
  <script>
    $(document).ready(function() {
      // $.get("php/roomavailable.php", function(data) {
      //   $("#standard").text(` ${data.Standard}`);
      //   $("#suites").text(` ${data.Suites}`);
      //   $("#family").text(` ${data.Family}`);
      //   $("#revenue").text(`${data.total_bill}`);
      // });
    });
  </script>

  <script>
    // Execute the PHP script on page load
    $(document).ready(function() {


      $.get("php/roomavailable.php", function(data) {
        $("#standard").text(` ${data.Standard}`);
        $("#suites").text(` ${data.Suites}`);
        $("#family").text(` ${data.Family}`);
        $("#revenue").text(`${data.total_bill}`);
      });


      $.ajax({
        url: 'php/duedateforpendings.php',
        type: 'GET',
        success: function(response) {

          console.log(response);
        },
        error: function(xhr, status, error) {

          console.error(error);
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      rooms();
    });

    function rooms() {
      $.ajax({
        url: 'php/rooms.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {

          populateTable(data);
        },
        error: function(error) {
          console.error('Error:', error);
        }
      });
    }



    function populateTable(data) {
      var table = '<table border="1">';
      for (var i = 0; i < data.length; i++) {
        var bgColor = (data[i].status == "Available") ? "green" : "#d37474";
        table += '<tr class="text-dark">';
        table += '<td>' + data[i].room_number + '</td>';
        table += '<td>' + data[i].name + '</td>';
        table += '<td>' + data[i].booking_id + '</td>';
        table += '<td>' + data[i].reservation_id + '</td>';
        table += `<td style="background-color:${bgColor};">` + data[i].status + '</td>';
        table += '</tr>';
      }

      table += '</table>';
      $('#roomTable').html(table);
    }
  </script>

</body>

</html>