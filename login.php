<?php
    session_start();

    // Database connection
    include 'db_connect.php';

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        // Query to check if user exists
        $query = "SELECT * FROM students WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        // Check if user exists
        if (mysqli_num_rows($result) > 0) {
            // Set session variables
            $_SESSION["username"] = $username;
            header("location: dashboard.php");
        } 
        else {
            echo "Invalid username or password";
        }
    }

    // Close database connection
    mysqli_close($conn);
?>