<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    header("Location: /login");
    die();
}
if ($_SESSION["user_role"] === "patient") {
    require_once('views/patient_home.php');
    die();
} else if ($_SESSION["user_role"] === "doctor") {
    require_once('views/doctor_home.php');
    die();
}
