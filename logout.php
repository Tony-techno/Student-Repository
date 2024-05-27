<?php
    session_start();

    // Database connection
    include 'db_connect.php';

    // Close database connection
    mysqli_close($conn);

    session_destroy();

    header('Location: index.php');
?>