<?php
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the login and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection information
    $servername = "localhost";
    $dbusername = "sae23";
    $dbpassword = "sae23";
    $dbname = "sae23";

    // Create a connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a secure SQL query to verify authentication
    $sql = "SELECT * FROM Administration WHERE login = ? AND mdp = ? AND id = ?"; // Add id as an additional condition
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $password, $id);

    // Replace $id with the specific ID of the row you want to select
    $id = 1; // Replace with the specific ID

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Query error: " . $conn->error);
    }

    // Check if the user exists and if the password is correct
    if ($result->num_rows > 0) {
        // Authentication successful, start the session
        $_SESSION['username'] = $username;
        $_SESSION['auth'] = true;
        header("Location: admin.html"); // Redirect to the secure page
        exit();
    } else {
        // Authentication failed, redirect to the login error page
        $_SESSION = array(); // Reset the session array
        session_destroy();   // Destroy the session
        header("Location: erreur.html"); // Redirect to the login error page
        exit();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
