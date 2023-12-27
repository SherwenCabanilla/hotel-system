<?php
// fetchAmenities.php

// Assuming you have a function to connect to your database
require_once('db.con.php');
$connection = connectToDB(); // Adjust this to match your connection method

// Check if searchID is received from the POST request
if (isset($_POST['searchID'])) {
    $searchID = $_POST['searchID'];

    // Query to fetch amenities based on searchID (can be first_name, last_name, or customer_id)
    $sql = "SELECT amenities.* 
            FROM customers 
            LEFT JOIN reservations ON customers.customer_id = reservations.customer_id
            LEFT JOIN bookings ON customers.customer_id = bookings.customer_id
            JOIN room_types ON COALESCE(reservations.room_type_id, bookings.room_type_id) = room_types.room_type_id
            JOIN amenities ON room_types.amenity_id = amenities.amenity_id
            WHERE customers.customer_id = ? 
            OR customers.firstname = ? 
            OR customers.lastname = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $searchID, $searchID, $searchID);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch data and store in an associative array
        $amenitiesData = $result->fetch_all(MYSQLI_ASSOC);

        // Return data in JSON format
        echo json_encode($amenitiesData);
    } else {
        // No data found for the given search ID
        echo json_encode(array('error' => 'No amenities found for the search ID'));
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
} else {
    // If searchID is not received, return an error message
    echo json_encode(array('error' => 'No search ID received'));
}
