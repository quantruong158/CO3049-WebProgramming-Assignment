<?php

function isEmailTaken($conn, $email)
{
    $sql = "SELECT * FROM User WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();

    return $exists;
}


function createUser($conn, $fullname, $email, $password)
{
    $sql = "INSERT INTO User (full_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss", $fullname, $email, $password);

    $success = $stmt->execute();

    $stmt->close();

    return $success;
}

function getUserByEmail($conn, $email)
{
    $sql = "SELECT * FROM User WHERE email = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    $userData = $result->fetch_assoc();

    $stmt->close();

    return $userData;
}
function getDoctors($conn)
{
    $doctors = [];

    $query = "SELECT * FROM user WHERE role = 'doctor';";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    $stmt->close();
    return $doctors;
}
