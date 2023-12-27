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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/nav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/hover.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>Reservation-booking</title>

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





  <form id="completeReservationForm" method="post">

    <div class="container mb-5 text-light p-5 mt-5 rounded" id="form">

      <div class="container mb-5  p-5 mt-5 rounded info" id="form">
        <div class="d-flex justify-content-center align-items-center">
          <h1>INFORMATION</h1>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="form-group">
              <label for="first_name">First Name:</label>
              <input type="text" class="form-control" id="first_name" name="first_name" autocomplete="given-name" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="last_name">Last Name:</label>
              <input type="text" class="form-control" id="last_name" name="last_name" autocomplete="family-name" required>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-1">
            <div class="form-group">
              <label for="age">Age:</label>
              <input type="number" class="form-control" id="age" name="age" autocomplete="age" required>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="contact_number">Contact #:</label>
              <input type="tel" class="form-control" id="contact_number" name="contact_number" autocomplete="tel" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="sex">Sex:</label>
              <select class="form-control" id="sex" name="sex" autocomplete="sex" required>
                <option value="">Select sex</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
              </select>
            </div>
          </div>
        </div>
        <!-- Reservation Details Form -->
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="form-group">
              <label for="checkin">Check-in</label>
              <input type="date" class="form-control" id="checkin" name="checkin" autocomplete="off" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="checkout">Check-out</label>
              <input type="date" class="form-control" id="checkout" name="checkout" autocomplete="off" required>
            </div>
          </div>
        </div>

      </div>
      <div class="row justify-content-center">
        <div class="col-md-4 text-light">
          <div class="form-group ">
            <label for="serviceType">Service Type:</label>
            <select class="form-control" id="serviceType" name="serviceType" required>
              <option value="">Select service</option>
              <option value="reservation">Reservation</option>
              <option value="booking">Booking</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="container form-container ">
      <div class="container form-container mt-5 ">
        <div class="d-flex justify-content-center align-items-center mb-3 text-light">
          <h2>Select room type</h2>
        </div>
        <div class="container form-container">
          <div class="d-flex justify-content-around">
            <div class="card room-card a" style="width: 18rem;">
              <img src="images/standard.jpg" class="card-img-top" alt="Standard Room">
              <div class="card-body">
                <h5 class="card-title">Standard Room</h5>
                <p class="card-text"> P3500/night</p>
                <input type="radio" id="standard" name="roomtype" value="Standard">
                <!-- <label for="standard" class="btn btn-primary">Select</label> -->
              </div>
            </div>
            <div class="card room-card b" style="width: 18rem;">
              <img src="images/suites.jpg" class="card-img-top" alt="Suites">
              <div class="card-body">
                <h5 class="card-title">Suite Room</h5>
                <p class="card-text">P5499/night</p>
                <input type="radio" id="suite" name="roomtype" value="Suites">
                <input type="hidden" value="5499" id="fam">
                <!-- <label for="suite" class="btn btn-primary">Select</label> -->
              </div>
            </div>
            <div class="card room-card c" style="width: 18rem;">
              <img src="images/family.jpg" class="card-img-top" alt="Family Room">
              <div class="card-body">
                <h5 class="card-title">Family Room</h5>
                <p class="card-text">P7599/night</p>
                <input type="radio" id="family" name="roomtype" value="Family">
                <!-- <label for="family" class="btn btn-primary">Select</label> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container form-container mt-5">
        <div class="d-flex justify-content-center align-items-center mb-3 text-light">
          <h2>Select Amenities</h2>
        </div>

        <div class="card-deck d-flex flex-md-wrap justify-content-around">
          <div class="card amenity-card m-3" style="width: 18rem;">
            <img src="images/breakfast.jpg" class="card-img-top" alt="Breakfast">
            <div class="card-body">
              <h5 class="card-title">Breakfast</h5>
              <input type="checkbox" id="breakfast" name="breakfast" value="500">

              <label for="breakfast">Include breakfast (₱500)</label>
            </div>
          </div>
          <div class="card amenity-card m-3" style="width: 18rem;">
            <img src="images/pool.jpg" class="card-img-top" alt="Pool">
            <div class="card-body">
              <h5 class="card-title">Pool</h5>
              <input type="checkbox" id="pool" name="pool" value="850">
              <label for="pool">Access to pool (₱850)</label>
            </div>
          </div>
          <!-- Add similar structures for other amenities -->
          <div class="card amenity-card m-3" style="width: 18rem;">
            <img src="images/spa.jpg" class="card-img-top" alt="Spa">
            <div class="card-body">
              <h5 class="card-title">Spa</h5>
              <input type="checkbox" id="spa" name="spa" value="600">
              <label for="spa">Spa services (₱600)</label>
            </div>
          </div>
          <div class="card amenity-card m-3" style="width: 18rem;">
            <img src="images/bathroomEssential.jpg" class="card-img-top" alt="bathroomessentials">
            <div class="card-body">
              <h5 class="card-title">Bathroom Essentials</h5>
              <input type="checkbox" id="bathroomessentials" name="bathroomessentials" value="550">
              <label for="spa">Bathroom Essentials (₱550)</label>
            </div>
          </div>
          <div class="card amenity-card m-3" style="width: 18rem;">
            <img src="images/roomService.jpg" class="card-img-top" alt="roomservice">
            <div class="card-body">
              <h5 class="card-title">Room Service</h5>
              <input type="checkbox" id="roomservice" name="roomservice" value="1000">
              <label for="roomservice">Room Service (₱1000)</label>
            </div>
          </div>
          <div class="card amenity-card m-3" style="width: 18rem;">
            <img src="images/wifi.jpg" class="card-img-top" alt="wifi">
            <div class="card-body">
              <h5 class="card-title">Wifi</h5>
              <input type="checkbox" id="wifi" name="wifi" value="200">
              <label for="wifi">Wifi (₱200)</label>
            </div>
          </div>
        </div>
        <input type="hidden" id="total" value="" name="total">
      </div>
  </form>




  <div class="d-flex justify-content-center align-items-center m-5">
    <button type="submit" class="btn btn-light" style="font-weight: bold; color:#4F4F4F;" id="submitBtn" onclick="calculateStay()">SUBMIT</button>
  </div>












  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>



  <script src="resbok.js"></script>


  <script>
    function paymentConfimation() {
      const serviceType = document.getElementById('serviceType').value

      alert(serviceType);
      if (serviceType == "booking") {
        if (confirm("Confirm payment for " + document.getElementById("total").value + "?")) {
          alert("Payment Successful");
        } else {
          return
        }
      }
    }



    document.querySelectorAll('.room-card').forEach(card => {
      card.addEventListener('click', function() {
        const radioBtn = this.querySelector('input[type="radio"]');
        if (radioBtn) {
          radioBtn.click();
        }
      });
    });


    document.querySelectorAll('.amenity-card').forEach(card => {
      card.addEventListener('click', function() {
        const checkbox = this.querySelector('input[type="checkbox"]');
        if (checkbox) {
          checkbox.checked = !checkbox.checked;

        }
      });
    });





    function calculateTotalCost() {
      const breakfastChecked = document.getElementById('breakfast').checked;
      const breakfastVal = parseFloat(document.getElementById('breakfast').value);

      const wifiChecked = document.getElementById('wifi').checked;
      const wifiVal = parseFloat(document.getElementById('wifi').value);

      const poolChecked = document.getElementById('pool').checked;
      const poolVal = parseFloat(document.getElementById('pool').value);

      const roomServiceChecked = document.getElementById('roomservice').checked;
      const roomServiceVal = parseFloat(document.getElementById('roomservice').value);

      const spaChecked = document.getElementById('spa').checked;
      const spaVal = parseFloat(document.getElementById('spa').value);

      const bathroomEssentialsChecked = document.getElementById('bathroomessentials').checked;
      const bathroomEssentialsVal = parseFloat(document.getElementById('bathroomessentials').value);

      let totalCost = 0;

      if (breakfastChecked) {
        totalCost += breakfastVal;
      }

      if (wifiChecked) {
        totalCost += wifiVal;
      }

      if (poolChecked) {
        totalCost += poolVal;
      }

      if (roomServiceChecked) {
        totalCost += roomServiceVal;
      }

      if (spaChecked) {
        totalCost += spaVal;
      }

      if (bathroomEssentialsChecked) {
        totalCost += bathroomEssentialsVal;
      }

      // document.getElementById('total').value = totalCost;
      return totalCost
    }


    function calculateStay() {


      // Get the check-in and check-out date input elements
      const checkinInput = document.getElementById("checkin");
      const checkoutInput = document.getElementById("checkout");




      // Convert the input values to Date objects
      const checkinDate = new Date(checkinInput.value);
      const checkoutDate = new Date(checkoutInput.value);

      // Check for valid dates
      if (isNaN(checkinDate.getTime()) || isNaN(checkoutDate.getTime())) {
        console.log("Invalid dates.");
        return null;
      }

      // Calculate the time difference in milliseconds
      const timeDifference = checkoutDate.getTime() - checkinDate.getTime();

      // Check if checkout date is before checkin date
      if (timeDifference < 0) {
        // alert("Checkout date should be after checkin date.");
        return null;
      }

      // Convert milliseconds to days
      const daysStayed = Math.ceil(timeDifference / (1000 * 3600 * 24));

      // Output the result
      console.log("Number of days stayed:", daysStayed);
      return daysStayed; // You can return this value for further use if needed
    }




    $(document).ready(function() {
      $("#submitBtn").click(function(e) {
        e.preventDefault(); // Prevent default form submission



        var selectedRoomValue = null;

        const roomTypeRadios = document.querySelectorAll('input[name="roomtype"]');
        roomTypeRadios.forEach((radio) => {
          if (radio.checked) {
            selectedRoomValue = parseInt(radio.parentNode.querySelector("p").innerText.match(/\d+/)[0]);
            console.log("Selected room value:", selectedRoomValue);
          }
        });

        const daysStayed = calculateStay();
        if (selectedRoomValue !== null && daysStayed !== null) {
          const total = document.getElementById("total").value = (selectedRoomValue * daysStayed) + calculateTotalCost();
          console.log("Total amount: ₱", total);

          if (document.getElementById("serviceType").value == "") {
            alert("please select service type");
            return
          }
          if (document.getElementById('serviceType').value == "booking") {
            if (!confirm("Total Payment for " + daysStayed + " days of Stay is " + `₱${total}` + " Do you want to proceed?")) {
              return; // If not confirmed, stop further execution
            } else {
              alert("Payment Successful");

            }
          } else {
            if (!confirm("Total Payment for " + daysStayed + " days of Stay is " + `₱${total}` + " Do you want to proceed for a reservation?")) {
              return;
            } else {
              alert("Reservation done!!")
            }
          }



          var complete = $("#completeReservationForm").serialize();

          $.ajax({
            type: "POST",
            url: "php/completeForm.php",
            data: complete,
            success: function(response) {
              // Handle success response
              console.log(response);
            },
            error: function(error) {
              // Handle error
              console.error(error);
            },
          });
          window.location.reload();
        } else {
          alert("Please select a room and provide valid dates.");
        }
      });


    });
  </script>


</body>

</html>