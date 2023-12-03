<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    header("Location: /login");
    die();
}

if (!isset($_SESSION["target_slot_id"])) {
    $_SESSION["message"] = "Failed to load";
    header("Location: /");
    die();
}

if ($_SESSION["user_role"] === 'patient') {
    require_once('configs/connect_to_db.php');
    require_once('models/users.php');
    $doctors = getDoctors($conn);
    require_once('views/change_appointment.php');
    die();
} else {
    header("Location: /");
    die();
}
