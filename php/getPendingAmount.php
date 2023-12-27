<?php
// Assuming you have a function to connect to your database
require_once('db.con.php');
$connection = connectToDB(); // Adjust this to match your connection method

// Check if searchID is received from the POST request
// Check if searchID is received from the POST request
if (isset($_POST['searchID'])) {
    $searchID = $_POST['searchID'];

    // Query to fetch pending payment amount based on searchID (customer_id or firstname/lastname)
    $sql = "SELECT pp.amount, pp.status 
    FROM pending_payments pp
    INNER JOIN reservations r ON pp.reservation_id = r.reservation_id
    INNER JOIN customers c ON r.customer_id = c.customer_id
    WHERE c.customer_id = ? 
    OR c.firstname = ? 
    OR c.lastname = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $searchID, $searchID, $searchID);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the amount
        $row = $result->fetch_assoc();
        $amount = $row['amount'];
        $status = $row['status'];

        // Return amount in JSON format
        echo json_encode(array('amount' => $amount, 'status' => $status));
    } else {
        // No pending payments found for the given searchID
        echo json_encode(array('error' => 'No pending payments found for the search ID'));
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
} else {
    // If searchID is not received, return an error message
    echo json_encode(array('error' => 'No search ID received'));
}
