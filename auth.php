<?php

include('DbConnect.php');
include('validation.php');  // Zahrnutí souboru s validacemi
session_start();

if (!validateInput($_POST['username']) || !validateInput($_POST['password'])) {
    exit('Please fill both the username and password fields!');
}

$username = $_POST['username'];
$password = $_POST['password'];

$db = new DbConnect();
$conn = $db->connect();

$sql = "SELECT email, password FROM accounts WHERE username = :username";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $user['email'];
            header('Location: home.php');
            exit;
        } else {
            echo 'Nesprávné uživatelské jméno nebo heslo!';
        }
    } else {
        echo 'Nesprávné uživatelské jméno nebo heslo!';
    }
} else {
    exit("Could not prepare statement");
}
