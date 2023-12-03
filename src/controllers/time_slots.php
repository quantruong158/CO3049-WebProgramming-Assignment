<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    header("Location: /login");
    die();
}

if (!isset($_GET["date"])) {
    header('Location: /home');
    die();
}

require_once('../configs/connect_to_db.php');
require_once('../models/time_slot.php');

$date = $_GET["date"];
if ($_SESSION['user_role'] === 'patient') {
    if (!isset($_GET["doctor_id"])) {
        $_SESSION["message"] = "ERROR";
        header('Location: /home');
        die();
    }
    $doctor_id = $_GET["doctor_id"];
} else if ($_SESSION['user_role'] === 'doctor') {
    $doctor_id = $_SESSION["user_id"];
}

$slots = getTimeSlotsByDateAndDoctor($conn, $date, $doctor_id);

$availableTime = [];
$scheduledTime = [];

foreach ($slots as $slot) {
    if (!isset($slot['patient_id'])) {
        $availableTime[] = $slot['slot_value'];
    }
}

if ($_SESSION['user_role'] === 'patient') {
    require_once('../views/partials/time_slots.php');
    die();
} else if ($_SESSION['user_role'] === 'doctor') {
    foreach ($slots as $slot) {
        if (isset($slot['patient_id'])) {
            $scheduledTime[] = $slot['slot_value'];
        }
    }
    require_once('../views/partials/update_time_slots.php');
    die();
}
