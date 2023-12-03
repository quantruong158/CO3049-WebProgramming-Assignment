<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        header("Location: /login");
        die();
    }
    if ($_SESSION['user_role'] !== 'patient') {
        header("Location: /");
        die();
    }

    $slotId = $_GET['slotId'];
    $_SESSION['target_slot_id'] = $slotId;
    header("Location: /change");
    die();
} else {
    header("Location: /");
    die();
}
