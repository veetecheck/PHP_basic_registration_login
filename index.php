<?php
session_start();

// Pokud je uživatel přihlášen, přesměrujte ho na hlavní stránku
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login page</title>
</head>
<body>

    <!-- container -->
    <div class="container">
        <h1 class="display-6 mt-3">Login</h1>
        <form action="auth.php" method="post">
            <input class="form-control my-2" type="text" name="username" placeholder="Username" required>
            <input class="form-control my-2" type="password" name="password" placeholder="Password" required>
            <input class="btn btn-warning my-2" type="submit" value="Login">
        </form>
        <p>Not registered yet? Then register here...</p>
        <a href="register.html" class="btn btn-secondary">Register</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
