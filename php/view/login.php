<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do list | Login</title>
    <!-- favicon -->
    <link rel="icon" href="../assets/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/login.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <div class="form">
            <form action="../controller/login_process.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="register-link">
            Belum punya akun? <a href="register.php">Daftar</a>
        </div>
    </div>
</body>

</html>