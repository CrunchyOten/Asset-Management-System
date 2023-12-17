<?php

if (isset($_POST['create'])) {

    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $name = validate($_POST['name']);
    $role = validate($_POST['role']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user_data = 'username='.$username. '&role='.$role;

    if (empty($username)) {
        header("Location: ../home.php?error=User Name is required&$user_data");
    }
    else if (empty($password)) {
        header("Location: ../home.php?error=Password is required&$user_data");
    }
    else if (empty($name)) {
        header("Location: ../home.php?error=Name is required&$user_data");
    }
    else {

       $sql = "INSERT INTO users(username, password, name, role) VALUES('$username', '$hashed_password', '$name', '$role')";
       $result = mysqli_query($conn, $sql);

       if ($result) {
          header("Location: ../home.php?created=Account successfully created!");
       } else {
          header("Location: ../index.php?error=Unknown Error Occurred&$user_data");
       }
    }
}