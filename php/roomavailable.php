<?php

require_once('db.con.php');

$connection = connectToDB();






$sql = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE name = 'Standard' AND status = 'Available'
"; // Adjust column names as needed
$result = $connection->query($sql);



$sqlStandard = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE name = 'Standard' AND status = 'Available'";
$resultStandard = $connection->query($sqlStandard);

$sqlSuites = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE name = 'Suites' AND status = 'Available'";
$resultSuites = $connection->query($sqlSuites);

$sqlFamily = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE name = 'Family' AND status = 'Available'";
$resultFamily = $connection->query($sqlFamily);

$data = array(
    'Standard' => $resultStandard->fetch_assoc()['available_rooms'],
    'Suites' => $resultSuites->fetch_assoc()['available_rooms'],
    'Family' => $resultFamily->fetch_assoc()['available_rooms']
);





$sqlTotalBill = "SELECT SUM(customer_total_bill) AS total_bill FROM invoices";
$resultTotalBill = $connection->query($sqlTotalBill);

$totalBill = 0; // Default value in case of no records
if ($resultTotalBill->num_rows > 0) {
    $totalBill = $resultTotalBill->fetch_assoc()['total_bill'];
}

$data['total_bill'] = $totalBill;



// Calculate the current total bill
// $sqlTotalBill = "SELECT SUM(customer_total_bill) AS total_bill FROM invoices";
// $resultTotalBill = $connection->query($sqlTotalBill);

// $totalBill = 0; // Default value in case of no records
// if ($resultTotalBill->num_rows > 0) {
//     $totalBill = $resultTotalBill->fetch_assoc()['total_bill'];
// }

// // Fetch the current totalrevenue
// $sqlCurrentRevenue = "SELECT totalrevenue FROM revenue";
// $resultCurrentRevenue = $connection->query($sqlCurrentRevenue);

// $currentRevenue = 0; // Default value in case of no records
// if ($resultCurrentRevenue->num_rows > 0) {
//     $currentRevenue = $resultCurrentRevenue->fetch_assoc()['totalrevenue'];
// }

// // Check if the new total_bill is greater than the current totalrevenue
// if ($totalBill > $currentRevenue) {
//     // Update the totalrevenue column with the new total_bill
//     $updateRevenue = "UPDATE revenue SET totalRevenue = $totalBill";
//     $connection->query($updateRevenue);
//     $totalBill = $resultTotalBill->fetch_assoc()['totalRevenue'];
// }
// $data["totalRevenue"] = $totalBill;




// Close database connection
$connection->close();



// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
