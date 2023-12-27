<?php

include_once('db.con.php');


// Establish connection
$connection = connectToDB();
$currentDate = date('Y-m-d');
$newStatus = "unavailable";



$lastAffectedRowId = null;


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $contact_number = $_POST['contact_number'];
    $sex = $_POST['sex'];

    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $serviceType = $_POST['serviceType'];
    $roomType = $_POST['roomtype'];
    $totaBill = $_POST['total'];
    $existingCustomer = $_POST['existingcustomer'];

    $formattedCheckin = date('Y-m-d', strtotime($checkin));
    $formattedCheckout = date('Y-m-d', strtotime($checkout));

    $lastInsertedIDfromCustomer =  null;




    $sql = "INSERT INTO customers (firstname, lastname, age, gender, phone_number) VALUES (?, ?, ?, ?, ?)";
    // Prepare the SQL statement
    $stmt = $connection->prepare($sql);
    // Bind parameters and execute the query
    $stmt->bind_param("ssiss", $first_name, $last_name, $age,  $sex, $contact_number);
    $stmt->execute();
    $lastInsertedIDfromCustomer = $connection->insert_id;







    // $lastInsertedIDfromCustomer = $existingCustomer;




    // Insert data into the database table
    // $sql = "INSERT INTO customers (firstname, lastname, age, gender, phone_number) VALUES (?, ?, ?, ?, ?)";
    // // Prepare the SQL statement
    // $stmt = $connection->prepare($sql);
    // // Bind parameters and execute the query
    // $stmt->bind_param("ssiss", $first_name, $last_name, $age, $contact_number, $sex);
    // $stmt->execute();



    $selectedAmenities = array();

    $selectedAmenities['breakfast'] = isset($_POST['breakfast']) ? 1 : 0;
    $selectedAmenities['pool'] = isset($_POST['pool']) ? 1 : 0;
    $selectedAmenities['spa'] = isset($_POST['spa']) ? 1 : 0;
    $selectedAmenities['bathroomessentials'] = isset($_POST['bathroomessentials']) ? 1 : 0;
    $selectedAmenities['roomservice'] = isset($_POST['roomservice']) ? 1 : 0;
    $selectedAmenities['wifi'] = isset($_POST['wifi']) ? 1 : 0;

    $sql = "INSERT INTO amenities (breakfast, wifi, pool, room_service, spa, bathroom_essentials) VALUES (?, ?, ?, ?, ?, ?)";
    // Prepare the SQL statement
    $stmt = $connection->prepare($sql);
    // Bind parameters and execute the query
    $stmt->bind_param("iiiiii", $selectedAmenities['breakfast'], $selectedAmenities['wifi'], $selectedAmenities['pool'], $selectedAmenities['roomservice'], $selectedAmenities['spa'], $selectedAmenities['bathroomessentials']);
    $stmt->execute();

    $lastInsertedIDfromAmenities = $connection->insert_id;


    $sql = "INSERT INTO room_types (name,amenity_ID) VALUES (?,?)";
    // Prepare the SQL statement
    $stmt = $connection->prepare($sql);
    // Bind parameters and execute the query
    $stmt->bind_param("si", $roomType,   $lastInsertedIDfromAmenities);
    $stmt->execute();

    $lastInsertedIDfromRoomType = $connection->insert_id;


    if ($serviceType == "reservation") {
        $sql = "INSERT INTO reservations (customer_ID,reservation_date,room_type_id,check_in_date,check_out_date) 
        VALUES (?,?,?,?,?)";
        // Prepare the SQL statement
        $stmt = $connection->prepare($sql);
        // Bind parameters and execute the query
        $stmt->bind_param("isiss", $lastInsertedIDfromCustomer,  $formattedCheckin,  $lastInsertedIDfromRoomType, $formattedCheckin, $formattedCheckout);
        $stmt->execute();
        $lastInsertedIDfromReservation = $connection->insert_id;


        $sql = "INSERT INTO pending_payments (amount, due_date, reservation_id) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);

        // Assuming $totaBill is a decimal, $dueDate is a string, and $lastInsertedIDfromReservation is an integer
        $stmt->bind_param("dsi", $totaBill, $checkin, $lastInsertedIDfromReservation);
        $stmt->execute();
        $lastInsertedIDfromPending_payments = $connection->insert_id;



        // Replace this with the specific room name you want to update

        // Construct the SQL query with a placeholder for the room name
        $sql = "UPDATE rooms SET reservation_id = ?, status = ? WHERE status = 'available' AND name = ? LIMIT 1";

        // Prepare the SQL statement
        $stmt = $connection->prepare($sql);

        // Bind parameters and execute the query
        $stmt->bind_param("iss", $lastInsertedIDfromReservation, $newStatus, $roomType);
        $stmt->execute();
    } else {
        $sql = "INSERT INTO bookings (customer_ID, room_type_id, amount, check_in_date, check_out_date) 
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bind_param("iidss", $lastInsertedIDfromCustomer, $lastInsertedIDfromRoomType,  $totaBill, $formattedCheckin, $formattedCheckout);
        $stmt->execute();

        $lastInsertedIDfromBooking = $connection->insert_id;




        // $sql = "UPDATE rooms SET booking_id = ?, status = ? WHERE status = 'available' AND name = ? LIMIT 1";

        // // Prepare the SQL statement
        // $stmt = $connection->prepare($sql);

        // // Bind parameters and execute the query
        // $stmt->bind_param("iss", $lastInsertedIDfromBooking, $newStatus, $roomType);
        // $stmt->execute();

        // Select query to fetch IDs of rows that match the criteria
        $selectQuery = "SELECT room_number FROM rooms WHERE status = 'available' AND name = ? LIMIT 1";

        // Prepare and execute the SELECT query
        $stmtSelect = $connection->prepare($selectQuery);
        $stmtSelect->bind_param("s", $roomType);
        $stmtSelect->execute();
        $result = $stmtSelect->get_result();

        // Initialize an array to store affected row IDs
        $affectedRowIds = [];

        // Fetch the IDs of matching rows
        while ($row = $result->fetch_assoc()) {
            $affectedRowIds[] = $row['room_number'];
        }

        // Close the SELECT statement
        // $stmtSelect->close();

        // If there are IDs found, proceed to UPDATE and get the last inserted ID

        if (!empty($affectedRowIds)) {
            // Your UPDATE query
            $sql = "UPDATE rooms SET booking_id = ?, status = ? WHERE status = 'available' AND name = ? LIMIT 1";
            $stmt = $connection->prepare($sql);

            // Your update parameters
            $stmt->bind_param("iss", $lastInsertedIDfromBooking, $newStatus, $roomType);
            $stmt->execute();

            // Get the last affected row ID after the UPDATE operation


            $lastAffectedRowId = $affectedRowIds[count($affectedRowIds) - 1];
            echo "Last affected row ID: " . $lastAffectedRowId;
        }
















        $sql = "INSERT INTO invoices (booking_id,customer_total_bill) 
        VALUES (?, ?)";

        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bind_param("id", $lastInsertedIDfromBooking, $totaBill);
        $stmt->execute();
        $lastInsertedIDfromInvoices = $connection->insert_id;


        $sql = "INSERT INTO confirmed_payments (invoice_id) 
        VALUES (?)";

        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bind_param("i", $lastInsertedIDfromInvoices);
        $stmt->execute();
        $lastInsertedIDfromInvoices = $connection->insert_id;
    }


    // $sql = "INSERT INTO pending_payments ($totaBill, , amount, check_in_date, check_out_date) 
    // VALUES (?, ?, ?, ?, ?)";

    // $stmt = $connection->prepare($sql);

    // // Bind parameters
    // $stmt->bind_param("dsi", $lastInsertedIDfromCustomer, $lastInsertedIDfromRoomType,  $totaBill, $formattedCheckin, $formattedCheckout);
    // $stmt->execute();




    // Check if the query executed successfully
    if ($stmt->affected_rows > 0) {
        // Data inserted successfully
        echo "Data inserted successfully!";
    } else {
        // Error in insertion
        echo "Error inserting data: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$connection->close();
