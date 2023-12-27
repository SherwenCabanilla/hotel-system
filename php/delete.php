<?php

require_once('db.con.php');


$response = array();



// Check if a customer_id is sent via POST request
if (isset($_POST['customer_id'])) {
    // Establish a database connection
    $connection = connectToDB();

    if ($connection) {
        // Sanitize the received customer_id
        $customer_id = $connection->real_escape_string($_POST['customer_id']);

        // Prepare the DELETE query based on the customer_id
        $query = "DELETE FROM customers WHERE customer_id = $customer_id";

        // Execute the query
        if ($connection->query($query) === TRUE) {
            // Return a success message to the frontend
            $response['success'] = true;
            $response['message'] = "Customer deleted successfully";


            $sql = "SELECT * FROM rooms";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Check if both reservation_id and booking_id are NULL
                    if ($row['reservation_id'] === NULL && $row['booking_id'] === NULL) {
                        // Update status to 'Available'
                        $roomId = $row['room_number'];
                        $updateSql = "UPDATE rooms SET status = 'Available' WHERE room_number = $roomId";
                        if ($connection->query($updateSql) === TRUE) {
                            // echo "Room ID: " . $roomId . " - Status updated to 'Available'";
                        } else {
                            // echo "Error updating status: " . $connection->error;
                        }
                    }
                }
            } else {
                echo "No rooms found";
            }
        } else {
            // Return an error message to the frontend
            $response['success'] = false;
            $response['message'] = "Error executing query: " . $connection->error;
        }

        // Close the database connection
        $connection->close();
    } else {
        // Database connection error
        $response['success'] = false;
        $response['message'] = "Database connection error";
    }
} else {
    // If no valid customer_id is provided
    $response['success'] = false;
    $response['message'] = "No valid customer_id provided";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
