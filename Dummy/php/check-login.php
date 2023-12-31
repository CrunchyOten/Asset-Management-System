<?php
session_start();
include "../db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);

    if (empty($username)) {
        header("Location: ../index.php?error=User Name is Required");
    } else if (empty($password)) {
        header("Location: ../index.php?error=Password is Required");
    } else {
        // Retrieve the user from the database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];

                header("Location: ../home.php");
            } else {
                header("Location: ../index.php?error=Incorrect User Name or Password");
            }
        } else {
            header("Location: ../index.php?error=Database Error");
        }
    }
} else {
    header("Location: ../index.php");
}