<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["message"] = "Invalid Email!";
        header('Location: /login');
        die();
    }
    require_once('../configs/connect_to_db.php');
    require_once('../models/users.php');

    $user = getUserByEmail($conn, $email);
    if ($user) {
        if (password_verify($pwd, $user['password'])) {
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['user_role'] = $user["role"];
            $_SESSION['user_email'] = $user["email"];
            $_SESSION['user_name'] = $user["full_name"];
            header('Location: /home');
            die();
        } else {
            $_SESSION["message"] = "Unauthorized!";
            header('Location: /login');
            die();
        }
    } else {
        $_SESSION["message"] = "Unauthorized!";
        header('Location: /login');
        die();
    }
} else {
    header("Location: /login");
    die();
}
