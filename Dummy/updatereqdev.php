<?php include 'php/updateReq.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Update User Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("img/bg1.jpg");
        background-size: cover;
    }
</style>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <form class="border shadow p-4 rounded" action="php/updateReq.php" method="post" style="width: 600px; background-color: white">

            <h4 class="text-center p-3">IT Staff Management</h4><hr>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="agent">Agent</label>
                <input type="text" class="form-control" id="agent" name="agent" value="<?= htmlspecialchars($row['agent']); ?>" autocomplete="off" readonly>
            </div>

            <label> Asset Type </label>
            <select class="form-control" name="device">
                <option disabled>Select Asset Type</option>
                <?php
                // Include the database connection
                include "../db_conn.php";

                // Fetch distinct device types from the database
                $query = "SELECT DISTINCT device FROM asset";
                $result = mysqli_query($conn, $query);

                // Check if there are rows in the result
                if (mysqli_num_rows($result) > 0) {
                    // Loop through the rows and populate the dropdown
                    while ($deviceRow = mysqli_fetch_assoc($result)) {
                        $selected = ($deviceRow['device'] == $row['device']) ? 'selected' : '';
                        echo '<option value="' . $deviceRow['device'] . '" ' . $selected . '>' . $deviceRow['device'] . '</option>';
                    }
                }
                ?>
            </select><br>

            <label> Asset Brand Name </label>
			<select class="form-control" name="brand">
    		<option disabled>Select Asset Brand Name</option>
    			<?php
    			// Fetch distinct device types from the database
    			$query = "SELECT DISTINCT brand FROM asset";
    			$result = mysqli_query($conn, $query);

    			// Check if there are rows in the result
    			if (mysqli_num_rows($result) > 0) {
        		// Loop through the rows and populate the dropdown
        		while ($brandRow = mysqli_fetch_assoc($result)) {
            	$selected = ($brandRow['brand'] == $row['brand']) ? 'selected' : '';
            	echo '<option value="' . $brandRow['brand'] . '" ' . $selected . '>' . $brandRow['brand'] . '</option>';
        				}
    				}
    			?>
			</select><br>

			<label> Asset Specifications </label>
			<select class="form-control" name="specs">
    		<option disabled>Select Asset Specifications</option>
    			<?php
    			// Fetch distinct device types from the database
    			$query = "SELECT DISTINCT specs FROM asset";
    			$result = mysqli_query($conn, $query);

    			// Check if there are rows in the result
    			if (mysqli_num_rows($result) > 0) {
        		// Loop through the rows and populate the dropdown
        		while ($specsRow = mysqli_fetch_assoc($result)) {
            	$selected = ($specsRow['specs'] == $row['specs']) ? 'selected' : '';
            	echo '<option value="' . $specsRow['specs'] . '" ' . $selected . '>' . $specsRow['specs'] . '</option>';
        				}
    				}
    			?>
			</select><br>

			<label> Asset Serial Number </label>
			<select class="form-control" name="serialno">
    		<option disabled>Select exact Asset Serial Number</option>
    			<?php
    			// Fetch distinct device types from the database
    			$query = "SELECT DISTINCT serialno FROM asset";
    			$result = mysqli_query($conn, $query);

    			// Check if there are rows in the result
    			if (mysqli_num_rows($result) > 0) {
        		// Loop through the rows and populate the dropdown
        		while ($serialnoRow = mysqli_fetch_assoc($result)) {
            	$selected = ($serialnoRow['serialno'] == $row['serialno']) ? 'selected' : '';
            	echo '<option value="' . $serialnoRow['serialno'] . '" ' . $selected . '>' . $serialnoRow['serialno'] . '</option>';
        				}
    				}
    			?>
			</select><br>


            <div class="mb-3">
                <label for="daterel">Date Released</label>
                <input type="date" class="form-control" id="daterel" name="daterel" value="<?= htmlspecialchars($row['daterel']); ?>">
            </div>

            <div class="mb-1">
                <label class="form-label">Status:</label>
            </div>

            <select class="form-control" name="status" aria-label="Default select example" value="<?= htmlspecialchars($row['status']); ?>">
				<option disabled> Please select..</option>
				<option selected value="Pending">Pending</option>
				<option value="Deployed">Deployed</option>
				<option value="Returned">Returned</option>
			</select><br>

            <!-- Add a hidden input field for the user ID -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">

            <button type="submit" class="btn btn-success" name="update" style="width:100%; margin-bottom:5px;">Update</button>
            <a href="home.php" style="width: 100%" class="btn btn-secondary">Back</a>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var serialnoInput = document.getElementById("serialno");
                    serialnoInput.addEventListener("input", function(e) {
                        this.value = this.value.replace(/\D/g, ''); // Allow only numeric values
                    });
                });
            </script>
        </form>
    </div>
</body>

</html>