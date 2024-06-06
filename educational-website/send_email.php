<?php
// Start a new session or resume the existing session.
session_start();

// Database connection parameters.
$host = "localhost";
$user = "root";
$pass = "";
$db = "contact_form";

// Create a new MySQLi object for database connection.
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection to the database was successful.
if ($conn->connect_error) {
    // If connection fails, terminate the script and display an error message.
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize input.
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare an SQL statement to insert data into the 'messages' table.
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    // Bind parameters to the prepared statement.
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the prepared statement.
    if ($stmt->execute()) {
        // If execution is successful, set feedback message.
        $feedback = "Message sent successfully.";
    } else {
        // If execution fails, set feedback message with error details.
        $feedback = "Error: " . $stmt->error;
    }

    // Close the prepared statement.
    $stmt->close();
    // Close the database connection.
    $conn->close();

    // HTML response to display feedback to the user.
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Form Submission</title>
        <link rel='stylesheet' href='StyleSheet.css'>
    </head>
    <body>
        <div style='text-align: center; margin-top: 20%;'>
            <p>$feedback</p>
            <a href='home-page.html' class='btn'>Return to Home</a>
        </div>
    </body>
    </html>";
} else {
    // If the request method is not POST, display an error message.
    echo "Invalid request.";
}
?>
