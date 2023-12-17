<?php
include __DIR__ . "/../db_conn.php"; // Use __DIR__ for an absolute path

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['id'])) {
    $id = validate($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM asset WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: ../home.php");
        exit();
    }
} elseif (isset($_POST['update'])) {
    $device = validate($_POST['device']);
    $brand = validate($_POST['brand']);
    $specs = validate($_POST['specs']);
    $serialno = validate($_POST['serialno']);
    $id = validate($_POST['id']);

    if (empty($device) || empty($brand) || empty($specs) || empty($serialno)) {
        header("Location: ../updateAss.php?id=$id&error=Please fill in all required fields");
        exit();
    }

    $stmt = $conn->prepare("UPDATE asset SET device=?, brand=?, specs=?, serialno=? WHERE id=?");
    $stmt->bind_param("ssssssi", $device, $brand, $specs, $serialno, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../home.php?Assetupdated=Asset successfully updated!");
        exit();
    } else {
        header("Location: ../updateAss.php?id=$id&error=Unknown error occurred");
        exit();
    }
} else {
    header("Location: ../home.php");
    exit();
}
?>