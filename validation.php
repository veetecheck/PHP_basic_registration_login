<?php

function validateInput($data) {
    return isset($data) && !empty(trim($data));
}

function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Email is not valid!';
    }
    return true;
}

function validateUsername($username) {
    if (preg_match('/^[a-zA-Z0-9._-]{3,20}$/', $username) == 0) {
        return 'Username is not valid! It must be 3-20 characters long and can contain letters, numbers, underscores, dashes, and dots.';
    }
    return true;
}

function validatePassword($password) {
    if (strlen($password) > 20 || strlen($password) < 8) {
        return 'Password must be between 8 and 20 characters long!';
    }
    return true;
}
