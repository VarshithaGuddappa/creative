<?php
// Start session to access session variables
session_start();

// Check if the user is logged in
if(isset($_SESSION['Username']) && isset($_SESSION['Email'])) {
    // Get the username and email from session
    $username = $_SESSION['Username'];
    $email = $_SESSION['Email'];

    // Check if the request is POST method and the necessary data is provided
    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        // Extract phone number from the form data
        

        // Perform necessary validation on the data (optional)

        // Connect to the database (replace with your database credentials)
        $servername = "localhost";
        $db_username = "root";
        $db_password = "123";
        $dbname = "blubirdhotel";

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert booking data into the database
        $stmt = $conn->prepare("INSERT INTO bookings (username, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email);

        // Execute the SQL statement
        if ($stmt->execute() === TRUE) {
            echo "Booking successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid request!";
    }
} else {
    // If user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
