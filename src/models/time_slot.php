<?php

function deleteUserId($conn, $slot_id)
{
    $query = "UPDATE Time_slot SET patient_id = NULL WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $slot_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();
}

function getTimeSlotsByPatientId($conn, $user_id)
{
    $slots = [];

    $query = "SELECT s.id, s.slot_date, s.slot_value, u.full_name FROM Time_slot s JOIN User u ON s.doctor_id = u.id WHERE patient_id = ? ORDER BY slot_date DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $slots[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    $stmt->close();
    return $slots;
}
function getTimeSlotsByDoctorId($conn, $user_id)
{
    $slots = [];

    $query = "SELECT s.id, s.slot_date, s.slot_value, s.patient_id, u.full_name FROM Time_slot s JOIN User u ON s.patient_id = u.id WHERE doctor_id = ? ORDER BY slot_date DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $slots[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    $stmt->close();
    return $slots;
}

function updateUserId($conn, $slot_id, $user_id)
{
    $query = "UPDATE Time_slot SET patient_id = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $slot_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();
}
function getAvailableTimeSlot($conn, $date, $value, $doctor_id)
{
    $query = "SELECT s.id, slot_date, slot_value, full_name, email FROM Time_slot s JOIN user u ON s.doctor_id = u.id WHERE slot_date = ? AND slot_value = ? AND patient_id IS NULL AND doctor_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $date, $value, $doctor_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $slot = $result->fetch_assoc();

    $stmt->close();
    return $slot;
}
function getTimeSlotOfPatient($conn, $slot_id, $user_id)
{
    $query = "SELECT s.id, slot_date, slot_value, full_name, email FROM Time_slot s JOIN user u ON s.doctor_id = u.id WHERE s.id = ? AND s.patient_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $slot_id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $slot = $result->fetch_assoc();

    $stmt->close();
    return $slot;
}
function getTimeSlotOfDoctor($conn, $slot_id, $user_id)
{
    $query = "SELECT s.id, slot_date, slot_value, full_name, email FROM Time_slot s JOIN user u ON s.patient_id = u.id WHERE s.id = ? AND s.doctor_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $slot_id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $slot = $result->fetch_assoc();

    $stmt->close();
    return $slot;
}

function getTimeSlotsByDateAndDoctor($conn, $date, $doctor_id)
{
    $slots = [];

    $query = "SELECT * FROM Time_slot WHERE slot_date = ? AND doctor_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $date, $doctor_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $slots[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    $stmt->close();
    return $slots;
}

function createMultipleTimeSlots($conn, $slot_date, $data, $doctor_id)
{
    if (empty($data)) {
        return false;
    }

    $insertQuery = "INSERT INTO Time_slot (slot_date, slot_value, doctor_id)  VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    $value = null;
    $stmt->bind_param("sii", $slot_date, $value, $doctor_id);

    foreach ($data as $entry) {
        $value = $entry;
        $stmt->execute();
    }

    $stmt->close();
}
function deleteMultipleTimeSlots($conn, $slot_date, $data, $doctor_id)
{
    if (empty($data)) {
        return false;
    }

    $insertQuery = "DELETE FROM Time_slot WHERE slot_date = ? AND slot_value = ? AND doctor_id = ?";
    $stmt = $conn->prepare($insertQuery);

    $value = null;
    $stmt->bind_param("sii", $slot_date, $value, $doctor_id);

    foreach ($data as $entry) {
        $value = $entry;
        $stmt->execute();
    }

    $stmt->close();
}

function changeAppointment($conn, $old_slot_id, $new_slot_id, $patient_id)
{
    $query = "UPDATE Time_slot SET patient_id = NULL WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $old_slot_id);
    $stmt->execute();

    $query = "UPDATE Time_slot SET patient_id = ? WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $patient_id, $new_slot_id);
    $stmt->execute();

    $stmt->close();
}
