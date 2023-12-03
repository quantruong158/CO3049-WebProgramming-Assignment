<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/Exception.php';
require '../lib/PHPMailer.php';
require '../lib/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        header("Location: /login");
        die();
    }
    $date = $_POST['date'];
    $slot = $_POST['timeSlot'];
    $doctor_id = $_POST['doctor'];
    $id = $_SESSION['user_id'];


    require_once('../configs/connect_to_db.php');
    require_once('../models/time_slot.php');

    $timeSlot = getAvailableTimeSlot($conn, $date, $slot, $doctor_id);
    if (!isset($timeSlot)) {
        $_SESSION["message"] = "Failed to make appointment!";
        header('Location: /schedule');
        die();
    }
    updateUserId($conn, $timeSlot["id"], $id);
    try {
        $startTime = date('H:i', strtotime('00:00') + ($timeSlot["slot_value"] - 1) * 30 * 60);
        $endTime = date('H:i', strtotime($startTime) + 30 * 60);
        $time = $startTime . " - " . $endTime;
        $slot_date = $timeSlot["slot_date"];
        $patient_name = $_SESSION["user_name"];
        $doctor_name = $timeSlot["full_name"];

        $to = array(
            $_SESSION["user_email"],
            $timeSlot["email"],
        );
        $mail = new PHPMailer(true);
        require_once('../configs/mail.php');
        mailInit($mail);
        foreach ($to as $to_add) {
            $mail->AddAddress($to_add);
        }
        $mail->isHTML(true);
        $mail->Subject = 'An appointment has been made successfully!';
        $mail->Body = "<h1>Appointment details:</h1>
                        <p>Date: $slot_date</p>
                        <p>Time: $time</p>
                        <p>Patient name: $patient_name</p>
                        <p>Doctor name: $doctor_name</p>
                        ";
        $mail->send();
    } catch (Exception $e) {
        $_SESSION["message"] = "Made appointment successfully! But failed to sent emails.";
        header("Location: /history");
        die();
    }
    $_SESSION["message"] = "Made appointment successfully!";
    header("Location: /history");
    die();
} else {
}
