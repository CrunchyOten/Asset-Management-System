<?php
session_start();

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function createRequest()
{
    if (isset($_POST['create'])) {
        include "../db_conn.php";

        // Fetch agent name from the session
        $agent = $_SESSION['name'];

        $device = validate($_POST['device']);
        // Get the current date and time
        $currentdate = date('Y-m-d H:i:s');

        $req_data = 'device=' . $device . '&currentdate=' . $currentdate;

        if (empty($device)) {
            header("Location: ../home.php?error=Device Type is required&$req_data");
        } else {
            $sql = "INSERT INTO reqdev(agent, device, currentdate) VALUES('$agent', '$device', '$currentdate')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Redirect with success message and user data
                header("Location: ../home.php?requested=Asset successfully requested!&asset_type=" . $_POST['device']);
            } else {
                // Redirect with error message and user data
                header("Location: ../home.php?error=Unknown Error Occurred&$user_data");
            }
        }
    }
}

// Call the function to process the form submission
createRequest();
?>