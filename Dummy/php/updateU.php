<?php

if (isset($_GET['id'])) {
    include "db_conn.php";

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_GET['id']);

    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: home.php");
    }
} else if (isset($_POST['update'])) {
    include "../db_conn.php";

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $name = validate($_POST['name']);
    $id = validate($_POST['id']);

    if (empty($username)) {
        header("Location: ../updateusers.php?id=$id&error=User Name is required");
    } else if (empty($password)) {
        header("Location: ../updateusers.php?id=$id&error=Password is required");
    } else if (empty($name)) {
        header("Location: ../updateusers.php?id=$id&error=Name is required");
    } else {
        // Hash the updated password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET username='$username', password='$hashed_password', name='$name' WHERE id=$id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../home.php?success=Account successfully updated!");
        } else {
            header("Location: ../updateusers.php?id=$id&error=Unknown error occurred");
        }
    }
} else {
    header("Location: home.php");
}