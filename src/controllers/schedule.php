<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    header("Location: /login");
    die();
}

if ($_SESSION["user_role"] === 'patient') {
    require_once('configs/connect_to_db.php');
    require_once('models/users.php');
    $doctors = getDoctors($conn);
    require_once('views/patient_schedule.php');
    die();
} else if ($_SESSION["user_role"] === 'doctor') {
    require_once('views/doctor_schedule.php');
    die();
}
