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

    $stmt = $conn->prepare("SELECT * FROM reqdev WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: home.php");
        exit();
    }
} elseif (isset($_POST['update'])) {
    $agent = validate($_POST['agent']);
    $device = validate($_POST['device']);
    $brand = validate($_POST['brand']);
    $specs = validate($_POST['specs']);
    $serialno = validate($_POST['serialno']);
    $daterel = validate($_POST['daterel']);
    $status = validate($_POST['status']);
    $id = validate($_POST['id']);

    if (empty($agent) || empty($device) || empty($brand) || empty($specs) || empty($serialno) || empty($daterel)) {
        header("Location: ../updatereqdev.php?id=$id&error=Please fill in all required fields");
        exit();
    }

    $stmt = $conn->prepare("UPDATE reqdev SET agent=?, device=?, brand=?, specs=?, serialno=?, daterel=?, status=? WHERE id=?");
    $stmt->bind_param("sssssssi", $agent, $device, $brand, $specs, $serialno, $daterel, $status, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../home.php?updated=Asset successfully updated!");
        exit();
    } else {
        header("Location: ../updatereqdev.php?id=$id&error=Unknown error occurred");
        exit();
    }
} else {
    header("Location: ../home.php"); // Correct the path to home.php
    exit();
}
?>