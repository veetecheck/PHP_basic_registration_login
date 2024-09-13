<?php

include('DbConnect.php');
include('validation.php');  // Zahrnutí souboru s validacemi

if (!validateInput($_POST['username']) || !validateInput($_POST['password']) || !validateInput($_POST['email'])) {
    exit('Please fill the form correctly.');
}

if (($error = validateEmail($_POST['email'])) !== true) {
    exit($error);
}

if (($error = validateUsername($_POST['username'])) !== true) {
    exit($error);
}

if (($error = validatePassword($_POST['password'])) !== true) {
    exit($error);
}
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Register</title>
</head>

<body>
    <div class="container">
    <?php

    // konec verifikací - připojujeme se k db
    $db = new DbConnect();

    $conn = $db->connect();
    // kontrola, zda už username neexistuje
    $sql = 'SELECT COUNT(*) FROM accounts WHERE username = :username';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);

        $stmt->execute();

        // Získání počtu řádků - fetchnu si hodnotu z jediného sloupce, který vyplivne dotaz, tedy COUNT(*)
        $userExists = $stmt->fetchColumn();

        if ($userExists > 0) {
            exit('<p class="my-2">Username already exists. Please choose another one.</p></div></body></html>');
        } else {
            // funguje
            $sql = 'INSERT INTO accounts (username, password, email) VALUES (:username, :password, :email)';
            if ($stmt = $conn->prepare($sql)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);

                $stmt->execute();
                echo '<p class="my-2">You have successfully registered! You can now login!</p>';
                echo '<a class="btn btn-primary my-2" href="index.php">Go to login page</a>';
            } else {
                exit("<p class='my-2'>Error: Could not prepare statement</p></div></body></html>");
            }
        }
    } else {
        exit("<p class='my-2'>Error: Could not prepare statement</p></div></body></html>");
    }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>