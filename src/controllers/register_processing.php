<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $_SESSION['input_email'] = $email;
    $_SESSION['name'] = $fullname;

    if ($fullname === '') {
        $_SESSION["message"] = "Error: Invalid name!";
        header('Location: /register');
        die();
    }

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["message"] = "Error: Invalid email!";
        header('Location: /register');
        die();
    }
    // validate password
    $pwdLength = strlen($pwd);
    if ($pwdLength < 8 && $pwdLength > 20) {
        $_SESSION["message"] = "Error: Invalid password!";
        header('Location: /register');
        die();
    }

    require_once('../configs/connect_to_db.php');
    require_once('../models/users.php');

    // check if email exists
    if (isEmailTaken($conn, $email)) {
        $_SESSION["message"] = "Error: User already exists!";
        header('Location: /register');
        die();
    }

    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
    createUser($conn, $fullname, $email, $hashPwd);
    $_SESSION["message"] = "Register successfully!";
    header('Location: /login');
} else {
    header("Location: /");
    die();
}
