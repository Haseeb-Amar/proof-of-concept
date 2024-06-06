<?php
// Database connection parameters
$host="localhost"; // Hostname where the database is located
$user="root";      // Username for database access
$pass="";          // Password for database access
$db="login";       // Name of the database

// Creating a new MySQLi connection object
$conn=new mysqli($host,$user,$pass,$db);

// Checking if connection to the database was successful
if($conn->connect_error){
    // If connection fails, print an error message
    echo "Failed to connect DB".$conn->connect_error;
}
?>
