<?php
    // Database connection
    include 'db_connect.php';

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $marks = $_POST["marks"];
        $attendance = $_POST["attendance"];

        // Validate input
        if (empty($username) || empty($password) || empty($marks) || empty($attendance)) {
            $error = "Please fill in all fields";
        } 
        else {
            // Insert data into database
            $sql = "INSERT INTO students (username, password, marks, attendance) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssii", $username, $password, $marks, $attendance);
            mysqli_stmt_execute($stmt);

            // Check if data was inserted successfully
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $success = "Student registered successfully";
            } else {
                $error = "Error registering student";
            }
        }
    }

    // Close database connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Student</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Register Student</h1>
            <form action="<?php 
                                echo htmlspecialchars($_SERVER["PHP_SELF"]); 
                            ?>" 
            method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="marks">Marks:</label>
                    <input type="number" class="form-control" id="marks" name="marks" required>
                </div>
                <div class="form-group">
                    <label for="attendance">Attendance:</label>
                    <input type="number" class="form-control" id="attendance" name="attendance" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <?php 
                if (isset($error)) { 
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $error; 
                    ?>
                </div>
            <?php 
                } 
                elseif (isset($success)) { 
            ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $success; 
                    ?>
                </div>
            <?php 
                } 
            ?>
        </div>
    </body>
</html>