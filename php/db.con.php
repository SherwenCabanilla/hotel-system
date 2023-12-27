<?php


function connectToDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "thisishoteldb";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection; // Return the connection object
}
