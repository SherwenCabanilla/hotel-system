//if you're checking these codes sir, i'm really sorry for not separating properly all the javascript codes.
//we encountered a lot of bugs when we separate the javascript code from the file where we need it.

function deleteRow(customerId) {
  console.log(customerId);

  let cont = confirm("Are you sure you want to delete this data?");
  if (!cont) {
    alert("Data deletion cancelled");
    return;
  }

  $.ajax({
    type: "POST",
    url: "php/delete.php",
    data: {
      customer_id: customerId,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        alert("Data deleted successfully!!");
        location.reload();
      } else {
        console.error("Deletion failed:", response.message);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
}

function populateModalForUpdate(customerData) {
  $("#firstName").val(customerData.firstname);
  $("#lastName").val(customerData.lastname);
  $("#age").val(customerData.age);
  $("#gender").val(customerData.gender);
  $("#phoneNumber").val(customerData.phone_number);
  $("#customerId").val(customerData.customer_id);

  // Show the modal
  $("#updateModal").modal("show");
}

document.getElementById("logout").addEventListener("click", function () {
  if (!confirm("Are you sure you want to logout?")) {
    return;
  }

  window.location.href = "login.php";
});

$(document).ready(function () {
  $("#searchForm").submit(function (event) {
    event.preventDefault();
    fetchDataAndDisplay();
    fetchAmenities();
    fetchPendingPaymentAmount();

    $("#updateForm").submit(function (event) {
      event.preventDefault();
      const customerId = $("#customerId").val();
      const updatedData = {
        firstname: $("#firstName").val(),
        lastname: $("#lastName").val(),
        age: $("#age").val(),
        gender: $("#gender").val(),
        phone_number: $("#phoneNumber").val(),
        customer_id: customerId,
      };

      $.ajax({
        type: "POST",
        url: "php/updateData.php",
        data: updatedData,
        dataType: "json",
        success: function (response) {
          $("#updateModal").modal("hide");

          fetchDataAndDisplay();
        },
        error: function (xhr, status, error) {
          console.error("Error:", error);
          // Handle error cases here
        },
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
      search_id: searchValue,
    },
    dataType: "json",
    success: function (data) {
      const tableHeaderRow = $("#dataTable thead tr");
      const tableBody = $("#tableBody");

      tableHeaderRow.empty();
      tableBody.empty();

      if (data.length > 0) {
        const keys = Object.keys(data[0]);

        keys.forEach(function (key) {
          $("<th>").text(key).appendTo(tableHeaderRow);
        });

        data.forEach(function (item) {
          const row = $("<tr>").appendTo(tableBody);

          keys.forEach(function (key) {
            $("<td>").text(item[key]).appendTo(row);
          });

          const deleteButton = $("<button>")
            .text("Delete")
            .addClass("btn btn-danger btn-sm me-2")
            .click(function () {
              deleteRow(item.customer_id);
            });

          const updateButton = $("<button>")
            .text("Update")
            .addClass("btn btn-primary btn-sm")
            .click(function () {
              // deleteRow(item.customer_id);
              populateModalForUpdate(item);
            });

          $("<td>").append(deleteButton, updateButton).appendTo(row);
        });
      } else {
        tableBody.append('<tr><td colspan="1">No data found.</td></tr>');
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
}

$(document).ready(function () {
  $("#reservation").submit(function (event) {
    event.preventDefault();

    document.getElementById("reservationID").value =
      document.getElementById("search_id").value;

    if (
      document.getElementById("reservationID").value == null ||
      document.getElementById("reservationID").value == ""
    ) {
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
    var reservationID = $("#reservationID").val();

    // AJAX request to send data to PHP
    $.ajax({
      type: "POST",
      url: "php/confirmPaymentForReservation.php",
      data: {
        reservationID: reservationID,
      }, // Data to be sent to PHP
      success: function (response) {
        // Handle the response from PHP
        console.log(response);
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
      },
    });
  });
});

function fetchAmenities() {
  var searchId = $("#search_id").val();

  $.ajax({
    type: "POST",
    url: "php/fetchAmenities.php",
    data: {
      searchID: searchId,
    },
    success: function (response) {
      var amenities = JSON.parse(response);
      displayAmenities(amenities);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}

function displayAmenities(amenities) {
  var tableContent = "";

  if (amenities && amenities.length > 0) {
    amenities.forEach(function (amenity) {
      tableContent += "<tr>";
      tableContent += `<td class='ps-3'>${amenity.breakfast}</td>`;
      tableContent += `<td class='ps-3'>${amenity.wifi}</td>`;
      tableContent += `<td class='ps-3'>${amenity.pool}</td>`;
      tableContent += `<td class='ps-3'>${amenity.room_service}</td>`;
      tableContent += `<td class='ps-3'>${amenity.spa}</td>`;
      tableContent += `<td class='ps-3'>${amenity.bathroom_essentials}</td>`;
      tableContent += "</tr>";
    });
  } else {
    tableContent += '<tr><td colspan="6">No data found</td></tr>';
  }

  $(".tbl .tb").html(tableContent);
}

function fetchPendingPaymentAmount() {
  var searchID = $("#search_id").val();

  // AJAX request to fetch pending payment amount based on searchID
  $.ajax({
    type: "POST",
    url: "php/getPendingAmount.php",
    data: {
      searchID: searchID,
    },
    success: function (response) {
      var result = JSON.parse(response);
      var hasData = false; // Flag to track if data is found or not
      if (result.error) {
        // Handle error case
        console.error(result.error);
      } else {
        // Display the amount
        var amount = result.amount;
        var status = result.status;
        $("#pending").text("Pending Payment Amount: " + amount);
        $("#status").text("Status: " + status);
        hasData = true; // Data found, set the flag to true
      }

      if (!hasData) {
        $("#pending").text("Pending Payment Amount: N/A");
        $("#status").text("Status: N/A");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);

      $("#pending").text("Pending Payment Amount: N/A");
      $("#status").text("Status: N/A");
    },
  });
}
