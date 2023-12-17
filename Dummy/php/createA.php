<?php

if (isset($_POST['create'])) {

    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $device = validate($_POST['device']);
    $brand = validate($_POST['brand']);
    $specs = validate($_POST['specs']);
    $serialno = validate($_POST['serialno']);
    $avail = validate($_POST['avail']);

    if (empty($device)) {
        header("Location: ../home.php?error=Asset Type is required");
    }
    else if (empty($brand)) {
        header("Location: ../home.php?error=Asset Brand Name is required");
    }
    else if (empty($specs)) {
        header("Location: ../home.php?error=Asset Specifications is required");
    }
    else if (empty($serialno)) {
        header("Location: ../home.php?error=Please Input exact right Serial Number");
    }
    else {

       $sql = "INSERT INTO asset(device, brand, specs, serialno, avail) VALUES('$device', '$brand', '$specs', '$serialno', '$avail')";
       $result = mysqli_query($conn, $sql);

       if ($result) {
          header("Location: ../home.php?createdAsset=Asset successfully created!");
       } else {
          header("Location: ../index.php?error=Unknown Error Occurred");
       }
    }
}