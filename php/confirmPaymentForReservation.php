<?php
require_once('db.con.php');

$connection = connectToDB();


if (isset($_POST['reservationID'])) {
    $customerID = $_POST['reservationID'];

    // Prepare and execute a SQL query to search for the customer ID in the reservations table
    $sql = "SELECT reservation_id FROM reservations WHERE customer_id = $customerID";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Customer ID found in the reservations table
        $row = $result->fetch_assoc();
        $reservationID = $row['reservation_id'];
        echo "Customer ID found in reservations table. Reservation ID: " . $reservationID;




        $sql_pending = "SELECT * FROM pending_payments WHERE reservation_id = $reservationID";
        $result_pending = $connection->query($sql_pending);



        if ($result_pending->num_rows > 0) {
            // Reservation ID found in the pending_payment table, delete the data
            $sql_update = "UPDATE pending_payments SET status = 'paid' WHERE reservation_id = $reservationID";
            if ($connection->query($sql_update) === TRUE) {
                echo "Update success.";
                // $updatedID = $connection->insert_id;


                $sql_fetch_updated_id = "SELECT pending_id FROM pending_payments WHERE reservation_id = $reservationID";
                $result_updated_id = $connection->query($sql_fetch_updated_id);

                if ($result_updated_id->num_rows > 0) {
                    $row_updated_id = $result_updated_id->fetch_assoc();
                    $updatedID = $row_updated_id['pending_id'];



                    $sql_amount = "SELECT amount FROM pending_payments WHERE pending_id = $updatedID";
                    $result_amount = $connection->query($sql_amount);

                    if ($result_amount->num_rows > 0) {
                        $row_amount = $result_amount->fetch_assoc();
                        $updatedAmount = $row_amount['amount'];
                        echo "Reservation ID found in pending_payment table. Data updated to 'paid' successfully. Updated ID: " . $updatedID . ", Updated Amount: " . $updatedAmount;
                        echo "<script>document.getElementById('pending').innerText = 'Pending amount: $updatedAmount';</script>";
                        $sql = "INSERT INTO invoices (pending_id,customer_total_bill) 
                          VALUES (?, ?)";

                        $stmt = $connection->prepare($sql);

                        if ($stmt) {
                            // Bind parameters and execute the statement
                            $stmt->bind_param("id", $updatedID, $updatedAmount);
                            $stmt->execute();


                            $lastInsertedIDfromInvoices = $connection->insert_id;


                            $sql = "INSERT INTO confirmed_payments (invoice_id) 
                            VALUES (?)";

                            $stmt = $connection->prepare($sql);

                            // Bind parameters
                            $stmt->bind_param("i", $lastInsertedIDfromInvoices);
                            $stmt->execute();



                            // Check for successful execution of the query
                            if ($stmt->affected_rows > 0) {
                                echo "Invoice data inserted successfully.";
                            } else {
                                echo "Error inserting invoice data: " . $stmt->error;
                            }
                        } else {
                            echo "Error preparing statement: " . $connection->error;
                        }
                    } else {
                        echo "problema";
                    }


                    echo "Updated ID: " . $updatedID;

                    // Rest of your code
                } else {
                    echo "No rows found for the updated ID.";
                }
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        // Customer ID not found in the reservations table
        echo "Customer ID not found in reservations table.";
    }
} else {
    // If customer ID is not received, send an error message
    echo "No customer ID received.";
}

$connection->close();
