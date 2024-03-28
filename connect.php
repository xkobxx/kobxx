<?php
// Database connection details
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cwsxkobxxdb";

// Create database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $message = $_POST['message'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO contacts (fullname, email, service, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $service, $message);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>document.getElementById('success-message').innerHTML = 'Message sent successfully.';</script>";
        header("Refresh:2; URL=contact.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>