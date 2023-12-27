<?php


// Include your database connection or establish a connection here
// For example purposes, assuming you have a db.con.php file

include_once('db.con.php');

// Assuming you have a function to connect to the database

// Ensure only JSON is output
header('Content-Type: application/json');


$connection = connectToDB();

// Fetch and sanitize the updated data from the POST request
$customerId = $_POST['customer_id'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$phoneNumber = $_POST['phone_number'];

// Prepare and execute the update query
$stmt = $connection->prepare("UPDATE customers SET firstname=?, lastname=?, age=?, gender=?, phone_number=? WHERE customer_id=?");
$stmt->bind_param("ssisss", $firstName, $lastName, $age, $gender, $phoneNumber, $customerId);

if ($stmt->execute()) {
    // If the update is successful
    $response = array('status' => 'success', 'message' => 'Customer details updated successfully');
    echo json_encode($response);
} else {
    // If there's an error in the update
    $response = array('status' => 'error', 'message' => 'Error updating customer details');
    echo json_encode($response);
}

$stmt->close();
$connection->close();
