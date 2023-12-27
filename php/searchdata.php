 <?php

    // include_once('db.con.php');

    // // Retrieve data from the request

    // // Establish a database connection
    // $connection = connectToDB();

    // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_id"])) {
    //     $searchValue = $_POST["search_id"];

    //     // Prepare and execute a database query using prepared statements to prevent SQL injection
    //     $sql = "SELECT * FROM customers WHERE customer_id = ? or lastname = ? or firstname = ?";

    //     // Prepare the SQL statement
    //     $stmt = $connection->prepare($sql);

    //     if ($stmt) {
    //         // Bind the parameter and execute the query
    //         $stmt->bind_param("sss", $searchValue, $searchValue, $searchValue);
    //         $stmt->execute();

    //         // Get the result of the query
    //         $result = $stmt->get_result();

    //         if ($result) {
    //             // Fetch data and return as JSON response
    //             $data = $result->fetch_all(MYSQLI_ASSOC);
    //             echo json_encode($data);
    //         } else {
    //             // Query execution failed
    //             http_response_code(500); // Set appropriate error code
    //             echo json_encode(array('error' => 'Query execution failed.'));
    //         }
    //     } else {
    //         // Statement preparation failed
    //         http_response_code(500); // Set appropriate error code
    //         echo json_encode(array('error' => 'Statement preparation failed.'));
    //     }
    // } else {
    //     // Invalid request or missing parameters
    //     http_response_code(400); // Bad Request
    //     echo json_encode(array('error' => 'Invalid request or missing parameters.'));
    // }


    // if ($connection) {
    //     $connection->close();
    // }


    include_once('db.con.php');

    // Establish a database connection
    $connection = connectToDB();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_id"])) {
        $searchValue = $_POST["search_id"];


        // Prepare and execute a database query using prepared statements to prevent SQL injection
        $sql = "SELECT customers.*, COALESCE(res_rooms.room_number, book_rooms.room_number) AS room_number
        FROM customers
        LEFT JOIN reservations ON customers.customer_id = reservations.customer_id
        LEFT JOIN rooms AS res_rooms ON reservations.reservation_id = res_rooms.reservation_id
        LEFT JOIN bookings ON customers.customer_id = bookings.customer_id
        LEFT JOIN rooms AS book_rooms ON bookings.booking_id = book_rooms.booking_id
        WHERE customers.customer_id = ? OR customers.lastname = ? OR customers.firstname = ?
        ";

        // Prepare the SQL statement
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            // Bind the parameter and execute the query
            $stmt->bind_param("sss", $searchValue, $searchValue, $searchValue);
            $stmt->execute();

            // Get the result of the query
            $result = $stmt->get_result();

            if ($result) {
                // Fetch data and return as JSON response
                $data = $result->fetch_all(MYSQLI_ASSOC);
                echo json_encode($data);
            } else {
                // Query execution failed
                http_response_code(500); // Set appropriate error code
                echo json_encode(array('error' => 'Query execution failed.'));
            }
        } else {
            // Statement preparation failed
            http_response_code(500); // Set appropriate error code
            echo json_encode(array('error' => 'Statement preparation failed.'));
        }
    } else {
        // Invalid request or missing parameters
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Invalid request or missing parameters.'));
    }

    if ($connection) {
        $connection->close();
    }
    ?>
    
    