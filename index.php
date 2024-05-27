<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Login</h1>
            <form action="login.php" method="post">
                <div class="form-group text-center">
                    <label for="username">Username</label>
                    <input type="text" class="form-control mx-auto" id="username" name="username" required style="width: 200px;">
                </div>
                <div class="form-group text-center">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mx-auto" id="password" name="password" required style="width: 200px;">
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>