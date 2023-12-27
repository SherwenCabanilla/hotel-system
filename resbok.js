//if you're checking these codes sir, i'm really sorry for not separating properly all the javascript codes.
//we encountered a lot of bugs when we separate the javascript code from the file where we need it.

function calculateTotalCost() {
  // Get all the checkboxes
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      let totalCost = 0; // Reset total cost

      // Loop through checkboxes to calculate total cost
      checkboxes.forEach((chk) => {
        if (chk.checked) {
          // Add the value of the checked checkbox to the total cost
          totalCost += parseInt(chk.value);
        }
      });

      // Update the hidden input field with the total cost
      return totalCost;
    });
  });
}

function existingCustomer() {
  document.getElementById("first_name").disabled = true;
  const val = document.getElementById("first_name").value; // Hide new customer fields
  if (val != "") {
    document.getElementById("first_name").disabled = false;
  }
}

document.getElementById("logout").addEventListener("click", function () {
  if (!confirm("Are you sure you want to logout?")) {
    return;
  }

  window.location.href = "login.php";
});

// function paymentConfimation() {
//   const serviceType = document.getElementById("serviceType").value;

//   alert(serviceType);
//   if (serviceType == "booking") {
//     if (
//       confirm(
//         "Confirm payment for " + document.getElementById("total").value + "?"
//       )
//     ) {
//       alert("Payment Successful");
//     } else {
//       return;
//     }
//   }
// }

// document.querySelectorAll(".room-card").forEach((card) => {
//   card.addEventListener("click", function () {
//     const radioBtn = this.querySelector('input[type="radio"]');
//     if (radioBtn) {
//       radioBtn.click();
//     }
//   });
// });

// document.querySelectorAll(".amenity-card").forEach((card) => {
//   card.addEventListener("click", function () {
//     const checkbox = this.querySelector('input[type="checkbox"]');
//     if (checkbox) {
//       checkbox.checked = !checkbox.checked;
//       // updateTotal(); // Call a function to update the total amount
//     }
//   });
// });

// function calculateTotalCost() {
//   const breakfastChecked = document.getElementById("breakfast").checked;
//   const breakfastVal = parseFloat(document.getElementById("breakfast").value);

//   const wifiChecked = document.getElementById("wifi").checked;
//   const wifiVal = parseFloat(document.getElementById("wifi").value);

//   const poolChecked = document.getElementById("pool").checked;
//   const poolVal = parseFloat(document.getElementById("pool").value);

//   const roomServiceChecked = document.getElementById("roomservice").checked;
//   const roomServiceVal = parseFloat(
//     document.getElementById("roomservice").value
//   );

//   const spaChecked = document.getElementById("spa").checked;
//   const spaVal = parseFloat(document.getElementById("spa").value);

//   const bathroomEssentialsChecked =
//     document.getElementById("bathroomessentials").checked;
//   const bathroomEssentialsVal = parseFloat(
//     document.getElementById("bathroomessentials").value
//   );

//   let totalCost = 0;

//   if (breakfastChecked) {
//     totalCost += breakfastVal;
//   }

//   if (wifiChecked) {
//     totalCost += wifiVal;
//   }

//   if (poolChecked) {
//     totalCost += poolVal;
//   }

//   if (roomServiceChecked) {
//     totalCost += roomServiceVal;
//   }

//   if (spaChecked) {
//     totalCost += spaVal;
//   }

//   if (bathroomEssentialsChecked) {
//     totalCost += bathroomEssentialsVal;
//   }

//   // document.getElementById('total').value = totalCost;
//   return totalCost;
// }

// function calculateStay() {
//   // Get the check-in and check-out date input elements
//   const checkinInput = document.getElementById("checkin");
//   const checkoutInput = document.getElementById("checkout");

//   // Convert the input values to Date objects
//   const checkinDate = new Date(checkinInput.value);
//   const checkoutDate = new Date(checkoutInput.value);

//   // Check for valid dates
//   if (isNaN(checkinDate.getTime()) || isNaN(checkoutDate.getTime())) {
//     console.log("Invalid dates.");
//     return null;
//   }

//   // Calculate the time difference in milliseconds
//   const timeDifference = checkoutDate.getTime() - checkinDate.getTime();

//   // Check if checkout date is before checkin date
//   if (timeDifference < 0) {
//     // alert("Checkout date should be after checkin date.");
//     return null;
//   }

//   // Convert milliseconds to days
//   const daysStayed = Math.ceil(timeDifference / (1000 * 3600 * 24));

//   // Output the result
//   console.log("Number of days stayed:", daysStayed);
//   return daysStayed; // You can return this value for further use if needed
// }

// $(document).ready(function () {
//   $("#submitBtn").click(function (e) {
//     e.preventDefault(); // Prevent default form submission

//     // if (!confirm("Are you sure you want to submit?")) {
//     //   return; // If not confirmed, stop further execution
//     // }

//     var selectedRoomValue = null;

//     const roomTypeRadios = document.querySelectorAll('input[name="roomtype"]');
//     roomTypeRadios.forEach((radio) => {
//       if (radio.checked) {
//         selectedRoomValue = parseInt(
//           radio.parentNode.querySelector("p").innerText.match(/\d+/)[0]
//         );
//         console.log("Selected room value:", selectedRoomValue);
//       }
//     });

//     const daysStayed = calculateStay();
//     if (selectedRoomValue !== null && daysStayed !== null) {
//       const total = (document.getElementById("total").value =
//         selectedRoomValue * daysStayed + calculateTotalCost());
//       console.log("Total amount: ₱", total);

//       if (document.getElementById("serviceType").value == "") {
//         alert("please select service type");
//         return;
//       }
//       if (document.getElementById("serviceType").value == "booking") {
//         if (
//           !confirm(
//             "Total Payment for " +
//               daysStayed +
//               " days of Stay is " +
//               `₱${total}` +
//               " Do you want to proceed?"
//           )
//         ) {
//           return; // If not confirmed, stop further execution
//         } else {
//           alert("Payment Successful");
//         }
//       } else {
//         if (
//           !confirm(
//             "Total Payment for " +
//               daysStayed +
//               " days of Stay is " +
//               `₱${total}` +
//               " Do you want to proceed for a reservation?"
//           )
//         ) {
//           return;
//         } else {
//           alert("Reservation done!!");
//         }
//       }

//       // Proceed with form submission via AJAX
//       var complete = $("#completeReservationForm").serialize();
//       // Send reservation form data to reservation.php using AJAX
//       $.ajax({
//         type: "POST",
//         url: "php/completeForm.php", // Update URL to your PHP file
//         data: complete, // Use the serialized form data
//         success: function (response) {
//           // Handle success response
//           console.log(response);
//         },
//         error: function (error) {
//           // Handle error
//           console.error(error);
//         },
//       });
//       window.location.reload();
//     } else {
//       alert("Please select a room and provide valid dates.");
//     }
//   });
// });
