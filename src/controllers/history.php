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
    require_once('configs/connect_to_db.php');
    require_once('models/time_slot.php');
    $slots = getTimeSlotsByPatientId($conn, $_SESSION["user_id"]);

    require_once('views/patient_history.php');
    die();
} else if ($_SESSION["user_role"] === "doctor") {
    require_once('configs/connect_to_db.php');
    require_once('models/time_slot.php');
    $slots = getTimeSlotsByDoctorId($conn, $_SESSION["user_id"]);

    require_once('views/doctor_history.php');
    die();
}
