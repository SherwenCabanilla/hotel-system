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


  <link rel="stylesheet" href="css/search.css" />
  <link rel="stylesheet" href="css/nav.css" />
  <link rel="stylesheet" href="css/hover.css" />
  <!-- <link rel="stylesheet" href="css/custom-style.css" /> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Search</title>
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


  <div class="container p-5 mt-5" id="form">
    <div class="row justify-content-center">
      <div class="col-md-3 position-relative">
        <form id="searchForm">
          <div class="form-group">
            <label for="search_id" class="mt-3"></label>
            <div class="input-group">
              <input type="text" class="form-control" id="search_id" name="search_id" placeholder="Search Data" onchange="fetchDataAndDisplay()" required>
              <div class="input-group-append ms-2">
                <button type="submit" class="btn text-light border-light" style="background-color: black;">Search</button>
              </div>
            </div>
          </div>
        </form>
        <form action="" id="reservation" class="position-absolute" style="right:-100px; top:24px">
          <input type="hidden" id="reservationID">
          <button type="submit" class="btn btn-light text-light" id="searchreservation" style="background-color: black;">Reservation</button>
        </form>
      </div>
    </div>
    <div class="row justify-content-center mt-4">
      <div class="col-md-8" id="tableContainer"></div>
    </div>
  </div>


  <div class="postion-relative d-flex justify-content-center align-items-center mt-5">
    <div class="container p-5 position-absolute" id="form" style="left:120px; ">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-striped bg-light" id="dataTable">

              <tr class="bg-light"></tr>
              <thead>
                <tr class="bg-light"></tr>
              </thead>
              <tbody id="tableBody">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center align-items-center position-relative" style="margin-top: 50px;">
    <div class="col-md-8">
      <h1 class="text-center mb-4 text-light">Amenities Selected</h1>
      <div class="table-responsive">
        <table class="tbl table-bordered table-striped bg-light mx-auto px-3">
          <thead class="thead-dark">
            <tr>
              <th scope="col" class="pe-5 ps-5">Breakfast</th>
              <th scope="col" class="pe-5 ps-5">WiFi</th>
              <th scope="col" class="pe-5 ps-5">Pool</th>
              <th scope="col" class="pe-5 ps-5">Room Service</th>
              <th scope="col" class="pe-5 ps-5">Spa</th>
              <th scope="col" class="pe-5 ps-5">Bathroom Essentials</th>
            </tr>
          </thead>
          <tbody class="tb">

          </tbody>
        </table>
      </div>
      <div class="text-center mt-4 ">
        <p id="pending" class="text-light"></p>
        <p id="status" class="text-light"></p>
      </div>
    </div>
  </div>






  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Update Customer Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateForm">
            <div class="mb-3">
              <label for="firstName">First Name</label>
              <input type="text" class="form-control" id="firstName">
            </div>
            <div class="mb-3">
              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName">
            </div>
            <div class="mb-3">
              <label for="age">Age</label>
              <input type="number" class="form-control" id="age">
            </div>
            <div class="mb-3">
              <label for="gender">Gender</label>
              <select class="form-control" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="phoneNumber">Phone Number</label>
              <input type="text" class="form-control" id="phoneNumber">
            </div>
            <input type="hidden" id="customerId">

            <button type="submit" class="btn btn-primary" onclick="alert('Saved Changes')">Save Changes</button>
          </form>

        </div>
      </div>
    </div>
  </div>









  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>



  <script src="search.js"></script>

  <!-- <script>
    $(document).ready(function() {
      $("#searchForm").submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        fetchDataAndDisplay(); // Call the function to fetch and display data
        fetchAmenities();
        fetchPendingPaymentAmount();

        $("#updateForm").submit(function(event) {
          event.preventDefault();
          const customerId = $("#customerId").val();
          const updatedData = {
            firstname: $("#firstName").val(),
            lastname: $("#lastName").val(),
            age: $("#age").val(),
            gender: $("#gender").val(),
            phone_number: $("#phoneNumber").val(),
            customer_id: customerId
          };

          // Perform an AJAX request to update the data on the server
          $.ajax({
            type: "POST",
            url: "php/updateData.php", // Replace with your server endpoint for updating customer data
            data: updatedData,
            dataType: "json",
            success: function(response) {
              // Handle success (e.g., hide modal, update table if necessary)
              $("#updateModal").modal("hide");
              // Refresh your table or update the specific row with the updated data
              fetchDataAndDisplay(); // Assuming this function retrieves and displays the updated data
            },
            error: function(xhr, status, error) {
              console.error("Error:", error);
              // Handle error cases here
            }
          });
        });
      });
    });

    function fetchDataAndDisplay() {
      const searchValue = $("#search_id").val();

      $.ajax({
        type: "POST",
        url: "php/searchdata.php",
        data: {
          search_id: searchValue
        },
        dataType: "json",
        success: function(data) {
          const tableHeaderRow = $("#dataTable thead tr");
          const tableBody = $("#tableBody");

          tableHeaderRow.empty();
          tableBody.empty();

          if (data.length > 0) {
            const keys = Object.keys(data[0]); // Define keys here within success block

            keys.forEach(function(key) {
              $("<th>").text(key).appendTo(tableHeaderRow);
            });

            data.forEach(function(item) {
              const row = $("<tr>").appendTo(tableBody);

              keys.forEach(function(key) {
                $("<td>").text(item[key]).appendTo(row);
              });

              const deleteButton = $("<button>")
                .text("Delete")
                .addClass("btn btn-danger btn-sm me-2")
                .click(function() {
                  deleteRow(item.customer_id);
                });

              const updateButton = $("<button>")
                .text("Update")
                .addClass("btn btn-primary btn-sm")
                .click(function() {
                  // deleteRow(item.customer_id);
                  populateModalForUpdate(item);
                });

              $("<td>").append(deleteButton, updateButton).appendTo(row);
            });
          } else {
            tableBody.append('<tr><td colspan="1">No data found.</td></tr>');
          }
        },
        error: function(xhr, status, error) {
          console.error("Error:", error);
        },
      });
    }
  </script>


  <script>
    $(document).ready(function() {
      $('#reservation').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        document.getElementById('reservationID').value = document.getElementById("search_id").value;

        if (document.getElementById('reservationID').value == null || document.getElementById('reservationID').value == "") {
          alert("NO DATA FOUND, PLEASE CHECK!!");
          return;
        }
        if (!confirm("Confirm Payment for this reservation?")) {
          return;
        } else {
          alert("Payment Confirmed");
          window.location.reload();
        }


        // Get the reservation ID from the hidden input field
        var reservationID = $('#reservationID').val();

        // AJAX request to send data to PHP
        $.ajax({
          type: 'POST',
          url: 'php/confirmPaymentForReservation.php',
          data: {
            reservationID: reservationID
          }, // Data to be sent to PHP
          success: function(response) {
            // Handle the response from PHP (if needed)
            console.log(response);
          },
          error: function(xhr, status, error) {
            // Handle errors (if any)
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>




  <script>
    function fetchAmenities() {
      var searchId = $('#search_id').val(); // Fetch your search ID here or manually enter it

      // AJAX request to fetch data based on the search ID
      $.ajax({
        type: 'POST',
        url: 'php/fetchAmenities.php', // Replace with your PHP file handling data retrieval
        data: {
          searchID: searchId // Change 'searchId' to 'searchID' to match the backend script
        },
        success: function(response) {
          var amenities = JSON.parse(response);
          displayAmenities(amenities);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }

    function displayAmenities(amenities) {
      var tableContent = '';

      if (amenities && amenities.length > 0) {
        // Loop through amenities array to display multiple rows if needed
        amenities.forEach(function(amenity) {
          tableContent += '<tr>';
          tableContent += `<td class='ps-3'>${amenity.breakfast}</td>`;
          tableContent += `<td class='ps-3'>${amenity.wifi}</td>`;
          tableContent += `<td class='ps-3'>${amenity.pool}</td>`;
          tableContent += `<td class='ps-3'>${amenity.room_service}</td>`;
          tableContent += `<td class='ps-3'>${amenity.spa}</td>`;
          tableContent += `<td class='ps-3'>${amenity.bathroom_essentials}</td>`;
          tableContent += '</tr>';
        });
      } else {
        tableContent += '<tr><td colspan="6">No data found</td></tr>';
      }

      $('.tbl .tb').html(tableContent);
    }
  </script>


  <script>
    function fetchPendingPaymentAmount() {
      var searchID = $('#search_id').val(); // Fetch the searchID from your HTML input or other element

      // AJAX request to fetch pending payment amount based on searchID
      $.ajax({
        type: 'POST',
        url: 'php/getPendingAmount.php', // Replace 'php_script_file.php' with the path to your PHP script
        data: {
          searchID: searchID
        },
        success: function(response) {
          var result = JSON.parse(response);
          var hasData = false; // Flag to track if data is found or not
          if (result.error) {
            // Handle error case
            console.error(result.error);
          } else {
            // Display the amount
            var amount = result.amount;
            var status = result.status;
            $('#pending').text('Pending Payment Amount: ' + amount);
            $('#status').text('Status: ' + status);
            hasData = true; // Data found, set the flag to true
          }

          // If no data found, update the display to show 'N/A'
          if (!hasData) {
            $('#pending').text('Pending Payment Amount: N/A');
            $('#status').text('Status: N/A');
          }
        },
        error: function(xhr, status, error) {
          // Handle AJAX error
          console.error(error);
          // Update display when data not found in pending payments
          $('#pending').text('Pending Payment Amount: N/A');
          $('#status').text('Status: N/A');
        }
      });
    }
  </script> -->








</body>

</html>