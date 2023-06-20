<?php
// Database connection parameters
    private $dataSource = "mysql:dbname=stemwijzer;host=localhost;"; //Hier dient je connection string te komen mysql:dbname=;host=;
    private $username = "root";
    private $password = "";

// Create a connection to the database
//$conn = new mysqli($localhost, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Rest of your code goes here...

// Close the database connection
$conn->close();
?>



