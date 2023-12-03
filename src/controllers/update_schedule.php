<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        header("Location: /login");
        die();
    }
    if (!isset($_POST["date"])) {
        header('Location: /schedule');
        die();
    }
    if (!isset($_POST["makeavailable"]) && !isset($_POST["makebusy"])) {
        header('Location: /schedule');
        die();
    }
    $date = $_POST['date'];
    $doctor_id = $_SESSION['user_id'];
    require_once('../configs/connect_to_db.php');
    require_once('../models/time_slot.php');
    if (isset($_POST["makeavailable"])) {
        $makeAvailable = $_POST['makeavailable'];
        createMultipleTimeSlots($conn, $date, $makeAvailable, $doctor_id);
    }
    if (isset($_POST["makebusy"])) {
        $makeBusy = $_POST['makebusy'];
        deleteMultipleTimeSlots($conn, $date, $makeBusy, $doctor_id);
    }
    $_SESSION["message"] = "Updated schedule successfully!";
    header("Location: /schedule");
    die();
} else {
}
