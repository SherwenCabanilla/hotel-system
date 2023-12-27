<?php
require_once('db.con.php');

$connection = connectToDB();

$currentDate = date('Y-m-d');




// $currentDate = '2023-12-26';



$sql = "SELECT customers.customer_id FROM pending_payments
        INNER JOIN reservations ON pending_payments.reservation_id = reservations.reservation_id
        INNER JOIN customers ON reservations.customer_id = customers.customer_id
        WHERE pending_payments.due_date < '$currentDate' AND pending_payments.status IS NULL";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $customersToDelete = [];
    while ($row = $result->fetch_assoc()) {
        $customersToDelete[] = $row['customer_id'];
    }

    // Delete customers with overdue due dates and null status
    if (!empty($customersToDelete)) {
        $placeholders = implode(',', array_fill(0, count($customersToDelete), '?'));
        $deleteSql = "DELETE FROM customers WHERE customer_id IN ($placeholders)";
        $deleteStmt = $connection->prepare($deleteSql);

        // Dynamically bind parameters
        $types = str_repeat('i', count($customersToDelete));
        $deleteStmt->bind_param($types, ...$customersToDelete);
        $deleteStmt->execute();

        $deletedRowCount = $deleteStmt->affected_rows;

        echo "Deleted $deletedRowCount customer(s) with overdue due dates and null status.";
    } else {
        echo "No customers found with overdue due dates and null status.";
    }



    $updateSql = "UPDATE rooms
    SET booking_id = NULL
    WHERE booking_id IN (
        SELECT rooms.booking_id
        FROM rooms
        INNER JOIN bookings ON rooms.booking_id = bookings.booking_id
        WHERE bookings.check_out_date < $currentDate
    )";

    // Execute the update query for bookings
    if ($connection->query($updateSql) === TRUE) {
        echo "Booking IDs in rooms updated successfully.";
    } else {
        echo "Error updating booking IDs in rooms: " . $connection->error;
    }





    // SQL update statement for reservation_id
    $updateSql = "UPDATE rooms
    SET reservation_id = NULL
    WHERE reservation_id IN (
        SELECT rooms.reservation_id
        FROM rooms
        INNER JOIN reservations ON rooms.reservation_id = reservations.reservation_id
        WHERE reservations.check_out_date < $currentDate
    )";

    // Execute the update query for reservations
    if ($connection->query($updateSql) === TRUE) {
        echo "Reservation IDs in rooms updated successfully.";
    } else {
        echo "Error updating reservation IDs in rooms: " . $connection->error;
    }
} else {
    echo "No customers found with overdue due dates and null status.";
}



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






//real time room availability
// $currentDate = '2023-12-30';

$sql = "UPDATE rooms r
    SET 
        r.status = CASE
            WHEN r.booking_id IN (
                SELECT b.booking_id
                FROM bookings b
                JOIN customers c ON b.customer_id = c.customer_id
                WHERE b.check_out_date < '$currentDate'
            ) OR r.reservation_id IN (
                SELECT res.reservation_id
                FROM reservations res
                JOIN customers c ON res.customer_id = c.customer_id
                WHERE res.check_out_date < '$currentDate'
            )
            THEN 'Available'
            ELSE r.status
        END,
        r.booking_id = CASE
            WHEN r.booking_id IN (
                SELECT b.booking_id
                FROM bookings b
                JOIN customers c ON b.customer_id = c.customer_id
                WHERE b.check_out_date < '$currentDate'
            )
            THEN NULL
            ELSE r.booking_id
        END,
        r.reservation_id = CASE
            WHEN r.reservation_id IN (
                SELECT res.reservation_id
                FROM reservations res
                JOIN customers c ON res.customer_id = c.customer_id
                WHERE res.check_out_date < '$currentDate'
            )
            THEN NULL
            ELSE r.reservation_id
        END
";

if ($connection->query($sql) === TRUE) {
    $rowsAffected = $connection->affected_rows;
    if ($rowsAffected > 0) {
        echo "Rooms status updated successfully. Total rooms updated: " . $rowsAffected;
    } else {
        echo "No rooms were updated.";
    }
} else {
    echo "Error updating rooms status: " . $connection->error;
}


$connection->close();
