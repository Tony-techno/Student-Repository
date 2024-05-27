<?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    // Database connection
    include 'db_connect.php';

    // Get user's marks and attendance
    $username = $_SESSION['username'];
    $sql = "SELECT marks, attendance FROM students WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $marks = $row['marks'];
    $attendance = $row['attendance'];

    // Close database connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="container">
            <h1 class="text-center">Welcome,    <?php 
                                                    echo $_SESSION['username']; 
                                                ?>
            !</h1>
            <h2 class="text-center">Marks</h2>
            <canvas id="marksChart"></canvas>
            <h2 class="text-center">Attendance</h2>
            <canvas id="attendanceChart"></canvas>
        </div>

        <script>
            // Create marks chart
            var ctx = document.getElementById('marksChart').getContext('2d');

            var marksChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6'],
                    datasets: [{
                        label: 'Marks',
                        data:   <?php 
                                    echo json_encode($marks); 
                                ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Create attendance chart
            var ctx = document.getElementById('attendanceChart').getContext('2d');

            var attendanceChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Present', 'Absent'],
                    datasets: [{
                        label: 'Attendance',
                        data:   <?php 
                                    echo json_encode($attendance); 
                                ?>,
                        backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    }]
                }
            });
        </script>
    </body>
</html>