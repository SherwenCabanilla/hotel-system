<?php

require_once("db.con.php");

$conn = connectToDB();


$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

// Fetch data and return as JSON
$rows = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "0 results";
}

$conn->close();
