<?php

// echo "Success";

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home Page</title>
</head>

<body>
    <!-- container -->
    <div class="container">
        <h1 class="display-6 mt-3">Home Page</h1>
        <p>Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES) ?></strong></p>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile card</h5>
                <p class="card-text">username: <strong><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES) ?></strong></p>
                <p class="card-text">email: <strong><?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES) ?></strong></p>
                <a href="logout.php" class="btn btn-warning">Logout</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>