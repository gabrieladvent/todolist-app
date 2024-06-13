<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List | Registration</title>
    <!-- favicon -->
    <link rel="icon" href="../assets/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/register.css">
</head>

<body>
    <div class="container">
        <h2>Registration</h2>
        <form action="../controller/register_process.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login</a>
        </div>
    </div>
</body>

</html>